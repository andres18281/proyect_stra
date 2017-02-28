<?php
include_once('../Model/Cliente.php');
class UsuarioController{
   private $cliente = null;
  function __construct(){
  	$this->cliente = new Cliente();
  	$request = json_decode($_POST['request'],true);
  	if(isset($request['agregar_usuario'])){
  	  $respon =	$this->Agregar_usuario($request['form']);
  	  echo json_encode($respon);
  	}

  	if(isset($request['agregar_empresa'])){
  	  $respon = $this->Agregar_empresa($request['form']);
  	  echo json_encode($respon);
  	}

  	if(isset($request['agregar_documento'])){
  		include_once('../Model/Empresa.php');
   		$empresa = new Empresa();
  		$url1 = "../View/img/documentos/";
		  $nit = $_POST['nit'];
		  $foto_cedu = '';
		  $foto_rut = '';
		  $foto_camara = '';
		  if(isset($_FILES['file1'])){ // camara y comercio
		    $foto_camara = $this->Agregar_foto($_FILES['file1'],$url1);
		  }
		  if(isset($_FILES['file2'])){ //cedula
		    $foto_cedu = $this->Agregar_foto($_FILES['file2'],$url1);
		  }
		  if(isset($_FILES['file3'])){ // rut
		    $foto_rut = $this->Agregar_foto($_FILES['file3'],$url1);
		  }
		  $respon = $empresa->Set_documentos($nit,$foto_cedu,$foto_rut,$foto_camara);
  		echo json_encode($respon);
  	}

  	if(isset($request['buscar_empresa'])){
  		$nit = $request['nit'];
    	$respon = $this->Buscar_empresa($nit);
  		echo json_encode($respon);
  	}

    // obtiene documentos de una empresa
    if(isset($request['get_document'])){
      $nit = $request['nit'];
      $respon = $this->Get_documentos_empresa($nit);
      echo json_encode($respon);
    }

  	if(isset($request['buscar_cliente'])){
  		$id =  $request['id_client'];
  		$respon = $this->Buscar_cliente($id);
  		echo json_encode($respon);
  	}

  	if(isset($request['listar_factura'])){
  	  $id = $request['id_contra'];
   	  $respon = $this->Listar_factura($id);
  	  echo json_encode($respon);
    }

    if(isset($request['show_all_empresa_by_client'])){
  		$cc = $request['id'];
  		$respon = $this->show_all_empresa_by_client($cc);
  		echo json_encode($respon);
  	}
  	
  	// buscar por palabras 
  	if(isset($request['search_empresa_words'])){
    	$palabras = $request['letras'];
  		$respon = $this->Search_empresa_words($palabras);
  		echo json_encode($respon);
  	}

  	if(isset($request['buscar_cliente_por_caract'])){
   		$data = $request['caract'];
   		$respon = $this->buscar_cliente_por_caract($data);
   		echo json_encode($respon);
 	  }
  }

  private function Agregar_usuario($array = array()){
  	$id = $array['id'];
  	$nomb = $array['nomb'];
  	$apell = $array['apelli'];
  	$sex = $array['sex'];
  	$ext = $array['ext'];
  	$dir = $array['direc'];
  	$ciud = $array['ciud'];
  	$tele = $array['tele'];
  	$fax = $array['fax'];
  	$email = $array['email'];
  	$tipo = $array['tipo'];	
  	$respon = $this->cliente->set_datos($id,$nomb,$apell,$sex,$tele,$ext,$dir,$ciud,$fax,$email,$tipo);
    return $respon;
  }

  private function Agregar_empresa($array = array()){
  	include_once('../Model/Empresa.php');
  	$empresa = new Empresa();		
  	$nit = $array['nit'];
  	$nombre = $array['razon'];
  	$tele = $array['tel'];
 	  $direc = $array['direc'];
  	$ciudad = $array['ciud'];
  	$id = $array['id_nit'];
  	$respon = $empresa->Set_empresa($nit,$nombre,$tele,$direc,$ciudad,$id);
  	return $respon;
  }

  private function Buscar_empresa($nit){
  	include_once('../Model/Empresa.php');
    $empresa = new Empresa();
    $respon = $empresa->Get_empresa($nit);
    if(isset($respon)){ 
    	$array = array("nomb"=>utf8_encode($respon['Empres_nomb']),"tel"=>$respon['Empres_tel'],"dir"=>$respon['Empres_dir'],"tel"=>$respon['Empres_ciud']);
     	return $array;
    }
  }

  private function Get_documentos_empresa($nit){
    include_once('../Model/Empresa.php');
    $empresa = new Empresa();
    $respon = $empresa->Get_documentos($nit);
    return $respon;
  }

