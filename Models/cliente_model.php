<?php
class Cliente
{
    private $id_cli;
    private $nom_cli;
    private $ced_rif_cli;
    private $tel_cli;
    private $dir_cli;

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
        //Para obtener todos los clientes.

        $sql = "SELECT * FROM clientes ORDER BY nom_cli ASC";
        $query = $this->con->query($sql);
        return $query;
    }

    public function add()
    {
        //Para agregar un registro.

        $sql = "INSERT INTO  clientes (id_cli, nom_cli, ced_rif_cli, tel_cli, dir_cli) VALUES (:id_cli, :nom_cli, :ced_rif_cli, :tel_cli, :dir_cli)";

        $datos = $this->con->prepare($sql);

        $datos->execute(array(":id_cli" => null, ":nom_cli" => $this->nom_cli, ":ced_rif_cli" => $this->ced_rif_cli, ":tel_cli" => $this->tel_cli, ":dir_cli" => $this->dir_cli));
    }

    public function edit()
    {
        //Para editar un registro.
        $sql = "UPDATE clientes SET  nom_cli=:nom_cli, ced_rif_cli=:ced_rif_cli, tel_cli=:tel_cli, dir_cli=:dir_cli WHERE id_cli=:id_cli";

        $datos = $this->con->prepare($sql);

        $datos->execute(array(":nom_cli" => $this->nom_cli, ":ced_rif_cli" => $this->ced_rif_cli, ":tel_cli" => $this->tel_cli, ":dir_cli" => $this->dir_cli, ":id_cli" => $this->id_cli));
    }

    public function delete()
    {
        //Para borrar un registro.

        $sql = "DELETE FROM clientes WHERE id_cli=:id_cli";

        $datos = $this->con->prepare($sql);

        $datos->execute(array(":id_cli" => $this->id_cli));
    }

    public function view()
    {
        //Para obtener los datos de un registro en especifico.

        $sql = "SELECT * FROM clientes WHERE id_cli=:id_cli";


        $datos = $this->con->prepare($sql);

        $datos->execute(array(":id_cli" => $this->id_cli));

        $row = $datos->fetch(PDO::FETCH_ASSOC);

        return $row;
    }
}
