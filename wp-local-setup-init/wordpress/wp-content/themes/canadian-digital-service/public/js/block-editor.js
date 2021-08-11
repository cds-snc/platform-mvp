wp.domReady(() => {
  /*
  wp.blocks.unregisterBlockStyle("core/quote", "default");
  wp.blocks.unregisterBlockStyle("core/quote", "large");
  wp.blocks.unregisterBlockStyle("core/button", "default");
  wp.blocks.unregisterBlockStyle("core/button", "fill");
  wp.blocks.unregisterBlockStyle("core/button", "outline");

  //
  const el = wp.element.createElement;
  const { registerBlockType } = wp.blocks;
  const { InnerBlocks } = wp.blockEditor;

  const BLOCKS_TEMPLATE = [
    // ["core/heading", { level: 1, content: "Start page heading" }],
    [
      "core/paragraph",
      { content: "You will need the following information to proceed:" },
    ],
    [
      "cds/callout-block",
      { text: "This application is only a demonstration purposes" },
    ],
    [
      "core/list",
      {
        values:
          "<li>The ability to copy and paste</li><li>An understanding that this is</li>",
      },
    ],
    ["core/button", { placeholder: "Start your application" }],
  ];

  registerBlockType("cds/start-page", {
    title: "Start Page",
    category: "layout",
    icon: "welcome-add-page",
    edit: (props) => {
      return el(InnerBlocks, {
        template: BLOCKS_TEMPLATE,
        templateLock: false,
      });
    },
    save: (props) => {
      return el(InnerBlocks.Content, {});
    },
  });
  */
});
