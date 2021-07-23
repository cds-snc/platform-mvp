import { Global, connect, Head } from "frontity";

import Switch from "@frontity/components/switch";
import Loading from "./Loading";
import PageError from "./PageError";
import Post from "./Post";
import GCWeb from "../GCWeb/css/theme.min.css";

import Title from "./Title";

import { Header } from "./Header";
import { Footer } from "./Footer";

const Theme = ({ state }) => {
  // Get information about the current URL.
  const data = state.source.get(state.router.link);

  return (
    <>
      {/* Add some metatags to the <head> of the HTML. */}
      <Title />
      <Head>
        <meta name="description" content={state.frontity.description} />
        <html lang="en" />
        <link
          rel="stylesheet"
          href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
          crossorigin="anonymous"
        ></link>
      </Head>

      {/* Add some global styles for the whole site, like body or a's. 
        Not classes here because we use CSS-in-JS. Only global HTML tags. */}
      <Global styles={[GCWeb]} />
      <body vocab="http://schema.org/" resource="#wb-webpage" typeof="WebPage">
        <Header />
        <Switch>
          <Loading when={data.isFetching} />
          <Post when={data.isPostType} />
          <PageError when={data.isError} />
        </Switch>
        <Footer />
      </body>
    </>
  );
};

export default connect(Theme);
