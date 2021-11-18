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
            <h4>Gestión de Docentes</h4>
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <a href="./index.php">
                        Inicio
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Docentes</li>
            </ol>
        </nav>
    </div>

    <div class="container my-4 py-3 bg-white rounded">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Nuevo Docente
                    </div>
                    <div class="card-body">

                        <form id="register_teacher">
                            <div class="mb-3">
                                <label for="codigo" class="form-label">Codigo</label>
                                <input type="text" class="form-control" id="codigo">
                            </div>

                            <div class="mb-3">
                                <label for="nombres" class="form-label">Nombres</label>
                                <input type="text" class="form-control" id="nombres">
                            </div>

                            <div class="mb-3">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos">
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
                            <th scope="col">Estado</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="teachers">

                    </tbody>
                </table>
            </div>
        </div>

    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Docente </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="update_teacher">
                        <input type="text" class="form-control" name="docente_id_editar" id="docente_id_editar" hidden>

                        <div class="mb-3">
                            <label for="codigo_form2" class="form-label">Codigo</label>
                            <input type="text" class="form-control" id="codigo_form2" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="nombres_form2" class="form-label">Nombres</label>
                            <input type="text" class="form-control" name="nombres_form2" id="nombres_form2">
                        </div>

                        <div class="mb-3">
                            <label for="apellidos_form2" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" name="apellidos_form2" id="apellidos_form2">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteLabel">Eliminar Docente </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <p class="text-center">
                        ¿ Está seguro que desea eliminar el docente
                    </p>
                    <p class="text-center" id="nombres_docente"></p>

                    <form id="form_delete">
                        <input type="text" class="form-control" name="docente_id" id="docente_id" hidden>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>

    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToast" class="toast align-items-center hide text-white bg-success border-0" role="alert"
            aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
            <div class="d-flex align-items-center">
                <span class="ms-2">
                    <i class="fas fa-check-circle"></i>
                </span>
                <div class="toast-body" id="mensaje_toast">
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>


    <?php include('Layouts/scripts.php')?>

    <script type="text/javascript">
    $(document).ready(function() {
        listado();

        $('#teachers').click(function(e) {
            if (e.target.classList.contains('verRegistro')) {
                let id = e.target.getAttribute('data-id');
                recuperar(id);
            } else if (e.target.classList.contains('eliminarRegistro')) {
                let id = e.target.getAttribute('data-id');
                eliminar(id);
            }
        });

        function recuperar(id) {
            let Codigo = $('#codigo_form2');
            let Nombres = $('#nombres_form2');
            let Apellidos = $('#apellidos_form2');

            $("#docente_id_editar").val(id);

            $.ajax({
                type: "POST",
                url: "backend/teacher/see_teacher.php",
                cache: false,
                data: {
                    Id: id
                },
                success: function(response) {
                    let datos = JSON.parse(response);
                    Codigo.val(datos[1]);
                    Nombres.val(datos[2]);
                    Apellidos.val(datos[3]);
                }
            });
        }

        function eliminar(id) {
            let docente_nombres = $('#nombres_docente');
            $('#docente_id').val(id);

            $.ajax({
                type: "POST",
                url: "backend/teacher/see_teacher.php",
                cache: false,
                data: {
                    Id: id
                },
                success: function(response) {
                    let datos = JSON.parse(response);
                    let nombres = `${datos[2]} ${datos[3]} ?`;
                    docente_nombres.text(nombres);

                    $("#modalDelete").modal("show");
                }
            });
        }

        function listado() {
            $.ajax({
                type: "GET",
                url: "backend/teacher/list_teachers.php",
                cache: false,
                success: function(response) {
                    let datos = JSON.parse(response);
                    let rows = ``;

                    datos.forEach(item => {

                        if (item.Estado == 'Habilitado') {

                            rows += `
                                <tr>
                                    <th scope="row">${item.IdDocente}</th>
                                    <td>${item.Codigo}</td>
                                    <td>${item.Nombres} ${item.Apellidos}</td>
                                    <td>${item.Estado == 'Habilitado' ? '<i class="fas fa-check text-success"></i>':'<i class="fas fa-times text-danger"></i>' } </td>
                                    <td>
                                        <button type="button" data-id="${item.IdDocente}" class="btn btn-warning verRegistro p-2 fas fa-edit" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        </button>
                                        <button type="button" data-id="${item.IdDocente}" class="btn btn-danger eliminarRegistro p-2 fas fa-trash" >
                                        </button>
                                    </td>
                                </tr>
                            `;

                        }

                    });

                    $('#teachers').html(rows);
                }
            });
        }

        $("#register_teacher").submit(function(event) {

            var Codigo = $("#codigo").val();
            var Nombres = $("#nombres").val();
            var Apellidos = $("#apellidos").val();


            if (Codigo !== "" && Nombres !== "") {
                $.ajax({
                    type: "POST",
                    url: "backend/teacher/insert_teacher.php",
                    cache: false,
                    data: {
                        Codigo: Codigo,
                        Nombres: Nombres,
                        Apellidos: Apellidos
                    },
                    success: function(datos) {
                        listado();
                        $("#register_teacher")[0].reset();
                        console.log("Registro exitoso!")
                    }
                });
            } else {
                console.log("Datos vacíos");
            }
            event.preventDefault();
        });

        $("#update_teacher").submit(function(event) {

            let nombres_form2 = $("#nombres_form2").val();
            let apellidos_form2 = $("#apellidos_form2").val();

            if (nombres_form2 != "" && apellidos_form2 != "") {
                $.ajax({
                    type: "POST",
                    url: "backend/teacher/update_teacher.php",
                    cache: false,
                    data: $('#update_teacher').serialize(),
                    success: function(datos) {

                        response = JSON.parse(datos)

                        if (response['statusCode'] == 200) {
                            $("#exampleModal").modal("hide");
                            listado();

                            $("#mensaje_toast").text(response['mensaje']);
                            $("#liveToast").toast('show');
                        }

                    }
                });

                event.preventDefault();

            }

        });

        $("#form_delete").submit(function(event) {

            var Codigo = $("#codigo").val();

            $.ajax({
                type: "POST",
                url: "backend/teacher/delete_teacher.php",
                cache: false,
                data: $('#form_delete').serialize(),
                success: function(datos) {

                    response = JSON.parse(datos)

                    if (response['statusCode'] == 200) {
                        $("#modalDelete").modal("hide");
                        listado();

                        $("#mensaje_toast").text(response['mensaje']);
                        $("#liveToast").toast('show');
                    }

                }
            });

            event.preventDefault();

        });

    });
    </script>
</body>


</html>