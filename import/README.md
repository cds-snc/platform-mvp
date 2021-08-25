# Import script

This script will create posts on your local wordpress environment

## Usage

Npm command:
```bash
npm run import --file=[path/to/file]
```

example:
```bash
npm run import --file=imports/export_public_templates.json
```

For debugging, this was an easy command for me to use:
```bash
(npm run import --file=imports/export_public_templates.json | tee import.log) 3>&1 1>&2 2>&3 | tee import.error.log
```