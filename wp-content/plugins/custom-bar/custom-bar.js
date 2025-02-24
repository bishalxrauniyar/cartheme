jQuery(document).ready(function ($) {
  $(".custom-bar-dismiss").on("click", function () {
    $(".custom-bar").hide();
    $.post(customBarAjax.ajaxurl, { action: "custom_bar_dismiss" });
  });
});
