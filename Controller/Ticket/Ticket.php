<?php
session_start();
include_once "../../Model/PQR.php";
include_once "../../Model/PQR_por_usuario.php";
// all ticket by area
if(isset($_POST['all_ticket'])){
  $pqr = new PQR(); 
  $id = $_SESSION['id_user'];
  $respon = $pqr->Get_All_ticket_by_employed($id);
  if(isset($respon)){
    echo json_encode($respon);
  }
}

if(isset($_POST['msn_ticket'])){
  $pqr = new PQR(); 
  $id = $_POST['msn_ticket'];	
  $respon = $pqr->Get_msn_ticket($id);
  echo json_encode($respon);
}

if(isset($_POST['respuesta'],$_POST['id_tick'],$_POST['estado'])){
  $id_recibe = $_SESSION['id_user'];
  include_once "../../Model/Empleado.php";
  $pqr = new PQR();
	if(isset($_POST['departamento'],$_POST['employ']) and !empty($_POST['employ']) and !empty($_POST['departamento'])){
	  $depart = $_POST['departamento'];
    $employed = $_POST['employ'];
	}else{
    $emple = new Empleado();
    $depart = $emple->Get_departament_from_employed($id_recibe);
    $depart = $depart[0]['cargo'];
    $employed = $_SESSION['id_user'];
	}
	$respon = $_POST['respuesta'];
	$tick = $_POST['id_tick'];
	$esta = $_POST['estado'];
  $respon = $pqr->Set_respon_ticket(utf8_encode($respon),$tick,$id_recibe,$esta,$depart,$employed);
  if(isset($respon['exito'])){
  	$pqr->Update_estado_pqr($tick,$esta,$employed);
  }
  echo json_encode($respon);
}

//verificar_respuesta
if(isset($_POST['id_ticket_respon'])){
  $id = $_POST['id_ticket_respon'];
  $pqr = new PQR();
  $respon = $pqr->Get_respon_ticket($id);
  if(isset($respon)){
  	$array = array();  	
  	  foreach($respon as $val){
  	  	$fecha = date_create($val['Respon_date']);
        array_push($array, array("respuesta"=>utf8_encode($val['Respon_text']),"fecha"=>date_format($fecha,"Y-m-d"),"hora"=>date_format($fecha,"h:i:sa"),date_format($fecha,"h:i:sa"),"departament"=>$val['Depart_nomb'],"empleado"=>utf8_encode($val['nombre'])));
  	  }
  	echo json_encode($array);
  }
}

// enlista los ticket por empleados
if(isset($_POST['ticket_by_employed'])){
  $id = $_SESSION['id_user'];
  $ticket = new PQR_por_usuario();
  $respon = $ticket->Get_all_ticket_by_employed($id); 
  if(isset($respon)){
    $array = array();
    foreach($respon as $val){
      $fecha = date_create($val['Ticket_date']);
      array_push($array, 
                 array("id"=>$val['Ticket_id'],"fecha"=>date_format($fecha,"Y-m-d"),"hora"=>date_format($fecha,"h:i:sa")));
    } 
    echo json_encode($array); 
  }
}

?>