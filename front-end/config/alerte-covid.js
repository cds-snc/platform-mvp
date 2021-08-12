export const alerteCovid = {
  name: "alerte-covid",
  match: [".*https?://localhost:8001", "\/alerte-covid"],
  state: {
    frontity: {
      title: "Alerte COVID",
      description:
        "Alerte COVID est l'application gratuite de notification d'exposition du Canada.",
      url: "https://platform.cdssandbox.xyz/alerte-covid",
      menuUrl: "main-fr",
      footerUrl: "footer-fr",
      languageUrl: "language-fr",
    },
  },
  packages: [
    {
      name: "@frontity/wp-source",
      state: {
        source: {
          url: "https://platform.digital.canada.ca/covid-alert/fr",
          homepage: "/alerte-covid",
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
