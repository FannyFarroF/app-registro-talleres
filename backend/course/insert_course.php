<?php
	include('../db.php');

	$Codigo = $_POST['Codigo'];
	$Descripcion = $_POST['Descripcion'];
	$Horas = $_POST['Horas'];
	$Docente = $_POST['Docente'];

	$sql = "INSERT INTO `curso`( `CodigoCurso`, `Descripcion`,`Horas`,`IdDocente`,`Estado`)
	VALUES ('$Codigo', '$Descripcion', '$Horas','$Docente', 'Habilitado')";

	if (mysqli_query($conn, $sql)) {
	echo json_encode(array("statusCode"=>200));
	}
	else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	mysqli_close($conn);

?>