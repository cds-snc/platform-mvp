import React from "react";
import { connect } from "frontity";
import Link from "@frontity/components/link";

const languageToggle = (state) => {
  const items = state.source.get(`/menu/${state.theme.languageUrl}/`).items;

  if (items && items[0]) {
    return <Link link={items[0].url}>{items[0].title}</Link>;
  }

  return null;
};

export const Header = ({ state }) => {
  const { name } = state.source.get("nameAndDescription");
  return (
    <header>
      <div className="wrap">
        <div className="site-title">
          <Link className="title-link" link="/">
            {name}
          </Link>
        </div>
        <h2 className="float-right">{languageToggle(state)}</h2>
      </div>
    </header>
  );
};

export default connect(Header);
