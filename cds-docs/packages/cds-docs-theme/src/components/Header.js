import React from "react";
import { connect} from "frontity";
export const Header = ({ state }) => {
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
          <a href="#">FR</a>
        </h2>
      </div>
    </header>
  );
};

export default connect(Header);
