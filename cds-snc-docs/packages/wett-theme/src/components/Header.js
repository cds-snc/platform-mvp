import Menu from "./Menu"

export const Header = () => {
  return (
    <header>
      <div id="wb-bnr" className="container">
        <div className="row">
          <section
            id="wb-lng"
            className="col-xs-3 col-sm-12 pull-right text-right"
          >
            <h2 className="wb-inv">Language selection</h2>
            <ul className="list-inline mrgn-bttm-0">
              <li>
                <a lang="fr" hrefLang="fr" href="#">
                  <span className="hidden-xs">Français</span>
                  <abbr
                    title="Français"
                    className="visible-xs h3 mrgn-tp-sm mrgn-bttm-0 text-uppercase"
                  >
                    fr
                  </abbr>
                </a>
              </li>
            </ul>
          </section>

          {/* */}

          <div
            className="brand col-xs-9 col-sm-5 col-md-4"
            property="publisher"
            resource="#wb-publisher"
            typeof="GovernmentOrganization"
          >
            <a href="https://www.canada.ca/en.html" property="url">
              <img
                src="https://wet-boew.github.io/themes-dist/GCWeb/GCWeb/assets/sig-blk-en.svg"
                alt=""
                property="logo"
              />
              <span className="wb-inv" property="name">
                {" "}
                Government of Canada /{" "}
                <span lang="fr">Gouvernement du Canada</span>
              </span>
            </a>
            <meta property="areaServed" typeof="Country" content="Canada" />
            <link
              property="logo"
              href="https://wet-boew.github.io/themes-dist/GCWeb/GCWeb/assets/wmms-blk.svg"
            />
          </div>
          {/* */}
        </div>
      </div>

      <nav className="gcweb-menu" typeof="SiteNavigationElement">
        <div className="container">
          <h2 className="wb-inv">Menu</h2>
          <button type="button" aria-haspopup="true" aria-expanded="false">
            <span className="wb-inv">Main </span>Menu{" "}
            <span className="expicon glyphicon glyphicon-chevron-down"></span>
          </button>

          <Menu />
          
        </div>
      </nav>
      <nav id="wb-bc" property="breadcrumb">
        <h2>You are here:</h2>
        <div className="container">
          <ol className="breadcrumb">
            <li>
              <a href="https://www.canada.ca/en.html">Canada.ca</a>
            </li>
          </ol>
        </div>
      </nav>
    </header>
  );
};
