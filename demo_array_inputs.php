<!DOCTYPE html>
<html lang="es-ES">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Ejemplo formulario con array de inputs</title>
</head>
<body>
	<form action="demo_array_inputs.php" method="get">

		<input type="checkbox" name="como[]" id="como1" value="Web">
		<label for="como1">Una web</label>

		<input type="checkbox" name="como[]" id="como2" value="Google">
		<label for="como2">Google</label>

		<input type="checkbox" name="como[]" id="como3" value="Anuncio en prensa">
		<label for="como3">Anuncio en prensa</label>

		<input type="checkbox" name="como[]" id="como4" value="Anuncio en tv">
		<label for="como4">Anuncio en tv</label>

		<button type="submit">Enviar</button>

	</form>
	
	<?php
	function obtener(){
		$Datos = "";
		$i = 0;
		if ( !empty($_GET["como"]) && is_array($_GET["como"]) ) {
			foreach ( $_GET["como"] as $como ) { 
					if($i!=0){
						$Datos = $Datos .",".$como;
					}else{
						$Datos = $Datos ."".$como;
					}
				$i += 1;
			 }
		}
	return $Datos;
	}
	echo obtener();
	?>
</body>
</html>