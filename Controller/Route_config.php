<?php
 if(isset($_POST['nomb_servi'],$_POST['cod_serv'])){
 	include_once "../Model/Configuracion_ticket.php";
 	$confi = new Configuracion();
 	$nomb = $_POST['nomb_servi'];
 	$cod = $_POST['cod_serv'];
 	$respon = $confi->Add_servicio($cod,$nomb);
 	echo json_encode($respon);
 }

 if(isset($_POST['cod_servi'],$_POST['id_servi_'],$_POST['nomb_servi'])){
 	include_once "../Model/Configuracion_ticket.php";
 	$confi = new Configuracion();
 	$cod = $_POST['cod_servi']; 
 	$id_servi = $_POST['id_servi_'];
 	$nomb = $_POST['nomb_servi'];
 	$respon = $confi->Add_evento($cod,$nomb,$id_servi);
 	if(isset($respon['exito']) and isset($_POST['descrip']) and !empty($_POST['descrip'])){
      $confi->Set_descrip_event($cod,$_POST['descrip']);
 	}
 	echo json_encode($respon);
 }

 if(isset($_POST['all_service'])){
 	include_once "../Model/Configuracion_ticket.php";
 	$confi = new Configuracion();
 	$data = $confi->Get_service();
 	if(isset($data)){
 	 $arr = array();
 	 if(isset($data[0]) and is_array($data[0])){
 	  foreach($data as $val){ 
 	  	array_push($arr,array("id"=>$val['Tipo_id'],"nomb"=>utf8_encode($val['Tipo_nomb'])));
 	  }
 	 }else{
 	 	$arr[] = array("id"=>$data['Tipo_id'],"nomb"=>utf8_encode($data['Tipo_nomb']));
 	 }
 	 echo json_encode($arr);
 	}
 }
 // lista todos los eventos creados
 if(isset($_POST['list_all_event'])){
  include_once "../Model/Configuracion_ticket.php";
 	$confi = new Configuracion();
 	$respon = $confi->Get_all_event();
 	if(isset($respon)){
 	  $array = array();
 	  if(isset($respon[0]) and  is_array($respon[0])){    
 	   foreach($respon as $val){
 	   	 array_push($array, array("id"=>$val['id'],"ser"=>$val['nomb'],"nomb"=>$val['tipo_nom']));
 	   }	
 	  }else{
 	  	$array[] = Array("id"=>$respon['id'],"ser"=>$respon['nomb'],"nomb"=>$respon['tipo_nom']);
 	  }
 	  echo json_encode($array);
 	}
 }

 if(isset($_POST['id_servi'])){
 	$id = $_POST['id_servi'];
 	include_once "../Model/Configuracion_ticket.php";
 	$confi = new Configuracion();
 	$respon = $confi->Get_event_by_service($id);
 	if(isset($respon)){
 	  $array = array();
 	  if(isset($respon[0]) and is_array($respon[0])){
 	  	foreach($respon as $val){
 	  	  array_push($array,array("id"=>$val['Tip_eve_id'],"name"=>utf8_encode($val['Tip_eve_nomb'])));
 	  	}
 	  }else{
 	  	$array[] = array("id"=>$respon['Tip_eve_id'],"name"=>utf8_encode($respon['Tip_eve_nomb']));
 	  }
 	  echo json_encode($array);	
 	}	
 }

 // agregar departamentos
 if(isset($_POST['departament'])){
 	$nomb = $_POST['departament'];
 	include_once "../Model/Configuracion_empresa.php";
 	$confi = new Configuracion_empresa();
 	$respon = $confi->Add_departamento($nomb);
 	echo json_encode($respon);
 }

 // mostrar todos los departamentos
 if(isset($_POST['get_departament'])){
 	include_once "../Model/Configuracion_empresa.php";
 	$confi = new Configuracion_empresa();
 	$data = $confi->Get_departamento();
 	if(isset($data)){
 	  $arra = array();
 	  if(isset($data[0]) and is_array($data[0])){ 
 	  	foreach($data as $val){
 	  	 array_push($arra,array("id"=>$val['Id_depart'],"nomb"=>utf8_encode($val['Depart_nomb'])));
 	  	}
 	  }else{
 	  	$arra[] = array("id"=>$data['Id_depart'],"nomb"=>utf8_encode($data['Depart_nomb']));
 	  }
 	  echo json_encode($arra);
 	}
 }

 if(isset($_POST['get_departament_pais'])){
 	include_once "../Model/Ubicacion.php";
 	$ubica = new Ubicacion();
 	$respon = $ubica->get_departament_pais();
 	if(isset($respon)){
 	  $array_depart = array();
 	  if(isset($respon[0]) and is_array($respon[0])){ 
 	  	foreach($respon as $val){
 	  	 array_push($array_depart,array("id"=>$val['id_depart'],"depart"=>utf8_encode($val['Nomb_depart'])));
 	  	}
 	  }else{
 	  	$array_depart[] = array("id"=>$respon['id_depart'],"depart"=>utf8_encode($respon['Nomb_depart']));
 	  }
 	  //var_dump($array_depart);
 	  echo json_encode($array_depart);
 	}
 }

