<?php
session_start();

if (!isset($_SESSION['id'])) {
    //para que si la sesion no esta iniciado te saque al login.
    header('location: http://localhost/BillingApp/');
}

require("../../../Controllers/producto_controller.php");
$datos = new Producto_controller();
$resultados = $datos->listar();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="icon" href="../../imgs/logo.ico">

    <link rel="stylesheet" href="../../css/listados.css?v=<?php echo (rand()); ?>" />

    <link rel="stylesheet" href="../../js/vendor/toast-main/toast-main-right.css">
    <script src="../../js/vendor/toast-main/toast-main.js"></script>

    <script src="../../js/jquery-3.6.4.min.js"></script>

    <script src="../../js/prod_func.js?v=<?php echo (rand()); ?>"></script>

    <script>
        $(document).ready(() => {
            listProd()
        })
    </script>
</head>

<body>
    <?php
    require("../navbar.php");
    include("producto_modal_agregar.php");
    include("producto_modal_editar.php");
    include("producto_modal_eliminar.php");
    ?>

    <div class="titulo" align="center">
        <h1>Productos</h1>
    </div>

    <div class="agregar">
        <button type="button" onclick="showModalAgreg()"><span>Agregar</span></button>
    </div>

    <?php

    if ($resultados->rowCount() <= 0) {
        echo "<div class='cont-error' style='display: block; margin-top: 30px;'><div class='error'><p>No existen productos en el sistema.</p></div></div>";
    } else { ?>
        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Producto</th>
                    <th>Precio compra</th>
                    <th>Precio venta</th>
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