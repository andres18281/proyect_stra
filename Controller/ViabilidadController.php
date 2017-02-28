<?php
session_start();
include_once "../Model/Viabilidad_tecnica.php";
class ViabilidadController{
  	private $viabilidad = null;
  	function __construct(){
     if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
       $this->viabilidad = new Viabilidad_tecnica();
	   $request = json_decode($_POST['request'],true);
	   if($request['accion'] == "create_viabilidad"){ 
	   	 $nit = $request['nit'];
	  	 $respon = $this->Add_ubicacion($request['form'],$_SESSION['id_user'],$nit);
	   	 echo json_encode($respon);
	   }
	 }
  	}

  	

    private function Add_ubicacion($request = array(),$id_emplo,$nit){
      $last_id = $this->Add_viabilidad($id_emplo,$nit);
  	  if(isset($request,$last_id)){
  	  	$array_respon = array();
  	  	if(isset($request[0]) and is_array($request[0])){
	  	  foreach($request as $val){
	  	    $array_viabi = array("viabili_busqueda"=>$val['hidden_dir'],
  	 					  	     "viabili_direcc"=>$val['hidden_direc'],
  	 					  	     "viabili_latitud"=>$val['hidden_long'],
  	 					  	     "viabili_longitud"=>$val['hidden_lati'],
  	 					  	     "viabili_config"=>$val['hidden_tip_ip'],
  	 					  	     "viabili_acceso"=>$val['hidden_tip_transf'],
  	 					  	     "viabili_velocid"=>$val['hidden_tip_velo'],
  	 					  	     "viabili_tipo_enlace"=>$val['hidden_tip_enlac'],
  	 					  	     "viabili_slas"=>$val['hidden_tip_slash'],
  	 					  	     "viabili_stado1"=>1,
  	 					  	     "viabili_id_solici"=>$last_id);
		  	$array_viabi[] = $this->viabilidad->Set_viabilidad($array_viabi);
  	      }
  	      return $array_viabi; 
  	    }
  	  }
    }

    private function Add_viabilidad($id_emplo,$nit){
      $id = $this->viabilidad->Add_viabilidad($id_emplo,$nit);
      return $id['last_cod_id'];
    }
}

?>