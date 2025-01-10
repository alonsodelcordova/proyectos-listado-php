<?php
include 'db/conexion.php';
include 'components/cabecera.php';

$conexion = new Conexion();
$resultado = $conexion->ejecutarConsulta("SELECT * FROM proyectos");

$DIRS_IMAGENES = 'static/img/portafolio/';

?>


<div class="jumbotron my-3 bg-light">
    <h1 class="display-4">Bienvenido a mi portafolio</h1>
    <p class="lead">Este es un ejemplo de un portafolio en PHP</p>
    <hr class="my-4">
    <p>Este es un ejemplo de un portafolio en PHP</p>
    <a class="btn btn-primary btn-lg" href="#" role="button">Leer más</a>
</div>

<div class="row">
    <?php foreach($resultado as $proyecto){ ?>
        <div class="col-md-4 p-2">
            <div class="card">
                <img src="<?php echo $DIRS_IMAGENES.$proyecto['imagen']; ?>" alt="Imagen del proyecto" class="card-img-top" >
                <div class="card-body">
                    <h5 class="card-title"><?php echo $proyecto['nombre']; ?></h5>
                    <p class="card-text"><?php echo $proyecto['descripcion_corta']; ?></p>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<?php
include 'components/pie.php';
?>


