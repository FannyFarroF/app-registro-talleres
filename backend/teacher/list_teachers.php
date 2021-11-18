<?php
    include('../db.php');

	$sql = "SELECT  *FROM docente";
	$result = mysqli_query($conn, $sql);
	
	if ($result) {
		
		$json = array();
		while ( $row = mysqli_fetch_array($result) ) {
			$json[] = array(
				'IdDocente' =>  $row['IdDocente'],
				'Codigo' =>  $row['CodigoDocente'],
				'Nombres' =>  $row['Nombres'],
				'Apellidos' =>  $row['Apellidos'],
				'Estado' =>  $row['Estado'],
			);
		}	

		$jsonstring = json_encode($json);
		echo $jsonstring;		
	}

	mysqli_close($conn);
	
?>