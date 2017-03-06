<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
if(file_exists("../Model/Usuarios.php")){
	include_once('../Model/Usuarios.php');	
}else if(file_exists("Model/Usuarios.php")){
	include_once('Model/Usuarios.php');
}
if(file_exists("constante.php")){
  include_once "constante.php";		
}else if(file_exists("Controller/constante.php")){
  include_once "Controller/constante.php";	
}
  class Login{
      public $user;
      public $pass;
      public function __construct($user,$pass){
        $this->user = $user;
        $this->pass = $pass;
      }
      public function loguearse(){
        $user = new Usuarios(); 
        $tipo_usuario = $user->Validar_usuario($this->user,$this->pass);
        if(isset($tipo_usuario)){
         if(isset($tipo_usuario[0]['str_tipe']) and $tipo_usuario[0]['str_tipe'] == "Empleado"){
          	$info_emple = $user->Tipo_usuario($tipo_usuario[0]['str_id_user']);
            $_SESSION['tipo_user_'] = sha1(empleados_stra);
            $_SESSION['id_user'] = $info_emple[0]['emple_id'];
      		  $_SESSION['user_nomb'] = $info_emple[0]['emple_nomb'];
      		  $_SESSION['user_email'] = $info_emple[0]['emple_email'];
      		  $_SESSION['user_tipo'] = $info_emple[0]['emple_tipo']; // si es jefe
      		  $_SESSION['user_carg'] = $info_emple[0]['Carg_depart']; // departamento del empleado
            $_SESSION['user_foto'] = $info_emple[0]['emple_foto'];
            $_SESSION['user_depart_user'] = $info_emple[0]['Cod_depart'];
           return true;
         }else if(isset($tipo_usuario[0]['str_tipe']) and $tipo_usuario[0]['str_tipe'] == 'Cliente'){
           $info_emple = $user->Get_cliente($tipo_usuario[0]['str_id_user']);
           $nit = $user->Get_empresa_by_user($tipo_usuario[0]['str_id_user']); 
           $_SESSION['tipo_user_'] = sha1(clientes_stra);
           $_SESSION['id_user'] = $tipo_usuario[0]['str_id_user'];
           $_SESSION['nit'] = $nit[0]['nit'];
           $_SESSION['user_nomb'] = $info_emple[0]['emple_nomb'];
           $_SESSION['user_email'] = $info_emple[0]['emple_email'];
           $_SESSION['user_tipo'] = $info_emple[0]['emple_tipo']; // si es jefe
           return true;
         }
        }else{
          return false;
        }
      }
  }
?>

		