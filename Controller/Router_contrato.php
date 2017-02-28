<?php
session_start();
 if(isset($_POST['id_client'],$_POST['id'],$_POST['servicio'],$_POST['tiempo_serv'],$_POST['time_ini'],$_POST['time_fin'],$_POST['descript'],$_POST['tip_pago'],$_POST['tiempo'],$_POST['costo'])){
 	include_once('../Model/Contrato.php');
 	$contra = new Contrato();
 	$id = $_POST['id'];
 	$servi = $_POST['servicio'];
 	$time_servi = $_POST['tiempo_serv'];
 	$timeini = $_POST['time_ini'];
 	$timefin = $_POST['time_fin'];
 	$descrip = $_POST['descript'];
 	$client = $_POST['id_client'];
  $tip_pago = $_POST['tip_pago'];
  $cuota = $_POST['tiempo']; 
  $costo = $_POST['costo'];
 	$respon = $contra->Set_contrato($id,$servi,$time_servi,$timeini,$timefin,utf8_encode($descrip),$client,$tip_pago,$cuota,$costo,$_SESSION['id_user']);
 	echo json_encode($respon);
 }

// modificar un contrato
if(isset($_POST['id'],$_POST['subservicio'],$_POST['time_servi'],$_POST['fech_ini'],$_POST['fech_fin'],$_POST['form_pago'],$_POST['cuota'],$_POST['servi_tect'])){
    if(isset($_POST['costo_new']) and !empty($_POST['costo_new'])){
      $cost = $_POST['costo_new'];
    }else{
      $cost = null;
    }
    if(isset($_POST['decrip_descuent']) and !empty($_POST['decrip_descuent'])){
      $descrip_ = $_POST['decrip_descuent'];
    }else{
       $descrip_ = null;
    }
    $id = $_POST['id'];
    $subservi = $_POST['subservicio'];
    $time_servi = $_POST['time_servi'];
    $fech_ini = $_POST['fech_ini'];
    $fech_fin = $_POST['fech_fin'];
    $form_pag = $_POST['form_pago'];
    $cuot = $_POST['cuota'];
    $serv_tect= $_POST['servi_tect'];
    $priori = $_POST['priori'];
    include_once('../Model/Contrato.php');
    $contra = new Contrato();
    $respon = $contra->Modify_contrato($id,$subservi,$time_servi,$fech_ini,$fech_fin,$form_pag,$cost,$serv_tect,$cuot,$descrip_,$priori);
    echo json_encode($respon);
}

if(isset($_POST['list_all_contrat_client'])){
  $id = $_POST['list_all_contrat_client'];
  include_once('../Model/Contrato.php');
  $contra = new Contrato();
  $respon = $contra->Get_contratos_by_client($id); 
  if(isset($respon)){
  	$array = array();
  	if(isset($respon[0]) and is_array($respon[0])){	
  	  foreach($respon as $val){
  	  	array_push($array,array("id"=>$val['Id_contrat'],"id_servi"=>$val['Contra_id_contr'],"tiemp"=>$val['Contra_time'],"time_inicio"=>$val['Contra_time_ini'],"time_fin"=>$val['Contra_time_fin'],"estado"=>$val['Contra_stado']));
  	  }
  	}else{
  		$array[] = array("id"=>$respon['Id_contrat'],"id_servi"=>$respon['Contra_id_contr'],"tiemp"=>$respon['Contra_time'],"time_inicio"=>$respon['Contra_time_ini'],"time_fin"=>$respon['Contra_time_fin'],"estado"=>$respon['Contra_stado']);
  	}
  	echo json_encode($array);
  }
}

if(isset($_POST['show_all_contrato'])){
	include_once('../Model/Contrato.php');
  	$contra = new Contrato();
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
	  echo json_encode($array);
	}
} 

if(isset($_POST['Get_all_contrato_by_empre'])){ 
  $id = $_POST['Get_all_contrato_by_empre'];
  include_once('../Model/Contrato.php'); 
  $contra = new Contrato();
  $respon =  $contra->Get_all_contrato_by_empre($id);
  if(isset($respon)){
   $array = array();
   if(isset($respon[0]) and is_array($respon[0])){ 
    foreach($respon as $val){ 
      array_push($array, array("id"=>$val['Id_contrat'],"servicio"=>utf8_encode($val['Contra_descrip']),"pagos"=>$val['Contra_cost_abona'],"inicio"=>$val['Contra_time_ini'],"fin"=>$val['Contra_time_fin'],"form_pago"=>$val['Contra_Form_pago'],"estado"=>$val['Contra_stado'],"total"=>$val['Contra_costo']));
    }
   }else{
     $array[] = array("id"=>$respon['Id_contrat'],"servicio"=>utf8_encode($respon['Contra_descrip']),"pagos"=>$respon['Contra_cost_abona'],"inicio"=>$respon['Contra_time_ini'],"fin"=>$respon['Contra_time_fin'],"form_pago"=>$respon['Contra_Form_pago'],"estado"=>$respon['Contra_stado'],"total"=>$respon['Contra_costo']);
   }
   echo json_encode($array);
  }
}

