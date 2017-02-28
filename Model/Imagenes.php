<?php
include_once('../Controller/conectar.php');
class Imagenes extends Conectar{

  public function __construct(){
  	parent::__construct();
  }

  public function Add_imagenes_servi_tecnico($img,$id){
  	$array = array("Foto_url"=>$img,
  				         "Foto_id_servi"=>$id);
  	$response = parent::inserta('foto_servi_tecn',$array);
    return $response;
  }

  public function Add_comentario($coment,$id){
  	$array = array("Coment_id"=>$id,
  				         "Coment_tipo"=>2,
  				         "Coment_text"=>$coment);
  	$response = parent::inserta('comentarios',$array);
    return $response;
  }
}

?>