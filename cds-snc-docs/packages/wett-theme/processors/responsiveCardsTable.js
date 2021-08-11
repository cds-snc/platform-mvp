// https://wet-boew.github.io/GCWeb/components/gc-table/gc-table-en.html#myTable2

export const responsiveCardsTable = {
  name: "responsive-cards-table",
  priority: 1,
  // Only process the node it if it's an anchor and href starts with http.
  test: ({ node }) => {
    return node.component === "figure";
  },
  // Add the target attribute.
  processor: ({ node }) => {
    if (node.props.className.indexOf("responsive-cards") !== -1) {
      node.children[0].props.className = "provisional gc-table table";
    }
    return node;
  },
};
