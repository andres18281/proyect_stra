<?php
include_once('../Controller/conectar.php');

class Viabilidad_tecnica extends Conectar{
  
  public function __construct(){
  	parent::__construct();
  }

  public function Set_viabilidad($array_client = array(),$array_viabili = array()){
  	 $array = array("solic_nit_empre"=>
  	 				"solic_fecha_solici"=>,
  	 				"solic_stado"=>,
  	 				"solic_id_emplo"=>,
  	 				"solic_id_tecnico"=>null);

  }

  	public function Add_viabilidad($id_emplo,$nit){
    	$array = array("solic_nit_empre"=>$nit,
    				   "solic_fecha_solici"=>date('Y-m-d'),
    				   "solic_stado"=>1,
    				   "solic_id_emplo"=>$id_emplo,
    				   "solic_id_tecnico"=>null);
    	$respon = parent::inserta("solicitud_instalacion",$array);
    	return $respon;
    }
}

?>