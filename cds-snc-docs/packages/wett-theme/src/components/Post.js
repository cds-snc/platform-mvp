import { useEffect } from "react";
import { connect } from "frontity";

const Post = ({ state, actions, libraries }) => {
  // Get information about the current URL.
  const data = state.source.get(state.router.link);
  // Get the data of the post.
  const post = state.source[data.type][data.id];

  // Get the html2react component.
  const Html2React = libraries.html2react.Component;

  /**
   * Once the post has loaded in the DOM, prefetch both the
   * home posts and the list component so if the user visits
   * the home page, everything is ready and it loads instantly.
   */
  useEffect(() => {
    actions.source.fetch("/");
  }, [actions.source]);

  // Load the post, but only if the data is ready.
  return data.isReady ? (
    <main
      property="mainContentOfPage"
      className="container"
      resource="#wb-main"
      typeof="WebPageElement"
    >
      <h1 className="page-title">
        <Html2React html={post.title.rendered} />
      </h1>
      <Html2React html={post.content.rendered} />
    </main>
  ) : null;
};

export default connect(Post);
