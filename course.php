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
            <h4>Gestión de Cursos</h4>
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <a href="./index.php">
                        Inicio
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Cursos</li>
            </ol>
        </nav>
    </div>

    <div class="container my-4 py-3 bg-white rounded">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Nuevo Curso
                    </div>
                    <div class="card-body">

                        <form id="register_course">
                            <div class="mb-3">
                                <label for="codigo" class="form-label">Codigo</label>
                                <input type="text" class="form-control" id="codigo">
                            </div>

                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripcion</label>
                                <input type="text" class="form-control" id="descripcion">
                            </div>

                            <div class="mb-3">
                                <label for="horas" class="form-label">Horas</label>
                                <input type="text" class="form-control" id="horas">
                            </div>

                            <div class="mb-3">
                                <label for="docente" class="form-label">Docente</label>
                                <select class="form-select" id="docente">
                                    <option selected>Seleccionar el docente</option>

                                </select>
                            </div>

                            <button type="submit" class="btn btn-success">Guardar</button>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Código</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Docente</th>
                            <th scope="col">Horas</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="courses">

                    </tbody>
                </table>
            </div>
        </div>

    </div>


    <?php include('Layouts/scripts.php')?>

    <script type="text/javascript">
    $(document).ready(function() {
        listado();
        cargarDocentes();

        function listado() {
            console.log("Cargando el listado de cursos")
            $.ajax({
                type: "GET",
                url: "backend/course/list_courses.php",
                cache: false,
                success: function(response) {
                    console.log(`CURSOS: ${response}`)

                    let datos = JSON.parse(response);
                    let rows = ``;

                    datos.forEach(item => {
                        rows += `
                            <tr>
                                <th scope="row">${item.IdCurso}</th>
                                <td>${item.Codigo}</td>
                                <td>${item.Descripcion}</td>
                                <td>${item.DocenteNombres} ${item.DocenteApellidos}</td>
                                <td>${item.Horas} hrs.</td>
                                <td>${item.Estado == 'Habilitado' ? '<i class="fas fa-check text-success"></i>':'<i class="fas fa-times text-danger"></i>' } </td>
                                <td>
                                    <a href="" class="btn btn-warning p-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="" class="btn btn-danger p-2">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        `;
                    });

                    $('#courses').html(rows);

                }
            });
        }

        $("#register_course").submit(function(event) {

            var codigo = $("#codigo").val();
            var descripcion = $("#descripcion").val();
            var horas = $("#horas").val();
            var docente = $("#docente").val();


            if (codigo !== "" && descripcion !== "" && horas !== "" && docente !== "") {
                $.ajax({
                    type: "POST",
                    url: "backend/course/insert_course.php",
                    cache: false,
                    data: {
                        Codigo: codigo,
                        Descripcion: descripcion,
                        Horas: horas,
                        Docente: docente
                    },
                    success: function(datos) {
                        listado();
                        $("#register_course")[0].reset();
                        console.log("Registro exitoso!")
                    }
                });
            } else {
                console.log("Datos vacíos");
            }
            event.preventDefault();
        });

        function cargarDocentes() {
            $.ajax({
                type: "GET",
                url: "backend/teacher/list_teachers.php",
                cache: false,
                success: function(response) {

                    let datos = JSON.parse(response);
                    let rows = ``;

                    if (datos.length > 0) {
                        datos.forEach(item => {
                            rows += `
                            <option value="${item.IdDocente}">${item.Nombres} ${item.Apellidos}</option>
                        `;
                        });

                        $('#docente').append(rows);
                    }

                }
            });
        }

    });
    </script>
</body>


</html>