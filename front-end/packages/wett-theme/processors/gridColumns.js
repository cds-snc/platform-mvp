export const gridColumns = {
  name: "grid-columns",
  priority: 10,
  // Only process the node it if it's an anchor and href starts with http.
  test: ({ node }) => {
    return node.component === "div";
  },
  // Add the target attribute.
  processor: ({ node }) => {
    if (node.props.className.indexOf("wp-block-columns") !== -1) {
      console.log("children.length", node.children.length);
      
      if(node.children.length){
        
      }

      //node.children.props.className = "provisional gc-table table wb-tables";
    }
    return node;
  },
};
