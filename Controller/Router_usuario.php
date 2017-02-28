<?php

 
 if(isset($_POST['agregar_usuario'])){
  include_once('../Model/Cliente.php');
  $cliente = new Cliente();
  $id = $_POST['id'];
  $nomb = $_POST['nomb'];
  $apell = $_POST['apelli'];
  $sex = $_POST['sex'];
  $ext = $_POST['ext'];
  $dir = $_POST['direc'];
  $ciud = $_POST['ciud'];
  $tele = $_POST['tele'];
  $fax = $_POST['fax'];
  $email = $_POST['email'];
  $tipo = $_POST['tipo'];
  $respon = $cliente->set_datos($id,$nomb,$apell,$sex,$tele,$ext,$dir,$ciud,$fax,$email,$tipo);
  echo json_encode($respon);
 }


 if(isset($_POST['agregar_empresa'])){
  include_once('../Model/Empresa.php');
  $empresa = new Empresa();
  $nit = $_POST['nit'];
  $nombre = $_POST['razon'];
  $tele = $_POST['tel'];
  $direc = $_POST['direc'];
  $ciudad = $_POST['ciud'];
   $id = $_POST['id'];
  $respon = $empresa->Set_empresa($nit,$nombre,$tele,$direc,$ciudad,$id);
  echo json_encode($respon);
 }



 if(isset($_POST['agregar_documento'])){
   include_once('../Model/Empresa.php');
   $nit = $_POST['nit'];
   $empresa = new Empresa();
   if(isset($_FILES['file1'])){
     $url = "../View/img/cedula/";
     $img_cedu = $this->Agregar_foto($_FILES['file1'],$nit,$url);
   }
  
   if(isset($_FILES['file2'])){
     $url = "../View/img/rut/";
     $img_rut = $this->Agregar_foto($_FILES['file2'],$nit,$url);
   }

   if(isset($_FILES['file3'])){
     $url = "../View/img/camara_comercio/";
     $img_cama = $this->Agregar_foto($_FILES['file3'],$nit,$url);
   }
   $respon = $empresa->Set_documentos($nit,$img_cedu,$img_rut,$img_cama);
   echo json_encode($respon);
 }

 // verificar si es util o no si esta usando este metodo
 if(isset($_POST['buscar_cliente'])){
   include_once('../Model/Cliente.php');
   $cliente = new Cliente();
   if(isset($_POST['id_client'])){
      $cc = $_POST['id_client'];
    $data = $cliente->Get_empresas($cc);
    $array = array();
      if(isset($data)){
        if(isset($data[0]) and is_array($data[0])){
          foreach($data as $val){
            array_push($array, array("nit"=>$val['Empres_nit'],"nomb"=>$val['Empres_nomb'],"tel"=>$val['Empres_tel'],"dir"=>$val['Empres_dir']));
          }
        }else{
          $array[] = array("nit"=>$data['Empres_nit'],"nomb"=>$data['Empres_nomb'],"tel"=>$data['Empres_tel'],"dir"=>$data['Empres_dir']);
        }
        echo json_encode($array);
      }
   }
 }

 if(isset($_POST['show_all_empresa_by_client'])){
   include_once('../Model/Cliente.php');
   $cliente = new Cliente();
   $cc = $_POST['show_all_empresa_by_client'];
   $data = $cliente->Get_empresas($cc);
   if(isset($data)){
      $array = array();
      if(isset($data[0]) and is_array($data[0])){
        foreach($data as $val){
          array_push($array,array("nit"=>$val['Empres_nit'],"nomb"=>utf8_encode($val['Empres_nomb']),"tel"=>$val['Empres_tel'],"dir"=>$val['Empres_dir'],"ciud"=>$val['Empres_ciud']));
        } 
      }else{
        $array[] = array("nit"=>$data['Empres_nit'],"nomb"=>utf8_encode($data['Empres_nomb']),"tel"=>$data['Empres_tel'],"dir"=>$data['Empres_dir'],"ciud"=>$data['Empres_ciud']);
      }
      echo json_encode($array);
   }
 }

  if(isset($_POST['buscar_empresa'],$_POST['nit'])){
    $nit = $_POST['nit'];
    include_once('../Model/Empresa.php');
    $empresa = new Empresa();
    $respon = $empresa->Get_empresa($nit);
    if(isset($respon)){ 
     $array = array("nomb"=>utf8_encode($respon['Empres_nomb']),"tel"=>$respon['Empres_tel'],"dir"=>$respon['Empres_dir'],"tel"=>$respon['Empres_ciud']);
     echo json_encode($array);
    }
  }

  // buscar por palabras 
  if(isset($_POST['search_empresa_words'])){
    $palabras = $_POST['search_empresa_words'];
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
      echo json_encode($array);
    }
  }
/*
 if(isset($_POST['listar_contratos'])){
   include_once('../Model/Empresa.php');
   $empresa = new Empresa();
   $nit = $_POST['id_empre']; 
   $data = $empresa->Get_contratos($nit);
   echo json_encode($data);
 }
 */

 if(isset($_POST['listar_factura'])){
   include_once('../Model/Empresa.php');  
   $id_cont = $_POST['id_contra'];
   $empresa = new Empresa();
   $data = $empresa->Get_facturas($id_cont);
   echo json_encode($data);
 }

 if(isset($_POST['buscar_cliente_por_caract'])){
   $data = $_POST['buscar_cliente_por_caract'];
   include_once('../Model/Cliente.php');
   $cliente = new Cliente(); 
   $respon = $cliente->Get_clientes_by_descrip($data);
   if(isset($respon)){
    $array = array(); 
     if(isset($respon[0]) and  is_array($respon[0])){
       foreach($respon as $val){
         array_push($array, array("id"=>$val['Client_id'],"nomb"=>utf8_encode($val['Client_nom']),"apell"=>utf8_encode($val['Client_apell'])));
       }
     }else{
       $array[] = array("id"=>$respon['Client_id'],"nomb"=>utf8_encode($respon['Client_nom']),"apell"=>utf8_encode($respon['Client_apell']));
     }
     echo json_encode($array);
   }
 }
?>