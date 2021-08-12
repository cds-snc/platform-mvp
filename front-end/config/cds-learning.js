export const cdsLearning = {
  name: "cds-learning",
  match: [".*https?://localhost:10000", "\/cds-learning"],
  state: {
    frontity: {
      title: "CDS Learning",
      description:
        "-",
      url: "https://platform.digital.canada.ca/cds-learning/",
      menuUrl: "main",
      footerUrl: "footer",
      languageUrl: "language",
    },
  },
  packages: [
    {
      name: "@frontity/wp-source",
      state: {
        source: {
          url: "https://platform.digital.canada.ca/cds-learning",
          homepage: "/cds-learning",
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
