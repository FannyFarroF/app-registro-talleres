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

    <div class="container  mt-5 py-3 bg-white rounded">
        <nav aria-label="breadcrumb" class="d-flex flex-column ">
            <h4>Gestión de Estudiantes</h4>
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <a href="./index.php">
                        Inicio
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Estudiantes</li>
            </ol>
        </nav>
    </div>


    <div class="container my-4 py-3 bg-white rounded">

        <div class="d-flex justify-content-end mb-4">

            <button class="btn btn-success" type="button" data-bs-toggle="offcanvas" data-bs-target="#register_student"
                aria-controls="offcanvasRight">
                Nuevo Estudiante
            </button>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Núm. Documento</th>
                    <th scope="col">Nombres</th>
                    <th scope="col">Escuela</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody id="students">

            </tbody>
        </table>
    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="register_student" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Nuevo Estudiante</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form id="form_register_student">
                <div class="mb-2">
                    <label for="numeroDocumento" class="form-label">Número de documento</label>
                    <input type="text" class="form-control" name="numeroDocumento" id="numeroDocumento">
                </div>
                <div class="mb-2">
                    <label for="nombres" class="form-label">Nombres</label>
                    <input type="text" class="form-control" name="nombres" id="nombres">
                </div>
                <div class="mb-2">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" name="apellidos" id="apellidos">
                </div>

                <div class="mb-2">
                    <label for="escuelas" class="form-label">Escuela</label>
                    <select class="form-select" name="escuela" id="escuelas">
                        <option value="0" selected>Seleccionar la escuela</option>
                    </select>
                </div>

                <hr>

                <div class="mb-2">
                    <label for="opcion_curso" class="form-label">Cursos</label>

                    <div class="row">
                        <div class="col-md-8">
                            <select class="form-select" id="opcion_curso">
                                <option value="0" selected>Seleccionar la cursos</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button id="agregar_curso" class="btn btn-secondary">Agregar</button>
                        </div>
                    </div>
                </div>

                <div class="mb-2">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col"> </th>
                            </tr>
                        </thead>
                        <tbody id="lits-cursos">

                        </tbody>
                    </table>
                </div>

                <button type="submit" class="btn btn-success">Guardar</button>
            </form>
        </div>
    </div>




    <?php include('Layouts/scripts.php')?>

    <script type="text/javascript">
    let index = 0;
    $(document).ready(function() {
        cargarEscuelas();
        cargarCursos();

        $('#agregar_curso').on('click', function(e) {
            agregar_curso();
            e.preventDefault();
        });

        $('#lits-cursos').on('click', function(e) {
            eliminar_curso(e);
        });
    });

    function cargarEscuelas() {
        $.ajax({
            type: "GET",
            url: "backend/school/list_school.php",
            cache: false,
            success: function(response) {

                let schools = JSON.parse(response);
                let rows = ``;

                schools.forEach(school => {
                    rows += `
                        <option value="${school.IdEscuela}" name="escuela">
                            ${school.Descripcion}
                        </option>
                    `;
                });

                $('#escuelas').append(rows);

            }
        });
    }

    function cargarCursos() {
        $.ajax({
            type: "GET",
            url: "backend/course/list_courses.php",
            cache: false,
            success: function(response) {
                let datos = JSON.parse(response);
                let rows = ``;

                datos.forEach(item => {
                    rows += `
                        <option value="${item.IdCurso}">${item.Descripcion}</option>
                    `;
                });

                $('#opcion_curso').append(rows);

            }
        });
    }

    function eliminar_curso(e) {
        e.preventDefault();

        if (e.target.classList.contains('btn-eliminar-item')) {
            let curso = e.target.getAttribute('data-id');
            $('#' + curso).remove();
            index -= 1;
        }

    }

    function agregar_curso() {
        const IdCurso = $('#opcion_curso').val();
        const NombreCurso = $('#opcion_curso option:selected').text();

        if (IdCurso > 0) {

            index += 1;
            let row = `
                    <tr id="${IdCurso}">
                        <th scope="row">${index}</th>
                        <td>
                            ${NombreCurso}
                            <input value="${IdCurso}" name="cursos[]" id="cursos[]" hidden>
                        </td>
                        <td class="text-end">
                            <a href="#" data-id="${IdCurso}" class="btn btn-danger p-1 btn-eliminar-item fas fa-trash" title="Eliminar curso">
                            </a>
                        </td>
                    </tr>
                `;

            $('#lits-cursos').append(row);

        }
    }
    </script>
</body>

</html>