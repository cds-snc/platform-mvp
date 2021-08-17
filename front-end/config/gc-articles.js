export const gcArticles = {
  name: "gc-articles",
  match: [".*https?://localhost:12000", "\/gc-articles"],
  state: {
    frontity: {
      title: "GC Articles",
      description:
        "-",
      url: "https://platform.digital.canada.ca/gc-articles/",
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
          url: "https://platform.digital.canada.ca/gc-articles",
          homepage: "/gc-articles",
        },
      },
    },

    {
      name: "@frontity/twentytwenty-theme",
      state: {
        theme: {
          menu: [
            ["Home", "/gc-articles/"],
            ["Nature", "/gc-articles/category/nature/"],
            ["Travel", "/gc-articles/category/travel/"],
          ],
          colors: {
            primary: "#E6324B",
            headerBg: "#ffffff",
            footerBg: "#ffffff",
            bodyBg: "#f5efe0"
          },
          showSearchInHeader: true,
          showAllContentOnArchive: false,
          featuredMedia: {
            showOnArchive: true,
            showOnPost: true
          },
          autoPreFetch: "hover",
          fontSets: "us-ascii"
        }
      }
    },


    "@frontity/tiny-router",
    "@frontity/html2react",
  ],
};
