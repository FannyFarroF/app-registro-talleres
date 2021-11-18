<?php
    include('../db.php');

	$sql = "SELECT  *FROM estudiante 
			INNER JOIN escuela ON escuela.IdEscuela = estudiante.IdEscuela";
	$result = mysqli_query($conn, $sql);
	
	if ($result) {
		
		$json = array();
		while ( $row = mysqli_fetch_array($result) ) {
			$json[] = array(
				'IdEstudiante' =>  $row['IdEstudiante'],
				'NumeroDocumento' =>  $row['NumeroDocumento'],
				'Nombres' =>  $row['Nombres'],
				'Apellidos' =>  $row['Apellidos'],
				'Escuela' =>  $row['Descripcion'],
				'NivelEscuela' =>  $row['Nivel'],
			);
		}	

		$jsonstring = json_encode($json);
		echo $jsonstring;		
	}

	mysqli_close($conn);
	
?>