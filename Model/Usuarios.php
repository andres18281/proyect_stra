<?php
 if(file_exists('Controller/conectar.php')){
 	include_once('Controller/conectar.php');
 }else if(file_exists('conectar.php')){
 	include_once('conectar.php');
 }
 Class Usuarios extends Conectar{

 	private $id;
 	private $tipo;
    public function __construct(){
		  parent::__construct();
    }

    public function Validar_usuario($user,$pass){
      $sql = 'SELECT str_tipe,str_id_user
      		  FROM str_user_coun 
      		  WHERE str_id_user = '.$user.'
      		  AND str_pass = "'.$pass.'"';
      $respon = parent::consultas($sql);
      if(isset($respon)){
      	$this->id = $respon['str_id_user'];
      	$this->tipo = $respon['str_tipe'];
      }
      return $respon;
    }

    public function Tipo_user(){
    	return $this->tipo;
    }

    public function Tipo_usuario($id){
      	$sql = 'SELECT emple_id,emple_nomb,emple_email,emple_tipo,Carg_depart,emple_foto,Cod_depart
      			FROM empleados em
      			INNER JOIN cargo_stra cs ON cs.Carg_id = em.emple_carg 
            INNER JOIN departament dep ON dep.id_depart = cs.Carg_depart
      			WHERE em.emple_id ='.$id;
      	$respon = parent::consultas($sql);
        return $respon;
    }

    public function Get_cliente($id_client){
      $sql = 'SELECT  Client_id as id,CONVERT(CONCAT(Client_nom," ",Client_apell) USING utf8) as nomb,Client_tipo as tipo,Client_email as mail
              FROM clientes_stra 
              WHERE Client_id = '.$id_client;
      $respon = parent::consultas($sql);
      return $respon;
    }
 }

?>