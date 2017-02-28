<?php
 if(file_exists('../Controller/conectar.php')){
  include_once('../Controller/conectar.php');
 }else if(file_exists('Controller/conectar.php')){
  include_once('Controller/conectar.php');
 }else if(file_exists('conectar.php')){
  include_once('conectar.php');
 }else if(file_exists('../../Controller/conectar.php')){
  include_once('../../Controller/conectar.php');
 }
 
 class Configuracion extends Conectar{
  
  public function __construct(){
    parent::__construct();
  }

  public function Add_servicio($cod,$nombre){
  	$array = array("Tipo_id"=>$cod,
  				   "Tipo_nomb"=>$nombre);
  	$respon = parent::inserta('tipo_servicio',$array);
  	return $respon;
  }

  public function Add_evento($cod,$nomb,$id_servi){
  	$array = array("Tip_eve_id"=>$cod,
  				         "Tip_eve_nomb"=>$nomb,
  				         "Tip_serv_id"=>$id_servi);
  	$respon = parent::inserta('tipo_evento',$array);
  	return $respon;
  }

  public function Get_service(){
  	$sql = 'SELECT Tipo_id,Tipo_nomb 
  			FROM tipo_servicio';
  	$data = parent::consultas($sql);
  	return $data;
  }

  public function Get_all_event(){ 
  	$sql = 'SELECT te.Tip_eve_id as id,te.Tip_eve_nomb as nomb ,ts.Tipo_nomb as tipo_nom 
			FROM tipo_evento te 
			INNER JOIN tipo_servicio ts ON te.Tip_serv_id = ts.Tipo_id';
  	$data = parent::consultas($sql);
  	return $data;
  }

  public function Set_descrip_event($id,$nomb){
    $array = Array("id"=>$id,
                 "descrip"=>utf8_encode($nomb));
    $respon = parent::inserta('Descripcion_de_evento',$array);
    return $respon;
  }

  public function Get_event_by_service($id){
    $sql = 'SELECT Tip_eve_id,Tip_eve_nomb
            FROM tipo_evento te 
            INNER JOIN tipo_servicio ts ON ts.Tipo_id = te.Tip_serv_id 
            WHERE Tipo_id = '.$id;
    $data = parent::consultas($sql);
    return $data;         
  }

  
 }
?>


