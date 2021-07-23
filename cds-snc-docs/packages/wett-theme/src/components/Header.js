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

          <section
            id="wb-srch"
            className="col-lg-offset-4 col-md-offset-4 col-sm-offset-2 col-xs-12 col-sm-5 col-md-4"
          >
            <h2>Search</h2>
            <form action="#" method="post" name="cse-search-box" role="search">
              <div className="form-group wb-srch-qry">
                <label for="wb-srch-q" className="wb-inv">
                  Search Canada.ca
                </label>
                <input
                  id="wb-srch-q"
                  list="wb-srch-q-ac"
                  className="wb-srch-q form-control"
                  name="q"
                  type="search"
                  size="34"
                  maxLength="170"
                  placeholder="Search Canada.ca"
                />
                <datalist id="wb-srch-q-ac"></datalist>
              </div>

              <div className="form-group submit">
                <button
                  type="submit"
                  id="wb-srch-sub"
                  className="btn btn-primary btn-small"
                  name="wb-srch-sub"
                >
                  <span className="glyphicon-search glyphicon"></span>
                  <span className="wb-inv">Search</span>
                </button>
              </div>
            </form>
          </section>

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
          <ul
            role="menu"
            aria-orientation="vertical"
            data-ajax-replace="https://www.canada.ca/content/dam/canada/sitemenu/sitemenu-v2-en.html"
          >
            <li role="presentation">
              <a
                role="menuitem"
                href="https://www.canada.ca/en/services/jobs.html"
              >
                Jobs and the workplace
              </a>
            </li>
            <li role="presentation">
              <a
                role="menuitem"
                href="https://www.canada.ca/en/services/immigration-citizenship.html"
              >
                Immigration and citizenship
              </a>
            </li>
            <li role="presentation">
              <a role="menuitem" href="https://travel.gc.ca/">
                Travel and tourism
              </a>
            </li>
            <li role="presentation">
              <a
                role="menuitem"
                href="https://www.canada.ca/en/services/business.html"
              >
                Business and industry
              </a>
            </li>
            <li role="presentation">
              <a
                role="menuitem"
                href="https://www.canada.ca/en/services/benefits.html"
              >
                Benefits
              </a>
            </li>
            <li role="presentation">
              <a
                role="menuitem"
                href="https://www.canada.ca/en/services/health.html"
              >
                Health
              </a>
            </li>
            <li role="presentation">
              <a
                role="menuitem"
                href="https://www.canada.ca/en/services/taxes.html"
              >
                Taxes
              </a>
            </li>
            <li role="presentation">
              <a
                role="menuitem"
                href="https://www.canada.ca/en/services/environment.html"
              >
                Environment and natural resources
              </a>
            </li>
            <li role="presentation">
              <a
                role="menuitem"
                href="https://www.canada.ca/en/services/defence.html"
              >
                National security and defence
              </a>
            </li>
            <li role="presentation">
              <a
                role="menuitem"
                href="https://www.canada.ca/en/services/culture.html"
              >
                Culture, history and sport
              </a>
            </li>
            <li role="presentation">
              <a
                role="menuitem"
                href="https://www.canada.ca/en/services/policing.html"
              >
                Policing, justice and emergencies
              </a>
            </li>
            <li role="presentation">
              <a
                role="menuitem"
                href="https://www.canada.ca/en/services/transport.html"
              >
                Transport and infrastructure
              </a>
            </li>
            <li role="presentation">
              <a
                role="menuitem"
                href="https://international.gc.ca/world-monde/index.aspx?lang=eng"
              >
                Canada and the world
              </a>
            </li>
            <li role="presentation">
              <a
                role="menuitem"
                href="https://www.canada.ca/en/services/finance.html"
              >
                Money and finances
              </a>
            </li>
            <li role="presentation">
              <a
                role="menuitem"
                href="https://www.canada.ca/en/services/science.html"
              >
                Science and innovation
              </a>
            </li>
          </ul>
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
