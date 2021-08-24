import { readFileSync } from 'fs';
import { spawn } from 'child_process';
import markdownConverter from "./markdown-converter.mjs";

export default class Importer {
    static processNotifyTemplate = (filename) => {
        let rawdata = readFileSync(filename);
        let contents = JSON.parse(rawdata);
    
        contents.forEach(item => {
            const post = {
                title: markdownConverter(item.subject),
                body: markdownConverter(item.content),
                name: item.name,
                createDate: item.created_at
            }    
            Importer.wpPostCreate(post)
        })
    }

    static wpPostCreate = ({body, title, name, createDate}) => {

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

        const create_post = spawn("docker", ["exec", "cli", "/usr/local/bin/wp", "--path=/var/www/html", 
            "post", "create",
            `--post_content=${body}`,
            `--post_title=${title}`,
            `--post_name=${name}`,
            `--post_date=${getFormattedDate(createDate)}`
        ])

        // WP CLI output
        create_post.stdout.on('data', (data) => {
            console.log(data.toString());
        });

        // WP CLI Errors
        create_post.stderr.on('data', (data) => {
            console.error("ERROR", data.toString());
        });
    }
}