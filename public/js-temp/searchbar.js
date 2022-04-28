$(document).ready(function(){
    $("#searchbar").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#aset tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });


