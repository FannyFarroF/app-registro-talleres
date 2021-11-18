<?php
    include('../db.php');

	$Descripcion = $_POST['Descripcion'];
	$Nivel = $_POST['Nivel'];
	$Direccion = $_POST['Direccion'];

	$sql = "INSERT INTO `escuela`( `Descripcion`, `Nivel`,`Direccion`,`Estado`) 
		VALUES ('$Descripcion', '$Nivel', '$Direccion', 'Habilitado')";

	if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	mysqli_close($conn);
	
?>