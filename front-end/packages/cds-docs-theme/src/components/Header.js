import React from "react";
import { connect } from "frontity";
import Link from "@frontity/components/link";

const languageToggle = (state) => {
  const items = state.source.get(`/menu/${state.frontity.languageUrl}/`).items;

  if (!items) {
    return null;
  }

  return items.map((item) => {
    return <Link key={item.ID} link={item.url}>{item.title}</Link>;
  });
};

export const Header = ({ state }) => {
  const title = state.frontity.title;
  return (
    <header>
      <div className="wrap">
        <div className="site-title">
          <Link className="title-link" link={state.frontity.url}>
            {title}
          </Link>
        </div>
        <h2 className="float-right">{languageToggle(state)}</h2>
      </div>
    </header>
  );
};

export default connect(Header);
