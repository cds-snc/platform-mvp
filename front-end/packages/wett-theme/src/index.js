import Theme from "./components/_layout";
import image from "@frontity/html2react/processors/image";
import iframe from "@frontity/html2react/processors/iframe";
import link from "@frontity/html2react/processors/link";
import menuHandler from "./components/handlers/menu-handler";
import { borderedTable } from "../processors/borderedTable";
import { responsiveCardsTable } from "../processors/responsiveCardsTable";
import { filterableTable } from "../processors/filterableTable";
import { gridColumns } from "../processors/gridColumns";

const beforeSSR = async ({ state, libraries, actions }) => {
  await actions.source.fetch(`/menu/${state.frontity.menuUrl}/`);
  // Add image processor.
  libraries.html2react.processors.push(image);
  libraries.html2react.processors.push(borderedTable);
  libraries.html2react.processors.push(responsiveCardsTable);
  libraries.html2react.processors.push(filterableTable);
  libraries.html2react.processors.push(gridColumns);
};

const beforeCSR = ({ libraries }) => {
  // Add image processor.
  libraries.html2react.processors.push(image);
  libraries.html2react.processors.push(borderedTable);
  libraries.html2react.processors.push(responsiveCardsTable);
  libraries.html2react.processors.push(filterableTable);
  libraries.html2react.processors.push(gridColumns);
};

export default {
  name: "wett-theme",
  roots: {
    wett: Theme,
  },
  state: {
    wett: {
      autoPrefetch: "in-view",
      menu: [],
      featured: {
        showOnList: false,
        showOnPost: false,
      },
    },
  },
  actions: {
    wett: {
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
      processors: [
        image,
        iframe,
        link,
        borderedTable,
        responsiveCardsTable,
        filterableTable,
        gridColumns
      ],
    },
    source: {
      handlers: [menuHandler],
    },
  },
};
