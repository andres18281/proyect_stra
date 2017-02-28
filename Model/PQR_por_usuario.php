<?php 

 if(file_exists('Controller/conectar.php')){
  include_once('Controller/conectar.php');
 }else if(file_exists('conectar.php')){
  include_once('conectar.php');
 }else if(file_exists('../Controller/conectar.php')){
  include_once('../Controller/conectar.php');
 }else{
   include_once $_SERVER['DOCUMENT_ROOT']."/proyect_stra/Controller/conectar.php";
 }

class PQR_por_usuario extends Conectar{
  public function __construct(){
    parent::__construct();
  }


  public function Get_all_ticket_by_employed($id){
    $sql = 'SELECT Ticket_id,Ticket_date
            FROM registro_ticket
            WHERE Ticket_ced_asign = '.$id.' 
            AND Ticket_estado IN (1,2)';
    $data = parent::consultas($sql); 
    return $data;     
  }

  public function Get_all_ticket_canalizado($id){
    $sql = 'SELECT Respon_id as id,Respon_id_ticket as Ticket_id,Respon_date as Ticket_date
            FROM respuesta_ticket 
            WHERE Respon_id_emplo_asig = '.$id.'
            AND Respon_estad = 1';
    $data = parent::consultas($sql); 
    return $data; 
  }
}

?> 