<?php
    include('../db.php');

	$request		= $_REQUEST;
	$buscar			= $request['buscar'];
	
	$sql = "SELECT  *FROM estudiante 
			INNER JOIN escuela ON escuela.IdEscuela = estudiante.IdEscuela
			WHERE 
				estudiante.NumeroDocumento LIKE '%$buscar%'
				OR estudiante.Nombres LIKE '%$buscar%'
				OR estudiante.Apellidos LIKE '%$buscar%'
				OR estudiante.Codigo LIKE '%$buscar%'
			";

	$result = mysqli_query($conn, $sql);
	
	if ($result) {
		
		$json = array();
		while ( $row = mysqli_fetch_array($result) ) {
			$json[] = array(
				'IdEstudiante' =>  $row['IdEstudiante'],
				'NumeroDocumento' =>  $row['NumeroDocumento'],
				'Codigo' =>  $row['Codigo'],
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