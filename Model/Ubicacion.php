<?php
include_once('../Controller/conectar.php');
class Ubicacion extends Conectar{

  public function __construct(){
	  parent::__construct();
  }

  public function get_departament_pais(){
  	$sql = 'SELECT id_depart,Nomb_depart
  			FROM departament_pais';
  	$respon = parent::consultas($sql);	
	  return $respon;				
  }

  public function get_ciudad_($id){
  	$sql = 'SELECT Ciudad_id,Ciudad_nomb
  			FROM ciudad 
  			WHERE Ciudad_depart = '.$id;
  	$respon = parent::consultas($sql);	
	  return $respon;				
  }
}
?>