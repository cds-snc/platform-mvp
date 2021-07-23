export const main = {
    name: "main",
    match: [".*https?://localhost:3000"],
    state: {
      frontity: {
        title: "Main",
        description:
          "Main website",
        url: "http://localhost:3000",
      },
    },
    packages: [
      {
        name: "@frontity/wp-source",
        state: {
          source: {
            url: "https://platform.digital.canada.ca/docs",
            homepage: "/docs",
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
  