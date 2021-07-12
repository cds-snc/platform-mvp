import React from "react";
import { connect } from "frontity";

const getLink = (item) => {
  if(!item) return null
  return <a href={item.url}>{item.title}</a>;
};

const Footer = ({ state }) => {
  const items = state.source.get(`/menu/${state.theme.footerUrl}/`).items;
  if(!items) return null
  return (
    <footer>
      <div className="wrap">
        <p>
          This project was built by the {getLink(items[0])}.
        </p>
      </div>
    </footer>
  );
};

export default connect(Footer);
