<?php
session_start();
include_once('../Model/Gestion.php');
class GestionController{
  private $gestion = null;
  function __construct(){
  	if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
      $this->gestion = new Gestion();
      $request = json_decode($_POST['request'],true);
      if($request['accion'] == "get_solicitud_soport"){
      	$respon = $this->Get_solicitudes_soporte();
        echo json_encode($respon);
      }

      // obtiene todas las solicitudes tecnicas asignadas a un usuario
      if($request['accion'] == "get_solicitud_tect"){
      	$id = $_SESSION['id_user'];
      	$respon = $this->Get_soporte_by_employed($id);
        echo json_encode($respon);
      }

      if($request['accion'] == "get_solicitud_employed"){
         $id = $_SESSION['id_user'];
         $respon = $this->Get_all_soporte_with_asig($id);      	
         echo json_encode($respon);
      }

      if($request['accion'] == "get_info_request_tecni"){
         $id = $request['id'];
         $respon = $this->Get_info_servicio_tecnico($id);
         echo json_encode($respon);
      }
 
      if($request['accion'] == "get_gestion_activo"){
        $respon = $this->Get_gestion_activo();
        echo json_encode($respon);
      }

      // obtiene todas las solicitudes en estado pendiente 
      if($request['accion'] == "get_solici_pendien"){
        $respon = $this->Get_solicitud_pendiente();
        echo json_encode($respon);
      }

      if($request['accion'] == "set_inicio_obra"){
        $id = $request['id'];
        $respon = $this->Set_inicio_obra($id);
        echo json_encode($respon);
      }

      if($request['accion'] == "autoriza_solici"){
        $id = $request['id'];
        $respon = $this->Set_autorizar_solicitu($id);
        echo json_encode($respon);
      }      

      if($request['accion'] == "canalizar"){
        $respon = $this->Canalizar_solicitud_operador($request);
        echo json_encode($respon);
      }

      if($request['accion'] == "gestion_terminado"){
        $respon = $this->Set_informe_terminado();
        echo json_encode($respon);
      }

      if($request['accion'] == "activar_contrato"){
        $id = $request['id'];
        $respon = $this->Activar_contrato($id);
        echo json_encode($respon);
      }

      if($request['accion'] == "get_contrato_sin_activar"){
        $respon = $this->Get_contrato_sin_activar();
        echo json_encode($respon);
      }

      if($request['accion'] == "get_informe"){
        $id = $request['id'];
        $respon = $this->Get_informe_instalacion($id);        
        echo json_encode($respon);
      }

      if($request['accion'] == "get_material"){
        $id = $request['id'];
        $respon = $this->Get_material_solicitados($id);
        echo json_encode($respon);
      }
   }
  }


  private function Get_solicitudes_soporte(){
  	$respon = $this->gestion->Get_all_request_soport_by_contrat();
  	if(isset($respon)){
  	 $array = array();
  	 if(isset($respon[0]) and is_array($respon[0])){
  	 	foreach($respon as $val){
  	    array_push($array, array("id"=>$val['id'],"priori"=>$val['Contra_servi_tec_pri'],"servi"=>utf8_encode($val['Servi_nomb'])));
  	 	}
  	 }else{
  	  $array[] = array("id"=>$respon['id'],"priori"=>$respon['Contra_servi_tec_pri'],"servi"=>utf8_encode($respon['Servi_nomb']));
  	 }
  	  return $array;
  	}else{
      return false;
    }
  }

  // solicitudes tecnicas por empleados
  private function Get_soporte_by_employed($id){
  	$respon = $this->gestion->Get_solicitud_tecnico_soport_notify($id);
    if(isset($respon)){
      $array = array();
      if(isset($respon[0]) and is_array($respon[0])){
        foreach($respon as $val){
          array_push($array, array("id"=>$val['Gestion_id_auto'],"fech"=>$val['Gestion_fecha'],"estado"=>$val['Gestion_estado']));
        }
      }else{
        $array[] = array("id"=>$respon['Gestion_id_auto'],"fech"=>$respon['Gestion_fecha'],"estado"=>$respon['Gestion_estado']);
      }
      return $array;
    }
  }

  private function Get_all_soporte_with_asig($id){
    // obtiene el listado de soporte tecnico para trabajar
      $respon = $this->gestion->Get_solicitud_tecnico_soport($id);
      if(isset($respon)){
        $array = array();
        if(isset($respon[0]) and is_array($respon[0])){
          foreach($respon as $val){
            array_push($array, array("id"=>$val['Gestion_id_auto'],"id_con"=>$val['Id_contrat'],"descrip"=>$val['Contra_descrip'],"fecha"=>$val['Gestion_fecha'],"estado"=>$val['Gestion_estado']));
          }
        }else{
          $array[] = array("id"=>$respon['Gestion_id_auto'],"id_con"=>$respon['Id_contrat'],"descrip"=>$respon['Contra_descrip'],"fecha"=>$respon['Gestion_fecha'],"estado"=>$respon['Gestion_estado']);
        }
         return $array;
      }else{
        return null;
      }
  }


  // obtiene los comentarios que describe el trabajo a realizar
  private function Get_info_servicio_tecnico($id){
    $respon = $this->gestion->Get_info_soport_tecnico($id);
    if(isset($respon)){ 
      $data = array("coment"=>$respon['Coment_text'],"empre"=>utf8_encode($respon['Empres_nomb']));
      return $data;
    }
  }

  private function Get_gestion_activo(){
    $data = $this->gestion->Get_procesos_en_gestion($_SESSION['id_user']); //
    if(isset($data)){
      $array = array();
      if(isset($data[0]) and is_array($data[0])){
        foreach($data as $val){
          array_push($array, array("id"=>$val['Gestion_id_auto'],"id_contrat"=>$val['Gestion_id_tip'],"empre"=>utf8_encode($val['Empres_nomb'])));
        }
      }else{
        $array[] = array("id"=>$data['Gestion_id_auto'],"id_contrat"=>$data['Gestion_id_tip'],"empre"=>utf8_encode($data['Empres_nomb']));
      }
      return $array;
    }
  }

  private function Get_solicitud_pendiente(){
    $request = $this->gestion->Get_all_request_gestion(); 
    if(isset($request)){
      $array = array();
      if(isset($request[0]) and is_array($request[0])){
        foreach($request as $val){
          array_push($array, array("id"=>$val['Gestion_id_auto'],"id_contrat"=>$val['Gestion_id_tip'],"id_emplo"=>$val['Gestion_id_emplead'],"emple"=>utf8_encode($val['emple']),"id_coment"=>$val['Gestion_id_coment'],"fecha"=>$val['Gestion_fecha_pend']));
        }
      }else{
        $array[] = array("id"=>$request['Gestion_id_auto'],"id_contrat"=>$request['Gestion_id_tip'],"id_emplo"=>$request['Gestion_id_emplead'],"emple"=>utf8_encode($request['emple']),"id_coment"=>$request['Gestion_id_coment'],"fecha"=>$request['Gestion_fecha_pend']);
      }
      return $array;
    }
  }


  // almacena informacion sobre instalacion realizada
  private function Set_informe_terminado(){
    include_once('../Model/Imagenes.php');
    if(isset($_FILES['img'],$_POST['coment'],$_POST['id'])){
      $coment = $_POST['coment'];
      $id = $_POST['id'];
      $cant = count($_FILES['img']['name']);
      $imagen = new Imagenes();
      $error['coment'] = $imagen->Add_comentario(utf8_encode($coment),$id);   
      $extension = array("jpg","jpeg","JPG","JPEG","gif","PNG");
      $error = array();
      for($i = 0;$i < $cant;$i++){
        $ext = end(explode(".",$_FILES['img']['name'][$i]));
        if(array_search($ext,$extension) >= 0){
          $nom_img = str_replace(" ","",$_FILES['img']['name'][$i]);
          if(move_uploaded_file($_FILES['img']['tmp_name'][$i],"../View/img/img_reportes/".$nom_img)){
            $error['imagen'][] = $imagen->Add_imagenes_servi_tecnico($nom_img,$id);
          }else{
            $error["error"][] = $nom_img;
          }
        }else{
          echo "no entra imagen";
        }
      }
       return $error;
    }else{
      return false;
    }
  }

  // funcion que activa el contrato cuando el tecnico ha subido el reporte
  private function Set_iniciar_contrato($id){
    include_once('../Model/Pagos.php');
    $respon = $this->gestion->Gestion_terminada($id);
    if(isset($respon['exito'])){
      $pago = new Pagos($valor,$cuota,$tipo);
      $pago->Generar_cuotas();
    }
    return $respon;
  }

  private function Set_inicio_obra($id){
    $respon = $this->gestion->Inicia_proceso($id);
    return $respon;
  }

  private function Set_autorizar_solicitu($id){
    // autoriza la compra
     $respon = $this->gestion->Autorizar_compra($id);
     return $respon;
  }
  
    //inicio_trabajo
  private function Set_inicio_trabajo($id){
    $respon = $this->gestion->Set_iniciar_proceso($id);
    return $respon;
  }
  // gestiona las solicitudes segun el tecnico

  private function Canalizar_solicitud_operador($array = array()){
    $emplo = $array['slt_person'];
    $text = $array['txt_coment'];
    $id = $array['hidden_solicitud'];
    $respon = $this->gestion->Set_solicitud_canalizada_soport($id,$emplo,$text);
    return $respon;
  }

  private function Activar_contrato($id){
    include_once('../Model/Pagos.php');
    $pagos = new Pagos();
    $respon = $this->gestion->Activar_contrato($id);
    if(isset($respon['exito'])){
      $pagos->Generar_cuotas($id);
    }
    return $respon;
  }

  private function Get_informe_instalacion($id){
    if(strpos($id,"-") > 0){
          $d = explode("-", $id);
          $id = $d[1];
    }
    $respon = $this->gestion->Get_informe_servicio($id);
    $descrip = $respon['descrip'];
    if(isset($respon['foto'])){
      if(strpos($respon['foto'],",") > 0){
        $foto = $respon['foto']; 
        $data['foto'] = $foto;  
      }
    }
    
    $data['descrip'] = $descrip;
    return $data;
  }

  private function Get_contrato_sin_activar(){
    $respon = $this->gestion->Get_contratos_sin_activar();
    if(isset($respon)){
      $array = array();
      if(isset($respon[0]) and is_array($respon[0])){
        $array = $respon;
      }else{
        $array[] = $respon;
      }
    }
    return $array;
  }

  private function Get_material_solicitados($id){
    include_once('../Model/Material.php');
    $mate = new Material();
    if(strpos($id,"-") > 0){
          $d = explode("-", $id);
          $id = $d[1];
    }
    $respon = $mate->Get_solicitud_material_by_id_contrat($id);
    if(isset($respon)){
      $array = array();
      if(isset($respon[0]) and is_array($respon[0])){
        $array = $respon; 
      }else{
        $array[] = $respon;
      }
      return $array;
    }
  }

}
new GestionController();
 


  // Envia una solicitud de productos que un tecnico va a necesitar //
/*
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
  }*/

?>