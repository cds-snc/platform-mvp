# Deploy scripts

These scripts will rsync files to the demo server.

## Usage

Begin by configuring your environment.

`cp .env.example .env`

There are three environment variables that need to be configured:

- `SERVER_URL` - this is the username and server url in the format `username@ip.address`
- `SERVER_PATH` - this is the absolute path to the wp-content directory on the server
- `PEMFILE` - this is a relative path to the pem key file

With those variable configured, you can deploy plugins or themes (from within this directory):

`./plugin [plugin-name]`
`./theme [theme-name]`

Alternatively, you can use NPM scripts at the root of this project:

`npm run deploy-plugin [plugin-name]`
`npm run deploy-theme [theme-name]`
