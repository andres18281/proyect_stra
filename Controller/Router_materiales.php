<?php
 include_once('../Model/Material.php');

 if(isset($_POST['get_list_material'])){	
 	$id = $_POST['get_list_material'];
 	if(stripos($id, "-") > 0){
 	  $var = explode("-", $id);
 	  $id = $var[0];
 	}
 	$material = new  Material();
 	$respon = $material->Get_solicitud_material_by_id_contrat($id);
 	if(isset($respon)){
 	  $array = array();
 	  if(isset($respon[0]) and is_array($respon[0])){
 	  	foreach($respon as $val){   
 	  	  array_push($array, array("id"=>$val['id'],"nomb"=>utf8_encode($val['nomb']),"cant"=>utf8_encode($val['cant'])));
 	  	}
 	  }else{
 	  	$array[] = array("id"=>$respon['id'],"nomb"=>utf8_encode($respon['nomb']),"cant"=>utf8_encode($respon['cant']));
 	  }
 	  echo json_encode($array);
 	}
 }

 if(isset($_POST['update_price_material'])){
 	$material = new  Material();
 	$array = json_decode($_POST['update_price_material'],true);
 	foreach($array as $key=>$val){
 	  $data[] = $material->Update_precio_material($key,$val);
 	}
 	echo json_encode($data);
 }
?>