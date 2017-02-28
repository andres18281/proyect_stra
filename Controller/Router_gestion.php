<?php
session_start();
  // request para peticiones de solicitudes de soporte en contratos
  if(isset($_POST['get_solicitud_soport'])){
  	include_once('../Model/Gestion.php');
  	$gestion = new Gestion();
  	$respon = $gestion->Get_all_request_soport_by_contrat();
  	if(isset($respon)){
  	 $array = array();
  	 if(isset($respon[0]) and is_array($respon[0])){
  	 	foreach($respon as $val){
  	    array_push($array, array("id"=>$val['Id_contrat'],"priori"=>$val['Contra_servi_tec_pri'],"servi"=>utf8_encode($val['Servi_nomb'])));
  	 	}
  	 }else{
  	  $array[] = array("id"=>$respon['Id_contrat'],"priori"=>$respon['Contra_servi_tec_pri'],"servi"=>utf8_encode($respon['Servi_nomb']));
  	 }
  	  echo json_encode($array);
  	}
  }


  // el jefe del area tecnica canaliza las solicitudes de contrato y las asigna a operadores
  if(isset($_POST['accion'])){
    $accion = json_decode($_POST['accion'],true);
    if(isset($accion['canalizar'])){
     $form = $accion['canalizar'];
     include_once('../Model/Gestion.php');
     $gestion = new Gestion();
     $emplo = $form['slt_person'];
     $text = $form['txt_coment'];
     $id = $form['hidden_solicitud'];
     $respon = $gestion->Set_solicitud_canalizada_soport($id,$emplo,$text); 
     echo json_encode($respon);
    }
  }

  // solicitudes tecnicas por empleados
  if(isset($_POST['id_employed_soport'])){
    $id = $_POST['id_employed_soport'];
    include_once('../Model/Gestion.php');
    $gestion = new Gestion();
    $respon = $gestion->Get_solicitud_tecnico_soport_notify($id);
    if(isset($respon)){
      $array = array();
      if(isset($respon[0]) and is_array($respon[0])){
        foreach($respon as $val){
          array_push($array, array("id"=>$val['Gestion_id_auto'],"fech"=>$val['Gestion_fecha'],"estado"=>$val['Gestion_estado']));
        }
      }else{
        $array[] = array("id"=>$respon['Gestion_id_auto'],"fech"=>$respon['Gestion_fecha'],"estado"=>$respon['Gestion_estado']);
      }
      echo json_encode($array);
    }
  }
  

  // obtiene el listado de soporte tecnico para trabajar
  if(isset($_POST['get_solicitud_employed'])){
    $id = $_POST['get_solicitud_employed'];
    include_once('../Model/Gestion.php');
    $gestion = new Gestion();
    $respon = $gestion->Get_solicitud_tecnico_soport($id);
    if(isset($respon)){
      $array = array();
      if(isset($respon[0]) and is_array($respon[0])){
        foreach($respon as $val){
          array_push($array, array("id"=>$val['Gestion_id_auto'],"id_con"=>$val['Id_contrat'],"descrip"=>$val['Contra_descrip'],"fecha"=>$val['Gestion_fecha'],"estado"=>$val['Gestion_estado']));
        }
      }else{
        $array[] = array("id"=>$respon['Gestion_id_auto'],"id_con"=>$respon['Id_contrat'],"descrip"=>$respon['Contra_descrip'],"fecha"=>$respon['Gestion_fecha'],"estado"=>$respon['Gestion_estado']);
      }
      echo json_encode($array);
    }
  }
  
  // obtiene los comentarios que describe el trabajo a realizar
  if(isset($_POST['get_info_request_tecni'])){
    $id = $_POST['get_info_request_tecni'];
    include_once('../Model/Gestion.php');
    $gestion = new Gestion();
    $respon = $gestion->Get_info_soport_tecnico($id);
    if(isset($respon)){ 
      $data = array("coment"=>$respon['Coment_text'],"empre"=>utf8_encode($respon['Empres_nomb']));
      echo json_encode($data);
    }  
  }

  // Envia una solicitud de productos que un tecnico va a necesitar //
  if(isset($_POST["product"],$_POST["id_solici"])){
    include_once('../Model/Material.php');
    $data = json_decode($_POST["product"]);
    $array = array();
    $id = $_POST["id_solici"];
    if(isset($data)){
      $material = new Material();
      if(is_array($data)){
        foreach($data as $val){
         $respon = $material->Set_solici_material($val->nomb,$val->cant,$id);
         array_push($array, array("id"=>$id,"estado"=>$respon));
        }
      }else{
        $respon = $material->Set_solici_material($data->nomb,$val->data,$id);
        $array[] = array("id"=>$id,"estado"=>$respon);
      }
      echo json_encode($array);
    }
  }

  // obtiene todas las solicitudes en estado pendiente 
  if(isset($_POST['get_solici_pendien'])){
    include_once('../Model/Compras.php');
    $com = new Compras();
    $request = $com->Get_all_request_gestion(); 
    if(isset($request)){
      $array = array();
      if(isset($request[0]) and is_array($request[0])){
        foreach($request as $val){
          array_push($array, array("id"=>$val['Gestion_id_auto'],"id_contrat"=>$val['Gestion_id_tip'],"id_emplo"=>$val['Gestion_id_emplead'],"emple"=>utf8_encode($val['emple']),"id_coment"=>$val['Gestion_id_coment'],"fecha"=>$val['Gestion_fecha_pend']));
        }
      }else{
        $array[] = array("id"=>$request['Gestion_id_auto'],"id_contrat"=>$request['Gestion_id_tip'],"id_emplo"=>$request['Gestion_id_emplead'],"emple"=>utf8_encode($request['emple']),"id_coment"=>$request['Gestion_id_coment'],"fecha"=>$request['Gestion_fecha_pend']);
      }
      echo json_encode($array);
    }
  }

  //
  if(isset($_POST['set_inicio_obra'])){
    include_once('../Model/Gestion.php');
    $id = $_POST['set_inicio_obra'];
    $gestion = new Gestion();
    $respon = $gestion->Inicia_proceso($id);
    echo json_encode($respon);
  }

  // autoriza la compra
  if(isset($_POST['autoriza_solici'])){
    $id = $_POST['autoriza_solici'];
    include_once('../Model/Gestion.php');
    $gestion = new Gestion();
    $respon = $gestion->Autorizar_compra($id);
    echo json_encode($respon);
  } 

  // tecnico indica que inicio obra de instalacion
  if(isset($_POST['inicio_trabajo'])){
    $id = $_POST['inicio_trabajo'];
    include_once('../Model/Gestion.php');
    $gestion = new Gestion();
    $respon = $gestion->Set_iniciar_proceso($id);
    echo json_encode($respon);
  }

  // gestiona las solicitudes segun el tecnico
  if(isset($_POST['get_gestion_activo'])){
    include_once('../Model/Gestion.php');
    $gestion = new Gestion();
    $data = $gestion->Get_procesos_en_gestion("22344"); //$_SESSION['id_user']
    if(isset($data)){
      $array = array();
      if(isset($data[0]) and is_array($data[0])){
        foreach($data as $val){
          array_push($array, array("id"=>$val['Gestion_id_auto'],"id_contrat"=>$val['Gestion_id_tip'],"empre"=>utf8_encode($val['Empres_nomb'])));
        }
      }else{
        $array[] = array("id"=>$data['Gestion_id_auto'],"id_contrat"=>$data['Gestion_id_tip'],"empre"=>utf8_encode($data['Empres_nomb']));
      }
      echo json_encode($array);
    }
  }
  


?>