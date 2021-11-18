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
            <h4>Gestión de Escuelas</h4>
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <a href="./index.php">
                        Inicio
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Escuelas</li>
            </ol>
        </nav>
    </div>

    <div class="container my-4 py-3 bg-white rounded">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Nueva Escuela
                    </div>
                    <div class="card-body">

                        <form id="register_school">
                            <div class="mb-3">
                                <label for="Descripcion" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="Descripcion">
                            </div>

                            <div class="mb-3">
                                <label for="Nivel" class="form-label">Nivel</label>
                                <select class="form-select" id="Nivel">
                                    <option selected>Seleccionar el nivel</option>
                                    <option value="Primario">Primario</option>
                                    <option value="Secundario">Secundario</option>
                                    <option value="Primario y Secundario">Primaria y Secundario</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="Direccion" class="form-label">Direccion</label>
                                <input type="text" class="form-control" id="Direccion">
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
                            <th scope="col">Nombre</th>
                            <th scope="col">Nivel</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="schools">

                    </tbody>
                </table>
            </div>
        </div>

    </div>


    <?php include('Layouts/scripts.php')?>

    <script type="text/javascript">
    $(document).ready(function() {
        list_school();

        function list_school() {
            console.log("Cargando el listado de escuelas")
            $.ajax({
                type: "GET",
                url: "backend/school/list_school.php",
                cache: false,
                success: function(response) {
                    console.log(`ESCUELAS: ${response}`)

                    let schools = JSON.parse(response);
                    let rows = ``;

                    schools.forEach(school => {
                        rows += `
                            <tr>
                                <th scope="row">${school.IdEscuela}</th>
                                <td>${school.Descripcion}</td>
                                <td>${school.Nivel}</td>
                                <td>${school.Estado == 'Habilitado' ? '<i class="fas fa-check text-success"></i>':'<i class="fas fa-times text-danger"></i>' } </td>
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

                    $('#schools').html(rows);

                }
            });
        }

        $("#register_school").submit(function(event) {

            var Descripcion = $("#Descripcion").val();
            var Nivel = $("#Nivel").val();
            var Direccion = $("#Direccion").val();


            if (Descripcion !== "" && Nivel !== "") {
                $.ajax({
                    type: "POST",
                    url: "backend/school/insert_school.php",
                    cache: false,
                    data: {
                        Descripcion: Descripcion,
                        Nivel: Nivel,
                        Direccion: Direccion
                    },
                    success: function(datos) {
                        list_school();
                        $("#register_school")[0].reset();
                        console.log("Registro exitoso!")
                    }
                });
            } else {
                console.log("Datos vacíos");
            }
            event.preventDefault();
        });

    });
    </script>
</body>


</html>