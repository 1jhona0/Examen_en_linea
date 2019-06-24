<?php

include("php/dbconnect.php");
include("php/verify.php");
///09/05/19 10:53pm falta probar

$nombre_exam = '';
$dur_examen = '';
$cant_repeticiones = '';
$ver_res_correc = '';
$ver_res_incorrec = '';
$id = '';
$errormsg = '';
if(isset($_POST['save']))
{
$nombre_exam = mysqli_real_escape_string($conn,$_POST['nombre_exam']);
$dur_examen = mysqli_real_escape_string($conn,$_POST['dur_examen']);
$cant_repeticiones = mysqli_real_escape_string($conn,$_POST['cant_repeticiones']);
$ver_res_correc = mysqli_real_escape_string($conn,$_POST['ver_res_correc']);
$ver_res_incorrec = mysqli_real_escape_string($conn,$_POST['ver_res_incorrec']);
if($_POST['action']=="add")
{ 
// correcciones
 $sql = $conn->query("INSERT INTO  examen (nombre_exam,dur_examen,cant_repeticiones,ver_res_correc,ver_res_incorrec) 
                    VALUES ('$nombre_exam','$dur_examen','$cant_repeticiones','$ver_res_correc','$ver_res_incorrec')") ;
 ///s echo '<script type="text/javascript">window.location="exam.php?act=1";</script>';
}else
if($_POST['action']=="update")
{

$id = mysqli_real_escape_string($conn,$_POST['id']);

$sql = $conn->query("update examen set nombre_exam= '$nombre_exam', dur_examen = '$dur_examen', cant_repeticiones = '$cant_repeticiones', ver_res_correc = '$ver_res_correc', ver_res_incorrecta = '$ver_res_incorrec' where id = '$id'") ;



//echo '<script type="text/javascript">window.location="exam.php?act=2";</script>';


}

}




$action = "add";
if(isset($_GET['action']) && $_GET['action']=="edit" ){
$id = isset($_GET['id'])?mysqli_real_escape_string($conn,$_GET['id']):'';

$sqlEdit = $conn->query("SELECT * FROM examen WHERE id='".$id."'");
if($sqlEdit->num_rows)
{
$rowsEdit = $sqlEdit->fetch_assoc();
extract($rowsEdit);
$action = "update";
}else
{
$_GET['action']="";
}

}


if(isset($_GET['action']) && $_GET['action']=="delete"){
    $var = "";

$conn->query("Update examen set nombre_exam='$var'  WHERE id='".$_GET['id']."'");	
header("location: exam.php?act=3");

}


if(isset($_REQUEST['act']) && @$_REQUEST['act']=="1")
{
$errormsg = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Éxito!</strong> Examen Añadido con Exito</div>";
}else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="2")
{
$errormsg = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Éxito!</strong> Examen Editado con Exito</div>";
}
else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="3")
{
$errormsg = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Éxito!</strong> Examen Eliminado con Exito</div>";
}


