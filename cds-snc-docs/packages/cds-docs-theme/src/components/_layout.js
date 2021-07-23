import { Global, connect, Head } from "frontity";

import Switch from "@frontity/components/switch";
import Loading from "./Loading";
import PageError from "./PageError";
import Post from "./Post";

import SideNav from "./SideNav";
import Header from "./Header";
import Footer from "./Footer";
import Title from "./Title";

import normalizeCss from "../assets/css/normalize.css";
import mainCss from "../assets/css/main.css";

/**
 * Theme is the root React component of our theme. The one we will export
 * in roots.
 *
 * @param props - The props injected by Frontity's {@link connect} HOC.
 *
 * @returns The top-level react component representing the theme.
 */
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
      </Head>

      {/* Add some global styles for the whole site, like body or a's. 
      Not classes here because we use CSS-in-JS. Only global HTML tags. */}
      <Global styles={[normalizeCss, mainCss]} />

      <div className="container">
        <Header />
        <div className="wrap content">
          <SideNav />
          <Switch>
            <Loading when={data.isFetching} />
            <Post when={data.isPostType} />
            <PageError when={data.isError} />
          </Switch>
        </div>
        <Footer />
      </div>
    </>
  );
};

export default connect(Theme);
