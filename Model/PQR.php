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
class PQR extends Conectar{

  public function __construct(){
    parent::__construct();
  }

  public function Set_PQR($nit,$tel,$cel,$descríp,$event,$ciudad,$id_recibe,$estado,$id_emplo,$area){
    if(isset($id_emplo) and !empty($id_emplo)){ // si existe un id de empleado a canalizar guarda el array 
  	  $array = Array("Nit_empresa"=>$nit,"Ticket_tel"=>$tel,"Ticket_cel"=>$cel,"Ticket_Descrip"=>$descríp,
  				         "Ticket_event"=>$event,"Ticket_ciudad"=>$ciudad,"Ticket_id_recibe"=>$id_recibe,
  				         "Ticket_date"=>date("Y-m-d H:i:s"),"Ticket_area"=>$area,"Ticket_ced_asign"=>$id_emplo,"Ticket_estado"=>$estado);
    }else{
      $array = Array("Nit_empresa"=>$nit,"Ticket_tel"=>$tel,"Ticket_cel"=>$cel,"Ticket_Descrip"=>$descríp,
                   "Ticket_event"=>$event,"Ticket_ciudad"=>$ciudad,"Ticket_id_recibe"=>$id_recibe,
                   "Ticket_date"=>date("Y-m-d H:i:s"),"Ticket_estado"=>$estado);
    }
    $data = parent::inserta('registro_ticket',$array);
    return $data;
  }

  public function Set_pqr_client($form = array()){
    $array = array("id_client"=>$form['id_client'],
                   "Nit_empresa"=>$form['nit'],
                   "Ticket_tel"=>$form['inp_tel'],
                   "Ticket_cel"=>$form['inp_cel'],
                   "Ticket_Descrip"=>$form['txt_descríp'],
                   "Ticket_event"=>$form['slt_tip_subtipo'],
                   "Ticket_ciudad"=>$form['slt_ciudad'],
                   "Ticket_id_recibe"=>$form['id_canalizar'],
                   "Ticket_date"=>date('Y-m-d'),
                   "Ticket_area"=>1008,
                   "Ticket_ced_asign"=>$form['id_canalizar'],
                   "Ticket_estado"=>2);
     $data = parent::inserta('registro_ticket',$array);
     return $data;
  }


  public function Set_respon_ticket($respon,$tick,$id_recibe,$esta,$depart,$emplo){
     $array = array("Respon_text"=>utf8_encode($respon), 
                    "Respon_id_ticket"=>$tick,
                    "Respon_recibe_id"=>$id_recibe,
                    "Respon_estad"=>$esta,
                    "Respon_departa_resp"=>$depart,
                    "Respon_id_emplo_asig"=>$emplo);
  	$data = parent::inserta('respuesta_ticket',$array);
    return $data;
  }
  public function Get_PQR($id){ 
  	$sql = 'SELECT Ticket_tel as tel,Ticket_cel as cel,CONVERT(Ticket_Descrip USING utf8) as descri,te.Tip_eve_nomb as nomb,ciu.Ciudad_nomb as ciudad,CONCAT(emple_nomb," ",emple_apell) as id_recibe ,Ticket_date as fecha,Ticket_estado as estado,de.Depart_nomb as area
            FROM registro_ticket rt
            INNER JOIN tipo_evento te ON te.Tip_eve_id = rt.Ticket_event
            INNER JOIN ciudad ciu ON  ciu.Ciudad_id = rt.Ticket_ciudad 
            INNER JOIN empleados em ON em.emple_id = rt.Ticket_id_recibe
            INNER JOIN departament de ON de.Id_depart = rt.Ticket_area
            WHERE rt.Ticket_id = '.$id;
  	$data = parent::consultas($sql);
  	return $data;
  }

