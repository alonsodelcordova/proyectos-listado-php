<?php
include 'db/conexion.php';

include 'components/cabecera.php';

$DIRS_IMAGENES = 'static/img/portafolio/';

$conexion = new Conexion();

$id_usuario = $_SESSION['id'];


if($_GET){
    $id = $_GET['id'];
    $accion = $_GET['accion'];



    if($accion == 'eliminar'){
        
        $sSql = "SELECT imagen, usuario_id FROM proyectos WHERE id = $id";
        $resultado = $conexion->ejecutarConsulta($sSql);

        if($resultado){

            if($resultado[0]['usuario_id'] != $id_usuario){
                echo "<script>alert('No tienes permisos para eliminar este proyecto');</script>";
                return;
            }


            $imagen_name = $resultado[0]['imagen'];

            $sSql = "DELETE FROM proyectos WHERE id = $id";
            $conexion->ejecutar($sSql);  
            if($imagen_name != ''){
                unlink($DIRS_IMAGENES.$imagen_name);
            }
            
        }else{
            echo "<script>alert('No existe el proyecto');</script>";
        }
        header('Location: portafolio.php');
    }
}

if($_POST){
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $descripcion_corta = $_POST['descripcion_corta'];

    $imagen_name = '';
    if($_FILES['imagen']['name'] != ''){
        $fecha = new DateTime();
        $imagen_name = $fecha->getTimestamp().'_'.$_FILES['imagen']['name'];
        $imagen_destino = $DIRS_IMAGENES.$imagen_name;
        move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen_destino);
    }

    $sSql = "INSERT INTO proyectos(nombre, imagen, descripcion, descripcion_corta, usuario_id) VALUES ('$nombre', '$imagen_name', '$descripcion', '$descripcion_corta', $id_usuario)";
    $conexion->ejecutar($sSql);
    header('Location: portafolio.php');
}


$sSql = "SELECT p.*, u.usuario FROM proyectos p INNER JOIN usuarios u ON p.usuario_id = u.id";
$resultado = $conexion->ejecutarConsulta($sSql);

?>
<div class="my-3">
    <div class="row">
        <div class="col-lg my-2">
            <div class="card">
                <div class="card-header">
                    <h5>Datos del proyecto</h5>
                </div>
                <div class="card-body">

                    <form action="portafolio.php" method="post" enctype="multipart/form-data">
                        <div class="form-group my-2">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required>
                        </div>
                        <div class="form-group my-2">
                            <label for="precio">Imagen</label>
                            <input type="file" name="imagen" id="imagen" class="form-control" required>
                        </div>

                        <div class="form-group my-2">
                            <label for="descripcion_corta">Descripcion Corta</label>
                            <textarea name="descripcion_corta" id="descripcion_corta" class="form-control" required></textarea>
                        </div>

                        <div class="form-group my-2">
                            <label for="descripcion">Descripcion</label>
                            <textarea name="descripcion" id="descripcion" class="form-control" required rows="7"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg my-2">

            <div class="card">
                <div class="card-header">
                    <h5>Proyectos</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Imagen</th>
                                <th>Descripcion Corta</th>
                                <th>Usuario</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($resultado as $proyecto){ ?>
                                <tr>
                                    <td><?php echo $proyecto['nombre']; ?></td>
                                    <td>
                                        <?php if($proyecto['imagen'] != ''): ?>
                                            <img src="<?php echo $DIRS_IMAGENES.$proyecto['imagen']; ?>" alt="Imagen del proyecto" class="img-fluid" width="100" height="100">
                                        <?php else: ?>
                                            <img src="static/img/no-image.png" alt="Imagen del proyecto" class="img-fluid" width="100" height="100">
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $proyecto['descripcion_corta']; ?></td>
                                    <td><?php echo $proyecto['usuario']; ?></td>
                                    <td>
                                        <a href="portafolio.php?id=<?php echo $proyecto['id']; ?>&accion=eliminar" class="btn btn-danger">Eliminar</a>
                                    </td>
                                </tr>
                            <?php } ?>
                            <?php if(count($resultado) == 0){ ?>
                                <tr>
                                    <td colspan="4" class="text-center">No hay proyectos</td>
                                </tr>
                            <?php } ?>
                        </tbody>

                    </table>


                </div>
            </div>

        </div>
    </div>

</div>


<?php
include 'components/pie.php';
?>