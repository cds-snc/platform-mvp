import Theme from "./components/_layout";
import image from "@frontity/html2react/processors/image";
import iframe from "@frontity/html2react/processors/iframe";
import link from "@frontity/html2react/processors/link";
import menuHandler from "./components/handlers/menu-handler";

import {divClass} from "./divClass";

const beforeSSR = async ({ state, libraries, actions }) => {
  await actions.source.fetch(`/menu/${state.frontity.menuUrl}/`);
  await actions.source.fetch(`/menu/${state.frontity.footerUrl}/`);
  await actions.source.fetch(`/menu/${state.frontity.languageUrl}/`);
  // Add image processor.
  libraries.html2react.processors.push(image);
  libraries.html2react.processors.push(divClass);
};

const beforeCSR = ({ libraries }) => {
  // Add image processor.
  libraries.html2react.processors.push(image);
  libraries.html2react.processors.push(divClass);
};

const cdsDocsTheme = {
  name: "cds-docs-theme",
  roots: {
    /**
     * In Frontity, any package can add React components to the site.
     * We use roots for that, scoped to the `theme` namespace.
     */
    theme: Theme,
  },
  state: {
    /**
     * State is where the packages store their default settings and other
     * relevant state. It is scoped to the `theme` namespace.
     */
    theme: {
      autoPrefetch: "in-view",
      menu: [],
      featured: {
        showOnList: false,
        showOnPost: false,
      },
    },
  },

  /**
   * Actions are functions that modify the state or deal with other parts of
   * Frontity like libraries.
   */
  actions: {
    theme: {
      beforeSSR: beforeSSR,
      beforeCSR: beforeCSR,
    },
  },
  libraries: {
    html2react: {
      /**
       * Add a processor to `html2react` so it processes the `<img>` tags
       * and internal link inside the content HTML.
       * You can add your own processors too.
       */
      processors: [image, iframe, link, divClass],
    },
    source: {
      handlers: [menuHandler],
    },
  },
};

export default cdsDocsTheme;