  public function Get_PQR_by_titular($id){ 
  	$sql = 'SELECT Ticket_id as id,CONVERT(te.Tip_eve_nomb USING utf8) as nomb_event,CONVERT(ci.Ciudad_nomb USING utf8) as ciud,rt.Ticket_id_recibe as canali,rt.Ticket_date as fecha,CONVERT(rt.Ticket_estado USING utf8) as estado,CONVERT(Depart_nomb USING utf8) as depart
            FROM registro_ticket rt 
            INNER JOIN tipo_evento te ON te.Tip_eve_id = rt.Ticket_event
            INNER JOIN ciudad ci ON ci.Ciudad_id = rt.Ticket_ciudad 
            INNER JOIN departament dpt ON dpt.Id_depart = rt.Ticket_area
            WHERE Nit_empresa = "'.$id.'"';
            //echo $sql;
  	$data = parent::consultas($sql);
  	return $data;
  }

  public function Get_Respond($id){
  	$sql = 'SELECT CONVERT(rt.Respon_text USING utf8) as descri,rt.Respon_date as fecha,CONCAT(emp.emple_nomb," ",emp.emple_apell) As nomb,rt.Respon_estad as estado,emp.emple_foto as img
            FROM respuesta_ticket rt 
            INNER JOIN empleados emp ON emp.emple_id = Respon_recibe_id
            WHERE rt.Respon_id_ticket = '.$id;
  	$data = parent::consultas($sql);
  	return $data;
  }

  // todos los tickets finalizados por area
  public function Get_PQR_by_Area($id){
  	$sql =
  		'SELECT Time_id_ticket
  		 FROM timeline_ticket
  		 WHERE Time_area = '.$id.'
  		 AND Time_estado = 3';
  	$data = parent::consultas($sql);
  	return $data;
  }

  public function Get_All_ticket_by_Area($area){
    $sql = 'SELECT Ticket_id,te.Tip_eve_nomb,ci.Ciudad_nomb,rt.Ticket_id_recibe,rt.Ticket_date,rt.Ticket_estado,Depart_nomb
            FROM registro_ticket rt 
            INNER JOIN tipo_evento te ON te.Tip_eve_id = rt.Ticket_event
            INNER JOIN ciudad ci ON ci.Ciudad_id = rt.Ticket_ciudad 
            INNER JOIN departament dpt ON dpt.Id_depart = rt.Ticket_area 
            WHERE Ticket_area = '.$area.'
            AND Ticket_estado = 2 
            OR Ticket_estado = 1';
    $data = parent::consultas($sql);
    return $data;
  }

  public function Get_All_ticket_by_employed($id){
    $sql = 'SELECT Ticket_id as id,CONVERT(te.Tip_eve_nomb USING utf8) as event,CONVERT(ci.Ciudad_nomb USING utf8) as ciud,rt.Ticket_id_recibe as id_recibe,rt.Ticket_date as fecha,rt.Ticket_estado as stado,Depart_nomb as depart
            FROM registro_ticket rt 
            INNER JOIN tipo_evento te ON te.Tip_eve_id = rt.Ticket_event 
            INNER JOIN ciudad ci ON ci.Ciudad_id = rt.Ticket_ciudad 
            INNER JOIN departament dpt ON dpt.Id_depart = rt.Ticket_area 
            LEFT JOIN respuesta_ticket resp_tick ON resp_tick.Respon_id_ticket = rt.Ticket_id 
            WHERE Ticket_ced_asign = '.$id.'  
            AND Ticket_estado IN (1,2) GROUP BY 1';
    $data = parent::consultas($sql);
    return $data;
  }


  // obtine los tickets que fueron canalizados a un empleados
  public function Get_all_ticket_canalizado($id){
    $sql = 'SELECT reg_ticket.Ticket_id as id,CONVERT(te.Tip_eve_nomb USING utf8) as event,CONVERT(ci.Ciudad_nomb USING utf8) as ciud,reg_ticket.Ticket_id_recibe as id_recibe,reg_ticket.Ticket_date as fecha,reg_ticket.Ticket_estado as stado,Depart_nomb as depart 
            FROM respuesta_ticket rt 
            INNER JOIN registro_ticket reg_ticket ON rt.Respon_id_ticket = reg_ticket.Ticket_id 
            INNER JOIN tipo_evento te ON te.Tip_eve_id = reg_ticket.Ticket_event 
            INNER JOIN ciudad ci ON ci.Ciudad_id = reg_ticket.Ticket_ciudad 
            INNER JOIN departament dpt ON dpt.Id_depart = reg_ticket.Ticket_area 
            WHERE Respon_id_emplo_asig = '.$id.' 
            AND rt.Respon_estad = 1
            AND reg_ticket.Ticket_estado = 2 
            GROUP BY 1';
    $data = parent::consultas($sql);
    return $data;
  }

