<?php
include_once $_SERVER['DOCUMENT_ROOT']."stratecsa/Controller/conectar.php";
class Cliente extends Conectar{
	public $id;
	public $nombre;
	public $direccion;
	public $cliente;
	public $tipo;
	public function __construct(){
			parent::__construct("root","");
			return false;
	}

	public function set_datos($id,$nomb,$tele,$ext,$dir,$tip){
		$array = Array(
			"Client_id"=>$id,
			"Client_nomb"=>$nomb,
			"Client_tel"=>$tele,
			"Client_ext"=>$ext,
			"Client_dire"=>$dir,
			"Client_tipo"=>$tip
		);
		parent::inserta("clientes_stra",$array);
	}

	public function get_datos($id){
		$sql = 'SELECT Client_nomb,Client_tel,Client_ext,Client_dire,Client_tipo
				FROM clientes_stra
				WHERE Client_id ="'.$id.'"';
		$array = parent::consultas($sql);
		return $array;		
	}
}
?>