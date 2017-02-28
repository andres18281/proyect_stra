<?php
include_once('../Controller/conectar.php');
class Modulos extends Conectar{
  public function __construct(){
  	parent::__construct();
  }

  public function Add_modulo(){

  }

  public function Agregar_modulo_empleado($id_modulo,$item,$id_emplo){
  	$array = array("modu_name"=>$id_modulo,
  				   "modu_item"=>$item,
  				   "modu_id_emplo"=>$id_emplo);
  	return parent::inserta('stra_modulo',$array);
  }

  public function Get_modulo_by_empleado($id){
  	$sql = 'SELECT modu_name,modu_item
  			FROM stra_modulo
  			WHERE modu_id_emplo = '.$id;
  	return parent::consultas($sql);
  }
}



?>