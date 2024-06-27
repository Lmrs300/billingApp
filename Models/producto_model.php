<?php
class Producto
{
    private $id_prod;
    private $cod_prod;
    private $nom_prod;
    private $prec_comp_prod;
    private $prec_ven_prod;

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
        //Para obtener todos los productos.

        $sql = "SELECT * FROM productos ORDER BY nom_prod ASC";
        $query = $this->con->query($sql);
        return $query;
    }

    public function add()
    {
        //Para agregar un registro.

        $sql = "INSERT INTO  productos (id_prod, nom_prod, cod_prod, prec_comp_prod, prec_ven_prod) VALUES (:id_prod, :nom_prod, :cod_prod, :prec_comp_prod, :prec_ven_prod)";

        $datos = $this->con->prepare($sql);

        $datos->execute(array(":id_prod" => null, ":nom_prod" => $this->nom_prod, ":cod_prod" => $this->cod_prod, ":prec_comp_prod" => $this->prec_comp_prod, ":prec_ven_prod" => $this->prec_ven_prod));
    }

    public function edit()
    {
        //Para editar un registro.
        $sql = "UPDATE productos SET  nom_prod=:nom_prod, cod_prod=:cod_prod, prec_comp_prod=:prec_comp_prod, prec_ven_prod=:prec_ven_prod WHERE id_prod=:id_prod";

        $datos = $this->con->prepare($sql);

        $datos->execute(array(":nom_prod" => $this->nom_prod, ":cod_prod" => $this->cod_prod, ":prec_comp_prod" => $this->prec_comp_prod, ":prec_ven_prod" => $this->prec_ven_prod, ":id_prod" => $this->id_prod,));
    }

    public function delete()
    {
        //Para borrar un registro.

        $sql = "DELETE FROM productos WHERE id_prod=:id_prod";

        $datos = $this->con->prepare($sql);

        $datos->execute(array(":id_prod" => $this->id_prod));
    }

    public function view()
    {
        //Para obtener los datos de un registro en especifico.

        $sql = "SELECT * FROM productos WHERE id_prod=:id_prod";


        $datos = $this->con->prepare($sql);

        $datos->execute(array(":id_prod" => $this->id_prod));

        $row = $datos->fetch(PDO::FETCH_ASSOC);

        return $row;
    }
}
