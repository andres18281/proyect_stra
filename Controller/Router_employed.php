<?php
 if(isset($_POST['get_employed_by_depart'])){
 	include_once('../Model/Empleado.php');
 	$id = $_POST['get_employed_by_depart'];
 	$emple = new Empleado();
 	$respon = $emple->Get_all_employed_by_depart($id);
 	if(isset($respon)){
      $array = array();
      if(isset($respon[0]) and is_array($respon[0])){
      	foreach($respon as $val){ 
        	array_push($array, array("id"=>$val['emple_id'],"nomb"=>utf8_encode($val['emple']),"carg"=>utf8_encode($val['Carg_nomb']),"email"=>$val['emple_email'],"img"=>$val['emple_foto']));
      	}
      }else{
      	$array[] = array("id"=>$respon['emple_id'],"nomb"=>$respon['emple'],"carg"=>$respon['Carg_nomb'],"email"=>$respon['emple_email'],"img"=>$respon['emple_foto']);
      }
    	echo json_encode($array);
  	}
 }

 if(isset($_POST['get_employed_by_cargo'])){
  include_once('../Model/Empleado.php');
  $id = $_POST['get_employed_by_cargo'];
  $emple = new Empleado();
  $respon = $emple->Get_all_employed_by_area($id);
  if(isset($respon)){
    $array = array();
    if(isset($respon[0]) and is_array($respon[0])){
      foreach($respon as $val){
        array_push($array, array("id"=>$val['emple_id'],"nombre"=>$val['emple']));
      }
    }else{
      $array[] = array("id"=>$respon['emple_id'],"nombre"=>$respon['emple']);
    }
    echo json_encode($array);
  }
 }
  

?>