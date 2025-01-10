<?php
include 'db/conexion.php';

$conexion = new Conexion();
$resultado = $conexion->ejecutarConsulta("SELECT id, nombre, imagen, descripcion_corta FROM proyectos ORDER BY id DESC");

$DIRS_IMAGENES = 'static/img/portafolio/';

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Proyectos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="jumbotron my-3 bg-light">
            <h1 class="display-4">PROYECTOS SHOP</h1>
            <p class="lead">Listado de proyectos</p>
            <hr class="my-4">
            <p>Los proyectos en el portafolio son los siguientes:</p>
        </div>

        <div class="row">
            <?php foreach($resultado as $proyecto){ ?>
                <div class="col-md-4 p-2">
                    <a href="detalle-proyecto.php?id=<?php echo $proyecto['id']; ?>" class="text-decoration-none">
                        <div class="card">
                            <img src="<?php echo $DIRS_IMAGENES.$proyecto['imagen']; ?>" alt="Imagen del proyecto"
                                class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php echo $proyecto['nombre']; ?>
                                </h5>
                                <p class="card-text">
                                    <?php echo $proyecto['descripcion_corta']; ?>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>

        <!-- Pie de pagina -->
        <div class="mt-5">
            <br>
            <a class="btn btn-primary" href="login.php">Login</a>
            <footer class="mt-2">
                <p class="text-center">Derechos reservados &copy; 2025</p>
            </footer>

        </div>
    </div>

   


</body>

</html>