<?php
include 'db/conexion.php';
session_start();
if($_POST){
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    if($usuario == '' || $password == ''){
        echo "<script>alert('Usuario y password son requeridos');</script>";
    }

    $conexion = new Conexion();
    $sSql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND password = '$password' AND estado = true";
    $resultado = $conexion->ejecutarConsulta($sSql);

    if(count($resultado) > 0){
        $_SESSION['usuario'] = $resultado[0]['usuario'];
        $_SESSION['id'] = $resultado[0]['id'];
        header('Location: admin.php');
    }else{
        echo "<script>alert('Usuario o password incorrectos');</script>";
    }

}



?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card card-body">
                    <h1>Login</h1>
                    <form action="login.php" method="post">

                        <div class="form-group my-2">
                            <label for="usuario">Usuario</label>
                            <input type="text" name="usuario" id="usuario" class="form-control">
                        </div>

                        <div class="form-group my-2">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Login</button>

                    </form>
                </div>
            </div>
        </div>
    </div>


</body>

</html>