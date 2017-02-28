<?php
include_once('../Model/Modulos.php');
class ModuloController {
  private $modulo = null;
  public function __construct(){
  	$this->modulo = new Modulos();
  	$request = json_decode($_POST['accion'],true);
  	if(isset($request['add_modulo_employed'])){
  	  $respon = $this->AgregarModulosEmpleados($request);
  	  echo json_encode($respon);
  	}
  }

  private function AgregarModulosEmpleados($request = array()){
  	$id = $request["id_emplo"];
  	$respon = array();
  	if(isset($request["ticket"]) and count($request["ticket"]) > 0){
  	  	$item = array();
  	  	$item[] = $request["ticket"]['options_ticke_redac'];
  	  	$item[] = $request["ticket"]['options_ticke_info'];
  		$item[] = $respon['ticket'] = $this->modulo->Agregar_modulo_empleado(1,implode(",",$item),$id);
  	}

  	if(isset($request["contrat"]) and count($request["contrat"]) > 0){
  	  	$item = array();
  	  	$item[] = $request["contrat"]['options_contrat_crear'];
  	  	$item[] = $request["contrat"]['options_ctr_edit'];
  	  	$item[] = $request["contrat"]['options_ctr_ver'];	    
  		$respon['contrat'] = $this->modulo->Agregar_modulo_empleado(2,implode(",",$item),$id);
  	}

  	if(isset($request["emple"]) and count($request["emple"]) > 0){
  		$item = array();
  		$item[] = $request['emple']['options_employ_crear'];
  		$item[] = $request['emple']['options_employ_elimi'];
  		$item[] = $request['emple']['options_employ_show']; 
  		$respon['emple'] = $this->modulo->Agregar_modulo_empleado(3,implode(",",$item),$id);
  	}

  	if(isset($request["client"]) and count($request["client"]) > 0){
  		$item = array();
  		$item[] = $request["client"]['options_clien_creat'];
  		$item[] = $request["client"]['options_clien_confi'];
  		$item[] = $request["client"]['options_clien_mostrar'];	
  		$respon['client'] = $this->modulo->Agregar_modulo_empleado(4,implode(",",$item),$id);
  	}

  	if(isset($request["provee"]) and count($request["provee"]) > 0){
  		$item = array();
  		$item[] = $request["provee"]['options_provee_crear'];
  		$item[] = $request["provee"]['options_provee_config'];
  		$item[] = $request["provee"]['options_provee_ver'];
 		$respon['provee'] = $this->modulo->Agregar_modulo_empleado(5,implode(",",$item),$id);
  	}

  	if(isset($request["soport"]) and count($request["soport"]) > 0){
  		$item = array();
  		$item[] = $request["soport"]['options_soport_ver'];
  		$item[] = $request["soport"]['options_orden_ver'];
  		$item[] = $request["soport"]['options_respon_viabili'];
  		$respon['soport'] = $this->modulo->Agregar_modulo_empleado(6,implode(",",$item),$id);	 
  	}
  	return $respon;
  }
}
new ModuloController();
?>