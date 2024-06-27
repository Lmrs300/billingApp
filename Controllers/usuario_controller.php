<?php

if (!isset($_POST['accion'])) {
    require("../../../Models/usuario_model.php");
} else {
    require("../Models/usuario_model.php");
}

class Usuario_controller
{
    private $usuario;

    public function __construct()
    {
        $this->usuario = new Usuario();
    }

    public function listar()
    {
        //Listar todos los usuarios.
        $datos = $this->usuario->index();
        return $datos;
    }

    public function agregar()
    {
        //Setear los atributos del modelo con los datos de los inputs y agregar el nuevo usuario.

        $this->usuario->set("nom_usu", $_POST['nom_usu']);
        $this->usuario->set("ced_usu", $_POST['ced_usu']);
        $this->usuario->set("contra", $_POST['contra']);

        $this->usuario->add();
    }

    public function editar($id_usu)
    {
        //Setear los atributos del modelo con los datos de los inputs y editar el usuario.

        $this->usuario->set("id_usu", $id_usu);
        $this->usuario->set("nom_usu", $_POST['nom_usu']);
        $this->usuario->set("ced_usu", $_POST['ced_usu']);
        $this->usuario->set("contra", $_POST['contra']);

        $this->usuario->edit();

        // //verificar si solo hay un usuario administrador en el sistema y si se esta intentando cambiarlo, quedandose el sistema sin administrador.

        // $this->usuario->set("id_usu", $id_usu);
        // $ver_usuario = $this->usuario->view();
        // $count = 0;
        // if (isset($_POST['id_rol'])) {
        //     if ($ver_usuario['rol'] == 'Administrador' and $_POST['id_rol'] != 1) {
        //         $usuarios = $this->usuario->index();

        //         while ($row = $usuarios->fetch(PDO::FETCH_ASSOC)) {
        //             if ($row['rol'] == 'Administrador') {
        //                 $count++;
        //             }
        //         }
        //         if ($count == 1) {
        //             $this->usuario->set("id_usu", $id_usu);
        //             $datos = $this->usuario->view();
        //             return $datos;
        //         }
        //     }
        // }

        //Si no hay errores, setear los atributos del modelo con los datos de los inputs y editar el usuario.


    }

    public function eliminar($id_usu)
    {
        //eliminar usuario.

        $this->usuario->set("id_usu", $id_usu);
        $this->usuario->delete();

        // $this->usuario->set("id_usu", $id_usu);
        // $ver_usuario = $this->usuario->view();

        // //verificar si solo hay un usuario administrador en el sistema y si se esta intentando eliminar, quedandose el sistema sin administrador.
        // if ($ver_usuario['rol'] == 'Administrador') {
        //     $usuarios = $this->usuario->index();
        //     $count = 0;
        //     while ($row = $usuarios->fetch(PDO::FETCH_ASSOC)) {
        //         if ($row['rol'] == 'Administrador') {
        //             $count++;
        //         }
        //     }
        //     if ($count == 1) {
        //         echo "errorad";
        //     } else {

        //         //Si el usuario a eliminar es un administrador pero hay mas de un administrador en el sistema, setear el atributo del id del modelo con el id del usuario a eliminar y eliminar el usuario.
        //         $this->usuario->set("id_usu", $id_usu);
        //         $this->usuario->delete();
        //     }
        // } else {
        //     //Si el usuario a eliminar no es un administrador, setear el atributo del id del modelo con el id del usuario a eliminar y eliminar el usuario.
        //     $this->usuario->set("id_usu", $id_usu);
        //     $this->usuario->delete();
        // }
    }

    public function ver($id_usu)
    {
        //obtener los datos de un usuario en especifico.
        $this->usuario->set("id_usu", $id_usu);
        $datos = $this->usuario->view();
        return $datos;
    }
}


if (isset($_POST["accion"])) {
    $controller = new Usuario_controller;

    //obtener usuarios
    if ($_POST["accion"] == "get_usu") {
        $resp = $controller->listar();

        $usuarios = $resp->fetchAll();

        echo json_encode($usuarios);
    }

    //obtener datos de un usuario
    if ($_POST["accion"] == "get_datos_usu") {

        $datos_usu = $controller->ver($_POST["id_usu"]);

        echo json_encode($datos_usu);
    }

    //agregar usuario
    if ($_POST["accion"] == "add_usu") {
        $resp = $controller->agregar();
    }

    //editar usuario
    if ($_POST["accion"] == "edit_usu") {
        $resp = $controller->editar($_POST["id_usu"]);
    }

    //eliminar usuario
    if ($_POST["accion"] == "delete_usu") {
        $resp = $controller->eliminar($_POST["id_usu"]);
    }
}
