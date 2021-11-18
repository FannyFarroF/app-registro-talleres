<?php
    include('../db.php');

	$IdEstudiante	= $_GET['IdEstudiante'];
	
	$sql = "SELECT curso.*, docente.* FROM matricula 
				inner join estudiante on estudiante.IdEstudiante = matricula.IdEstudiante
				inner join curso on curso.IdCurso = matricula.IdCurso
				inner join docente on docente.IdDocente = curso.IdDocente
				where estudiante.IdEstudiante = $IdEstudiante
			";

	$result = mysqli_query($conn, $sql);
	
	if ($result) {
		
		$json = array();
		while ( $row = mysqli_fetch_array($result) ) {
			$json[] = array(
				'CodigoCurso' =>  $row['CodigoCurso'],
				'DescripcionCurso' =>  $row['Descripcion'],
				'Horas' =>  $row['Horas'],
				'NombreDocente' =>  $row['Nombres'],
				'ApellidosDocente' =>  $row['Apellidos']
			);
		}	

		$jsonstring = json_encode($json);
		echo $jsonstring;		
	}

	mysqli_close($conn);
	
?>