include("php/header.php");
?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                         USFX<small> Examenes</small>
                        </h1>
                       
                    </div>
                </div>
                <!-- /.row -->

				
				<?php
			if(isset($_GET['action']) && @$_GET['action']=="add" || @$_GET['action']=="edit")
			  {
				?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong>nombre examen?</strong> Añadir examen!
                        </div>
						
						
						
						
                    </div>
                </div>
                <!-- /editar examen-->

                <div class="row">
                    <div class=" col-md-12">
					
					 <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?php echo (($action=="edit")?"Edit":"Añadir"); ?> Examen</h3>
                            </div>
                            <div class="panel-body">
                         <form role="form" method="post" action="exam.php" >

                            <div class="form-group">
                                <label>Nombre examen</label>
                                <input class="form-control" name="nombre_exam" value="<?php echo $nombre_exam;?>" required>
                                <p class="help-block">Introdusca el nombre del examen</p>

                                <label > Duracion examen</label>
                                <input class="form-control"  type="number" name="dur_examen" value="<?php echo $dur_examen;?>" required pattern="[0-9]+" required>
                                <p class="help-block">Introduzca la duracion del examen</p>

                                <label>Cantidad de repeticiones</label>
                                <input class="form-control" type="number" name="cant_repeticiones" value="<?php echo $cant_repeticiones;?>" required>
                                <p class="help-block">Introdusca cantidad de repeticiones</p>

                                <label>Ver respuestas correctas</label> <br>                                                                   
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="materialChecked2" name="ver_res_correc"  value="SI"<?php if($ver_res_correc == 'SI') echo "checked";?> required>
                                    <label class="form-check-label" for="materialChecked2">SI</label> <br>
                                    <input type="radio" class="form-check-input" id="materialChecked2" name="ver_res_correc" value="NO"<?php if($ver_res_correc == 'NO') echo "checked";?> required>
                                    <label class="form-check-label" for="materialChecked2">NO</label>
                                </div>

                                <label>Ver respuestas incorrectas</label> <br>                                                                   
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="materialChecked2" name="ver_res_incorrec" value="SI"<?php if($ver_res_incorrec == 'SI') echo "checked";?>required>
                                    <label class="form-check-label" for="materialChecked2">SI</label> <br>
                                    <input type="radio" class="form-check-input" id="materialChecked2" name="ver_res_incorrec" value="NO"<?php if($ver_res_incorrec == 'NO') echo "checked";?>required>
                                    <label class="form-check-label" for="materialChecked2">NO</label>
                                </div>

                            </div>
                         <input type="hidden" name="action" value="<?php echo $action;?>">
                            <input type="hidden" name="id" value="<?php echo $id;?>">

                            <a href="exam.php" class="btn btn-danger">Cancelar</a>
                            <button type="submit" name="save" class="btn btn-primary">Guardar</button>

                        </form>
						</div>
                        </div>

                    </div>
                   
                </div>
                <!-- /.row -->
              <?php
			  }else
			  
			  {
			  ?>
			  
			   <link href="plugin/datatable/dataTables.bootstrap.css" rel="stylesheet" />
			  
			  
					
             <div class="row">
                 <div class="col-md-12">
			    <div class="pull-right">
                <a href="exam.php?action=add" class="btn btn-primary">Añadir</a>
				
              </div>
			  </div>
			  
			  </div>
			  <br/>
			  
			  <?php
						
				echo $errormsg;
				?>
			  
			   <div class="panel panel-primary">
                        <div class="panel-heading">
                            Examenes           
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Nombre examen</th>
                                            <th>Duracion del examen</th>
                                            <th>Cantidad de repeticiones</th>
                                            <th>ver respuestas correctas</th>
                                            <th>ver respuestas incorrectas</th>
                                            <th width="20%">Acciones</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
									
									<?php 
								
								$sql = $conn->query("select * from examen");
								while($row = $sql->fetch_assoc())
								{						
                                    // 19/05/2019 recciones del primer sprint
                                    // añadimos nuevos campor a la configuracion del examen
                                    if($row["nombre_exam"]!=""){
                                        echo '<tr>
                                       
                                        <td>'.$row['nombre_exam'].'</td>
                                        <td>'.$row['dur_examen'].'</td>
                                        <td>'.$row['cant_repeticiones'].' </td>
                                        <td>'.$row['ver_res_correc'].'</td>
                                        <td>'.$row['ver_res_incorrec'].'</td>
                                        
										<td><a href="exam.php?action=edit&id='.$row['id'].'" class="btn btn-primary btn-xs">Editar</a>  &nbsp; <a  onclick="return confirm(\'¿Estas seguro de borrar este examen?\');"  href="exam.php?action=delete&id='.$row['id'].'" class="btn btn-danger btn-xs"  >Eliminar</a>&nbsp; <a href="pregunta_examen.php?action=edit&id='.$row['id'].'" class="btn btn-success btn-xs">preguntas</a></td>
                                       </tr>';
                                    }
								}
								?>
                                       
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
                    </div>
			  
			     <script type='text/javascript' src='plugin/datatable/jquery.dataTables.js'></script>
	<script type='text/javascript' src='plugin/datatable/dataTables.bootstrap.js'></script>
	
	<script>
         $(document).ready(function () {
             $('#dataTables-example').dataTable();
         });
    </script>
			 
			  <?php
			  
			  }
			  
			  ?>
               

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
 </div>
   


</body>

</html>
 
