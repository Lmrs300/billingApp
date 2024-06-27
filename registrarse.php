<?php

include("Models/base_datos.php");

session_start();

if (isset($_SESSION['id'])) {

    //Para que si la sesion esta iniciada, lleve directamente al usuario a su pagina principal respectiva.
    header("location: Views/pages/principal/inicio.php");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="icon" href="Views/imgs/logo.ico">
    <link rel="stylesheet" id="link_general" href="Views/css/general.css">
    <link rel="stylesheet" href="Views/css/iniciar_sesion.css?v=<?php echo (rand()); ?>" />

    <link rel="stylesheet" href="Views/js/vendor/toast-main/toast-main-right.css">
    <script src="Views/js/vendor/toast-main/toast-main.js"></script>

    <script src="Views/js/jquery-3.6.4.min.js"></script>

    <script src="Views/js/usu_func.js?v=<?php echo (rand()); ?>"></script>

    <style>
        #contenedor {
            width: 620px;
        }

        #logo,
        h1,
        input {
            margin-top: -20px;
        }

        h1 {
            margin-bottom: -10px;
        }

        label {
            margin-top: -10px;
        }

        #btn_agregar {
            margin-top: 5px;
        }

        #btn_agregar:disabled {
            background: linear-gradient(gray 0%, gray 100%);
            filter: none;
            cursor: default;
        }

        .usu_ced_div,
        .contras_div {
            display: flex;
            justify-content: center;
            align-items: center;

        }

        .usu_ced_div div,
        .contras_div div {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin-block: 10px;
        }

        .usu_ced_div div label,
        .contras_div div label {
            border: none;
            font-weight: 500;
        }
    </style>

    <script>
        async function signUp(e) {
            e.preventDefault()
            await addUsu(e, "Controllers/usuario_controller.php", true)
        }

        $(document).ready(() => {
            $("#reg_form").on("submit", (e) => signUp(e))


        })
    </script>
</head>

<body>

    <div id="contenedor">

        <img src="Views/imgs/logo.png" id="logo">

        <form id="reg_form">

            <h1 id="titulo">Registrarse</h1>

            <div class="usu_ced_div">
                <div>
                    <label for="nom_usu">Usuario:</label>
                    <input type="text" name="nom_usu" id="nom_usu" maxlength="100" autocomplete="off" required>
                </div>

                <div>
                    <label for="nom_usu">Cédula:</label>
                    <input type="text" name="ced_usu" id="ced_usu" maxlength="15" autocomplete="off" required>
                </div>
            </div>

            <div class="contras_div">
                <div>
                    <label for="contra">Contraseña:</label>
                    <input type="password" name="contra" id="contra" maxlength="25" minlength="0" autocomplete="off" required>
                </div>


                <div>
                    <label for="contra">Confirmar contraseña:</label>
                    <input type="password" name="con_contra" id="con_contra" maxlength="25" minlength="0" autocomplete="off" required>
                </div>

            </div>



            <input type="submit" id="btn_agregar" value="Registrarse">

            <div class="div_reg_btn">
                <a href="iniciar_sesion.php" class="reg_btn"><button type="button">Iniciar sesión</button></a>
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