const settings = {
  name: "tax-benefits",
  state: {
    frontity: {
      title: "Claim tax benefits documentation",
      description: "Help low-income Canadians file taxes to access their benefits",
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
          url: "https://platform.digital.canada.ca/tax-benefits",
          homepage:"/home",
        },
      },
      
    },
    "@frontity/tiny-router",
    "@frontity/html2react",
  ],
};

export default settings;
