<?php
	include('../db.php');

	$request = $_REQUEST;

	$Id = $request['docente_id'];

	$sql = "UPDATE docente SET Estado = 'Inhabilitado' WHERE IdDocente = $Id ";

	if (!mysqli_query($conn, $sql)) {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	
	echo json_encode(array("statusCode"=>200, "mensaje"=>"Eliminación exitosa."));
	
	mysqli_close($conn);

?>