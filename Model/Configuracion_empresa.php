<?php
 if(file_exists('../Controller/conectar.php')){
  include_once('../Controller/conectar.php');
 }else if(file_exists('Controller/conectar.php')){
 	include_once('Controller/conectar.php');
 }else if(file_exists('conectar.php')){
 	include_once('conectar.php');
 }
 
 class Configuracion_empresa  extends Conectar{

   public function __construct(){
     parent::__construct();
   }

   // añade departamento de la empresa
   public function Add_departamento($nomb){
   	 $array = Array("Depart_nomb"=>utf8_encode($nomb));
   	 $respon = parent::inserta('departament',$array);
  	 return $respon;
   }
   
   public function Get_departamento(){
   	 $sql = 'SELECT Id_depart,Depart_nomb
   	 		 FROM departament';
   	 $data = parent::consultas($sql);
   	 return $data;
   }

   public function Get_cargos_by_departament($id){
     $sql = 'SELECT Carg_id,Carg_nomb 
             FROM cargo_stra
             WHERE Carg_depart = '.$id;
     $data = parent::consultas($sql);
     return $data;        
   }

   // Agrega cargo
   public function Add_cargos($name,$depart,$tipo){
     $array = array("Carg_nomb"=>$name,
                    "Carg_depart"=>$depart,
                    "Cargo_tipo"=>$tipo);
     $respon = parent::inserta('cargo_stra',$array);
     return $respon;
   }

   public function Delete_Departamento($id){
     $sql = 'DELETE 
             FROM departament 
             WHERE Id_depart = '.$id;
     $respon = parent::update_query($sql);
     return $respon;
   }
 }

?>