  private function Agregar_foto($files,$url){
    if(isset($files)){
      if(count($files['name']) > 1){
        $separator_img = '';
      	foreach($files as $file){
        	$ext = end(explode(".",$file['name']));
        	if(strlen($file['name']) > 50){
          	   $nomb_img = date('his')."_".substr($file['name'], 0,40).".".$ext;
        	}else{
          	   $nomb_img = date('his')."_".$file['name'];
        	}
        	if(move_uploaded_file($file['tmp_name'], $url.$nomb_img)){
          		$separator_img .= $nomb_img."||";
        	} 
      	}
      }else if(count($files['name']) == 1){ 
      	$ext = end(explode(".",$files['name'][0]));
      	if(strlen($files['name'][0]) > 50){
          $nomb_img = str_replace(" ", "", $files['name'][0]);
          $nomb_img = date('his')."_".substr($nomb_img, 0,40).".".$ext;
      	}else{
          $nomb_img = str_replace(" ", "", $files['name'][0]);
        	$nomb_img = date('his')."_".$nomb_img;
      	}
      	if(move_uploaded_file($files['tmp_name'][0], $url.$nomb_img)){
        	$separator_img = $nomb_img;
      	}
      }
      return $separator_img;
  	}
  }


  private function Buscar_cliente($cc){
    $data = $this->cliente->Get_empresas($cc);
    $array = array();
    if(isset($data)){
      if(isset($data[0]) and is_array($data[0])){
        foreach($data as $val){
          array_push($array, array("nit"=>$val['Empres_nit'],"nomb"=>$val['Empres_nomb'],"tel"=>$val['Empres_tel'],"dir"=>$val['Empres_dir']));
        }
      }else{
         $array[] = array("nit"=>$data['Empres_nit'],"nomb"=>$data['Empres_nomb'],"tel"=>$data['Empres_tel'],"dir"=>$data['Empres_dir']);
      }
      return $array;
    }
  }

   
  private function Listar_factura($id){
  	include_once('../Model/Empresa.php');  
  	$empresa = new Empresa();
  	$data = $empresa->Get_facturas($id);
  	return $data;
  }


  private function show_all_empresa_by_client($cc){
  	$data = $this->cliente->Get_empresas($cc);
   	if(isset($data)){
      $array = array();
      if(isset($data[0]) and is_array($data[0])){
        foreach($data as $val){
          array_push($array,array("nit"=>$val['Empres_nit'],"nomb"=>utf8_encode($val['Empres_nomb']),"tel"=>$val['Empres_tel'],"dir"=>$val['Empres_dir'],"ciud"=>$val['Empres_ciud']));
        } 
      }else{
        $array[] = array("nit"=>$data['Empres_nit'],"nomb"=>utf8_encode($data['Empres_nomb']),"tel"=>$data['Empres_tel'],"dir"=>$data['Empres_dir'],"ciud"=>$data['Empres_ciud']);
      }
      return $array;
   	}
  }

  
  private function Search_empresa_words($palabras){
  	include_once('../Model/Empresa.php');
    $empresa = new Empresa();
    $respon = $empresa->Get_search_words_empresa($palabras);
    if(isset($respon)){
      $array = array();
      if(isset($respon[0]) and is_array($respon[0])){
        foreach($respon as $val){ 
          array_push($array, array("nit"=>$val['Empres_nit'],"nomb"=>utf8_encode($val['Empres_nomb']),"tel"=>$val['Empres_tel']));
        }
      }else{
        $array[] = array("nit"=>$respon['Empres_nit'],"nomb"=>utf8_encode($respon['Empres_nomb']),"tel"=>$respon['Empres_tel']);
      }
      return $array;
    }
  }

  private function buscar_cliente_por_caract($caract){
    $respon = $this->cliente->Get_clientes_by_descrip($caract);
    if(isset($respon)){
     $array = array(); 
     if(isset($respon[0]) and  is_array($respon[0])){
       foreach($respon as $val){
         array_push($array, array("id"=>$val['Client_id'],"nomb"=>utf8_encode($val['Client_nom']),"apell"=>utf8_encode($val['Client_apell'])));
       }
     }else{
       $array[] = array("id"=>$respon['Client_id'],"nomb"=>utf8_encode($respon['Client_nom']),"apell"=>utf8_encode($respon['Client_apell']));
     }
     return $array;
    }
  } 
}
new UsuarioController();
 

  

  
/*
 if(isset($_POST['listar_contratos'])){
   include_once('../Model/Empresa.php');
   $empresa = new Empresa();
   $nit = $_POST['id_empre']; 
   $data = $empresa->Get_contratos($nit);
   echo json_encode($data);
 }
 */

 

 
?>
