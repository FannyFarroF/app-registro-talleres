<?php
	include('../db.php');

	$Codigo = $_POST['Codigo'];
	$Nombres = $_POST['Nombres'];
	$Apellidos = $_POST['Apellidos'];

	$sql = "INSERT INTO `docente`( `CodigoDocente`, `Nombres`,`Apellidos`,`Estado`)
	VALUES ('$Codigo', '$Nombres', '$Apellidos', 'Habilitado')";

	if (mysqli_query($conn, $sql)) {
	echo json_encode(array("statusCode"=>200));
	}
	else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	mysqli_close($conn);

?>