<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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
$respuestavr = '';
$puntaje_general = '';
$puntaje_campos = '';
$penitencias = '';



if(isset($_POST['save1']))
{
$pregunta = mysqli_real_escape_string($conn,$_POST['pregunta']);
$tipo = mysqli_real_escape_string($conn,$_POST['tipo']);
$examen = mysqli_real_escape_string($conn,$_POST['examen']);



if($_POST['action']=="add")
{

if($tipo=='Verdadero/Falso')
{
$puntaje_general = mysqli_real_escape_string($conn,$_POST['puntaje_general']);
$respuesta = $v_f = mysqli_real_escape_string($conn,$_POST['v_f']);
$sql = $conn->query("INSERT INTO  pregunta (examen,pregunta,tipo,v_f,respuesta,puntaje_general) VALUES ('$examen','$pregunta','$tipo','$v_f','$respuesta','$puntaje_genreal')") ;

}else
if($tipo=='Completar Campos')
{
    $puntaje_general = mysqli_real_escape_string($conn,$_POST['puntaje_general']);
$respuesta = $una_palabra = mysqli_real_escape_string($conn,$_POST['una_palabra']);
$sql = $conn->query("INSERT INTO  pregunta (examen,pregunta,tipo,una_palabra,respuesta,puntaje_general) VALUES ('$examen','$pregunta','$tipo','$una_palabra','$respuesta','puntaje_general')") ;

}else
if($tipo==' Opción multiple')
{
$obj1 = mysqli_real_escape_string($conn,$_POST['obj1']);
$obj2 = mysqli_real_escape_string($conn,$_POST['obj2']);
$obj3 = mysqli_real_escape_string($conn,$_POST['obj3']);
$obj4 = mysqli_real_escape_string($conn,$_POST['obj4']);
$puntaje_general = mysqli_real_escape_string($conn,$_POST['puntaje_general']);
$respuesta1 = 'obj'.mysqli_real_escape_string($conn,$_POST['respuesta']);
$respuesta = $_POST[$respuesta1];

$sql = $conn->query("INSERT INTO  pregunta (examen,pregunta,tipo,obj1,obj2,obj3,obj4,respuesta,puntaje_general) VALUES ('$examen','$pregunta','$tipo','$obj1','$obj2','$obj3','$obj4','$respuesta','$puntaje_general')") ;

}else
if($tipo==' Opción varias')
{
$obj1 = mysqli_real_escape_string($conn,$_POST['obj1']);
$obj2 = mysqli_real_escape_string($conn,$_POST['obj2']);
$obj3 = mysqli_real_escape_string($conn,$_POST['obj3']);
$obj4 = mysqli_real_escape_string($conn,$_POST['obj4']);
$puntaje_general = mysqli_real_escape_string($conn,$_POST['puntaje_general']);
$respuesta1 = 'obj'.mysqli_real_escape_string($conn,$_POST['respuestavr']);
$respuesta = obtener();
$puntaje_campos = validar_campos();
$penitencias = validar_penit();

$sql = $conn->query("INSERT INTO  pregunta (examen,pregunta,tipo,obj1,obj2,obj3,obj4,respuesta,puntaje_general,puntaje_campos,penitencias) VALUES ('$examen','$pregunta','$tipo','$obj1','$obj2','$obj3','$obj4','$respuesta','$puntaje_general','$puntaje_campos','$penitencias')") ;

}

  echo '<script type="text/javascript">window.location="pregunta.php?action=add";</script>';
}else
if($_POST['action']=="update")
{

$id = mysqli_real_escape_string($conn,$_POST['id']);
$qtype = mysqli_real_escape_string($conn,$_POST['qtype']);

if($qtype=='Verdadero/Falso')
{
    $puntaje_general = mysqli_real_escape_string($conn,$_POST['puntaje_general']);
$respuesta = $v_f = mysqli_real_escape_string($conn,$_POST['v_f']);
$sql = $conn->query("update pregunta set v_f= '$v_f' ,respuesta= '$respuesta' ,pregunta= '$pregunta',puntaje_general='$puntaje_general' ,examen= '$examen'   where id = '$id'") ;


}else
if($qtype=='Completar Campos')
{
    $puntaje_general = mysqli_real_escape_string($conn,$_POST['puntaje_general']);
$respuesta = $una_palabra = mysqli_real_escape_string($conn,$_POST['una_palabra']);
$sql = $conn->query("update pregunta set una_palabra= '$una_palabra' ,respuesta= '$respuesta' ,pregunta= '$pregunta',puntaje_general='$puntaje_general' ,examen= '$examen'   where id = '$id'") ;



}else
if($qtype==' Opción multiple')
{
$obj1 = mysqli_real_escape_string($conn,$_POST['obj1']);
$obj2 = mysqli_real_escape_string($conn,$_POST['obj2']);
$obj3 = mysqli_real_escape_string($conn,$_POST['obj3']);
$obj4 = mysqli_real_escape_string($conn,$_POST['obj4']);
$puntaje_general = mysqli_real_escape_string($conn,$_POST['puntaje_general']);
$respuesta1 = 'obj'.mysqli_real_escape_string($conn,$_POST['respuesta']);
$respuesta = $_POST[$respuesta1];

$sql = $conn->query("update pregunta set obj1= '$obj1' ,obj2= '$obj2' ,obj3= '$obj3' ,obj4= '$obj4' ,respuesta= '$respuesta',puntaje_general='$puntaje_general' ,pregunta= '$pregunta' ,examen= '$examen'   where id = '$id'") ;


}else
if($qtype==' Opción varias')
{
$obj1 = mysqli_real_escape_string($conn,$_POST['obj1']);
$obj2 = mysqli_real_escape_string($conn,$_POST['obj2']);
$obj3 = mysqli_real_escape_string($conn,$_POST['obj3']);
$obj4 = mysqli_real_escape_string($conn,$_POST['obj4']);
$puntaje_general = mysqli_real_escape_string($conn,$_POST['puntaje_general']);
$respuesta1 = 'obj'.mysqli_real_escape_string($conn,$_POST['respuestavr']);
$respuesta = obtener();
$puntaje_campos = validar_campos();
$penitencias = validar_penit();

$sql = $conn->query("update pregunta set obj1= '$obj1' ,obj2= '$obj2' ,obj3= '$obj3' ,obj4= '$obj4' ,respuesta= '$respuesta',puntaje_general='$puntaje_general',puntaje_campos='$puntaje_campos',penitencias='$penitencias' ,pregunta= '$pregunta' ,examen= '$examen'   where id = '$id'") ;

}




  echo '<script type="text/javascript">window.location="pregunta.php?act=2";</script>';


}

}

