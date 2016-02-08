<?php
require('DetallesDAO.php');
include_once $_SERVER['DOCUMENT_ROOT']."stratecsa/Controller/conectar.php";
class factura extends DetallesDAO{
    private $id_factura;
    private $total;
    private $fecha;
    public function __construct($){

    }
    public function set_fecha(){
        $this->fecha = date('dmY');
    }

    public function set_id_factura($id_factura){
        $this->id_factura = $id_factura;
    }

    public function get_codigo_factura(){
        return $this->id_factura;
    }

    public function get_fecha(){
        return $this->fecha;
    }
    public function get_codigo_cliente(){
        return $this->codigo_cliente;
    }
    public function get_costo_total(){
        $total = parent::calculo_total();
        return $total;
    }
    public function add_detalle($codigo,$id_fact,$id_servi,$costo){     
        parent::agregar($codigo,$id_fact,$id_servi,$costo);
    }
    public function eliminar($posicion){
        parent::borrar($posicion);
    }
    public function mostrar(){        
        $arreglo = parent::mostrar();
        return $arreglo;   
    }

    public function Get_Detalles(){
        $conecta = new Conectar('root','');
        $sql = "SELECT Deta_id, Deta_id_serv, Deta_cost 
                FROM detalles_fact 
                WHERE Deta_id_fact = ".$this->get_codigo_factura();
        $datos = $conecta->consultas($sql); 
        return $datos;

    }

    public function Set_factura($id,$client,$fecha_ini,$fecha_fina){
          $array = Array("Fact_id"=>$id,
                      "Fact_id_client"=>$client,
                      "Fact_fecha"=>$fecha_ini,
                      "act_fecha_final"=>$fecha_fina,
                      "Fact_cancelado"=>1);
         $data =  $conecta->inserta('factura_stra',$array);
         $this->set_id_factura($data['last_cod_id']);
         return $data;
    }

    public function Insert_detalle(){
       $conecta = new Conectar('root','');
        foreach(mostrar() as $key=>$value){ 
         $array = array('Deta_id'=>$value["codigo"],
                        'Deta_id_fact'=>$value["id_fact"],
                        'Deta_id_serv'=>$value["id_servicio"],
                        'Deta_cost'=>$value["costo"]);
         $conecta->inserta('detalles_fact',$array);


        }
    }

}
?>