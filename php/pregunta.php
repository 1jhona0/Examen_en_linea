<?php

include("php/dbconnect.php");
include("php/verify.php");


$examen = '';
$id = '';
$errormsg = '';
$pregunta = '';
$tipo = '';
$obj1 = '';
$obj2 = '';
$obj3 = '';
$obj4 = '';
$v_f = '';

$una_palabra='';
$respuesta = '';



if(isset($_POST['save1']))
{
$pregunta = mysqli_real_escape_string($conn,$_POST['pregunta']);
$tipo = mysqli_real_escape_string($conn,$_POST['tipo']);
$examen = mysqli_real_escape_string($conn,$_POST['examen']);



if($_POST['action']=="add")
{

if($tipo=='Verdadero/Falso')
{

$respuesta = $v_f = mysqli_real_escape_string($conn,$_POST['v_f']);
$sql = $conn->query("INSERT INTO  pregunta (examen,pregunta,tipo,v_f,respuesta) VALUES ('$examen','$pregunta','$tipo','$v_f','$respuesta')") ;

}else
if($tipo=='Una palabra')
{
$respuesta = $una_palabra = mysqli_real_escape_string($conn,$_POST['una_palabra']);
$sql = $conn->query("INSERT INTO  pregunta (examen,pregunta,tipo,una_palabra,respuesta) VALUES ('$examen','$pregunta','$tipo','$una_palabra','$respuesta')") ;

}else
if($tipo==' Opción multiple ur')
{
$obj1 = mysqli_real_escape_string($conn,$_POST['obj1']);
$obj2 = mysqli_real_escape_string($conn,$_POST['obj2']);
$obj3 = mysqli_real_escape_string($conn,$_POST['obj3']);
$obj4 = mysqli_real_escape_string($conn,$_POST['obj4']);
$respuesta1 = 'obj'.mysqli_real_escape_string($conn,$_POST['respuesta']);
$respuesta = $_POST[$respuesta1];

$sql = $conn->query("INSERT INTO  pregunta (examen,pregunta,tipo,obj1,obj2,obj3,obj4,respuesta) VALUES ('$examen','$pregunta','$tipo','$obj1','$obj2','$obj3','$obj4','$respuesta')") ;

}
else
if($tipo==' Opción multiple vr')
{
$obj1 = mysqli_real_escape_string($conn,$_POST['obj1']);
$obj2 = mysqli_real_escape_string($conn,$_POST['obj2']);
$obj3 = mysqli_real_escape_string($conn,$_POST['obj3']);
$obj4 = mysqli_real_escape_string($conn,$_POST['obj4']);
$respuesta1 = 'obj'.mysqli_real_escape_string($conn,$_POST['respuesta']);
$respuesta = $_POST[$respuesta1];

$sql = $conn->query("INSERT INTO  pregunta (examen,pregunta,tipo,obj1,obj2,obj3,obj4,respuesta) VALUES ('$examen','$pregunta','$tipo','$obj1','$obj2','$obj3','$obj4','$respuesta')") ;

}

  echo '<script type="text/javascript">window.location="pregunta.php?act=1";</script>';
}else
if($_POST['action']=="update")
{

$id = mysqli_real_escape_string($conn,$_POST['id']);
$qtype = mysqli_real_escape_string($conn,$_POST['qtype']);

if($qtype=='Verdadero/Falso')
{

$respuesta = $v_f = mysqli_real_escape_string($conn,$_POST['v_f']);
$sql = $conn->query("update pregunta set v_f= '$v_f' ,respuesta= '$respuesta' ,pregunta= '$pregunta' ,examen= '$examen'   where id = '$id'") ;


}else
if($qtype=='Una palabra')
{
$respuesta = $una_palabra = mysqli_real_escape_string($conn,$_POST['una_palabra']);
$sql = $conn->query("update pregunta set una_palabra= '$una_palabra' ,respuesta= '$respuesta' ,pregunta= '$pregunta' ,examen= '$examen'   where id = '$id'") ;



}else
if($qtype==' Opción multiple')
{
$obj1 = mysqli_real_escape_string($conn,$_POST['obj1']);
$obj2 = mysqli_real_escape_string($conn,$_POST['obj2']);
$obj3 = mysqli_real_escape_string($conn,$_POST['obj3']);
$obj4 = mysqli_real_escape_string($conn,$_POST['obj4']);
$respuesta1 = 'obj'.mysqli_real_escape_string($conn,$_POST['respuesta']);
$respuesta = $_POST[$respuesta1];

$sql = $conn->query("update pregunta set obj1= '$obj1' ,obj2= '$obj2' ,obj3= '$obj3' ,obj4= '$obj4' ,respuesta= '$respuesta' ,pregunta= '$pregunta' ,examen= '$examen'   where id = '$id'") ;


}
//// multiple opcion varias respuestas
else
if($qtype==' Opción multiple vr')
{
$obj1 = mysqli_real_escape_string($conn,$_POST['obj1']);
$obj2 = mysqli_real_escape_string($conn,$_POST['obj2']);
$obj3 = mysqli_real_escape_string($conn,$_POST['obj3']);
$obj4 = mysqli_real_escape_string($conn,$_POST['obj4']);
$respuesta1 = 'obj'.mysqli_real_escape_string($conn,$_POST['respuesta']);
$respuesta = $_POST[$respuesta1];

$sql = $conn->query("update pregunta set obj1= '$obj1' ,obj2= '$obj2' ,obj3= '$obj3' ,obj4= '$obj4' ,respuesta= '$respuesta' ,pregunta= '$pregunta' ,examen= '$examen'   where id = '$id'") ;


}




  echo '<script type="text/javascript">window.location="pregunta.php?act=2";</script>';


}

}




