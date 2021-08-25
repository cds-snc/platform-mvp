import { readFileSync } from 'fs';
import { spawn } from 'child_process';
import markdownConverter from "./markdown-converter.mjs";

export default class Importer {

    static importCount = {
        success: 0,
        failure: 0,
        skipped: 0,
        total: 0
    }

    static processNotifyTemplate = (filename) => {
        let rawdata = readFileSync(filename);
        let contents = JSON.parse(rawdata);

        const getTitleAndBody = (subject, content) => {
            let title = content.split('\r\n')[0]
            
            if(title.length >= 100 && subject){
                title = subject
            }else{
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
    
        contents.forEach(item => {
            const post = {
                ...getTitleAndBody(item.subject, item.content),
                name: item.name,
                createDate: item.created_at
            }
            if( item.archived ){
                Importer.importCount.skipped++
            } else {
                Importer.wpPostCreate(post)
            }
        })

    }

    static wpPostCreate = ({body, title, name, createDate}, attempts = 0) => {
    

        const getFormattedDate = (dateStr) => {
            // returns formatted date string yyyy-mm-dd hh:mm:ss
            let cDate = new Date(dateStr)
            if(cDate instanceof Date && !isNaN(cDate)){
                const offset = cDate.getTimezoneOffset()
                cDate = new Date(cDate.getTime() - (offset*60*1000))
                const formattedDate = cDate.toISOString().split('T')[0] + ' ' + cDate.toISOString().split('T')[1].split('.')[0]
                return formattedDate
            }
            return ''
        }

        // Pause spawning for 3 secs for every 30 commands
        if(Importer.importCount % 30 == 0){
            setTimeout(() => {
                console.log('pausing...')
            }, 3000)
        }

        const create_post = spawn("docker", ["exec", "cli", "/usr/local/bin/wp", "--path=/var/www/html", 
            "post", "create",
            `--post_content=${body}`,
            `--post_title=${title}`,
            `--post_name=${name}`,
            `--post_date=${getFormattedDate(createDate)}`
        ])

        // WP CLI output
        create_post.stdout.on('data', (data) => {
            if(data.toString().includes("Success: Created post")){
                Importer.importCount.success++
            }
            console.log({
                'title': title,
                // 'item': body,
                'msg': data.toString(),
                'count': `${Importer.importCount.success} (${Importer.importCount.skipped}) / ${Importer.importCount.total}`
            })
        });

        // WP CLI Errors
        create_post.stderr.on('data', (data) => {
            const maxAttempts = 3
            if( attempts < maxAttempts ){
                // If we spawned too many commands, the database goes away, but it restarts, so we attempt to retry
                console.error('retrying...', attempts)
                setTimeout(() => {
                    console.error('retrying', attempts+1)
                    Importer.wpPostCreate({body, title, name, createDate}, attempts + 1)
                }, 3000)
                
            } else {
                // Fail after maxAttempts
                Importer.importCount.failure++
                console.error({
                    'title': title,
                    // 'item': body,
                    'msg': `ERROR: ${data.toString()}`,
                    'count': `${Importer.importCount.failure} / ${Importer.importCount.total}`
                })
            }
        });
    }
}