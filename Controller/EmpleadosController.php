<?php
include_once "../Model/Empleado.php";
class EmpleadosController{
	private $employed = null;
	function __construct(){
   	  $this->employed = new Empleado();
   	  //$request = json_decode($_POST['request'],true);
   	  if($_POST["accion"] == "create_employed"){
   	  	$form = json_decode($_POST['formu'],true);
   	    $respon = $this->Agregar_employed($form);
   	  	echo json_encode($respon);
   	  }
	}

	private function Agregar_employed($array = array()){
		if(isset($_FILES['file'])){
 	  	  $name = $_FILES['file']['name'];
 	  	  $cont_caract = strlen($name);
    	  $ext = $_FILES['file']['type'];
    	  $tipo = str_replace('image/', "", $ext);
    	  if($cont_caract > 35){
      		$nomb = substr($_FILES['file']['name'], 0,30);
    	  }else{
      		$nomb = $_FILES['file']['name'];  
    	  }
    	  $nombre_img = time().$nomb.".".$tipo;
    	  move_uploaded_file($_FILES['file']['tmp_name'],"../View/img/employed/".$nombre_img);  
 		}else{
 	  	  $nombre_img = null;	
 		}
 		$respon = $this->employed->Add_employed($array['cedu'],$array['nomb'],$array['apell'],$array['tel'],$array['cel'],$array['ciud'],$array['barrio'],$array['dire'],$array['email'],$array['carg'],$array['tipo_emp'],$nombre_img);
 		return $respon;
	}
}
new EmpleadosController();


?>