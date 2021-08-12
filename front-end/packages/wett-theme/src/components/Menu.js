import React from "react";
import { connect } from "frontity";
import Link from "@frontity/components/link";

const isActive = (state, link) => {
  const current = state.router.link;
  if (`${state.source.url}${current}` === link) {
    return "sidebar-nav-active";
  }
  return null;
};

// https://www.canada.ca/content/dam/canada/sitemenu/sitemenu-v2-en.html

const Menu = ({ state }) => {
  const items = state.source.get(`/menu/${state.frontity.menuUrl}/`).items;

  if (!items) {
    return null;
  }

  return (
    <ul role="menu" aria-orientation="vertical">
      {items.map((item) => {
        if (!item.child_items) {
          return (
            <li key={item.ID} className={isActive(state, item.url)} role="presentation">
              <Link  role="menuitem" link={item.url}>{item.title}</Link>
            </li>
          );
        } else {
          const childItems = item.child_items;
          return (
            <li key={item.ID} className={isActive(state, item.url)} >
              <Link role="menuitem" link={item.url}>{item.title}</Link>
              <ul id={item.ID}>
                {childItems.map((childItem) => {
                  return (
                    <li
                      className={`sub-link ${isActive(state, childItem.url)}`}
                      key={childItem.ID}
                      role="presentation"
                    >
                      <Link link={childItem.url}>{childItem.title}</Link>
                    </li>
                  );
                })}
              </ul>
            </li>
          );
        }
      })}
    </ul>
  );
};

export default connect(Menu);
