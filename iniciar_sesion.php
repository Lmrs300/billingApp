<?php

include("Models/base_datos.php");

session_start();

if (isset($_SESSION['id'])) {

    //Para que si la sesion esta iniciada, lleve directamente al usuario a su pagina principal respectiva.
    header("location: Views/pages/principal/inicio.php");
}

if (isset($_POST["nom_usu"]) && isset($_POST["contra"])) {
    //Para validar datos.

    $nom_usu = $_POST["nom_usu"];
    $contra = $_POST["contra"];

    $db = new Base_datos();
    $query = $db->connect()->prepare('SELECT id_usu, nom_usu, ced_usu FROM usuarios WHERE nom_usu=:nom_usu AND contra COLLATE utf8mb4_bin =:contra');
    $query->execute([":nom_usu" => $nom_usu, ":contra" => $contra]);

    $row = $query->fetch(PDO::FETCH_ASSOC);
    if ($row == true) {
        $_SESSION['id'] = $row["id_usu"];
        $_SESSION['nombre'] = $row["nom_usu"];
        $_SESSION['cedula'] = $row["ced_usu"];

        header("location: Views/pages/principal/inicio.php");
    } else {
        $errorLogin = "El usuario o contraseña son incorrectos.";
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="icon" href="Views/imgs/logo.ico">

    <link rel="stylesheet" id="link_general" href="Views/css/general.css">
    <link rel="stylesheet" href="Views/css/iniciar_sesion.css?v=<?php echo (rand()); ?>" />

    <script src="Views/js/jquery-3.6.4.min.js"></script>

    <script>
        function viewHidePass() {
            const contraInput = $("#contra")

            const eye = $(".ver_contra")

            if (contraInput.attr("type") == "password") {
                contraInput.attr("type", "text")
                eye.attr("src", "Views/imgs/eye-slash.svg")
            } else {
                contraInput.attr("type", "password")
                eye.attr("src", "Views/imgs/eye.svg")
            }

        }
    </script>

</head>

<body>

    <div id="contenedor">

        <img src="Views/imgs/logo.png" id="logo">

        <form action="#" method="post">

            <h1 id="titulo">Iniciar sesión</h1>

            <label for="nom_usu">Usuario:</label>
            <input type="text" name="nom_usu" id="nom_usu" maxlength="80" autocomplete="off" required>

            <label for="contra">Contraseña:</label>
            <div class="contra_div" style="position: relative;">
                <input type="password" name="contra" id="contra" maxlength="25" autocomplete="off" required>
                <img src="Views/imgs/eye.svg" class="ver_contra" onclick="viewHidePass()">
            </div>


            <input type="submit" id="btn_iniciar_sesión" value="Iniciar sesión">

            <div class="div_reg_btn">
                <a href="registrarse.php" class="reg_btn"><button type="button">Registrarse</button></a>
            </div>


        </form>
        <div class="error">
            <?php
            if (isset($errorLogin)) {
                echo $errorLogin;
            }
            ?>
        </div>
    </div>

</body>

</html>