$action = "add";
if(isset($_GET['action']) && $_GET['action']=="edit" ){
$id = isset($_GET['id'])?mysqli_real_escape_string($conn,$_GET['id']):'';

$sqlEdit = $conn->query("SELECT * FROM pregunta WHERE id='".$id."'");
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

$conn->query("Delete from pregunta  WHERE id='".$_GET['id']."'");	
header("location: pregunta.php?act=3");

}


if(isset($_REQUEST['act']) && @$_REQUEST['act']=="1")
{
$errormsg = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Éxito!</strong> Examen añadido</div>";
}else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="2")
{
$errormsg = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Éxito!</strong> Examen editado</div>";
}
else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="3")
{
$errormsg = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Éxito!</strong> Examen eliminado</div>";
}

include("php/header.php");
?>

        <div id="page-wrapper">

            <div class="container-fluid">

     

				
				<?php
			if(isset($_GET['action']) && @$_GET['action']=="add" || @$_GET['action']=="edit")
			  {
				?>
				
				
	<script type="text/javascript">
$(document).ready(function(){

$("#qtype").change(function(){


 $(".questiontype").each(function(){
        $(this).hide();
    });
	
	
if($(this).val()==" Opción multiple ur")
{
$("#multiplechoice").show();
}
else
if($(this).val()=="Verdadero/Falso")
{
$("#trueflase").show();
}
else
if($(this).val()=="Opción multiple vr")
{
$("#multipleres").show();
}
else
if($(this).val()=="Una palabra")
{
$("#una_palabra").show();
}

});

});

   </script>	
				
				
                      <!-- Encabezado de la pagina -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                          Examenes en Linea USFX <small class="pull-right"> <?php echo (($action=="update")?"Editar":"Añadir"); ?> Preguntas</small>
                        </h1>
                       
                    </div>
                </div>
                <!-- /.row -->
                       
						
						 <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong>Establecer pregunta </strong> <?php echo (($action=="update")?"Editar":"Añadir"); ?> pregunta al examen!
                        </div>
						
                
                <!-- /.row -->
 <form role="form" method="post" action="pregunta.php" >
                <div class="row">
                    <div class=" col-md-6">
					
					 <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title"> Informacion Examen </h3>
                            </div>
                            <div class="panel-body">
                        

						 
						 <div class="form-group">
                                <label>Examen</label>
                                <select class="form-control"   name="examen" required>
									<option value="">Seleccionar Examen</option>
								<?php
								$sql = "select * from  examen";
								$q = $conn->query($sql);
								
							  
								while($r = $q->fetch_assoc())
								{
								 echo ' <option value="'.$r['id'].'"  '.(($r['id']==$examen)?'selected="selected"':'').'>'.$r['nombre_exam'].'</option>';
								}
								?>
                                    
                                </select>
								
								 <p class="help-block">
                                        Seleccione el nombre del examen donde se mostrará esta pregunta
                                </p>
                            </div>
							
							
							
							
						<div class="form-group">
                                <label>Tipo</label>
                                <select class="form-control"  name="tipo"   id="qtype"  <?php echo ($action=="update")?'disabled="disabled"':'';?>>
								
								<option  value=" Opción multiple ur" <?php echo ($tipo==" Opción multiple ur")?'selected="selected"':''; ?> >Multiple opcion una respuesta</option>
								<option  value="Verdadero/Falso" <?php echo ($tipo=="Verdadero/Falso")?'selected="selected"':''; ?> >Verdadero/Falso</option>
                                <option  value=" Opción multiple vr" <?php echo ($tipo==" Opción multiple vr")?'selected="selected"':''; ?> >Multiple opcion varias respuesta</option>
								<option  value="Una palabra" <?php echo ($tipo=="Una palabra")?'selected="selected"':''; ?> >Una Palabra</option>
								
                                </select>
								
								 <p class="help-block">Seleccione Tipo de Pregunta</p>
                            </div>
                            
                         

                        
						</div>
                        </div>
						
						<input type="hidden" name="action" value="<?php echo $action;?>">
						<input type="hidden" name="qtype" value="<?php echo $tipo;?>">
                            <input type="hidden" name="id" value="<?php echo $id;?>">

                            <a href="pregunta.php" class="btn btn-danger">Cancelar</a>
                            <button type="submit" name="save1" class="btn btn-primary">Guardar </button>

                    </div>
					
					
					
					 <div class=" col-md-6">
					      <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title"> Informacion Pregunta</h3>
                            </div>
                            <div class="panel-body">
                        

						 
						 <div class="form-group">
                                <label>Pregunta</label>
                                 <textarea class="form-control" rows="2" name="pregunta" required><?php echo $pregunta;?></textarea>		
								
                            </div>
					
					
					 <?php
					 
					 if($action =="add")
					 {
					 ?>
					
						 <div class="form-group">
                                <!-- multiple opcion una respuestas-->
                               <div id="multiplechoice"  class="questiontype" >
							    <label>Multiple</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="radio" value="1"    name="respuesta" > <input type="text" name="obj1" value="" >
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="radio" value="2"  name="respuesta" > <input type="text" name="obj2" value=""  >
                                    </label>
                                </div>
                                 <div class="checkbox">
                                    <label>
                                        <input type="radio" value="3"  name="respuesta" > <input type="text" name="obj3" value="" >
                                    </label>
                                </div>
								
								 <div class="checkbox">
                                    <label>
                                        <input type="radio" value="4"  name="respuesta" > <input type="text" name="obj4" value="" >
                                    </label>
                                </div>	


                                <p class="help-block">
                                    Seleccione la respuesta correcta
                                </p>								
								</div>
								
								
								<div id="trueflase"  class="questiontype" style="display:none;">
																
                                <label>Verdadero/Falso</label>
                                <select class="form-control"  name="v_f" id="qtype">
								
								<option  value="Verdadero"  >Verdadero</option>
								<option  value="Falso" >Falso</option>
								
								
                                </select>
								
								 <p class="help-block">Seleccione la Repuesta Correcta ya Sea Verdadero o Falso </p>
								
								</div>

                                <!-- multiple opcion varias respuestas-->
                                <div id="multipleres"  class="questiontype" style="display:none;">
							    <label>Multiple</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="1"    name="respuesta" > <input type="text" name="obj1" value="" >
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="2"  name="respuesta" > <input type="text" name="obj2" value=""  >
                                    </label>
                                </div>
                                 <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="3"  name="respuesta" > <input type="text" name="obj3" value="" >
                                    </label>
                                </div>
								
								 <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="4"  name="respuesta" > <input type="text" name="obj4" value="" >
                                    </label>
                                </div>	


                                <p class="help-block">
                                    Seleccione las respuesta correctas
                                </p>								
								</div>
								
								
								<div id="una_palabra"  class="questiontype"  style="display:none;">
								<label>Una palabra</label>
								 <input type="text" name="una_palabra" value=""  >
								  <p class="help-block">Seleccione la palabra correcta para la respuesta</p>			
								</div>
								
								
                            </div>
							
					<?php
					}else
					{ // Este código se utilizará cuando se realice la acción de edición.
					?>
					       
					    <div class="form-group">
						 <?php
					 
					 if($tipo ==" Opción multiple ur")
					 {
					 ?>
                               <div id="multiplechoice"  class="questiontype">
							    <label>Multiple</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="radio" value="1"    name="respuesta" <?php echo ($obj1==$respuesta)?'checked="checked"':'';?>> <input type="text" name="obj1" value="<?php echo $obj1; ?>">
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="radio" value="2" name="respuesta" <?php echo ($obj2==$respuesta)?'checked="checked"':'';?>> <input type="text" name="obj2" value="<?php echo $obj2; ?>"  >
                                    </label>
                                </div>
                                 <div class="checkbox">
                                    <label>
                                        <input type="radio" value="3" name="respuesta" <?php echo ($obj3==$respuesta)?'checked="checked"':'';?>> <input type="text" name="obj3" value="<?php echo $obj3; ?>">
                                    </label>
                                </div>
								
								 <div class="checkbox">
                                    <label>
                                        <input type="radio" value="4" name="respuesta" <?php echo ($obj4==$respuesta)?'checked="checked"':'';?>> <input type="text" name="obj4" value="<?php echo $obj4; ?>">
                                    </label>
                                </div>	

                                <p class="help-block">Seleccione la respuesta correcta</p>											
								</div>
								<?php
								}else if($tipo =="Verdadero/Falso")
					                 {
								?>
								
								<div id="trueflase"  class="questiontype" >
																
                                <label>Verdadero/Falso</label>
                                <select class="form-control"  name="v_f" id="qtype">
								
								<option  value="Verdadero" <?php echo ($v_f=="Verdadero")?'selected="selected"':''; ?> >Verdadero </option>
								<option  value="Falso" <?php echo ($v_f=="Falso")?'selected="selected"':''; ?> >Falso</option>
								
								
                                </select>
								
								 <p class="help-block">
                                        Seleccione la respuesta de correcta ya sea verdadero o falso
                                </p>
								
								</div>
								
								<?php
								}else if($tipo =="Una palabra")
					            {
								?>
								<div id="una_palabra"  class="questiontype" >
								<label>Una Palabra</label>
								 <input type="text" name="obj2" value="<?php echo $una_palabra; ?>"  >
								  <p class="help-block">Seleccione la Respuesta Correcta</p>			
								</div>
								<?php
								}
								?>
								
                            </div>
					<?php
					
					}
					
					?>
						
                            
                         

                        
						</div>
                        </div>
					
					</div>
                   
                </div>
				
				
				
				
				</form>
                <!-- /.row -->
              <?php
			  }else			  
			  {
			  ?>
			  
			   <link href="plugin/datatable/dataTables.bootstrap.css" rel="stylesheet" />
			  
			          <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                          Examen en linea USFX<small>  Pregunta</small>
						   <div class="pull-right">
                <a href="pregunta.php?action=add" class="btn btn-primary">Añadir</a>
				
              </div>
                        </h1>
                       
                    </div>
                </div>
                <!-- /.row -->
					
             <div class="row">
                 <div class="col-md-12">
			   
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
                            
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Nombre Examen</th>
											<th>Pregunta </th>
											<th>Tipo de Pregunta </th>
											<th>Respuesta </th>
                                            <th width="15%">Accion</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
									
									<?php 
								
								$sql = $conn->query("select q.id as qid,nombre_exam,pregunta,tipo,respuesta from pregunta as q ,examen as p where q.examen = p.id group by q.id");
								while($row = $sql->fetch_assoc())
								{
								
								
                                    echo '<tr>
                                       
                                        <td>'.$row['nombre_exam'].'</td>
										<td>'.$row['pregunta'].'</td>
										<td>'.$row['tipo'].'</td>
										<td>'.$row['respuesta'].'</td>
										
										<td><a href="pregunta.php?action=edit&id='.$row['qid'].'" class="btn btn-primary btn-xs">Editar</a>  &nbsp; <a  onclick="return confirm(\'¿Estás seguro de que quieres eliminar este registro?\');"  href="pregunta.php?action=delete&id='.$row['qid'].'" class="btn btn-danger btn-xs"  >Eliminar</a></td>
                                        
                                        </tr>';
								}
								?>
                                       
                                    </tbody>
                                </table>
                            
                           
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
 
