<?php
ob_start();
$database = "db_proyecto_examen";
$host = "localhost";
$username = "root";
$password = "";

$conn  = new mysqli($host,$username,$password,$database);
if($conn->connect_error)
die("Error no se puede conectar con la base de datos : ".$conn->connect_error);

?>