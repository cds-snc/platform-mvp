import { Global, connect, Head } from "frontity";

import Switch from "@frontity/components/switch";
import Loading from "./Loading";
import PageError from "./PageError";
import Post from "./Post";

import Title from "./Title";

const Theme = ({ state }) => {
  // Get information about the current URL.
  const data = state.source.get(state.router.link);
  console.log("state", state)
  console.log("data", data.isPostType)

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

      <Switch>
        <Loading when={data.isFetching} />
        <Post when={data.isPostType} />
        <PageError when={data.isError} />
      </Switch>
    </>
  );
};

export default connect(Theme);
