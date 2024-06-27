<?php
session_start();

if (!isset($_SESSION['id'])) {
    //para que si la sesion no esta iniciado te saque al login.
    header('location: http://localhost/BillingApp/');
}

require("../../../Controllers/cliente_controller.php");
$datos = new Cliente_controller();
$resultados = $datos->listar();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link rel="icon" href="../../imgs/logo.ico">

    <link rel="stylesheet" href="../../css/listados.css?v=<?php echo (rand()); ?>" />

    <link rel="stylesheet" href="../../js/vendor/toast-main/toast-main-right.css">
    <script src="../../js/vendor/toast-main/toast-main.js"></script>

    <script src="../../js/jquery-3.6.4.min.js"></script>

    <script src="../../js/cli_func.js?v=<?php echo (rand()); ?>"></script>

    <script>
        $(document).ready(() => {
            listCli()
        })
    </script>
</head>

<body>
    <?php
    require("../navbar.php");
    include("cliente_modal_agregar.php");
    include("cliente_modal_editar.php");
    include("cliente_modal_eliminar.php");
    ?>

    <div class="titulo" align="center">
        <h1>Clientes</h1>
    </div>

    <div class="agregar">
        <button type="button" onclick="showModalAgreg()"><span>Agregar</span></button>
    </div>

    <?php

    if ($resultados->rowCount() <= 0) {
        echo "<div class='cont-error' style='display: block; margin-top: 30px;'><div class='error'><p>No existen clientes en el sistema.</p></div></div>";
    } else { ?>
        <table>
            <thead>
                <tr>
                    <th>Cédula/RIF</th>
                    <th>Cliente</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
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