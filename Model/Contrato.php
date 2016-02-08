<?php
include_once $_SERVER['DOCUMENT_ROOT']."stratecsa/Controller/conectar.php";

Class Contrato extends Conectar{
  
  public function __construct(){

  }

  public function Get_contratos_by_client($id){
  	$sql = 'SELECT Id_contratm,	Contra_id_contr,Contra_stado 
  			FROM 
  			WHERE Contra_id_client = "'.$id.'"';
  	$response = parent::consultas($sql);
  	return $response;
  }

  public function Get_contratos_by_state($state){
  	$sql = 'SELECT Contra_id_contr 
  			FROM contrato
  			WHERE Contra_stado = '.$state; 
  	$response = parent::consultas($sql);
  	return $response;
  }
}