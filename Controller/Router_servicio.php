<?php
 
if(isset($_POST['agregar_servicio'])){
 if(isset($_POST['id_item'],$_POST['nomb_servi'])){
   include_once('../Model/Servicios.php');
   $id = $_POST['id_item'];
   $nomb = $_POST['nomb_servi'];
   $servi = new Servicios();
   $respon = $servi->Set_servicio_principal($id,$nomb);
   echo json_encode($respon);
 }	
}

 if(isset($_POST['registrar_servicio'],$_POST['id_ser'],$_POST['nomb_serv'],$_POST['tipo_serv'],$_POST['cost_serv'],$_POST['select_tim'])){
 	include_once('../Model/Servicios.php');
 	$servi = new Servicios();
 	$id = $_POST['id_ser'];
 	$nomb = $_POST['nomb_serv'];
 	$tipo = $_POST['tipo_serv'];
 	$cost = $_POST['cost_serv'];
 	$tiemp = $_POST['select_tim']; 
 	$respon = $servi->Set_servicios_secundario($id,$tipo,$nomb,$cost,$tiemp);
 	echo json_encode($respon);
 }

 if(isset($_POST['listar_servicios_principal'])){
 	include_once('../Model/Servicios.php');
 	$servi = new Servicios();
 	$respon = $servi->Get_listado_servicio();
 	if(isset($respon)){
 	  $array = Array();
 	  if(isset($respon[0]) and is_array($respon[0])){ 
 	  	foreach ($respon as $key => $value) {
 		   array_push($array,array("id"=>$value['Tipo_id'],"nomb"=>utf8_encode($value['Tipo_nomb'])));
 	  	}
 	  }else{
 	  	$array[] = array("id"=>$respon['Tipo_id'],"nomb"=>utf8_encode($respon['Tipo_nomb']));
 	  }
 	  echo json_encode($array);
 	}
 }

 if(isset($_POST['list_servicios_vent'])){
 	include_once('../Model/Servicios.php');
 	$servi = new Servicios();
 	$data = $servi->Get_all_servicios_secundario();
 	if(isset($data)){
 	  $array = array();
 	  if(isset($data[0]) and is_array($data[0])){
 	  	foreach($data as $val){
 	  	  array_push($array,array("id"=>$val['Servi_id'],"tipo"=>$val['Servi_id_tip'],"nomb_serv"=>utf8_encode($val['Servi_nomb']),"cost"=>number_format($val['Servi_cost']),"item"=>$val['Servi_tiem']));
 	  	}
 	  }else{
 	  	$array[] = array("id"=>$data['Servi_id'],"tipo"=>$data['Servi_id_tip'],"nomb_serv"=>utf8_encode($data['Servi_nomb']),"cost"=>number_format($data['Servi_cost']),"item"=>$data['Servi_tiem']);
 	  }
 	  echo json_encode($array);
 	}
 } 
 // lista los servicios de contratos
 if(isset($_POST['list_servi_contratos'])){
 	include_once('../Model/Servicios.php');
 	$id = $_POST['list_servi_contratos'];
 	$servi = new Servicios();
 	$respon = $servi->Get_servicios_by_tipo($id);
 	if(isset($respon)){
 	  $array = array();
 	  if(isset($respon[0]) and is_array($respon[0])){
 	  	foreach($respon as $val){
 	  	  array_push($array,array("id"=>$val['Servi_id'],"servicio"=>"|  ".$val['Servi_nomb']." | Costo = ".number_format($val['Servi_cost'])."| Tiempo = ".$val['Servi_tiem'],"costo"=>$val['Servi_cost'],"tiempo"=>$val['Servi_tiem']));
 	  	}
 	  }else{
 	  	$array[] = array("id"=>$respon['Servi_id'],"servicio"=>"|  ".$respon['Servi_nomb']." | Costo = ".number_format($respon['Servi_cost'])."| Tiempo = ".$respon['Servi_tiem'],"costo"=>$respon['Servi_cost'],"tiempo"=>$respon['Servi_tiem']);
 	  }
 	  echo json_encode($array);
 	}
 }

 // lista el servicio que se presta
 if(isset($_POST['item_for_contrato'])){
 	include_once('../Model/Servicios.php');
 	$servi = new Servicios();
 	$id = $_POST['item_for_contrato'];
 	$data = $servi->Get_service_by_id($id);
 	if(isset($data)){
 	  $data = array("costo"=>$data['Servi_cost'],"tiempo"=>$data['Servi_tiem']);
 	  echo json_encode($data);
 	}
 }
 


?>