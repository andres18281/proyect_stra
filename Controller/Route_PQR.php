<?php
 include_once('../Model/PQR.php');
 if(isset($_POST['add_pqr_nuevo'])){
   if(isset($_POST['Nit_empresa'],$_POST['telefono'],$_POST['celular'],$_POST['descrip'],$_POST['event'],$_POST['ciudad'],$_POST['id_recibe'],$_POST['estado'],$_POST['area'],$_POST['id_employed'])){
   	$nit = $_POST['Nit_empresa'];	
   	$tel = $_POST['telefono'];
    $cel = $_POST['celular'];
    $descrip = $_POST['descrip'];
    $event = $_POST['event'];
    $ciudad = $_POST['ciudad'];
    $id_emplo = !empty($_POST['id_employed'])?$_POST['id_employed']:null;
    $id_recibe = base64_decode($_POST['id_recibe']);
    $estado = $_POST['estado'];
    $area = !empty($_POST['area'])?$_POST['area']:null;
   	$pqr = new PQR();
   	$data = $pqr->Set_PQR($nit,$tel,$cel,$descrip,$event,$ciudad,$id_recibe,$estado,$id_emplo,$area);
   	echo json_encode($data);
   }	
 	
 }

 if(isset($_POST['buscar_empresa'])){
 	if(isset($_POST['nit'])){
 	  $nit = $_POST['nit'];
 	  $pqr = new PQR();
 	  $respon = $pqr->Get_PQR_by_titular($nit);
    if(isset($respon)){
      $array = array();
      if(isset($respon[0]) and is_array($respon)){
        foreach($respon as $val){       
          array_push($array,array("id"=>$val["id"],"nomb"=>utf8_encode($val['nomb_event']),"ciud"=>$val['ciud'],"id_recib"=>$val['canali'],"fecha"=>$val['fecha'],"estado"=>$val['estado'],"depart"=>$val['depart']));
        }
      }else{
        $array[] = array("id"=>$respon["id"],"nomb"=>utf8_encode($respon['nomb_event']),"ciud"=>$respon['ciud'],"id_recib"=>$respon['canali'],"fecha"=>$respon['fecha'],"estado"=>$respon['estado'],"depart"=>$respon['depart']); 
      }
      echo json_encode($array);         
    }
 	}
 }


  if(isset($_POST['id_ticket'])){
   $id = $_POST['id_ticket'];
   $pqr = new PQR();
   $array = array();
   $array2 = array();
   $data_ = $pqr->Get_PQR($id);
   $data2 = $pqr->Get_Respond($id);
   if(isset($data_)){
     foreach($data_ as $data1){
       $respon['ticket_primary'] = $data1;
     }
   }
   if(isset($data2)){
      foreach($data2 as $val){
        $array2[] = $val; 
      }
   }
   $respon['ticket_respon'] = $array2; 
   echo json_encode($respon);
  }
?>