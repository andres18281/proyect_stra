<?php
include_once('../Controller/conectar.php');
class Compras extends Conectar{
  
  public function __construct(){
  	parent::__construct();
  }

  public function Get_all_request_gestion(){
  	$sql = 'SELECT Gestion_id_auto,	CONCAT(con.Id_contrat,"-",con.Contra_id_no) as id,Gestion_id_emplead,CONCAT(emple_nomb," ",emple_apell) as emple,Gestion_id_coment,Gestion_fecha_pend 
  			FROM gestion_stra gs
  			INNER JOIN empleados emp ON emp.emple_id = gs.Gestion_id_emplead 
  			INNER JOIN contrato con ON con.Id_contrat = gs.Gestion_id_tip
  			WHERE Gestion_estado = 2';
  	$data = parent::consultas($sql);
    return $data; 
  }
}
?>