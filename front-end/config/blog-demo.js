export const blogDemo = {
  name: "blog-demo",
  match: [".*https?://localhost:12000", "\/blog-demo"],
  state: {
    frontity: {
      title: "Blog Demo",
      description:
        "-",
      url: "https://platform.digital.canada.ca/blog-demo/",
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
          url: "https://platform.digital.canada.ca/blog-demo",
          homepage: "/blog-demo",
        },
      },
    },

    {
      name: "@frontity/twentytwenty-theme",
      state: {
        theme: {
          menu: [
            ["Home", "/"],
            ["Nature", "/category/nature/"],
            ["Travel", "/category/travel/"],
            ["Japan", "/tag/japan/"],
            ["About Us", "/about-us/"]
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
