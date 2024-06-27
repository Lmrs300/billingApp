<?php

if (!isset($_POST['accion'])) {
    require("../../../Models/producto_model.php");
} else {
    require("../Models/producto_model.php");
}

class Producto_controller
{
    private $producto;

    public function __construct()
    {
        $this->producto = new Producto();
    }

    public function listar()
    {
        //Listar todos los productos.
        $datos = $this->producto->index();
        return $datos;
    }

    public function agregar()
    {
        //Setear los atributos del modelo con los datos de los inputs y agregar el nuevo producto.

        $this->producto->set("nom_prod", $_POST['nom_prod']);
        $this->producto->set("cod_prod", $_POST['cod_prod']);
        $this->producto->set("prec_comp_prod", $_POST['prec_comp_prod']);
        $this->producto->set("prec_ven_prod", $_POST['prec_ven_prod']);

        $this->producto->add();
    }

    public function editar($id_prod)
    {
        //Setear los atributos del modelo con los datos de los inputs y editar el producto.

        $this->producto->set("id_prod", $id_prod);
        $this->producto->set("nom_prod", $_POST['nom_prod']);
        $this->producto->set("cod_prod", $_POST['cod_prod']);
        $this->producto->set("prec_comp_prod", $_POST['prec_comp_prod']);
        $this->producto->set("prec_ven_prod", $_POST['prec_ven_prod']);

        $this->producto->edit();
    }

    public function eliminar($id_prod)
    {
        //eliminar producto.

        $this->producto->set("id_prod", $id_prod);
        $this->producto->delete();
    }

    public function ver($id_prod)
    {
        //obtener los datos de un producto en especifico.
        $this->producto->set("id_prod", $id_prod);
        $datos = $this->producto->view();
        return $datos;
    }
}


if (isset($_POST["accion"])) {
    $controller = new producto_controller;

    //obtener productos
    if ($_POST["accion"] == "get_prod") {
        $resp = $controller->listar();

        $productos = $resp->fetchAll();

        echo json_encode($productos);
    }

    //obtener datos de un producto
    if ($_POST["accion"] == "get_datos_prod") {

        $datos_prod = $controller->ver($_POST["id_prod"]);

        echo json_encode($datos_prod);
    }

    //agregar producto
    if ($_POST["accion"] == "add_prod") {
        $resp = $controller->agregar();
    }

    //editar producto
    if ($_POST["accion"] == "edit_prod") {
        $resp = $controller->editar($_POST["id_prod"]);
    }

    //eliminar producto
    if ($_POST["accion"] == "delete_prod") {
        $resp = $controller->eliminar($_POST["id_prod"]);
    }
}
