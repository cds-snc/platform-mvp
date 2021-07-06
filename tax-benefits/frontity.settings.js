const settings = {
  name: "tax-benefits",
  packages: [
    {
      name: "@frontity/mars-theme",
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