if(isset($_POST['Get_pagos_by_contrat'])){ 
  $id = $_POST['Get_pagos_by_contrat'];
  include_once('../Model/Contrato.php');
  $contra = new Contrato();
  $respon = $contra->Get_all_pago_by_contrato($id);
  if(isset($respon)){
    $array = array();
    if(isset($respon[0]) and is_array($respon[0])){
      foreach($respon as $val){ 
        array_push($array, array("id"=>$val['pagos_id'],"fecha_ini"=>$val['pago_fecha_inic'],"fecha_end"=>$val['pago_fecha_fin'],"costo"=>$val['pago_costo'],"fecha_pago"=>$val['pago_fecha_pago'],"confir"=>$val['pago_confir']));
      }
    }else{
      $array[] = array("id"=>$respon['pagos_id'],"fecha_ini"=>$respon['pago_fecha_inic'],"fecha_end"=>$respon['pago_fecha_fin'],"costo"=>$respon['pago_costo'],"fecha_pago"=>$respon['pago_fecha_pago'],"confir"=>$respon['pago_confir']);
    } 
    echo json_encode($array);
  }
}


// busca un contrato sin activar con el id
if(isset($_POST['contrato_sin_active'])){ 
  $id = $_POST['contrato_sin_active'];
  include_once('../Model/Contrato.php');
  $contra = new Contrato();
  $respon = $contra->Get_contrato_by_id($id);
  if(isset($respon)){
    $array = array("id"=>$respon['Id_contrat'],"id_cli"=>$respon['Contra_id_client'],"nomb_empr"=>utf8_encode($respon['Empres_nomb']),"employed"=>utf8_encode($respon['employed']),"id_vende"=>$respon['Contra_id_vended'],"id_servi"=>$respon['Contra_id_contr'],"id_servi_princi"=>$respon['Servi_id_tip'],"tiempo_contrat"=>$respon['Contra_time'],"Form_pago"=>$respon['Contra_Form_pago'],"time_done"=>$respon['Contra_time_contrat'],"time_ini"=>$respon['Contra_time_ini'],"time_fin"=>$respon['Contra_time_fin'],"estado"=>$respon['Contra_stado'],"cost"=>$respon['Contra_costo'],"serv_nom"=>utf8_encode($respon['Servi_nomb']),"servi_cost"=>$respon['Servi_cost'],"time_service"=>$respon['Servi_tiem'],"servi_princi"=>utf8_encode($respon['Tipo_nomb']),"cuota"=>$respon['Contra_Form_cuota'],
      "nomb_cli"=>$respon['nomb_client'],"mail_cli"=>$respon['Client_email'],"dir">=$respon['Client_dire']);
    echo json_encode($array);
  }
}

if(isset($_POST['all_contrat_without_active'])){
  include_once('../Model/Contrato.php');
  $contra = new Contrato();
  $respon = $contra->Get_all_contrato_without_active();
  if(isset($respon)){
    $array = array();
    if(isset($respon[0]) and is_array($respon[0])){
      foreach($respon as $val){
        $fecha = date_create($val['Contra_time_contrat']);
        array_push($array, array("id"=>$val['Id_contrat'],"dia"=>date_format($fecha,"d"),"dia_letr"=>date_format($fecha,"D"),"mes_let"=>date_format($fecha,"F"),"ano"=>date_format($fecha,"Y"),"hora"=>date_format($fecha,"h:i:sa"),"servicio"=>utf8_encode($val['Servi_nomb'])));
      }
    }else{ 
      $fecha = date_create($respon['Contra_time_contrat']);
      $array[] = array("id"=>$respon['Id_contrat'],"dia"=>date_format($fecha,"d"),"dia_letr"=>date_format($fecha,"D"),"mes_let"=>date_format($fecha,"M"),"ano"=>date_format($fecha,"Y"),"hora"=>date_format($fecha,"h:i:sa"),"servicio"=>utf8_encode($respon['Servi_nomb']));
    }
    echo json_encode($array);
  }
}


?>