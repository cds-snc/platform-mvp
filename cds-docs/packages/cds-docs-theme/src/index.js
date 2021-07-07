const Root = () => {
  return (
    <>
      You can edit your package in:
      <pre>packages/cds-docs-theme/src/index.js</pre>
    </>
  );
};

export default {
  name: "cds-docs-theme",
  roots: {
    cds: Root
  },
  state: {
    cds: {}
  },
  actions: {
    cds: {}
  }
};
