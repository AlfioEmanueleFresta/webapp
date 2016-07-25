$(document).ready(function() {
   $(".close-button").click(function() {
      $(this).parent().hide(500);
   });

   $("[data-confirm]").each(function(i, e) {
      $(e).click(function() {
         var message = $(e).data('confirm');
         return confirm(message);
      })
   });
});
