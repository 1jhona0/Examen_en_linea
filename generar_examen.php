<?php

include("php/dbconnect.php");
include("php/verify.php");
include("php/header.php");
?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           USFX<small> Generar examen</small>
                        </h1>
                       
                    </div>
                </div>
                <!-- /.row -->

				
				
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i> Generar examen <strong>  </strong> 
                        </div>
						
						
						
						
                    </div>
                </div>
                <!-- /.row -->

				
<script type="text/javascript">
function printpaper()
{
var examen = $("#examen").val();
var sets = $("#sets").val();
var title = $("#examen option:selected").text();

if(examen=="" || sets =="")
{
alert("Please select all fields");
return;
}

window.open("printpaper.php?examen="+examen+"&sets="+sets+"&title="+title,"OriginalWindowA4",'width=1000,height=1000,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');	


}
</script>
                <div class="row">
                    <div class=" col-md-12">
					
					 <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Generar examen</h3>
                            </div>
                            <div class="panel-body">
                         <form class="form-inline">
  <div class="form-group">
    <label for="email">Seleccionar examen</label>
     <select class="form-control" id="examen"   name="examen" required>
									<option value="">Seleccionar examen</option>
								<?php
								$sql = "select * from  examen";
								$q = $conn->query($sql);
								
							  
								while($r = $q->fetch_assoc())
								{
								 echo ' <option value="'.$r['id'].'" >'.$r['nombre_exam'].'</option>';
								}
								?>
                                    
                                </select>
  </div>
   <!--12/05/19 falta pruebas-->
  <div class="form-group">
    <label for="pwd">Conjunto de Examenes:</label>
    <select class="form-control" id="sets"  name="sets" required>
		<option value="">Seleccionar</option>
		<option value="A">A</option>
		<option value="B">A-B</option>
		<option value="C">A-C</option>
		<option value="D">A-D</option>
	</select>
									
  </div>
 
  <button type="button" onclick="printpaper();" class="btn btn-primary">Enviar</button>
</form>


						</div>
                        </div>

                    </div>
                   
                </div>
                <!-- /.row -->
          
               

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
 </div>
   


</body>

</html>
 
