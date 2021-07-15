export const covidAlertFr = {
  name: "covid-alert-fr",
  match: [
    ".*https?://localhost:4000",
    ".*https?://platform-covid-alert-fr.herokuapp.com",
  ],
  state: {
    frontity: {
      title: "Alerte COVID",
      description:
        "Alerte COVID est l'application gratuite de notification d'exposition du Canada.",
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
      name: "cds-docs-theme",
    },
    "@frontity/tiny-router",
    "@frontity/html2react",
  ],
};
