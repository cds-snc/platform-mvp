import { readFileSync } from 'fs';
import { spawn } from 'child_process';
import markdownConverter from "./markdown-converter.js";

export default class Importer {

    static importCount = {
        success: 0,
        failure: 0,
        skipped: 0,
        total: 0
    }

    static processNotifyTemplate = (filename, timeout) => {
        // Handle notify json template and create wp posts for each item
        let rawdata = readFileSync(filename);
        let contents = JSON.parse(rawdata);

        const getTitleAndBody = (subject, content) => {
            // Parse subject and content to get the title and body
            let title = content.split('\r\n')[0]
            
            if(title.length >= 100 && subject){
                title = subject
            } else {
                content = content.substring(title.length).trim()
            }

            if(title.startsWith("#")){
                title = title.substring(1).trim()
            }

            return {
                title: title,
                body: markdownConverter(content)
            }
        }

        Importer.importCount.total = contents.length

        let queuedContents = []
    
        contents.forEach(item => {
            const post = {
                ...getTitleAndBody(item.subject, item.content),
                name: item.name,
                createDate: item.created_at,
                guid: item.id
            }
            if( item.archived ){
                Importer.importCount.skipped++
            } else {
                queuedContents.push(post)
            }
        })

        console.log('Attempting to import', queuedContents.length, 'items. (Skipping', Importer.importCount.skipped,'archived items)')

        Importer.queuePostCreate(queuedContents, 0, timeout)

    }

    static wpPostCreate = ({body, title, name, createDate, guid}, attempts = 0) => {
        // Create post in wordpress using wp cli

        const getFormattedDate = (dateStr) => {
            // Returns formatted date string yyyy-mm-dd hh:mm:ss
            let cDate = new Date(dateStr)
            if(cDate instanceof Date && !isNaN(cDate)){
                const offset = cDate.getTimezoneOffset()
                cDate = new Date(cDate.getTime() - (offset*60*1000))
                const formattedDate = cDate.toISOString().split('T')[0] + ' ' + cDate.toISOString().split('T')[1].split('.')[0]
                return formattedDate
            }
            return ''
        }

        async function checkIfExists (guid) {
            // Check if post already exists in wordpress
            let exists = false
            const check_exists = spawn("docker", ["exec", "cli", "/usr/local/bin/wp", "--path=/var/www/html", 
                                        "db", "query",
                                        `select json_object('id', id) from wp_posts where guid like "%${guid}"`])
            for await (const data of check_exists.stdout) {
                let outputArr = data.toString().split('\n').slice(1)
                if(JSON.parse(outputArr[0]).id){
                    exists = true
                }
                return exists
            }
    
            check_exists.on('exit', function() {
                return exists
            })
        }

        const create = (body, title, name, createDate, guid) => {
            // Create post in wordpress
            const create_post = spawn("docker", ["exec", "cli", "/usr/local/bin/wp", "--path=/var/www/html", 
                "post", "create",
                `--post_content=${body}`,
                `--post_title=${title}`,
                `--post_name=${name}`,
                `--post_date=${getFormattedDate(createDate)}`,
                `--guid=${guid}`
            ])

            // WP CLI output
            create_post.stdout.on('data', (data   ) => {
                if(data.toString().includes("Success: Created post")){
                    Importer.importCount.success++
                }
                console.log({
                    'title': title,
                    // 'item': body,
                    'guid': guid,
                    'msg': data.toString(),
                    'count': `${Importer.importCount.success} (${Importer.importCount.skipped}) / ${Importer.importCount.total}`
                })
            })

            // WP CLI Errors
            create_post.stderr.on('data', (data) => {
                Importer.importCount.failure++
                console.error({
                    'title': title,
                    // 'item': body,
                    'msg': `ERROR: ${data.toString()}`,
                    'count': `${Importer.importCount.failure} / ${Importer.importCount.total}`
                })
            })
        }

        // Create post, but skip if there already is one in wordpress
        checkIfExists(guid).then((exists) => {
            if( !exists ){
                create(body, title, name, createDate, guid)
            } else {
                Importer.importCount.skipped++
            }
        })
    
    }

    static queuePostCreate = (item, i=0, timeout=3000) => {
        if(i < item.length){
            setTimeout(() => {
                do {
                    Importer.wpPostCreate(item[i])
                    i++
                } while (i % 5 !=0 && i < item.length)

                Importer.queuePostCreate(item, i, timeout)
            }, timeout)
        }
    }
}