function obtener(){
    $Datos = "";
    $i = 0;
    if ( !empty($_POST["respuestavr"]) && is_array($_POST["respuestavr"]) ) {
        foreach ( $_POST["respuestavr"] as $respuesta ) { 
                if($i!=0){
                    $Datos = $Datos .",".$respuesta;
                }else{
                    $Datos = $Datos ."".$respuesta;
                }
            $i += 1;
         }
    }
return $Datos;
}

function obtenerVariables(){
    $Datos = "";
    $i = 0;
    if ( !empty($_POST["respuestavr"]) && is_array($_POST["respuestavr"]) ) {
        foreach ( $_POST["respuestavr"] as $respuesta ) { 
                if($respuesta!=""){
                    $i += 1;
                }
         }
    }
return $i;
}



function campos(){
    if(obtenerVariables()==1){
        return 100;
    }
    if(obtenerVariables()==2){
        return 50;
    }
    if(obtenerVariables()==3){
        return 33.3333;
    }
    if(obtenerVariables()==4){
        return 25;
    }
}
/*

function penitencias(){
    if(obtenerVariables()==1){
        return -100;
    }
    if(obtenerVariables()==2){
        return -50;
    }
    if(obtenerVariables()==3){
        return -33.333;
    }
    if(obtenerVariables()==4){
        return -25;
    }
}
*/



function penitencias(){
    $dat =100;
    if(campos()==100){
        return -$dat/3;
    }
    if(campos()==50){
        return -$dat/2;
    }
    if(campos()==33.3333){
        return -$dat;
    }
    if(campos()==25){
        return 0.0;
    }
}






function checks_calif(){
    $Datos = 0;
    $respuestas = $_POST["califi"];
    if($respuestas=="true_califi"){
        return "True";
    }else{
        return "False";
    }
}





function checks_penit(){
    $respuestas = $_POST["penit"];
    if($respuestas=="true_penit"){
        return "True";
    }else{
        return "False";
    }
}

function validar_campos(){
    if(checks_calif()=="True"){
        return campos();
    }else{
        return "";
    }
}





function validar_penit(){
    if(checks_penit()=="True"){
        return penitencias();
    }else{
        return "";
    }
}




