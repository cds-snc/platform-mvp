const awsServerlessExpress = require("aws-serverless-express");
const app = require("./build/server.js").default;
const server = awsServerlessExpress.createServer(app);
const path = require("path");
const FileHandler = require("serverless-aws-static-file-handler");

// Handle routing to Frontity Server
exports.handler = (event, context) => {
  awsServerlessExpress.proxy(server, event, context);
};

// Handle returning all static files located in `/build/static/`
const StaticFilesPath = path.join(__dirname, "./build/static/");
const staticFileHandler = new FileHandler(StaticFilesPath);
exports.static = async (event, context) => {
  if (!event.path.startsWith("/static/")) {
    throw new Error(`[404] Invalid filepath for this resource: ${fname}`);
  }
  let response = await staticFileHandler.get(event, context);
  response.headers = {
    'Content-Type': response.headers["Content-Type"],
    'Cache-Control': 'max-age=31536000',
 }
 return response;
};

// Handle returning `favicon.ico` file in the project root
const RootFilesPath = path.join(__dirname);
const rootFileHandler = new FileHandler(RootFilesPath);
exports.favicon = async (event, context) => {
  return rootFileHandler.get(event, context);
}