<?php

include("php/dbconnect.php");
session_start();

$errormsg = '';
if(isset($_POST['login']))
{
$nombre_usuario = mysqli_real_escape_string($conn,$_POST['nombre_usuario']);
$password = mysqli_real_escape_string($conn,$_POST['password']);

$sql = "select * from usuario where nombre_usuario = '$nombre_usuario' and password='$password'";
$q = $conn->query($sql);
if($q->num_rows>0)
{
$r = $q->fetch_assoc();
$_SESSION['uid'] = $r['id'];
header("location:index.php");
}else
{

$errormsg = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Error!</strong> Usuario o contraseña invalido</div>";
}

}





include("php/login_header.php");
?>

     

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header text-center" style="color:#fff;border-bottom: none;">
                          Examenes en Linea USFX
                        </h1>
                       
                    </div>
                </div>
                <!-- /.row -->

				
			
               
                <!-- /.row -->

                <div class="row">
				  <div class=" col-md-3">
				  &nbsp;
				  </div>
                    <div class=" col-md-6">
					
					
					
					
					 <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title"> Iniciar Sesion</h3>
                            </div>
                            <div class="panel-body">
							
							<?php
							echo $errormsg;
							?>
							
                         <form role="form" method="post" action="login.php" >

                            <div class="form-group">
                                <label>Nombre usuario</label>
                                <input class="form-control" name="nombre_usuario" >
                               
                            </div>
							
							<div class="form-group">
                                <label>Password </label>
                                <input class="form-control"  type="password" name="password" >
                               
                            </div>
                         
                           
                            <button type="submit" name="login" class="btn btn-primary">Iniciar Sesion </button>

                        </form>
						</div>
                        </div>

                    </div>
					
					 <div class=" col-md-3">
				  &nbsp;
				  </div>
                   
                </div>
                <!-- /.row -->
           
               

            </div>
            <!-- /.container-fluid -->

   


</body>

</html>
 
