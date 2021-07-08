const settings = [
  {
    name: "covid-alert",
    match: [".*https?:\/\/platform-covid-alert.herokuapp.com\$"],
    state: {
      frontity: {
        title: "-",
        description: "-",
      },
    },
    packages: [
      {
        name: "@frontity/wp-source",
        state: {
          source: {
            url: "https://platform.digital.canada.ca/covid-alert/",
            homepage: "/home",
          },
        },
      },
      {
        name: "@cdssnc/cds-docs-theme",
      },
      "@frontity/tiny-router",
      "@frontity/html2react",
    ],
  },
  {
    name: "covid-alert-fr",
    match: [".*https?:\/\/platform-covid-alert-fr.herokuapp.com\$"],
    state: {
      frontity: {
        title: "-",
        description: "-",
      },
    },
    packages: [
      {
        name: "@frontity/wp-source",
        state: {
          source: {
            url: "https://platform.digital.canada.ca/covid-alert/fr",
            homepage: "/home",
          },
        },
      },
      {
        name: "@cdssnc/cds-docs-theme",
      },
      "@frontity/tiny-router",
      "@frontity/html2react",
    ],
  },
];

export default settings;
// ?frontity_name=covid-alert-fr
