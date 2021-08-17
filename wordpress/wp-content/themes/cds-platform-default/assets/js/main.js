(function ($) {
  /*
  |--------------------------------------------------------------------------
  | NAVBAR
  |--------------------------------------------------------------------------
  */
  var scrollPosition;
  $(".navbar-toggler").toggle(
    function () {
      scrollPosition = window.pageYOffset;
      $("body")
        .css("top", -scrollPosition + "px")
        .addClass("no-scroll");
      $("#navbarContainer, #navbarMenu").collapse("show");
    },
    function () {
      $("body").removeClass("no-scroll");
      $("#navbarContainer, #navbarMenu").collapse("hide");
      $(window).scrollTop(scrollPosition);
    }
  );

  var headerHeight = 0;
  if (
    $("#header").css("position") == "sticky" ||
    $("#header").css("position") == "-webkit-sticky"
  ) {
    headerHeight = $("#header").outerHeight();
    // console.log('+sticks', headerHeight);
  }

  //This wont do anything... wpadmin is not loaded when this script runs
  if ($("#wpadminbar").length) {
    if ($("#wpadminbar").css("position") == "fixed") {
      headerHeight += $("#wpadminbar").outerHeight();
      // console.log('+adminbar', headerHeight);
    }
  }

  /*
  |--------------------------------------------------------------------------
  | DOCUMENT STATES
  |--------------------------------------------------------------------------
  */
  $(document).ready(function () {});
  $(window).resize(function () {});
})(jQuery);

/*
|--------------------------------------------------------------------------
| Loadmore
|--------------------------------------------------------------------------
*/

(function ($) {
  if ($(".btn-loadmore").length || $(".platform-loader").length) {
    var waitForRequestCompletion = false;

    if (platform_ajax.max_page == 0) {
      $(".load-more").addClass("d-none");
      return;
    }
    $(".btn-loadmore").click(function (e) {
      // Don't actually follow the href in the <a>
      e.preventDefault();

      var button = $(this),
        data = {
          action: "platform_loadmore",
          query: platform_ajax.posts, // that's how we get params from wp_localize_script() function
          page: platform_ajax.current_page,
        },
        results = $("#main__content");

      // console.log(data, platform_ajax);

      $.ajax({
        // you can also use $.post here
        url: platform_ajax.ajaxurl, // AJAX handler
        data: data,
        type: "POST",
        beforeSend: function (xhr) {
          button.text("Loading..."); // change the button text, you can also add a preloader image
        },
        success: function (data) {
          if (data) {
            button.text("Load More Designs"); // insert new posts
            results.append(data);
            platform_ajax.current_page++;

            if (platform_ajax.current_page == platform_ajax.max_page)
              button.remove(); // if last page, remove the button

            // you can also fire the "post-load" event here if you use a plugin that requires it
            // $( document.body ).trigger( 'post-load' );
          } else {
            button.remove(); // if no data, remove the button as well
          }
        },
      });
    });
    if ($(".platform-loader").length) {
      $(document).scroll(function () {
        var loader = $(".platform-loader"),
          data = {
            action: "platform_loadmore",
            query: platform_ajax.posts, // that's how we get params from wp_localize_script() function
            page: platform_ajax.current_page,
          },
          results = $("#main__content");

        if (
          loader.get(0).getBoundingClientRect().top - window.innerHeight <
            200 &&
          !waitForRequestCompletion &&
          platform_ajax.max_page > 0
        ) {
          // console.log(data, platform_ajax);

          $.ajax({
            // you can also use $.post here
            url: platform_ajax.ajaxurl, // AJAX handler
            data: data,
            type: "POST",
            beforeSend: function (xhr) {
              loader.removeClass("d-none");
              waitForRequestCompletion = true;
            },
            success: function (data) {
              if (data) {
                loader.addClass("d-none"); // insert new posts
                results.append(data);
                waitForRequestCompletion = false;
                platform_ajax.current_page++;

                if (platform_ajax.current_page == platform_ajax.max_page)
                  loader.addClass("d-none"); // if last page, remove the button

                // you can also fire the "post-load" event here if you use a plugin that requires it
                // $( document.body ).trigger( 'post-load' );
              } else {
                loader.addClass("d-none"); // if no data, remove the button as well
              }
            },
          });
        }
      });
    }
  }
})(jQuery);