  public function Get_msn_ticket($id){
    $sql = 'SELECT Ticket_Descrip
            FROM registro_ticket 
            WHERE Ticket_id = '.$id;
    $data = parent::consultas($sql);
    return $data;
  }

  public function Update_estado_pqr($id,$esta,$id_emple){
    if($esta == 1){
     $sql = 'UPDATE registro_ticket 
             SET Ticket_estado = 2,
             Ticket_ced_asign = '.$id_emple.'
             WHERE Ticket_id = '.$id;
    }else if($esta == 2){
      $sql = 'UPDATE registro_ticket 
              SET Ticket_estado = 3,
              Ticket_ced_asign = '.$id_emple.'
              WHERE Ticket_id = '.$id;
      $id = $this->Last_id_respuesta($id);
      if(isset($id)){
        $last_id = $id[0]['Respon_id'];
        $upda = 'UPDATE respuesta_ticket 
                 SET Respon_estad = 2
                 WHERE Respon_id = '.$last_id;
        parent::update_query($upda);
      }
    }
    $data = parent::update_query($sql);
    return $data;
  }

  private function Last_id_respuesta($id_ticket){
    $sql = 'SELECT Respon_id
            FROM respuesta_ticket 
            WHERE Respon_id_ticket = '.$id_ticket.'
            ORDER BY 1 desc 
            LIMIT 1';
    $data = parent::consultas($sql);
    return $data;
  }

  public function Get_respon_ticket($id){
    $sql = 'SELECT Respon_text,Respon_date,Depart_nomb,CONCAT(emple_nomb," ",emple_apell) as nombre 
            FROM respuesta_ticket rt 
            INNER JOIN empleados em ON em.emple_id = rt.Respon_recibe_id 
            INNER JOIN departament de ON de.Id_depart = rt.Respon_departa_resp 
            WHERE Respon_id_ticket ='.$id.'
            ORDER BY Respon_date ASC';
    $data = parent::consultas($sql);
    return $data;        
  }

  // funciones de reporte 
  // obtiene todos los tickets por ciudad que aun estan pendientes
  public function Get_ticket_by_ciudad(){
    $sql = 'SELECT COUNT(*) as cant,ciud.Ciudad_nomb as ciud
            FROM registro_ticket rt
            INNER JOIN ciudad ciud ON ciud.Ciudad_id = rt.Ticket_ciudad 
            GROUP BY 2';
    $data = parent::consultas($sql);
    return $data;    
  }

  // obtiene todos los tickets mas frecuentes
  public function Get_ticket_more_pedido(){
    $sql = 'SELECT MAX(Ticket_event) as max,Tip_eve_nomb as event,COUNT(*) AS cant  
            FROM registro_ticket rt
            INNER JOIN tipo_evento te ON te.Tip_eve_id = rt.Ticket_event 
            LIMIT 5';
    $data = parent::consultas($sql);
    return $data;
  }

  // obtiene todos los tickets por departamentos
  public function Get_ticket_by_departament_pendiente(){ 
    $sql = 'SELECT COUNT(*) as cant,de.Depart_nomb as depart
            FROM registro_ticket rt
            INNER JOIN departament de ON de.Id_depart = rt.Ticket_area 
            GROUP BY 2';
    $data = parent::consultas($sql);
    return $data;
  } 

  public function Get_gestion_ticket(){
    $sql = 'SELECT COUNT(DISTINCT rt.Ticket_id) as cant,ciud.Ciudad_nomb as nomb, COUNT(rt2.Ticket_id) as cant2
            FROM registro_ticket rt
            INNER JOIN ciudad ciud ON ciud.Ciudad_id = rt.Ticket_ciudad AND rt.Ticket_estado = 3
            INNER JOIN registro_ticket rt2 ON ciud.Ciudad_id = rt2.Ticket_ciudad 
            AND rt2.Ticket_estado IN (1,2)';
    $data = parent::consultas($sql);
    return $data;
  }
}