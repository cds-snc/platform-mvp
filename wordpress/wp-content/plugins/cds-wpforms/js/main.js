(function ($) {
       $("input[id^='wpforms-']").focus(function () {

              var elId = $(this).attr('id');
              $("label[for='"+elId+"']").addClass("focus-colour");
       });

       $("input[id^='wpforms-']").blur(function () {
              var elId = $(this).attr('id');
              $("label[for='"+elId+"']").removeClass("focus-colour");
       });
})(jQuery);