import React from "react";
import { connect } from "frontity";
import Link from "@frontity/components/link";
export const Header = ({ state, actions }) => {
  const { name } = state.source.get("nameAndDescription");
  return (
    <header>
      <div className="wrap">
        <div className="site-title">
          <a className="title-link" href="#">
            {name}
          </a>
        </div>
        <h2 className="float-right">
          <Link link="#" onClick={actions.theme.toggleLanguage}>
            {state.theme.lang == "en" ? "Français" : "English"}
          </Link>
        </h2>
      </div>
    </header>
  );
};

export default connect(Header);
