$(document).ready(function() {
      $("#califi").click(function(){
          if ($(this).is(':checked')) {
            //$("input[type=checkbox]").prop('checked', true); //todos los check
            $("#califi input[type=checkbox]").prop('checked', true); //solo los del objeto #diasHabilitados
            $("#califi").val("true_califi");
        } else {
            //$("input[type=checkbox]").prop('checked', false);//todos los check
            $("#califi input[type=checkbox]").prop('checked', false);//solo los del objeto #diasHabilitados
            $("#califi").val("false_califi");
        }
      });
      $("#penit").click(function(){
        if ($(this).is(':checked')) {
          //$("input[type=checkbox]").prop('checked', true); //todos los check
          $("#penit input[type=checkbox]").prop('checked', true); //solo los del objeto #diasHabilitados
          $("#penit").val("true_penit");
      } else {
          //$("input[type=checkbox]").prop('checked', false);//todos los check
          $("#penit input[type=checkbox]").prop('checked', false);//solo los del objeto #diasHabilitados
          $("penit").val("false_penit");
      }
    });
  });