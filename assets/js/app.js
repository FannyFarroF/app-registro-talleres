$(document).ready(function() {

    list_studentes();

    function list_studentes() {
        $.ajax({
            type: "GET",
            url: "backend/student/list_students.php",
            cache: false,
            success: function(response) {

                let students = JSON.parse(response);
                let rows = ``;

                students.forEach(student => {
                    rows += `
                        <tr>
                            <th scope="row">${student.IdEstudiante}</th>
                            <td>${student.NumeroDocumento}</td>
                            <td>${student.Nombres} ${student.Apellidos}</td>
                            <td>${student.Escuela} - ${student.NivelEscuela}</td>
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

                $('#students').html(rows);

            }
        });
    }

    $("#register_student").submit(function(event) {

        event.preventDefault();

        let numDoc = $("#numeroDocumento").val();
        let nombres = $("#nombres").val();
        let apellidos = $("#apellidos").val();
        let escuela = $("#escuelas").val();

        if (numDoc !== "" && nombres !== "" && apellidos !== "" && escuela !== "") {

            $.ajax({
                type: "POST",
                data: $('#form_register_student').serialize(),
                dataType: "json",
                url: "backend/student/insert_student.php",
                success: function(datos) {
                    $("#register_student").offcanvas("hide");
                    $("#form_register_student")[0].reset();
                    list_studentes();
                    limpiarListaCursos();
                }
            });
            
        } else {
            console.log("Datos vacíos");
        }
    });

    function limpiarListaCursos() {
        //lits-cursos
    }
});