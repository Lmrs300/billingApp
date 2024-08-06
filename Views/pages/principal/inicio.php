<?php
session_start();

if (!isset($_SESSION['id'])) {
    //para que si la sesion no esta iniciada te saque al login.
    header('location: ../../../index.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="icon" href="../../imgs/logo.ico">
    <link rel="stylesheet" href="../../css/principal.css?v=<?php echo (rand()); ?>" />
</head>

<body>
    <?php
    require("../navbar.php");
    ?>

    <h1>Bienvenido
        <?php echo $_SESSION['nombre'] ?>
    </h1>

    <div class=logo_principal>
        <img class="logo" src="../../imgs/logo.png">
    </div>
    <h2>Sistema de facturación</h2>

</body>

</html>