export const covidAlertFr = {
  name: "covid-alert-fr",
  match: [".*https?://localhost:4000", "\/alerte-covid"],
  state: {
    frontity: {
      title: "Alerte COVID",
      description:
        "Alerte COVID est l'application gratuite de notification d'exposition du Canada.",
      url: "https://platform.cdssandbox.xyz/alerte-covid",
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
