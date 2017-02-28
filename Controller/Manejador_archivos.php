<?php

 class Manejador_archivos{

 	public function __construct(){

 	}

 	public function Add_file($_FILES,$url,$nit){
 	  if(isset($_FILES)){
      $nit_name = substr($nit, 0,5);
      $cont_caract = strlen($files['name']);
      $ext = $_FILES['type'];
      $tipo = str_replace('image/', "", $ext);
      if($cont_caract > 20){
       	$nomb = substr($files['name'], 0,20);
      }else{
       	$nomb = $files['name'];  
      }
      $nombre_img = time().$nit_name."_".$nomb.".".$tipo;
      if(move_uploaded_file($files['tmp_name'], $url.$nombre_img)){
      	 return $nombre_img;   	 
      }else{
      	 return null;
      }      
    }
 	}

 	public function Delete_file($url,$file){
 		chmod('"'.$url."/".$file.'"',777);
 		return unlink($url."/".$file);
 	}
 }

?>