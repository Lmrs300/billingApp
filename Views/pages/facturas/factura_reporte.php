<?php
ob_start();

session_start();

if (!isset($_SESSION['id'])) {
    header('location: ../../../index.php');
}

require("../../../Controllers/factura_controller.php");
$datos = new Factura_controller();
$factura = $datos->ver($_GET["id_fac"]);
$prod_fac = $datos->listar_prod($_GET["id_fac"]);

$titulo = "Factura - " . date('d-m-Y');

$fecha = explode(" ", $factura["fec_fac"]);

$fecha[0] = date("d/m/Y", strtotime($fecha[0]));

$fecha[1] = substr($fecha[1], 0, -3)
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <title>Reporte de factura</title>
    <link rel="stylesheet" href="../../css/reportes.css">

    <style>
        #div_firmas {
            position: fixed;
            bottom: 0px;
            left: 0px;
            right: 0px;
        }

        table {
            margin-bottom: 200px;
        }
    </style>

</head>

<body>

    <div class="contenedor">
        <header>

            <div class="texto">
                <p style="margin: 0px;">
                    <b>SENIAT <br>
                        RIF J5000084641</b><br>
                    SUPER NEGOCIO C.A.<br>
                    Av. Inventada Edif. Inventado<br>
                    Piso PB Local 01 Sector Inventado<br>
                    Los Teques Edo. Miranda<br>
                </p>
            </div>

        </header>

        <div class="info_cli">
            <p style="margin: 0px;">
                RIF/C.I.: V<?php echo $factura["ced_rif_cli"] ?><br>
                Razón social/Cliente: <?php echo $factura["nom_cli"] ?><br>
                Teléfono: <?php echo $factura["tel_cli"] ?><br>
                Dirección: <?php echo $factura["dir_cli"] ?><br>
                Vendedor: <?php echo $factura["nom_usu"] ?><br>
                Los Teques Edo. Miranda<br>
            </p>
        </div>

        <div class="titulo">
            <h2>FACTURA</h2>
        </div>

        <section class="info_fac">
            <div class="div_cont">
                <div class="izq">FACTURA: </div>
                <div class="der"><?php echo $factura["serial_fac"] ?></div>
            </div>

            <div class="div_cont">
                <div class="izq">FECHA: <?php echo $fecha[0] ?></div>
                <div class="der">HORA: <?php echo $fecha[1] ?></div>
            </div>
        </section>

        <section class="info_prod">
            <ul>
                <?php
                while ($row = $prod_fac->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <li class="div_cont">
                        <div class="izq"><?php echo $row["prod_ven"] ?> (x<?php echo $row["cant_ven"] ?>)</div>
                        <div class="der">Bs <?php echo round($row["cant_ven"] * $row["prod_prec_unid"], 2)  ?></div>
                    </li>
                <?php
                }
                ?>
            </ul>

        </section>
        <section class="subtotal">
            <div class="div_cont">

                <div class="izq">
                    <?php echo $factura["met_pago"] ?>
                </div>

                <div class="med">
                    Bs <?php echo $factura["monto_fac"] ?> + IVA <?php echo $factura["iva_fac"] ?>%
                </div>

                <div class="der">
                    Bs <?php echo round(($factura["monto_fac"] * $factura["iva_fac"]) / 100, 2) ?>
                </div>
            </div>
        </section>

        <section class="total" style="border: none;">
            <div class="div_cont">
                <div class="izq">
                    <h3 style="display: inline;">TOTAL</h3>
                </div>

                <div class="der">
                    <h3 style="display: inline;">Bs <?php echo $factura["total_fac"] ?></h3>
                </div>
            </div>
        </section>

</body>


</html>

<?php
$html = ob_get_clean();

require("../../../dompdf_library/dompdf/autoload.inc.php");

require("../../../dompdf_library/usar_dompdf.php");

?>