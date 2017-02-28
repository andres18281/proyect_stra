<?php
include_once('../Model/Imagenes.php');
include_once('../Model/Gestion.php');
if(isset($_FILES['img'],$_POST['coment'],$_POST['id'],$_POST['id_contrat'])){
  $coment = $_POST['coment'];
  $id_contrat = $_POST['id_contrat'];
  $id = $_POST['id'];
  $cant = count($_FILES['img']['name']);
  $imagen = new Imagenes();
  $gestion = new Gestion();
  $error['coment'] = $imagen->Add_comentario(utf8_encode($coment),$id);
  $gestion->Gestion_terminada($id,$id_contrat); 
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
 
  echo json_encode($error);
}else{
  echo "no entra";
}