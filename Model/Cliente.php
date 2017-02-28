<?php
if(file_exists("../Controller/conectar.php")){
 include_once('../Controller/conectar.php');    
}else if(file_exists("Controller/conectar.php")){
  include_once('Controller/conectar.php');   
}

class Cliente extends Conectar{
	public $id;
	public $nombre;
	public $direccion;
	public $cliente;
	public $tipo;
	
	public function __construct(){
		parent::__construct();
	}

	public function set_datos($id,$nomb,$apell,$sex,$tele,$ext,$dir,$ciud,$fax,$email,$tip){
		$array = Array(
			"Client_id"=>$id,
			"Client_nom"=>$nomb,
			"Client_apell"=>$apell,
			"Client_sex"=>$sex,
			"Client_tel"=>$tele,
			"Client_ext"=>$ext,
			"Client_dire"=>$dir,
			"Client_ciud"=>$ciud,
			"Client_fax"=>$fax,
			"Client_email"=>$email,
			"Client_tipo"=>$tip
		);
		$response = parent::inserta("clientes_stra",$array);
		return $response;
	}

	public function get_datos($id){
		$sql = 'SELECT Client_nomb,Client_tel,Client_ext,Client_dire,Client_tipo
				FROM clientes_stra
				WHERE Client_id = '.$id;
		$respon = parent::consultas($sql);	
		return $respon;		
	}

	public function Get_empresas($id){
		$sql = 'SELECT Empres_nit,Empres_nomb,Empres_tel,Empres_dir,Empres_ciud
				FROM empresa_stra 
				WHERE Empres_id_client = '.$id; 
		$respon = parent::consultas($sql);		
		return $respon;	
	}

	public function Get_clientes_by_descrip($caract){
		$sql = 'SELECT Client_id,Client_nom,Client_apell 
				FROM clientes_stra 
				WHERE Client_id LIKE "%'.$caract.'%" 
				OR Client_nom LIKE "%'.$caract.'%" 
				OR Client_apell  LIKE "%'.$caract.'%"';
		$respon = parent::consultas($sql);		
		return $respon;	
	}

	public function Get_cant_client(){
		$sql = 'SELECT COUNT(*) as cant
				FROM clientes_stra';
		$respon = parent::consultas($sql);		
		return $respon;	
	}

} 
?>