import Theme from "./components/_layout";
import image from "@frontity/html2react/processors/image";
import iframe from "@frontity/html2react/processors/iframe";
import link from "@frontity/html2react/processors/link";

const beforeSSR = async ({ state, libraries, actions }) => {
  await actions.source.fetch(`/menu/${state.frontity.menuUrl}/`);
  await actions.source.fetch(`/menu/${state.frontity.footerUrl}/`);
  await actions.source.fetch(`/menu/${state.frontity.languageUrl}/`);
  // Add image processor.
  libraries.html2react.processors.push(image);
};

const beforeCSR = ({ libraries }) => {
  // Add image processor.
  libraries.html2react.processors.push(image);
};

export default {
  name: "wett-theme",
  roots: {
    wett: Theme,
  },
  state: {
    wett: {}
  },
  actions: {
    wett: {
      beforeSSR: beforeSSR,
      beforeCSR: beforeCSR,
    }
  },
  libraries: {
    html2react: {
      /**
       * Add a processor to `html2react` so it processes the `<img>` tags
       * and internal link inside the content HTML.
       * You can add your own processors too.
       */
       processors: [image, iframe, link],
    },
    source: {
      handlers: [],
    },
  },
};
