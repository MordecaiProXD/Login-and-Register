<?php
    session_start();
    require("database.php");
    if(isset($_POST['nombre']) and isset($_POST['correo']) and isset($_POST['clave']) and isset($_POST['edad']) and isset($_POST['fecha'])){
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $clave = $_POST['clave'];
        $edad = $_POST['edad'];
        $fecha = $_POST['fecha'];

        $sql = "INSERT INTO user (usuario, correo, clave, edad, fecha_nacimiento) VALUES (:nombre, :correo, :clave, :edad, :fecha)";
        $resultado = $conn->prepare($sql);
        $resultado->bindParam(":nombre",$nombre);
        $resultado->bindParam(":correo",$correo);
        $resultado->bindParam(":clave",$clave);
        $resultado->bindParam(":edad",$edad);
        $resultado->bindParam(":fecha",$fecha);
        
        if($resultado->execute()){
            echo "Se ah creado tu usuario exitosamente";
            header("Location: login.php");
        }else{
            echo "No se integró el usuario";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php
        include("include/metaPrincipal.php");
    ?>
</head>
<body>
    <?php 
        if(!empty($_SESSION['usuario'])): 
        header("Location: ./");
    ?>
        
    <?php else: ?>
        <form method="post">
            <h3>Usuario</h3>
            <input type="text" name="nombre" style="width:100%;">
            <h3>Correo</h3>
            <input type="email" name="correo" style="width:100%;">
            <h3>Contraseña</h3>
            <input type="password" name="clave" style="width:100%;">
            <h3>Edad</h3>
            <input type="number" name="edad" id="">
            <h3>Fecha_Nacimiento</h3>
            <input type="date" name="fecha" value="2006-0-0" max="2006-12-12" min="1950-0-0">
            <br><br>
            <button type="submit">Iniciar Sesión</button>
        </form>
    <?php endif; ?>
</body>
</html>