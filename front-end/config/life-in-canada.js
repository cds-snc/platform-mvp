export const lifeInCanada = {
  name: "life-in-canada",
  match: [".*https?://localhost:11000", "\/life-in-canada"],
  state: {
    frontity: {
      title: "Life In Canada",
      description:
        "-",
      url: "https://platform.digital.canada.ca/life-in-canada/",
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
          url: "https://platform.digital.canada.ca/life-in-canada",
          homepage: "/life-in-canada",
        },
      },
    },
    {
      name: "wett-theme",
    },
    "@frontity/tiny-router",
    "@frontity/html2react",
  ],
};
