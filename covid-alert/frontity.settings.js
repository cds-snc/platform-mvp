const settings = {
  name: "tax-benefits",
  state: {
    frontity: {
      title: "-",
      description: "-",
    },
  },
  packages: [
    {
      name: "@cdssnc/cds-docs-theme",
      state: {
        theme: {
          menu: [],
          featured: {
            showOnList: false,
            showOnPost: false,
          },
        },
      },
    },
    {
      name: "@frontity/wp-source",
      state: {
        source: {
          url: "https://platform.digital.canada.ca/covid-alert/",
          homepage:"/home",
        },
      },
      
    },
    "@frontity/tiny-router",
    "@frontity/html2react",
  ],
};

export default settings;
