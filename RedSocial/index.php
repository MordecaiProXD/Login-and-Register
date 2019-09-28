<?php
    require("database.php");

    session_start();

    if(isset($_SESSION['usuario'])){
        $sql = "SELECT * FROM user WHERE id=:id";
        $resultado = $conn->prepare($sql);
        $resultado->bindParam(":id", $_SESSION['usuario']);
        $resultado->execute();
        $fila = $resultado->fetch(PDO::FETCH_ASSOC);
    }else{
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
        echo $fila['usuario'];
    ?>
        inicio, publicaciones y todo lo demas<br>
        <a href="logout.php">Cerrar Sesion</a>
    <?php else: ?>
        <a href="signup.php">Registrate</a><p> o </p><a href="login.php">Logueate</a>
    <?php endif; ?>
</body>
</html>