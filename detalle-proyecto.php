<?php
include 'db/conexion.php';

if(!isset($_GET['id'])){    
    header('Location: index.php');
}

$id = $_GET['id'];

$conexion = new Conexion();
$resultado = $conexion->ejecutarConsulta("SELECT * FROM proyectos WHERE id = $id");

if(count($resultado) == 0){
    header('Location: index.php');
}

$DIRS_IMAGENES = 'static/img/portafolio/';

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Proyecto <?php echo $resultado[0]['nombre']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container ">
        <a href="index.php" class="btn btn-primary my-2">Volver al listado</a>
        <div class="jumbotron my-3 bg-light">
            <img src="<?php echo $DIRS_IMAGENES.$resultado[0]['imagen']; ?>" alt="Imagen del proyecto" class="img-fluid" style="width: 100%; height: auto;">
            <h1 class="display-4">PROYECTO <?php echo strtoupper($resultado[0]['nombre']); ?></h1>
            <p><?php echo $resultado[0]['descripcion_corta']; ?></p>
        </div>
        
        <h3>Descripcion</h3>

        <p><?php echo $resultado[0]['descripcion']; ?></p>

        <!-- Pie de pagina -->
        <div class="mt-5">
           
            <footer class="mt-2">
                <p class="text-center">Derechos reservados &copy; 2025</p>
            </footer>

        </div>
    </div>

   


</body>

</html>