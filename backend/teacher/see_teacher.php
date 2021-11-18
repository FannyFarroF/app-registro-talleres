<?php
	include('../db.php');

	$request = $_REQUEST;

	$Id = $request['Id'];

	$query = "SELECT *FROM docente WHERE IdDocente = $Id";

	$result = mysqli_query($conn, $query);

	if ($result) {
		$row = $result->fetch_row();

		echo json_encode($row);
		 		
	}

	mysqli_close($conn);
	

?>