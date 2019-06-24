$(document).ready(function() {

  $('[name="respuestavr[]"]').click(function() {
      
    var arr = $('[name="respuestavr[]"]:checked').map(function(){
      return this.value;
    }).get();
    
    var q = [arr];

    $("#puntos1").click(function(){
        if ($(this).is(':checked')) {
          //$("input[type=checkbox]").prop('checked', true); //todos los check
          $("#puntos1 input[type=checkbox]").prop('checked', true); //solo los del objeto #diasHabilitados
          $("#puntos").val(q);
      } else {
          //$("input[type=checkbox]").prop('checked', false);//todos los check
          $("#puntos1 input[type=checkbox]").prop('checked', false);//solo los del objeto #diasHabilitados
          $("#puntos").val("");
      }
    });
  
  });
});