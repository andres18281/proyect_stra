<?php
include_once('../Controller/conectar.php');
class Gestion extends Conectar{
  public function __construct(){
  	parent::__construct();
  }

  // obtiene todas las solicitudes de contratos que requieren 
  // la labor de servicio tecnico
  public function Get_all_request_soport_by_contrat(){
  	$sql = 'SELECT CONCAT(Id_contrat,"-",Contra_id_no) as id,Contra_servi_tec_pri,Servi_nomb
  			    FROM contrato con
            INNER JOIN servicios_prestado sp ON sp.Servi_id =  con.Contra_id_contr
  			    WHERE Contra_servi_tecni = 1 
            AND Id_contrat NOT IN(SELECT Gestion_id_tip FROM gestion_stra)';
  	$data = parent::consultas($sql);
  	return $data;
  }

  // canaliza a un tecnico 
  public function Set_solicitud_canalizada_soport($id,$emplo,$text){
    if(strpos($id,"-") > 0){
      $v = explode("-",$id);
      $id = $v[0];
    }
    $coment = array("Coment_id"=>$id,
                    "Coment_tipo"=>2,
                    "Coment_text"=>utf8_encode($text));
    $respon_coment = parent::inserta('comentarios',$coment);
    $nit = $this->Get_client_by_contrato($id);
    $sql = array("Gestion_id_tip"=>$id,
                 "Gestion_estado"=>1,
                 "Gestion_id_empresa"=>$nit,
                 "Gestion_id_emplead"=>$emplo,
                 "Gestion_id_coment"=>$respon_coment['last_cod_id'],
                 "Gestion_fecha"=>date('Y-m-d h:i:s'));
    $response = parent::inserta('gestion_stra',$sql);
    return $response;
  }

  public function Get_solicitud_tecnico_soport_notify($id){
    $sql = 'SELECT Gestion_id_auto,Gestion_fecha,Gestion_estado
            FROM gestion_stra
            WHERE Gestion_id_emplead = '.$id.'
            AND Gestion_estado IN(1,3)';
    $data = parent::consultas($sql);
    return $data;
  }

  public function Get_client_by_contrato($id_contrat){
    if(strpos($id_contrat,"-") > 0){
      $v = explode("-",$id_contrat);
      $id_contrat = $v[1];
    }
    $sql = 'SELECT Contra_id_client
            FROM contrato 
            WHERE Id_contrat = '.$id_contrat;
    $data = parent::consultas($sql);
    return $data['Contra_id_client'];
  }

  // lista todos los reportes tecnicos pendientes para un usuario
  public function Get_solicitud_tecnico_soport($id){
    $sql = 'SELECT  Gestion_id_auto,Id_contrat,Contra_descrip,Gestion_fecha,Gestion_estado
            FROM gestion_stra gs 
            INNER JOIN contrato con ON con.Id_contrat = gs.Gestion_id_tip
            WHERE Gestion_id_emplead = '.$id;
    $data = parent::consultas($sql);
    return $data;
  }

  // muestra mas en detalle el soporte tecnico que requiere
  public function Get_info_soport_tecnico($id){
    $sql = 'SELECT Coment_text, Empres_nomb
            FROM  gestion_stra gs
            INNER JOIN comentarios com ON gs.Gestion_id_coment = com.Coment_auto 
            INNER JOIN empresa_stra em ON em.Empres_nit = gs.Gestion_id_empresa 
            WHERE Gestion_id_auto = '.$id;
    $data = parent::consultas($sql);
    return $data;
  }

  public function Autorizar_compra($id){
    $sql = 'UPDATE gestion_stra 
            SET Gestion_estado = 3
            WHERE Gestion_id_auto = '.$id;
    $data = parent::update_query($sql);   
    return $data;
  }

  // el tecnico genera informacion que empieza la operacion
  public function Inicia_proceso($id){
    $sql = 'UPDATE gestion_stra 
            SET Gestion_estado = 4,
            Gestion_fecha_inicio = "'.date("Y-m-d h:i:s").'" 
            WHERE Gestion_id_auto = '.$id;
    $data = parent::update_query($sql);   
    return $data;
  }

  public function Set_iniciar_proceso($id){
    $sql = 'UPDATE gestion_stra 
            SET Gestion_estado = 4 
            WHERE Gestion_id_auto = '.$id;
    $data = parent::update_query($sql);   
    return $data;
  }

  public function Get_procesos_en_gestion($id){
    $sql = 'SELECT Gestion_id_auto,Gestion_id_tip,Empres_nomb
            FROM gestion_stra gs 
            INNER JOIN empresa_stra es ON es.Empres_nit = gs.Gestion_id_empresa
            WHERE Gestion_estado = 4 AND
            Gestion_id_emplead = '.$id;
    $data = parent::consultas($sql);
    return $data;
  }

  // Trabajo de instalacion ya finalizada
  public function Gestion_terminada($id,$id_contrat){
    $sql = 'UPDATE gestion_stra 
            SET Gestion_estado = 5
            WHERE  Gestion_id_auto = '.$id;
    $data = parent::update_query($sql);   
    if(isset($data['exito'])){
      $sql = 'UPDATE contrato 
              SET Contra_stado = 4
              WHERE Id_contrat = '.$id_contrat;
      $respon = parent::update_query($sql);
      return $respon;
    }
  }

  public function Activar_contrato($id){
     if(strpos($id,"-") > 0){
       $v = explode("-",$id);
       $id = $v[1];
     }
      $sql = 'UPDATE contrato 
              SET Contra_stado = 1
              WHERE Id_contrat = '.$id;
      $data = parent::update_query($sql); 
      return $data;
  }
  
  public function Get_contratos_sin_activar(){
    $sql = 'SELECT CONCAT(Contra_id_no,"-",Id_contrat) as id,Contra_costo as cost,CONVERT(Contra_descrip USING utf8) as descrip,Gestion_id_auto as gest_id
            FROM contrato con 
            INNER JOIN gestion_stra gs ON gs.Gestion_id_tip = con.Id_contrat
            WHERE Contra_stado = 4';
    $data = parent::consultas($sql);
    return $data;
  }

 

  public function Get_all_request_gestion(){
    $sql = 'SELECT Gestion_id_auto, Gestion_id_tip,Gestion_id_emplead,CONCAt(emple_nomb," ",emple_apell) as emple,Gestion_id_coment,Gestion_fecha_pend 
        FROM gestion_stra gs
        INNER JOIN empleados emp ON emp.emple_id = gs.Gestion_id_emplead 
        WHERE Gestion_estado = 2';
    $data = parent::consultas($sql);
    return $data; 
  }

  // obtiene la informacion diligenciada del tecnico y las fotos que envio
  public function Get_informe_servicio($id){
    $sql = 'SELECT Gestion_id_auto
            FROM gestion_stra 
            WHERE Gestion_id_tip = '.$id;
    $data = parent::consultas($sql);
    if(isset($data['Gestion_id_auto'])){
      $id = $data['Gestion_id_auto'];
      $sql = 'SELECT CONVERT(Coment_text USING utf8) as descrip,GROUP_CONCAT(Foto_url) as foto
              FROM comentarios comen 
              INNER JOIN foto_servi_tecn foto ON foto.Foto_id_servi = comen.Coment_id
              WHERE comen.Coment_id = '.$id.'
              GROUP BY Coment_id';
      $respon = parent::consultas($sql);
      return $respon;
    }
  } 
}