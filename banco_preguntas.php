<?php
include("php/dbconnect.php");
include("php/verify.php");
include("php/header.php");


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
      

<div class="panel panel-primary">
                        <div class="panel-heading">
                            Banco de preguntas        
                        </div>
                        <div class="panel-body">
                            
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>id</th>
											<th>Pregunta</th>
											<th>Tipo de Pregunta </th>
											<th>Respuesta </th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
									
									<?php 
								
								$sql = $conn->query("select * from pregunta");
								while($row = $sql->fetch_assoc())
								{
								
								
                                    echo '<tr>
                                       
                                        <td>'.$row['id'].'</td>
										<td>'.$row['pregunta'].'</td>
										<td>'.$row['tipo'].'</td>
										<td>'.$row['respuesta'].'</td>
										
                                        
                                        </tr>';
								}
								?>
                                       
                                    </tbody>
                                </table>
                            
                           
                        </div>
                    </div>

                </div>
    </div>
    <script type='text/javascript' src='plugin/datatable/jquery.dataTables.js'></script>
	<script type='text/javascript' src='plugin/datatable/dataTables.bootstrap.js'></script>
			  

	
	<script>
         $(document).ready(function () {
             $('#dataTables-example').dataTable();
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