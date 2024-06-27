<?php
session_start();

if (!isset($_SESSION['id'])) {
  //para que si la sesion no esta iniciado te saque al login.
  header('location: http://localhost/BillingApp/');
}
require("../../../Controllers/factura_controller.php");
$datos = new Factura_controller();
$resultados = $datos->listar();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Facturas</title>
  <link rel="icon" href="../../imgs/logo.ico">
  <link rel="stylesheet" href="../../css/listados.css?v=<?php echo (rand()); ?>" />

  <link rel="stylesheet" href="../../js/vendor/toast-main/toast-main-right.css">
  <script src="../../js/vendor/toast-main/toast-main.js"></script>

  <script src="../../js/jquery-3.6.4.min.js"></script>

  <script src="../../js/fac_func.js?v=<?php echo (rand()); ?>"></script>

  <script>
    $(document).ready(() => {
      listFac()
      loadDataCli()
      loadDataUsu()
      loadDataProd()
    })
  </script>

  <style>
    body {
      min-width: 1030px;
    }

    .principal_table tbody td {
      word-break: break-all;
    }
  </style>

</head>

<body>
  <?php
  require("../navbar.php");
  include("factura_modal_agregar.php");
  include("factura_modal_ver_prod.php");
  include("factura_modal_editar.php");
  include("factura_modal_eliminar.php");
  ?>

  <div class="titulo" align="center">
    <h1>Facturas</h1>
  </div>

  <div class="agregar">
    <button type="button" onclick="showModalAgreg()"><span>Agregar</span></button>
  </div>

  <?php

  if ($resultados->rowCount() <= 0) {
    echo "<div class='cont-error' style='display: block; margin-top: 30px;'><div class='error'><p>No existen facturas en el sistema.</p></div></div>";
  } else { ?>
    <table class="principal_table">
      <thead>
        <tr>
          <th>Serial</th>
          <th>Fecha y hora</th>
          <th>Cliente</th>
          <th>Vendedor</th>
          <th>Prod / Cant</th>
          <th>Met. pago</th>
          <th>Monto</th>
          <th>IVA</th>
          <th>Total</th>
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