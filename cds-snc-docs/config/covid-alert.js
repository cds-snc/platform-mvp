export const covidAlert = {
  name: "covid-alert",
  match: [
    ".*https?://localhost:3000",
    ".*https?://platform-covid-alert.herokuapp.com",
    "\/covid-alert"
  ],
  state: {
    frontity: {
      title: "Covid Alert",
      description:
        "COVID Alert is Canada's free COVID-19 exposure notification app.",
      url: "https://platform.cdssandbox.xyz/covid-alert",
    },
  },
  packages: [
    {
      name: "@frontity/wp-source",
      state: {
        source: {
          url: "https://platform.digital.canada.ca/covid-alert",
          homepage: "/home",
        },
      },
    },
    {
      name: "cds-docs-theme",
    },
    "@frontity/tiny-router",
    "@frontity/html2react",
  ],
};
