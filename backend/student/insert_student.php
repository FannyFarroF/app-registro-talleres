<?php
    include('../db.php');

	$request		= $_REQUEST;

	$numDoc			= $request['numeroDocumento'];
	$nombres		= $request['nombres'];
	$apellidos		= $request['apellidos'];
	$escuela		= $request['escuela'];
	$cursos			= $request['cursos'];
	$codigo			= substr(md5(time()), 0, 6);

	$query 			= "INSERT INTO `estudiante`( `NumeroDocumento`, `Codigo`,`Nombres`,`Apellidos`, `IdEscuela`,`Estado`) VALUES ('$numDoc', '$codigo', '$nombres', '$apellidos', '$escuela', 'Habilitado')";
		
	if (!mysqli_query($conn, $query)) {
		echo "Error: " . $query . "<br>" . mysqli_error($conn);
	}
	
	$IdEstudiante 	= mysqli_insert_id($conn);

    if (sizeof($cursos) > 0 ) {
        for ($i=0; $i < sizeof($cursos); $i++) {
            $query2 =  "INSERT INTO `matricula`( `IdEstudiante`, `IdCurso`, `Estado`) VALUES ('$IdEstudiante', '$cursos[$i]', 'Habilitado')";
            
            if (!mysqli_query($conn, $query2)) {
                echo "Error: " . $query2 . "<br>" . mysqli_error($conn);
            }
        }
    }

	echo json_encode(array("statusCode"=>200));
	mysqli_close($conn);
	
	#if (mysqli_query($conn, $sql)) {
	#	echo json_encode(array("statusCode"=>200));
	#} 
	#else {
	#	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	#}
	
?>