/*
function check(){
    $q = "";
    $uno = $_POST['obj1'];
    $dos = $_POST['obj2'];
    $tres = $_POST['obj3'];
    $cuatro = $_POST['obj4'];
    $d = [$uno,$dos,$tres,$cuatro];
    for($i = 0; $i < $d.length;$i++){
        if($d[i]!=""){
            if($i!=0){
                $q = $q.",".$d[i];
            }else{
                $q = $q."".$d[i];
            }
        }
    }
    return $q;
}*/


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
	
	
if($(this).val()==" Opción multiple")
{
$("#multiplechoice").show();
}else
if($(this).val()==" Opción varias")
{
$("#opcionvarias").show();
}else
if($(this).val()=="Verdadero/Falso")
{
$("#trueflase").show();
}else
if($(this).val()=="Completar Campos")
{
$("#una_palabra").show();
}

});

});

   </script>	
				
				
                      <!-- Page Heading -->
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
								
                                <option  value=" Opción multiple" <?php echo ($tipo==" Opción multiple")?'selected="selected"':''; ?> >Multiple opcion una respuesta</option>
                                <option  value=" Opción varias" <?php echo ($tipo==" Opción varias")?'selected="selected"':''; ?> >Multiple opcion varias respuestas</option>
								<option  value="Verdadero/Falso" <?php echo ($tipo=="Verdadero/Falso")?'selected="selected"':''; ?> >Verdadero/Falso</option>
                                <option  value="Completar Campos" <?php echo ($tipo=="Completar Campos")?'selected="selected"':''; ?> >Completar Campos</option>
                                
								
                                </select>
								
								 <p class="help-block">Seleccione Tipo de Pregunta</p>
                            </div>
                            
                         

                        
						</div>
                        </div>
						
						<input type="hidden" name="action" value="<?php echo $action;?>">
						<input type="hidden" name="qtype" value="<?php echo $tipo;?>">
                            <input type="hidden" name="id" value="<?php echo $id;?>">

                            <!--<a href="pregunta.php" class="btn btn-danger">Cancelar</a>-->
                            <button type="submit" name="save1" class="btn btn-primary">Guardar </button>
                            <a href="exam.php" class="btn btn-success">Salir</a>        
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
                            <div id="multiplechoice"  class="questiontype">
                                <label>Multiple</label>
                               
                                <div class="checkbox">
                                    <label>
                                        <input type="radio" value="1"    name="respuesta" > <input type="text" name="obj1" value="" >
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="radio" value="2"  name="respuesta" > <input type="text" name="obj2" value="" > 
                                    </label>
                                </div>
                                 <div class="checkbox">
                                    <label>
                                        <input type="radio" value="3"  name="respuesta" > <input type="text" name="obj3" value="" > 
                                    </label>
                                </div>
								
								 <div class="checkbox">
                                    <label>
                                        <input type="radio" value="4"  name="respuesta" > <input type="text" name="obj4" value=""> 
                                    </label>
                                </div>	



                                <div class=" col-md-12">
					            <div class="panel panel-success">
                                <div class="panel-heading">
                                <h3 class="panel-title"> Puntaje General_</h3>
                                </div>
                                <div class="panel-body">
                                	
					                               
                                 <div class="checkbox">
                                    <label for=""> Calificacion Pregunta</label>
                                    <label>
                                        <input type="text" value=""  name="puntaje_general" id="puntaje_general"> 
                                    </label>
                                </div>
                                </div>	
                                </div>
                                </div>




                                <p class="help-block">
                                    Seleccione la respuesta correcta
                                </p>								
                            </div>
                            
                            <div id="opcionvarias"  class="questiontype" style="display:none;">
							    <label>Multiple varias Respuestas</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="uno" value=""  name="respuestavr[]" > <input type="text" name="obj1" id="obj1" value="" onblur="document.getElementById('uno').value=this.value">
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="dos" value=""  name="respuestavr[]" > <input type="text" name="obj2" id="obj2" value="" onblur="document.getElementById('dos').value=this.value">
                                    </label>
                                </div>
                                 <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="tres" values="" name="respuestavr[]" > <input type="text" name="obj3" id="obj3" value="" onblur="document.getElementById('tres').value=this.value">
                                    </label>
                                </div>
								
								 <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="cuatro" value=""  name="respuestavr[]" > <input type="text" name="obj4" id="obj4" value="" onblur="document.getElementById('cuatro').value=this.value">
                                    </label>
                                </div>

                                

                                <p class="help-block">
                                    Seleccione las respuesta correctas
                                </p>	



                                <div class=" col-md-12">
					            <div class="panel panel-success">
                                <div class="panel-heading">
                                <h3 class="panel-title"> Puntaje Generals</h3>
                                </div>
                                <div class="panel-body">
                                	
					                               
                                 <div class="checkbox">
                                    <label for=""> Calificacion Pregunta</label>
                                    <label>
                                        <input type="text" value=""  name="puntaje_general" id="puntaje_general"> 
                                    </label>
                                </div>
                                </div>	
                                </div>
                                </div>



                                                                <!-- puebas de varias respuestas-->
                                
                                <div class=" col-md-12">
					            <div class="panel panel-success">
                                <div class="panel-heading">
                                <h3 class="panel-title"> Opciones</h3>
                                </div>
                                <div class="panel-body">
                                	
					                               
                                 <div class="checkbox">
                                    <label for=""> Calificar cada opcion</label>
                                    <label>
                                        <input type="checkbox" value=""  name="califi" id="califi"> 
                                    </label>

                                    <label for=""> Penalizacion</label>
                                    <label>
                                    <input type="checkbox" value=""  name="penit" id="penit">
                                    </label>
                                    <script type="text/javascript" src="js/validar_puntos.js"></script>
                                </div>
                                </div>	
                                </div>
                                </div>


							</div>
     
								
								
								<div id="trueflase"  class="questiontype" style="display:none;">
																
                                <label>Verdadero/Falso</label>
                                <select class="form-control"  name="v_f" id="qtype">
								
								<option  value="Verdadero"  >Verdadero</option>
								<option  value="Falso" >Falso</option>
								
								
                                </select>
								
								 <p class="help-block">Seleccione la Repuesta Correcta ya Sea Verdadero o Falso </p>


                                 <div class=" col-md-12">
					            <div class="panel panel-success">
                                <div class="panel-heading">
                                <h3 class="panel-title"> Puntaje General_</h3>
                                </div>
                                <div class="panel-body">
                                	
					                               
                                 <div class="checkbox">
                                    <label for=""> Calificacion Pregunta</label>
                                    <label>
                                        <input type="text" value=""  name="puntaje_general" id="puntaje_general"> 
                                    </label>
                                </div>
                                </div>	
                                </div>
                                </div>

								
								</div>
								
								
								<div id="una_palabra"  class="questiontype"  style="display:none;">
								<label>Completar Campos</label>
                                 <input type="text" name="una_palabra" value=""  >
								  <p class="help-block">Seleccione la palabra correctas para la respuesta</p>	



                                  <div class=" col-md-12">
					            <div class="panel panel-success">
                                <div class="panel-heading">
                                <h3 class="panel-title"> Puntaje General_</h3>
                                </div>
                                <div class="panel-body">
                                	
					                               
                                 <div class="checkbox">
                                    <label for=""> Calificacion Pregunta</label>
                                    <label>
                                        <input type="text" value=""  name="puntaje_general" id="puntaje_general"> 
                                    </label>
                                </div>
                                </div>	
                                </div>
                                </div>


								</div>
								
								
                            </div>
							
					<?php
					}else
					{ // this code will use when edit action is perform
					?>
					       
					    <div class="form-group">
						 <?php
					 
					 if($tipo ==" Opción multiple")
					 {
					 ?>
                               <div id="multiplechoice"  class="questiontipo">
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




                                <div class=" col-md-12">
					            <div class="panel panel-success">
                                <div class="panel-heading">
                                <h3 class="panel-title"> Puntaje General_</h3>
                                </div>
                                <div class="panel-body">
                                	
					                               
                                 <div class="checkbox">
                                    <label for=""> Calificacion Pregunta</label>
                                    <label>
                                        <input type="text" value="<?php echo $puntaje_general;?>"  name="puntaje_general" id="puntaje_general"> 
                                    </label>
                                </div>
                                </div>	
                                </div>
                                </div>

                                </div>
                                
                                <?php
								}else if($tipo ==" Opción varias")
					                 {
                                ?>
                                <div id="opcionvarias"  class="questiontipo">
							    <label>Multiple</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"  value="<?php echo $obj1; ?>" name="respuestavr[]" <?php echo ($obj1==$respuesta)?'checked="checked"':'';?>> <input type="text" name="obj1" value="<?php echo $obj1; ?>" >
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="<?php echo $obj2; ?>" name="respuestavr[]" <?php echo ($obj2==$respuesta)?'checked="checked"':'';?>> <input type="text" name="obj2" value="<?php echo $obj2; ?>" >
                                    </label>
                                </div>
                                 <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="<?php echo $obj3; ?>" name="respuestavr[]" <?php echo ($obj3==$respuesta)?'checked="checked"':'';?>> <input type="text" name="obj3" value="<?php echo $obj3; ?>" >
                                    </label>
                                </div>
								
								 <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="<?php echo $obj4; ?>" name="respuestavr[]" <?php echo ($obj4==$respuesta)?'checked="checked"':'';?>> <input type="text" name="obj4" value="<?php echo $obj4; ?>" >
                                    </label>
                                </div>	


                                






                                <p class="help-block">Seleccione la respuesta correcta</p>											
                                </div>





                                <div class=" col-md-12">
					            <div class="panel panel-success">
                                <div class="panel-heading">
                                <h3 class="panel-title"> Puntaje General_</h3>
                                </div>
                                <div class="panel-body">
                                	
					                               
                                 <div class="checkbox">
                                    <label for=""> Calificacion Pregunta</label>
                                    <label>
                                        <input type="text" value="<?php echo $puntaje_general;?>"  name="puntaje_general" id="puntaje_general"> 
                                    </label>
                                </div>
                                </div>	
                                </div>
                                </div>



                                                                <!-- puebas de varias respuestas-->
                                
                                                                <div class=" col-md-12">
					            <div class="panel panel-success">
                                <div class="panel-heading">
                                <h3 class="panel-title"> Calificacion</h3>
                                </div>
                                <div class="panel-body">
                                	
					                               
                                 <div class="checkbox">
                                    <label for=""> Calificar cada opcion</label>
                                    <label>
                                        <input type="checkbox" value=""  name=califi id="califi"> 
                                    </label>

                                    <label for=""> Penalizacion</label>
                                    <label>
                                    <input type="checkbox" value=""  name="penit" id="penit">
                                    </label>
                                    <script type="text/javascript" src="js/validar_puntos.js"></script>
                                </div>
                                </div>	
                                </div>
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






                                <div class=" col-md-12">
					            <div class="panel panel-success">
                                <div class="panel-heading">
                                <h3 class="panel-title"> Puntaje General_</h3>
                                </div>
                                <div class="panel-body">
                                	
					                               
                                 <div class="checkbox">
                                    <label for=""> Calificacion Pregunta</label>
                                    <label>
                                        <input type="text" value="<?php echo $puntaje_general;?>"  name="puntaje_general" id="puntaje_general"> 
                                    </label>
                                </div>
                                </div>	
                                </div>
                                </div>




								
								</div>
								
								<?php
								}else if($tipo =="Completar Campos")
					                 {
								?>
								<div id="una_palabra"  class="questiontype" >
								<label>Completar Campos</label>
								 <input type="text" name="una_palabra" value="<?php echo $una_palabra; ?>"  >
								  <p class="help-block">Seleccione la Respuesta Correcta</p>			
								</div>





                                <div class=" col-md-12">
					            <div class="panel panel-success">
                                <div class="panel-heading">
                                <h3 class="panel-title"> Puntaje General_</h3>
                                </div>
                                <div class="panel-body">
                                	
					                               
                                 <div class="checkbox">
                                    <label for=""> Calificacion Pregunta</label>
                                    <label>
                                        <input type="text" value="<?php echo $puntaje_general;?>"  name="puntaje_general" id="puntaje_general"> 
                                    </label>
                                </div>
                                </div>	
                                </div>
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
                          USFX<small> Banco de preguntas</small>
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



         $(document).ready(function () {
        $("#nombres1").keyup(function () {
            var value = $(this).val();
            $("#nombres2").val(value);
            });
        });
        // Campos apellidos
        $(document).ready(function () {
        $("#apellidos1").keyup(function () {
            var value = $(this).val();
            $("#apellidos2").val(value);
        });
        });
        function PasarValor(){
            document.getElementById("nombre2").value = document.getElementById("nombre1").value;
        }
        let nuevo = function() {
        $("<section/>").insertBefore("[name='save1']")
                 .append($(".inputs").html())
                 .find("button")
                 .attr("onclick", "eliminar(this)")
                 .text("Eliminar");
            }

        let eliminar = function(obj) {
        $(obj).closest("section").remove();
        }

        





    </script>
			 
			  <?php
			  
			  }
			  
			  ?>
               

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
</body>
</html>