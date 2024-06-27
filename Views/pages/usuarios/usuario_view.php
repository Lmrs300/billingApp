<?php
session_start();

if (!isset($_SESSION['id'])) {
    //para que si la sesion no esta iniciado te saque al login.

    header('location: http://localhost/BillingApp/');
}

require("../../../Controllers/usuario_controller.php");
$datos = new Usuario_controller();
$resultados = $datos->listar();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de usuarios</title>
    <link rel="icon" href="../../imgs/logo.ico">
    <link rel="stylesheet" href="../../css/listados.css?v=<?php echo (rand()); ?>" />

    <link rel="stylesheet" href="../../js/vendor/toast-main/toast-main-right.css">
    <script src="../../js/vendor/toast-main/toast-main.js"></script>

    <script src="../../js/jquery-3.6.4.min.js"></script>

    <script src="../../js/usu_func.js"></script>


    <script>
        $(document).ready(() => {
            listUsu()
        })
    </script>


</head>

<body>
    <?php
    require("../navbar.php");
    include("usuario_modal_agregar.php");
    include("usuario_modal_editar.php");
    include("usuario_modal_eliminar.php");
    ?>

    <div class="titulo" align="center">
        <h1>Usuarios</h1>
    </div>

    <div class="cont-error">
        <div class="error">
            <?php
            if (isset($_GET['errorad'])) { ?>
                <style>
                    .cont-error {
                        display: block;
                    }
                </style>
            <?php
                echo "<p><b>Error:</b> No se puede eliminar al unico administrador del sistema.</p>";
            }
            ?>
        </div>
    </div>

    <div class="agregar">
        <button type="button" onclick="showModalAgreg()"><span>Agregar</span></button>
    </div>

    <?php

    if ($resultados->rowCount() <= 0) {
        echo "<div class='cont-error' style='display: block; margin-top: 30px;'><div class='error'><p>No existen usuarios en el sistema.</p></div></div>";
    } else { ?>
        <table>
            <thead>
                <tr>
                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>Contraseña</th>
                    <th>Acción</th>

                </tr>
            </thead>
            <tbody></tbody>

        </table>

    <?php
    }

    include("../loader.php");
    ?>
</body>

</html>