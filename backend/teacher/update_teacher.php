<?php
	include('../db.php');

	$request = $_REQUEST;

	$Id = $request['docente_id_editar'];
	$nombres = $request['nombres_form2'];
	$apellidos = $request['apellidos_form2'];
	
	
	$sql = "UPDATE docente SET Nombres = '$nombres', Apellidos = '$apellidos' WHERE IdDocente = $Id ";
	
	if (!mysqli_query($conn, $sql)) {
		#echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		echo json_encode(array("sql"=>$sql, "mensaje"=> mysqli_error($conn)));
	}
	
	echo json_encode(array("statusCode"=>200, "mensaje"=>"Actualización exitosa."));
	
	mysqli_close($conn);

?>