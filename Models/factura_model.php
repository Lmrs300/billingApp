<?php
class Factura
{
    private $id_fac;
    private $serial_fac;
    private $fec_fac;
    private $nom_cli;
    private $ced_rif_cli;
    private $tel_cli;
    private $dir_cli;
    private $nom_usu;
    private $met_pago;
    private $monto_fac;
    private $iva_fac;
    private $total_fac;

    private $id_cant_prod_ven;
    private $prod_ven;
    private $prod_prec_unid;
    private $cant_ven;

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
        //Para obtener todos los facturas.

        $sql = "SELECT * FROM facturas ORDER BY fec_fac DESC";
        $query = $this->con->query($sql);
        return $query;
    }

    public function index_prod($id_fac)
    {
        //Para obtener todos los productos de la factura.

        $sql = "SELECT * FROM cant_prod_ven WHERE id_fac=:id_fac ORDER BY prod_ven ASC";

        $datos = $this->con->prepare($sql);

        $datos->execute(array(":id_fac" => $id_fac));

        return $datos;
    }

    public function add()
    {
        //Para agregar un registro.

        $sql = "INSERT INTO  facturas (id_fac, serial_fac, fec_fac, nom_cli, ced_rif_cli, tel_cli, dir_cli, nom_usu, met_pago, monto_fac, iva_fac, total_fac) VALUES (:id_fac, :serial_fac, :fec_fac,:nom_cli, :ced_rif_cli, :tel_cli, :dir_cli, :nom_usu, :met_pago, :monto_fac, :iva_fac, :total_fac)";

        $datos = $this->con->prepare($sql);

        $datos->execute(array(":id_fac" => null, ":serial_fac" => $this->serial_fac, ":fec_fac" => $this->fec_fac, ":nom_cli" => $this->nom_cli, ":ced_rif_cli" => $this->ced_rif_cli, ":tel_cli" => $this->tel_cli, ":dir_cli" => $this->dir_cli, ":nom_usu" => $this->nom_usu, ":met_pago" => $this->met_pago, ":monto_fac" => $this->monto_fac, ":iva_fac" => $this->iva_fac, ":total_fac" => $this->total_fac));
    }

    public function add_prod()
    {
        $sql = "INSERT INTO  cant_prod_ven (id_cant_prod_ven, prod_ven, prod_prec_unid, cant_ven, id_fac) VALUES (:id_cant_prod_ven, :prod_ven, :prod_prec_unid, :cant_ven, :id_fac)";

        $datos = $this->con->prepare($sql);

        $datos->execute(array(":id_cant_prod_ven" => null, ":prod_ven" => $this->prod_ven, ":prod_prec_unid" => $this->prod_prec_unid, ":cant_ven" => $this->cant_ven, ":id_fac" => $this->id_fac));
    }

    public function edit()
    {
        //Para editar un registro.
        $sql = "UPDATE facturas SET  serial_fac=:serial_fac, fec_fac=:fec_fac, nom_cli=:nom_cli, ced_rif_cli=:ced_rif_cli, tel_cli=:tel_cli, dir_cli=:dir_cli, nom_usu=:nom_usu, met_pago=:met_pago, iva_fac=:iva_fac, total_fac=ROUND(((monto_fac*:iva_fac)/100) + monto_fac, 2) WHERE id_fac=:id_fac";

        $datos = $this->con->prepare($sql);

        $datos->execute(array(":serial_fac" => $this->serial_fac, ":fec_fac" => $this->fec_fac, ":nom_cli" => $this->nom_cli, ":ced_rif_cli" => $this->ced_rif_cli, ":tel_cli" => $this->tel_cli, ":dir_cli" => $this->dir_cli, ":nom_usu" => $this->nom_usu, ":met_pago" => $this->met_pago, ":iva_fac" => $this->iva_fac, ":id_fac" => $this->id_fac));
    }

    public function edit_monto($prec_prod, $cant_ven, $op, $id_fac)
    {
        $sql = "UPDATE facturas SET  monto_fac=ROUND(monto_fac $op ($prec_prod*$cant_ven), 2), total_fac=ROUND(((monto_fac*iva_fac)/100) + monto_fac, 2) WHERE id_fac=$id_fac";

        $this->con->query($sql);
    }

    public function edit_cant_ven($id_cant_prod_ven, $cant_ven)
    {
        $sql = "UPDATE cant_prod_ven SET  cant_ven=cant_ven+$cant_ven WHERE id_cant_prod_ven=$id_cant_prod_ven";

        $this->con->query($sql);
    }

    public function delete()
    {
        //Para borrar un registro.

        $sql = "DELETE FROM facturas WHERE id_fac=:id_fac";

        $datos = $this->con->prepare($sql);

        $datos->execute(array(":id_fac" => $this->id_fac));
    }

    public function delete_prod()
    {
        //Para borrar un registro.

        $sql = "DELETE FROM cant_prod_ven WHERE id_cant_prod_ven=:id_cant_prod_ven";

        $datos = $this->con->prepare($sql);

        $datos->execute(array(":id_cant_prod_ven" => $this->id_cant_prod_ven));
    }

    public function view()
    {
        //Para obtener los datos de un registro en especifico.

        $sql = "SELECT * FROM facturas WHERE id_fac=:id_fac";


        $datos = $this->con->prepare($sql);

        $datos->execute(array(":id_fac" => $this->id_fac));

        $row = $datos->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

    public function view_cli($nom_cli)
    {
        $sql = "SELECT * FROM clientes WHERE nom_cli=:nom_cli";

        $datos = $this->con->prepare($sql);

        $datos->execute(array(":nom_cli" => $nom_cli));

        $row = $datos->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

    public function view_prod($nom_prod)
    {
        $sql = "SELECT * FROM productos WHERE nom_prod=:nom_prod";

        $datos = $this->con->prepare($sql);

        $datos->execute(array(":nom_prod" => $nom_prod));

        $row = $datos->fetch(PDO::FETCH_ASSOC);

        return $row;
    }
}
