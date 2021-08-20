'use strict';

import { readFileSync } from 'fs';
import { spawn } from 'child_process';

importNotifyTemplates('./imports/export_public_templates.json')

/**
 * Create posts from a json formatted notify template
 * @param filename 
 */
function importNotifyTemplates(filename) {
    let rawdata = readFileSync(filename);
    let contents = JSON.parse(rawdata);

    contents.forEach(item => {
        let postTitle = item.subject
        let postBody = item.content
        let postName = item.name

        // TODO: WP CLI says post_date can be included: https://developer.wordpress.org/cli/commands/post/create/
        // However, we get the following error:
        //      ERROR [20-Aug-2021 22:44:34 UTC] PHP Warning:  checkdate() expects parameter 3 to be int, string given in /var/www/html/wp-includes/functions.php on line 6775
        //      Warning: checkdate() expects parameter 3 to be int, string given in /var/www/html/wp-includes/functions.php on line 6775
        //      Error: Invalid date.

        // let postDate = new Date(item.created_at)
        // const offset = postDate.getTimezoneOffset()
        // postDate = new Date(postDate.getTime() - (offset*60*1000))
        // const postDateFormatted = postDate.toISOString().split('T')[0] + ' ' + postDate.toISOString().split('T')[1].split('.')[0]


        const create_post = spawn("docker", ["exec", "cli", "/usr/local/bin/wp", "--path=/var/www/html", 
            "post", "create",
            `--post_content=${postBody}`,
            `--post_title='${postTitle}'`,
            `--post_name='${postName}'`,
        // `--post_date='${postDateFormatted}'`
        ])

        create_post.stdout.on('data', (data) => {
            console.log(data.toString());
        });

        create_post.stderr.on('data', (data) => {
            console.error("ERROR", data.toString());
        });

        // console.log("Post created")

    })
}