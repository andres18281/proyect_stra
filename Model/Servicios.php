
<?php
include_once $_SERVER['DOCUMENT_ROOT']."stratecsa/Controller/conectar.php";

class Servicios extends Conectar {
 
  public function __construct(){

  }
  //--------------------------------------------
  // Enlista todos los servicios principales segun la clasificacion
  //--------------------------------------------
  public function Get_listado_servicio(){
  	$sql = 'SELECT Tipo_id,	Tipo_nomb
  			FROM tipo_servicio';
  	$response = parent::consultas($sql);
  	return $response;
  }

  //-----------------------------------------------------
  // Enlista todos los servicios prestados segun el tipo de servicio tipo skus
  //-----------------------------------------------------
  public function Get_servicios_by_tipo($tipo){
  	$sql = 'SELECT Servi_id, Servi_id_tip, Servi_nomb,Servi_cost,Servi_tiem
  			FROM servicios_prestado 
  			WHERE Servi_id_tip = '.$tipo;
  	$response = parent::consultas($sql);
  	return $response;
  }

  //----------------------------------------------------
  // Enlista todos los servicios prestados
  //----------------------------------------------------

  public function Get_all_servicios_secundario(){
  	$sql = 'SELECT 	Servi_id,Servi_id_tip,Servi_nomb,Servi_cost,Servi_tiem
  			FROM servicios_prestado';
  	$response = parent::consultas($sql);
  	return $response;
  }

  //---------------------------------------------------
  // Inserta servicios principales que se agregaran en mysql
  //--------------------------------------------------

  public function  Set_servicio_principal($servicio){
  	$array = Array('Tipo_nomb'=>$servicio);
  	$response = parent::inserta('tipo_servicio',$array);
  	return $response;
  }

  // -------------------------------------------------
  // Inserta nuevos servicios que agregara a la base de datos
  //-------------------------------------------------
  
  public function Set_servicios_secundario($id_tipo,$nomb,$cost,$tiemp){
  	$array = Array("Servi_id_tip"=>$id_tipo,
  				   "Servi_nomb"=>$nomb,
  				   "Servi_cost"=>$cost,
  				   "Servi_tiem"=>$tiemp);
  	$response = parent::inserta('servicios_prestado',$array);
  	return $response;
  }

  // actualizar precio de servicio
  public function Update_precio($price,$id_servi){
  	$upda = 'UPDATE servicios_prestado 
  			 SET Servi_cost = '.$price.'
  			 WHERE Servi_id = '.$id_servi;
    $response = parent::update_query($upda);
    return $response;
  }

}

?>