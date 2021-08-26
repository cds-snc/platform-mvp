# Import script

This script will create posts on your local wordpress environment. Currently, it only supports importing notify tempaltes but can be modified to include more types and templates.

### How it works
The import script uses the `wp cli` to create the posts, and does this by utilizing the `cli` container on your local machine such as `docker exec cli wp cli post create`. NodeJS calls (spawns) this command in groups of 5, with a wait time / timeout in between to give time for previous commands to finish gracefully.

The script checks the wp database for the post's guid to avoid duplication before it creates one.

## Usage

Npm command:
```bash
npm run import --file=[path/to/file]
```

The default wait time / timeout is 3 seconds. You may also change the timeout value if you find it takes too long (or goes too fast and crashes mysql):
```
npm run import --file=[path/to/file] --timeout=2000
```


example:
```bash
npm run import --file=imports/export_public_templates.json
```

For debugging, this was an easy command for me to use:
```bash
(npm run import --file=imports/export_public_templates.json --timeout=2000| tee import.log) 3>&1 1>&2 2>&3 | tee import.error.log
```