// https://wet-boew.github.io/GCWeb/components/gc-table/gc-table-en.html#myTable5

export const filterableTable = {
  name: "filterable-table",
  priority: 1,
  // Only process the node it if it's an anchor and href starts with http.
  test: ({ node }) => {
    return node.component === "figure";
  },
  // Add the target attribute.
  processor: ({ node }) => {
    if (node.props.className.indexOf("filterable") !== -1) {
      node.children[0].props.className = "provisional gc-table table wb-tables";
    }
    return node;
  },
};
