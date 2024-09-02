<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Project Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .carousel-image {
            width: 100%;
            height: 600px; /* Adjust the height as needed */
            object-fit: cover; /* Ensures the image covers the entire area without distortion */
        }
    </style>
</head>
<body class="bg-light text-dark">
<header class="bg-primary text-white p-4 d-flex justify-content-between align-items-center">
    <h1 class="h2">Proyecto Dashboard</h1>
    <nav>
        <a href="{{ route('formLogin') }}" class="text-white me-4">Login</a>
        <a href="{{ route('newUser') }}" class="text-white">Registrar</a>
    </nav>
</header>
<main class="p-4">
    <section class="bg-white shadow rounded p-4">
        <h2 class="h4">Resumen de proyectos y usuarios</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="bg-white shadow rounded p-4">
                    <h2 class="h5">Usuarios</h2>
                    <p class="small">Total de usuarios: {{ $totalUsers }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-white shadow rounded p-4">
                    <h2 class="h5">Proyectos</h2>
                    <p class="small">Total de proyectos: {{ $totalProjects }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-white shadow rounded p-4">
                    <h2 class="h5">Proyectos recientes</h2>
                    <p class="small">{{ $recentProjects }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white shadow rounded p-4 mt-4">
        <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://www.claracanalingenieria.com/wp-content/uploads/2017/12/gesti%C3%B3n-de-proyectos.jpg" class="d-block w-100 carousel-image" alt="Image 1">
                </div>
                <div class="carousel-item">
                    <img src="https://www.obsbusiness.school/sites/obsbusiness.school/files/images/4-tecnicas-de-gestion-de-proyectos-de-exito.jpg" class="d-block w-100 carousel-image" alt="Image 2">
                </div>
                <div class="carousel-item">
                    <img src="https://economia3.com/wp-content/uploads/2022/11/business-team-connect-pieces-of-gears-teamwork-partnership-and-picture-id1203832818-1.jpg" class="d-block w-100 carousel-image" alt="Image 3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
</main>
<footer class="bg-dark text-white text-center p-4 mt-4">
    <p>&copy; 2024 Proyecto Dashboard</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
