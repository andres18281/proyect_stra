<?php
session_start();
include_once "../Model/Contrato.php";
class ContratoController{
	private $contra = null;
	function __construct(){
	 if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
	  $this->contra = new Contrato();
	  $request = json_decode($_POST['request'],true);
	  if($request['accion'] =="create_contrato"){
	  	$respon = $this->Create_contrato($request);
	  	echo json_encode($respon);
	  }

	  if($request['accion'] == "modificar_contrato"){
	  	$respon = $this->Motificar_contrato($request);
	    echo json_encode($respon);
	  }

	  if($request['accion'] == "buscar_por_cliente"){
	  	$id = $request['id'];
	  	if(isset($id) and !empty($id)){
	  	  $respon = $this->Get_contrato_by_client($id);
	      echo json_encode($respon);
	    }
	  }

	  if($request['accion'] == "get_all_contrato"){
	  	$respon = $this->Get_list_contrat_client();
	  	if(isset($respon)){
	  		echo json_encode($respon);
	  	}
	  }

	  if($request['accion'] == "Get_all_contrato_by_empre"){
	  	 $id = $request['id'];
	  	 $respon = $this->Get_all_contrato_by_empre($id);
	     echo json_encode($respon);
	  }

	  if($request['accion'] == "Get_contrato"){
	  	if(isset($request['id']) and !empty($request['id'])){
	  	  $id = $request['id'];
	  	  $respon = $this->contra->Get_contrato_by_id($id);
  		  if(isset($respon)){
    		echo json_encode($respon);
  		  }
	  	}
	  }

	  if($request['accion'] == "Get_pagos_by_contrat"){
	  	$id = $request['id'];
	  	$respon = $this->Get_pagos_by_contrat($id);
	  	echo json_encode($respon);
	  }

	  if($request['accion'] == "Get_contrat_no_active"){
	  	 $respon = $this->Get_contrat_sin_activar();
	  	 if(isset($respon)){
	  	 	echo json_encode($respon);
	  	 }
	  }
	 }
	}

	private function Create_contrato($array = array()){
	  $respon = $this->contra->Set_contrato($array,$_SESSION['id_user']);
	  return $respon;
	}

	private function Motificar_contrato($array = array()){
	  $respon = $this->contra->Modify_contrato($array);
	  return $respon;
	}

	private function Get_contrato_by_client($id){
	  $respon = $this->contra->Get_contratos_by_client($id);
	  $array = array();
	  if(isset($respon)){
  		if(isset($respon[0]) and is_array($respon[0])){	
  	      foreach($respon as $val){
  	  		array_push($array,array("id"=>$val['Id_contrat'],"id_servi"=>$val['Contra_id_contr'],"tiemp"=>$val['Contra_time'],"time_inicio"=>$val['Contra_time_ini'],"time_fin"=>$val['Contra_time_fin'],"estado"=>$val['Contra_stado']));
  	  	}
  	   }else{
  		$array[] = array("id"=>$respon['Id_contrat'],"id_servi"=>$respon['Contra_id_contr'],"tiemp"=>$respon['Contra_time'],"time_inicio"=>$respon['Contra_time_ini'],"time_fin"=>$respon['Contra_time_fin'],"estado"=>$respon['Contra_stado']);
  	   }
  	   return $array;  	
	  }else{
	  	return false;
	  }
	}

	private function Get_list_contrat_client(){
	  $respon = $contra->Get_all_contrato();
	  if(isset($respon)){
	    $array = array();
	    if(isset($respon[0]) and is_array($respon[0])){
	  	  foreach($respon as $val){	
	  	    array_push($array,array("id"=>$val['Id_contrat'],"client"=>$val['Contra_id_client'],"servi"=>$val['Contra_id_contr'],"time"=>$val['Contra_time'],"timeini"=>$val['Contra_time_ini'],"timefin"=>$val['Contra_time_fin'],"estado"=>$val['Contra_stado']));
	  	  }
	    }else{
	  	  $array[] = array("id"=>$respon['Id_contrat'],"client"=>$respon['Contra_id_client'],"servi"=>$respon['Contra_id_contr'],"time"=>$respon['Contra_time'],"timeini"=>$respon['Contra_time_ini'],"timefin"=>$respon['Contra_time_fin'],"estado"=>$respon['Contra_stado']);
	    }
	     return $array;
	  }else{
	  	return false;
	  }
	}

	private function Get_all_contrato_by_empre($id){
	  $respon =  $this->contra->Get_all_contrato_by_empre($id);
  	  if(isset($respon)){
   		$array = array();
   		if(isset($respon[0]) and is_array($respon[0])){ 
          foreach($respon as $val){ 
      		array_push($array, array("id"=>$val['Id_contrat'],"servicio"=>utf8_encode($val['Contra_descrip']),"pagos"=>$val['Contra_cost_abona'],"inicio"=>$val['Contra_time_ini'],"fin"=>$val['Contra_time_fin'],"form_pago"=>$val['Contra_Form_pago'],"estado"=>$val['Contra_stado'],"total"=>$val['Contra_costo']));
    	  }
    	}else{
          $array[] = array("id"=>$respon['Id_contrat'],"servicio"=>utf8_encode($respon['Contra_descrip']),"pagos"=>$respon['Contra_cost_abona'],"inicio"=>$respon['Contra_time_ini'],"fin"=>$respon['Contra_time_fin'],"form_pago"=>$respon['Contra_Form_pago'],"estado"=>$respon['Contra_stado'],"total"=>$respon['Contra_costo']);
     	}
      	return $array;
  	  }else{
  	 	return false;
  	  }
  	}	

  	private function Get_contrat_sin_activar(){
  	   $respon = $this->contra->Get_all_contrato_without_active();
  		if(isset($respon)){
    	  $array = array();
    	  if(isset($respon[0]) and is_array($respon[0])){
      		foreach($respon as $val){
        	  $fecha = date_create($val['Contra_time_contrat']);
        	  array_push($array, array("id"=>$val['Id_contrat'],"no"=>$val['Contra_id_no'],"dia"=>date_format($fecha,"d"),"dia_letr"=>date_format($fecha,"D"),"mes_let"=>date_format($fecha,"F"),"ano"=>date_format($fecha,"Y"),"hora"=>date_format($fecha,"h:i:sa"),"servicio"=>utf8_encode($val['Servi_nomb'])));
      		}
    	  }else{ 
      		  $fecha = date_create($respon['Contra_time_contrat']);
      		  $array[] = array("id"=>$respon['Id_contrat'],"no"=>$respon['Contra_id_no'],"dia"=>date_format($fecha,"d"),"dia_letr"=>date_format($fecha,"D"),"mes_let"=>date_format($fecha,"M"),"ano"=>date_format($fecha,"Y"),"hora"=>date_format($fecha,"h:i:sa"),"servicio"=>utf8_encode($respon['Servi_nomb']));
    	  }
    	  return $array;	
  		}else{
  			return false;
  		}	
	}

	private function Get_pagos_by_contrat($id){
	  	include_once "../Model/Pagos.php";
	  	$pagos = new Pagos();	
	  	if(strpos($id,"-") > 0){
	  	  $v = explode("-",$id);
	  	  $id = $v[1];		
	  	}
  		$respon = $pagos->Get_all_pago_by_contrato($id);
  		$array = array();
  		if(isset($respon)){
  		 if(isset($respon[0]) and is_array($respon[0])){
  		 	$array = $respon;
  		 }else{
			$array[0] = $respon; 	
  		 }
    	  return $array;
		}
		unset($respon);
	}
}
new ContratoController();










?>