<?php
session_start();
include_once('../../Model/PQR.php');
 class TicketController{
   private $pqr = null;
   function __construct(){
   	if($_SERVER['REQUEST_METHOD'] == 'POST'){
   	 $this->pqr = new PQR();
   	 $request = json_decode($_POST['accion'],true);
   	 if(isset($request['form']['create_ticket_client'])){
   	 	$respon = $this->Save_ticket_cliente($request['form']);
   	 	echo json_encode($respon);
   	 }

   	 if(isset($request['get_subitem'])){
   	 	$id = $request['id'];
   	 	$respon = $this->Get_sub_item_($id);
   	 	echo json_encode($respon);
   	 }
    }
   }


   private function Save_ticket_cliente($form = array()){
   	include_once('../../Model/Empleado.php');
   	$emple = new Empleado();
   	$id_emplo = $emple->Get_one_employed_by_area(1008); // llama a un empleado de servicio tecnico
   	$form['id_canalizar'] = $id_emplo[0]['id'];
   	$form['id_client'] = $_SESSION['id_user'];
   	$respon = $this->pqr->Set_pqr_client($form);
   	return $respon;
   }

   private function Get_sub_item_($id){
   	if($id == 1){ $array = array("11"=>"Caida de red","12"=>"Falla tecnica","13"=>"caida"); }
   	if($id == 2){ $array = array("21"=>"Caida de red","22"=>"Falla tecnica","23"=>"Caida"); }
   	if($id == 3){ $array = array("31"=>"Caida de red","32"=>"Falla tecnica","33"=>"Caida");	}
   	return $array;
   }
 }
 new TicketController();
?>