<?php
    session_start();
    require("database.php");
    if(isset($_POST['correo']) and isset($_POST['clave'])){
        $sql = "SELECT * FROM user WHERE correo=:correo AND clave=:clave";
        $resultado = $conn->prepare($sql);
        $resultado->bindParam(":correo", $_POST['correo']);
        $resultado->bindParam(":clave", $_POST['clave']);
        $resultado->execute();
        $fila = $resultado->fetch(PDO::FETCH_ASSOC);

        $_SESSION['usuario'] = $fila['id'];
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
            <h3>Correo</h3>
            <input type="email" name="correo" style="width:100%;">
            <h3>Contraseña</h3>
            <input type="password" name="clave" style="width:100%;">
            <br><br>
            <button type="submit">Iniciar Sesión</button>
        </form>
    <?php endif; ?>
</body>
</html>