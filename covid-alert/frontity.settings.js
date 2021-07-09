const settings = [
  {
    name: "covid-alert",
    match: [
      ".*https?://localhost:3000",
      ".*https?://platform-covid-alert.herokuapp.com",
    ],
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
    match: [
      ".*https?://localhost:4000",
      ".*https?://platform-covid-alert-fr.herokuapp.com",
    ],
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
            homepage: "/home-fr",
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
