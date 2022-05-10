  $(document).ready(function(){
    $("#searchbar-gudang").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#aset-gudang tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
