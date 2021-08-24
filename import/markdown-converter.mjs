// This script is taken from the gutenberg markdown converter (link below):
// https://github.com/WordPress/gutenberg/blob/3da717b8d0ac7d7821fc6d0475695ccf3ae2829f/packages/blocks/src/api/raw-handling/markdown-converter.js
//
// License:
// 
// Gutenberg
// Copyright 2016-2021 by the contributors
// License for Contributions (on and after April 15, 2021)
// All code contributed to the Gutenberg project is dual-licensed, and released under both of the following licenses:
// the GNU General Public License as published by the Free Software Foundation; either version 2 of the License or (at your option) any later version (the “GPL”) and the Mozilla Public License, Version 2.0 (the “MPL”).

/**
 * External dependencies
 */
 import showdown from 'showdown';

 // Reuse the same showdown converter.
 const converter = new showdown.Converter( {
     noHeaderId: true,
     tables: true,
     literalMidWordUnderscores: true,
     omitExtraWLInCodeBlocks: true,
     simpleLineBreaks: true,
     strikethrough: true,
 } );
 
 /**
  * Corrects the Slack Markdown variant of the code block.
  * If uncorrected, it will be converted to inline code.
  *
  * @see https://get.slack.help/hc/en-us/articles/202288908-how-can-i-add-formatting-to-my-messages-#code-blocks
  *
  * @param {string} text The potential Markdown text to correct.
  *
  * @return {string} The corrected Markdown.
  */
 function slackMarkdownVariantCorrector( text ) {
     return text.replace(
         /((?:^|\n)```)([^\n`]+)(```(?:$|\n))/,
         ( match, p1, p2, p3 ) => `${ p1 }\n${ p2 }\n${ p3 }`
     );
 }
 
 /**
  * Converts a piece of text into HTML based on any Markdown present.
  * Also decodes any encoded HTML.
  *
  * @param {string} text The plain text to convert.
  *
  * @return {string} HTML.
  */
 export default function markdownConverter( text ) {
     return converter.makeHtml( slackMarkdownVariantCorrector( text ) );
 }