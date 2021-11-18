<?php
   include('./backend/db.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <?php include('Layouts/styles.php')?>
</head>

<body class="bg-light">
    <?php include('Layouts/nav.php')?>

    <div class="container  mt-5 py-4 px-5 bg-white rounded-3 ">

        <h3 class="fs-3 fw-600">Bienvenido</h3>
        <h1 class="text-primary fw-bold">ADMIN!</h1>
        <p class="fs-6">
            Sistema de inscripción de cursos de taller de verano 2022
        </p>
    </div>

    <div class="container  my-5 py-4  px-5 bg-white rounded-3">
        <div class="row">
            <div class="col-md-6">
                <h4 class="">Búsqueda de alumnos</h4>
            </div>
            <div class="col-md-6">
                <form class="d-flex" id="form_buscador">
                    <input class="form-control me-2" type="search" placeholder="Buscar alumnos por nombres o dni"
                        aria-label="Search" id="a_buscar" name="buscar">
                    <button class="btn btn-outline-success" type="submit">Buscar</button>
                </form>
            </div>
        </div>

        <div id="lits_results" class="mt-4">

        </div>
    </div>


    <?php include('Layouts/scripts.php')?>

    <script type="text/javascript">
    $(document).ready(function() {
        $("#form_buscador").submit(function(event) {
            event.preventDefault();

            let abuscar = $("#a_buscar").val();
            let IdEstudiante;

            if (abuscar != ' ') {
                $.ajax({
                    type: "GET",
                    url: "backend/student/see_student.php",
                    cache: false,
                    data: $('#form_buscador').serialize(),
                    success: function(response) {
                        console.log(response)

                        let rpta = JSON.parse(response);
                        let rows = ``;

                        rpta.forEach(item => {
                            IdEstudiante = item.IdEstudiante;
                            rows += `
                                <div class="card">
                                    <div class="card-header">
                                        Información General 
                                    </div>
                                    <div class="card-body">
                                        <div class="row my-2">
                                            <div class="col-md-3 mb-3">
                                                <label class="mb-2">
                                                    DNI
                                                </label>
                                                <input class="form-control" value="${item.NumeroDocumento}" readonly/>
                                            </div>

                                             <div class="col-md-3 mb-3">
                                                <label class="mb-2">
                                                    Código
                                                </label>
                                                <input class="form-control" value="${item.Codigo}" readonly/>
                                            </div>
                                        
                                            <div class="col-md-6 mb-3">
                                                <label class="mb-2">
                                                    Nombres
                                                </label>
                                                <input class="form-control" value="${item.Nombres}  ${item.Apellidos}" readonly/>
                                            </div>
                                        </div>
                                        <div class="row my-2">
                                            <div class="col-md-6 mb-3">
                                                <label class="mb-2">
                                                    Escuela
                                                </label>
                                                <input class="form-control" value="${item.Escuela}" readonly/>
                                            </div>
                                             <div class="col-md-6 mb-3">
                                                <label class="mb-2">
                                                    Nivel
                                                </label>
                                                <input class="form-control" value="${item.NivelEscuela}" readonly/>
                                            </div>
                                        
                                        </div>

                                        <hr>

                                        <h6>Curso matriculados</h6>
                                        
                                        <div id="cursos_matriculados">
                                            
                                        </div>

                                    </div>
                                </div>
                    `;
                        });

                        $('#lits_results').html(rows);

                        listar_cursos_matriculador(IdEstudiante)

                    }
                });
            } else {
                console.log("Busqueda de nada");
            }

        });


        function listar_cursos_matriculador(IdEstudiante) {
            console.log(`A punto de listar los cursos matriculados del ${IdEstudiante}`);

            $.ajax({
                type: "GET",
                url: "backend/register/see_register.php",
                cache: false,
                data: {
                    IdEstudiante: IdEstudiante
                },
                success: function(response) {
                    let datos = JSON.parse(response);

                    console.log(response)
                    let rows = ``;

                    datos.forEach(item => {
                        rows += `
                            <div class="card my-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3 my-2">
                                            <label class="mb-2">
                                                Código: ${item.CodigoCurso}
                                            </label>    
                                        </div>
                                        <div class="col-md-3 my-2">
                                            <label class="mb-2">
                                                Curso: ${item.DescripcionCurso}
                                            </label>
                                        </div>
                                        <div class="col-md-3 my-2">
                                            <label class="mb-2">
                                                Num. Horas: ${item.Horas} hrs.
                                            </label>
                                        </div>
                                        <div class="col-md-3 my-2">
                                            <label class="mb-2">
                                                Docente: ${item.NombreDocente} ${item.ApellidosDocente} 
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    `;
                    });

                    $('#cursos_matriculados').append(rows);

                }
            });
        }

    });
    </script>
</body>

</html>