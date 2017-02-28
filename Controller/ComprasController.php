<?php
include_once('../Model/Compras.php');
class ComprasController{
	private $compras = null;
	function __construct(){
		$this->compras = new Compras();
		$request = json_decode($_POST['request'],true);
		if($request['accion'] == "get_solici_pendien"){
	  	  $respon = $this->Get_solicitud_compras();
		  echo json_encode($respon);
		}
	}


	private function Get_solicitud_compras(){
	  $respon = $this->compras->Get_all_request_gestion();	
	  if(isset($respon)){
        $array = array();
        if(isset($respon[0]) and is_array($respon[0])){
          foreach($respon as $val){
            array_push($array, array("id"=>$val['Gestion_id_auto'],"id_contrat"=>$val['id'],"id_emplo"=>$val['Gestion_id_emplead'],"emple"=>utf8_encode($val['emple']),"id_coment"=>$val['Gestion_id_coment'],"fecha"=>$val['Gestion_fecha_pend']));
          }
        }else{
          $array[] = array("id"=>$respon['Gestion_id_auto'],"id_contrat"=>$respon['id'],"id_emplo"=>$respon['Gestion_id_emplead'],"emple"=>utf8_encode($respon['emple']),"id_coment"=>$respon['Gestion_id_coment'],"fecha"=>$respon['Gestion_fecha_pend']);
        }
        return $array;
      }else{
      	return false;
      }
	}
}
new ComprasController();
?>