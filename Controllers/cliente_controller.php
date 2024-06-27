<?php

if (!isset($_POST['accion'])) {
    require("../../../Models/cliente_model.php");
} else {
    require("../Models/cliente_model.php");
}

class Cliente_controller
{
    private $cliente;

    public function __construct()
    {
        $this->cliente = new Cliente();
    }

    public function listar()
    {
        //Listar todos los clientes.
        $datos = $this->cliente->index();
        return $datos;
    }

    public function agregar()
    {
        //Setear los atributos del modelo con los datos de los inputs y agregar el nuevo cliente.

        $this->cliente->set("nom_cli", $_POST['nom_cli']);
        $this->cliente->set("ced_rif_cli", $_POST['ced_rif_cli']);
        $this->cliente->set("tel_cli", $_POST['tel_cli']);
        $this->cliente->set("dir_cli", $_POST['dir_cli']);

        $this->cliente->add();
    }

    public function editar($id_cli)
    {
        //Setear los atributos del modelo con los datos de los inputs y editar el cliente.

        $this->cliente->set("id_cli", $id_cli);
        $this->cliente->set("nom_cli", $_POST['nom_cli']);
        $this->cliente->set("ced_rif_cli", $_POST['ced_rif_cli']);
        $this->cliente->set("tel_cli", $_POST['tel_cli']);
        $this->cliente->set("dir_cli", $_POST['dir_cli']);

        $this->cliente->edit();
    }

    public function eliminar($id_cli)
    {
        //eliminar cliente.

        $this->cliente->set("id_cli", $id_cli);
        $this->cliente->delete();
    }

    public function ver($id_cli)
    {
        //obtener los datos de un cliente en especifico.
        $this->cliente->set("id_cli", $id_cli);
        $datos = $this->cliente->view();
        return $datos;
    }
}


if (isset($_POST["accion"])) {
    $controller = new Cliente_controller;

    //obtener clientes
    if ($_POST["accion"] == "get_cli") {
        $resp = $controller->listar();

        $clientes = $resp->fetchAll();

        echo json_encode($clientes);
    }

    //obtener datos de un cliente
    if ($_POST["accion"] == "get_datos_cli") {

        $datos_cli = $controller->ver($_POST["id_cli"]);

        echo json_encode($datos_cli);
    }

    //agregar cliente
    if ($_POST["accion"] == "add_cli") {
        $resp = $controller->agregar();
    }

    //editar cliente
    if ($_POST["accion"] == "edit_cli") {
        $resp = $controller->editar($_POST["id_cli"]);
    }

    //eliminar cliente
    if ($_POST["accion"] == "delete_cli") {
        $resp = $controller->eliminar($_POST["id_cli"]);
    }
}
