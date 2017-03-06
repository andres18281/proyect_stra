<?php
 if(file_exists('Controller/conectar.php')){
  include_once('Controller/conectar.php');
 }else if(file_exists('conectar.php')){
  include_once('conectar.php');
 }else if(file_exists('../Controller/conectar.php')){
  include_once('../Controller/conectar.php');
 }else if(file_exists('../../Controller/conectar.php')){
  include_once('../../Controller/conectar.php');
 }else{
   include_once $_SERVER['DOCUMENT_ROOT']."/proyect_stra/Controller/conectar.php";
 }
class Empleado extends Conectar{
  
  public function __construct(){
  	parent::__construct();
  }


  public function Add_employed($ced,$nomb,$apell,$tel,$cel,$ciud,$barr,$dir,$emai,$carg,$tip,$foto){
  	$array = array("emple_id"=>$ced,
  				  "emple_nomb"=>$nomb,
  				  "emple_apell"=>$apell,
  				  "emple_tel"=>$tel,
  				  "emple_cel"=>$cel,
  				  "emple_dir"=>$dir,
  				  "emple_email"=>$emai,
  				  "emple_ciudad"=>$ciud,
  				  "emple_carg"=>$carg,
  				  "emple_tipo"=>$tip,
  				  "emple_activo"=>1,
  				  "emple_foto"=>$foto);
    $data = parent::inserta('empleados',$array);
    if(isset($data)){
      $array = array("str_id_user"=>$ced,
                     "str_pass"=>sha1("stratecsa2016"),
                     "str_tipe"=>1);
      parent::inserta('str_user_coun',$array);
    }
  	return $data;
  }

  public function Get_all_employed_by_area($area){
    $sql = 'SELECT emple_id,CONCAT(emple_nomb," ",emple_apell," ( ",Carg_nomb," ) ") as emple
            FROM empleados emp 
            INNER JOIN cargo_stra carg ON carg.Carg_id = emp.emple_carg 
            WHERE carg.Carg_depart = '.$area; 
    $respon = parent::consultas($sql);
    return $respon;
  }

  public function Get_all_employed_by_depart($area){ 
    $sql = 'SELECT emple_id,CONCAT(emple_nomb," ",emple_apell) as emple,Carg_nomb,emple_email,emple_foto
            FROM empleados emp 
            INNER JOIN cargo_stra carg ON carg.Carg_id = emp.emple_carg 
            WHERE Carg_depart = '.$area; 
    $respon = parent::consultas($sql);
    return $respon;
  }

  public function Get_all_employed(){
    $sql = 'SELECT emple_id,CONCAT(emple_nomb," ",emple_apell) as emple,Carg_nomb,emple_email,emple_foto
            FROM empleados emp 
            INNER JOIN cargo_stra carg ON carg.Carg_id = emp.emple_carg';
    $respon = parent::consultas($sql);
    return $respon;
  }

  public function Get_one_employed_by_area($area){
    $sql = 'SELECT emple_id as id
            FROM empleados 
            WHERE emple_carg = '.$area.'
            LIMIT 1';
    $respon = parent::consultas($sql);
    return $respon;
  }

  public function Get_departament_from_employed($id){
    $sql = 'SELECT CONVERT(cs.Carg_depart USING utf8) as cargo
            FROM empleados emple 
            INNER JOIN cargo_stra cs ON cs.Carg_id = emple.emple_carg
            WHERE emple_id = '.$id;
    $respon = parent::consultas($sql);
    return $respon;
  }
}
?>