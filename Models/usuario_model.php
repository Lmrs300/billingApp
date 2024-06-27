<?php
class Usuario
{
    private $id_usu;
    private $nom_usu;
    private $ced_usu;
    private $contra;

    private $con;

    public function __construct()
    {
        require("base_datos.php");
        $this->con = Base_datos::connect();
    }

    public function set($atributo, $contenido)
    {
        //Para setear un atributo.

        $this->$atributo = $contenido;
    }

    public function get($atributo)
    {
        //Para retornar el valor de un atributo.

        return $this->$atributo;
    }

    public function index()
    {
        //Para obtener todos los usuarios.

        $sql = "SELECT * FROM usuarios ORDER BY nom_usu ASC";
        $query = $this->con->query($sql);
        return $query;
    }

    public function add()
    {
        //Para agregar un registro.

        $sql = "INSERT INTO  usuarios (id_usu, nom_usu, ced_usu, contra) VALUES (:id_usu, :nom_usu, :ced_usu, :contra)";

        $datos = $this->con->prepare($sql);

        $datos->execute(array(":id_usu" => null, ":nom_usu" => $this->nom_usu, ":ced_usu" => $this->ced_usu, ":contra" => $this->contra));
    }

    public function edit()
    {
        //Para editar un registro.
        $sql = "UPDATE usuarios SET  nom_usu=:nom_usu, ced_usu=:ced_usu, contra=:contra WHERE id_usu=:id_usu";

        $datos = $this->con->prepare($sql);

        $datos->execute(array(":nom_usu" => $this->nom_usu, ":ced_usu" => $this->ced_usu, ":contra" => $this->contra, ":id_usu" => $this->id_usu,));
    }

    public function delete()
    {
        //Para borrar un registro.

        $sql = "DELETE FROM usuarios WHERE id_usu=:id_usu";

        $datos = $this->con->prepare($sql);

        $datos->execute(array(":id_usu" => $this->id_usu));
    }

    public function view()
    {
        //Para obtener los datos de un registro en especifico.

        $sql = "SELECT nom_usu, ced_usu FROM usuarios WHERE id_usu=:id_usu";


        $datos = $this->con->prepare($sql);

        $datos->execute(array(":id_usu" => $this->id_usu));

        $row = $datos->fetch(PDO::FETCH_ASSOC);

        return $row;
    }
}
