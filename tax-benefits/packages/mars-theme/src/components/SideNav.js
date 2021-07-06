import React from "react";
import { connect} from "frontity";
import Link from "@frontity/components/link";

const SideNav = ({ state }) => {
  const items = state.source.get(`/menu/${state.theme.menuUrl}/`).items;
  const { description } = state.source.get("nameAndDescription");

  if (!items) {
    return null;
  }
  return (
    <aside>
      <p className="intro">{description}</p>
      <nav className="sidebar-nav">
        <ul>
        {items.map((item) => {
          if (!item.child_items) {
            return (
              <li key={item.ID}>
                <Link  link={item.url}>
                  {item.title}
                </Link>
              </li>
            );
          } else {
            const childItems = item.child_items;
            return (
              <li key={item.ID}>
                 <Link link={item.url}>{item.title}</Link>
                <ul className="sub-menu">
                  {childItems.map((childItem) => {
                    return (
                      <li className="sub-link" key={childItem.ID}>
                        <Link  link={childItem.url}>
                          {childItem.title}
                        </Link>
                      </li>
                    );
                  })}
                </ul>
              </li>
            );
          }
        })}
        </ul>
      </nav>
    </aside>
  );
};

export default connect(SideNav);
