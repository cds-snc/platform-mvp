import React from "react";
import { connect } from "frontity";
import Link from "@frontity/components/link";


const Footer = ({ state }) => {
  const items = state.source.get(`/menu/${state.frontity.footerUrl}/`).items;
  
  if (!items) return null;

  return (
    <footer>
      <div className="wrap">
        {items.map((item) => {
          return <Link key={item.ID} link={item.url}>{item.title}</Link>;
        })}
      </div>
    </footer>
  );
};

export default connect(Footer);
