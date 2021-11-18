<?php
    include('../db.php');

	$sql = "SELECT  *FROM curso inner join docente on docente.IdDocente = curso.IdDocente";
	$result = mysqli_query($conn, $sql);
	
	if ($result) {
		
		$json = array();
		while ( $row = mysqli_fetch_array($result) ) {
			$json[] = array(
				'IdCurso' =>  $row['IdCurso'],
				'Codigo' =>  $row['CodigoCurso'],
				'Descripcion' =>  $row['Descripcion'],
				'Horas' =>  $row['Horas'],
				'DocenteNombres' =>  $row['Nombres'],
				'DocenteApellidos' =>  $row['Apellidos'],
				'Estado' =>  $row['Estado'],
			);
		}	

		$jsonstring = json_encode($json);
		echo $jsonstring;		
	}

	mysqli_close($conn);
	
?>