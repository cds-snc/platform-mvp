
let content = "";

jQuery(document).ready(function($){
  $("#no-fields").html("<div>"+content+"</div>").show();
  $("li input[data-type='name']").parent().remove();
  $("li input[data-type='name']").parent().remove();
  $("li input[data-type='multiselect']").parent().remove();
  $("li input[data-type='number']").parent().remove();
  $("li input[data-type='hidden']").parent().remove();
  $("li input[data-type='section']").parent().remove();
  $("li input[data-type='html']").parent().remove();
  $("li input[data-type='fileupload']").parent().remove();
  $("li input[data-type='captcha']").parent().remove();
  $("li input[data-type='consent']").parent().remove();
  $("li input[data-type='list']").parent().remove();
  $("li input[data-type='radio']").val("Multiple Choice");
  $("#add_post_fields").html("");
  $("#add_pricing_fields").html("");
});