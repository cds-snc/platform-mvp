export const divClass = {
  name: "add div class",
  priority: 10,
  // Only process the node it if it's an anchor and href starts with http.
  test: ({ node }) => {
   console.log("node.component",node.component)
   return node.component === "p";
  },
  // Add the target attribute.
  processor: ({ node }) => {
    console.log("node props", node.props);
    node.props.className = "test";
    return node;
  },
};