if(isset($_POST['get_ciudad_'])){
 	include_once "../Model/Ubicacion.php";
  $ubica = new Ubicacion();
  $id = $_POST['get_ciudad_'];
 	$respon = $ubica->get_ciudad_($id);
 	if(isset($respon)){
 	  $arra = array();
 	  if(isset($respon[0]) and is_array($respon[0])){
 	  	foreach($respon as $val){ 
 	  	 array_push($arra,array("id"=>$val['Ciudad_id'],"ciudad"=>utf8_encode($val['Ciudad_nomb'])));
 	  	}
 	  }else{
 	  	$arra[] = array("id"=>$respon['Ciudad_id'],"ciudad"=>utf8_encode($respon['Ciudad_nomb']));
 	  }
 	  echo json_encode($arra);
 	}
}

 // añade nuevos cargos 
 if(isset($_POST['nombre_cargo'],$_POST['departament_'],$_POST['tipo'])){
 	include_once "../Model/Configuracion_empresa.php";
 	$confi = new Configuracion_empresa();
 	$cargo = utf8_encode($_POST['nombre_cargo']);
 	$depart = $_POST['departament_'];
 	$tipo = $_POST['tipo'];
 	$respon = $confi->Add_cargos($cargo,$depart,$tipo);
 	echo json_encode($respon);
 }

 // enlista todos los departamentos
 if(isset($_POST['id_departament'])){
 	include_once "../Model/Configuracion_empresa.php";
 	$id = $_POST['id_departament'];
 	$confi = new Configuracion_empresa();
 	$data = $confi->Get_cargos_by_departament($id);
 	if(isset($data)){
 	  $array = array();
 	  if(isset($data[0]) and is_array($data[0])){ 
 	  	foreach($data as $val){ 
 	  	  array_push($array, array("id"=>$val['Carg_id'],"nomb"=>$val['Carg_nomb']));
 	  	}
 	  }else{
 	  	$array[] = array("id"=>$data['Carg_id'],"nomb"=>$data['Carg_nomb']); 
 	  }
 	  echo json_encode($array);	
 	}
 }

 if(isset($_POST['user_depart'])){
   $area = $_POST['user_depart'];
  include_once "../Model/Empleado.php"; 
  $emplo = new Empleado();
  $respon = $emplo->Get_all_employed_by_area($area);
  if(isset($respon)){
    $array = array();
    if(isset($respon[0]) and is_array($respon[0])){
      foreach($respon as $val){  
        array_push($array,array("id"=>$val['emple_id'],"nombre"=>utf8_encode($val['emple'])));
      }
    }else{
      $array[] = array("id"=>$respon['emple_id'],"nombre"=>utf8_encode($respon['emple']));
    } 
    echo json_encode($array);
  }
 }

 if(isset($_POST['Area_delete_id'])){ 
  $id = $_POST['Area_delete_id'];
  include_once "../Model/Configuracion_empresa.php"; 
  $config = new Configuracion_empresa();
  $respon = $config->Delete_Departamento($id);
  echo json_encode($respon);
 }
 
 if(isset($_POST['cedu'],$_POST['nomb'],$_POST['apell'],$_POST['tel'],$_POST['cel'],$_POST['depar'],$_POST['ciud'],$_POST['barrio'],$_POST['dire'],$_POST['email'],$_POST['area'],$_POST['carg'],
 	$_POST['tipo_emp'])){
 	include_once "../Model/Empleado.php";
 	$emplea = new Empleado();
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
    if(move_uploaded_file($_FILES['file']['tmp_name'],"../View/img/employed/".$nombre_img)){
    	echo "enviado";
    }else{
    	echo "no enviado";
    }   
 	}else{
 	  $nombre_img = null;	
 	}
 	$ced = $_POST['cedu'];
 	$nomb = $_POST['nomb'];
 	$apell = $_POST['apell'];
 	$tel = $_POST['tel'];
 	$cel = $_POST['cel'];
 	$ciud = $_POST['ciud'];
 	$barr = $_POST['barrio'];
 	$dir = $_POST['dire'];
 	$emai = $_POST['email'];
 	$carg = $_POST['carg'];
 	$tip = $_POST['tipo_emp'];
 	$respon = $emplea->Add_employed($ced,$nomb,$apell,$tel,$cel,$ciud,$barr,$dir,$emai,$carg,$tip,$nombre_img);
 	echo json_encode($respon);
 }
 
 // enlista todos los empleados
 if(isset($_POST['all_employed'])){
  include_once "../Model/Empleado.php";
  $emp = new Empleado();
  $respon = $emp->Get_all_employed();
  if(isset($respon)){
    $array = array();
    if(isset($respon[0]) and is_array($respon[0])){
      foreach($respon as $val){ 
        array_push($array, array("id"=>$val['emple_id'],"nomb"=>utf8_encode($val['emple']),"carg"=>utf8_encode($val['Carg_nomb']),"email"=>$val['emple_email'],"img"=>$val['emple_foto']));
      }
    }else{
      $array[] = array("id"=>$respon['emple_id'],"nomb"=>$respon['emple'],"carg"=>$respon['Carg_nomb'],"email"=>$respon['emple_email'],"img"=>$respon['emple_foto']);
    }
    echo json_encode($array);
  }
 }
?>