<?php
if(file_exists("../Controller/conectar.php")){
 include_once('../Controller/conectar.php');    
}else if(file_exists("Controller/conectar.php")){
  include_once('Controller/conectar.php');   
}

class Factura extends Conectar{
    
    public function __construct(){
        parent::__construct();
    }
     
    public function Get_factura($id){ 
        $sql = 'SELECT Fact_total as total,Fact_cancelado as estado,Fact_fecha as fecha,fact_fecha_final as fecha_fin,Fact_id_client as client
                FROM factura_stra 
                WHERE Fact_id = '.$id;
        $data = parent::consultas($sql);
        return $data;
    }

    public function Get_facturas_by_empresa($nit){ 
        $sql = 'SELECT Fact_id as id,Fact_fecha as fecha,fact_fecha_final as fech_final,Fact_total as total,Fact_cancelado as estado
                FROM factura_stra 
                WHERE Fact_id_client = '.$nit;
        $data = parent::consultas($sql);
        return $data;
    }

    public function Get_datalle_factura($id){ 
        $sql = 'SELECT pago_costo as cost,pago_id_contrat as id_contrat,pago_confir as pag_confir,CONVERT(Contra_descrip USING utf8) as descrip
                FROM detalles_fact detall 
                INNER JOIN pagos_str pag ON pag.pagos_id = detall.Deta_id_pago 
                INNER JOIN contrato cont ON cont.Id_contrat = pag.pago_id_contrat
                WHERE Deta_id_fact = '.$id;
        $data = parent::consultas($sql);
        return $data;
    }
}
?>