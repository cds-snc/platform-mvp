const gettextTwigParser = require('@dreamproduction/gettext-twig-parser');

gettextTwigParser.parse({
  options: {
    textdomain: 'cds-snc',
    add_textdomain: true,
    output_dir: '.cache/',
    output_filename: 'strings.php',
  },
  files: ['./templates/**/*.twig'],
});
