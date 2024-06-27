<?php

if (!isset($_POST['accion'])) {
    require("../../../Models/factura_model.php");
} else {
    require("../Models/factura_model.php");
}

class Factura_controller
{
    private $factura;

    public function __construct()
    {
        $this->factura = new Factura();
    }

    public function listar()
    {
        //Listar todas las facturas.
        $datos = $this->factura->index();
        return $datos;
    }

    public function listar_prod($id_fac)
    {
        //Listar todas las facturas.
        $datos = $this->factura->index_prod($id_fac);
        return $datos;
    }

    public function agregar()
    {

        $cliente = $this->factura->view_cli($_POST["nom_cli"]);
        //Setear los atributos del modelo con los datos de los inputs y agregar la nueva factura.

        $this->factura->set("serial_fac", $_POST['serial_fac']);
        $this->factura->set("fec_fac", $_POST['fec_fac']);
        $this->factura->set("nom_cli", $_POST['nom_cli']);
        $this->factura->set("ced_rif_cli", $cliente['ced_rif_cli']);
        $this->factura->set("tel_cli", $cliente['tel_cli']);
        $this->factura->set("dir_cli", $cliente['dir_cli']);
        $this->factura->set("nom_usu", $_POST['nom_usu']);
        $this->factura->set("met_pago", $_POST['met_pago']);
        $this->factura->set("monto_fac", 0);
        $this->factura->set("iva_fac", $_POST['iva_fac']);
        $this->factura->set("total_fac", 0);

        $this->factura->add();
    }

    public function agregar_prod()
    {

        $productos = $this->factura->index_prod($_POST['id_fac']);

        $isAdded = false;

        while ($row = $productos->fetch(PDO::FETCH_ASSOC)) {
            if ($row["prod_ven"] == $_POST['prod_ven']) {
                $isAdded = true;
                $id_cant_prod_ven = $row["id_cant_prod_ven"];
            }
        }

        $prod = $this->factura->view_prod($_POST['prod_ven']);

        if ($isAdded == true) {
            $this->factura->edit_cant_ven($id_cant_prod_ven, $_POST['cant_ven']);
        } else {
            $this->factura->set("prod_ven", $_POST['prod_ven']);

            $this->factura->set("prod_prec_unid", $prod['prec_ven_prod']);
            $this->factura->set("cant_ven", $_POST['cant_ven']);
            $this->factura->set("id_fac", $_POST['id_fac']);

            $this->factura->add_prod();
        }



        $this->factura->edit_monto($prod['prec_ven_prod'], $_POST['cant_ven'], "+", $_POST['id_fac']);
    }

    public function editar($id_fac)
    {
        $cliente = $this->factura->view_cli($_POST["nom_cli"]);

        //Setear los atributos del modelo con los datos de los inputs y editar la factura.

        $this->factura->set("id_fac", $id_fac);
        $this->factura->set("serial_fac", $_POST['serial_fac']);
        $this->factura->set("fec_fac", $_POST['fec_fac']);
        $this->factura->set("nom_cli", $_POST['nom_cli']);
        $this->factura->set("ced_rif_cli", $cliente['ced_rif_cli']);
        $this->factura->set("tel_cli", $cliente['tel_cli']);
        $this->factura->set("dir_cli", $cliente['dir_cli']);
        $this->factura->set("nom_usu", $_POST['nom_usu']);
        $this->factura->set("met_pago", $_POST['met_pago']);
        $this->factura->set("iva_fac", $_POST['iva_fac']);

        $this->factura->edit();
    }

    public function eliminar($id_fac)
    {
        //eliminar factura.

        $this->factura->set("id_fac", $id_fac);
        $this->factura->delete();
    }

    public function eliminar_prod()
    {

        $this->factura->set("id_cant_prod_ven", $_POST["id_cant_prod_ven"]);
        $this->factura->delete_prod();

        $this->factura->edit_monto($_POST["prec_prod"], $_POST["cant_ven"], "-", $_POST["id_fac"]);
    }

    public function ver($id_fac)
    {
        //obtener los datos de una factura en especifico.
        $this->factura->set("id_fac", $id_fac);
        $datos = $this->factura->view();
        return $datos;
    }

    public function ver_cli($nom_cli)
    {
        //obtener los datos de una factura en especifico.
        $datos = $this->factura->view_cli($nom_cli);
        return $datos;
    }
}

if (isset($_POST["accion"])) {
    $controller = new factura_controller;

    //obtener facturas
    if ($_POST["accion"] == "get_fac") {
        $resp = $controller->listar();

        $facturas = $resp->fetchAll();

        echo json_encode($facturas);
    }

    //obtener productos de una factura
    if ($_POST["accion"] == "get_prod_ven") {
        $resp = $controller->listar_prod($_POST["id_fac"]);

        $facturas = $resp->fetchAll();

        echo json_encode($facturas);
    }

    //obtener datos de una factura
    if ($_POST["accion"] == "get_datos_fac") {

        $datos_fac = $controller->ver($_POST["id_fac"]);

        echo json_encode($datos_fac);
    }

    //agregar factura
    if ($_POST["accion"] == "add_fac") {
        $resp = $controller->agregar();
    }

    //agregar productos a una factura
    if ($_POST["accion"] == "add_prod_ven") {
        $resp = $controller->agregar_prod();
    }

    //editar factura
    if ($_POST["accion"] == "edit_fac") {
        $resp = $controller->editar($_POST["id_fac"]);
    }

    //eliminar factura
    if ($_POST["accion"] == "delete_fac") {
        $resp = $controller->eliminar($_POST["id_fac"]);
    }

    //eliminar productos de una factura
    if ($_POST["accion"] == "delete_prod_ven") {
        $resp = $controller->eliminar_prod();
    }
}
