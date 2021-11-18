<?php
    include('../db.php');

	$sql = "SELECT  *FROM escuela";
	$result = mysqli_query($conn, $sql);
	
	if ($result) {
		
		$json = array();
		while ( $row = mysqli_fetch_array($result) ) {
			$json[] = array(
				'IdEscuela' =>  $row['IdEscuela'],
				'Descripcion' =>  $row['Descripcion'],
				'Nivel' =>  $row['Nivel'],
				'Direccion' =>  $row['Direccion'],
				'Estado' =>  $row['Estado'],
			);
		}	

		$jsonstring = json_encode($json);
		echo $jsonstring;		
	}

	mysqli_close($conn);
	
?>