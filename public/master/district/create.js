(function() {
  $("#district-create-form").on("ajax.form.success", function() {
    return $(this).trigger("reset");
  });

}).call(this);