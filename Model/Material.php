
<?php
include_once('../Controller/conectar.php');
class Material extends Conectar{
  public function __construct(){
  	parent::__construct();
  }
  
  public function Set_solici_material($mate,$can,$id){
  	$array = array("Solici_mat_nomb"=>$mate,
  				   "Solici_mat_cant"=>$can,
  				   "Solici_id_servi_id"=>$id);
  	$response = parent::inserta('solici_material_servi_tect',$array);
  	if(isset($response['exito'])){
  	  $upda = 'UPDATE gestion_stra
  	  		   SET Gestion_fecha_pend = "'.date('Y-m-d h:i:s').'",
  	  		   Gestion_estado = 2
  	  		   WHERE Gestion_id_auto = '.$id;
  	  $response = parent::update_query($upda);
      return $response;
  	}
  }

  // devuelve todos los materiales solicitados por un tecnico
  public function Get_solicitud_material_by_id_contrat($id){ 
    $sql = 'SELECT Gestion_id_auto
            FROM gestion_stra 
            WHERE  Gestion_id_auto = '.$id;
    $data = parent::consultas($sql);
    if(isset($data)){ 
      $sql = 'SELECT Solici_mat_id as id,CONVERT(Solici_mat_nomb USING utf8) as nomb,Solici_mat_cant as cant
  			      FROM solici_material_servi_tect
  			      WHERE Solici_id_servi_id = '.$data['Gestion_id_auto']; 
  	 $data = parent::consultas($sql);
     return $data;
    }
  }

  public function Get_solicitud_material($id){
     $sql = 'SELECT Solici_mat_id,Solici_mat_nomb,Solici_mat_cant
             FROM solici_material_servi_tect
             WHERE Solici_id_servi_id = '.$id;
     $data = parent::consultas($sql);
     return $data;  
  }
  
  public function Update_precio_material($id,$cost){
    $sql = 'UPDATE solici_material_servi_tect
            SET Solici_mat_cost = '.$cost.'
            WHERE Solici_mat_id = '.$id;
    $response = parent::update_query($sql);
    return $response;
  }


}