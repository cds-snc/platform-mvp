const settings = {
  name: "tax-benefits",
  state: {
    frontity: {
      url: "https://platform.digital.canada.ca/tax-benefits/",
      title: "-",
      description: "WordPress installation for Frontity development",
    },
  },
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
          url: "https://platform.digital.canada.ca/tax-benefits/",
          homepage:"/tax-benefits",
        },
      },
      
    },
    "@frontity/tiny-router",
    "@frontity/html2react",
  ],
};

export default settings;
