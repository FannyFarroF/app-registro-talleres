<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3">
    <div class="container container-fluid">
        <a class="navbar-brand fw-bold" href="./">SISVE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="./student.php">Estudiantes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./school.php">Escuelas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./course.php">Cursos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./teacher.php">Docentes</a>
                </li>
            </ul>

            <div class="dropdown">
                <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user-cog me-2"></i>
                    Admin
                </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="#">Editar perfil</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>