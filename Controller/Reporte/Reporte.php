<?php
include_once "../../Model/PQR.php";
include_once "../../Model/Cliente.php";
include_once "../../Model/Contrato.php";
include_once "../../Model/Usuarios.php";
include_once "../../Model/PQR.php";
class Reporte{
  private $pqr = null;
  private $contrato = null;
  private $cliente = null;
  public function __construct(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
  	 $this->pqr = new PQR();
  	 $this->contrato = new Contrato();
  	 $this->cliente = new Cliente();
     $request = json_decode($_POST['request'],true);
     if($request['accion'] == "get_dashboard"){
       $array = array();
       $array['ticket'] = $this->Get_reporte_ticket();
       $array['contrat'] = $this->Get_reporte_contrato();
       $array['client'] = $this->Get_reporte_client();
       echo json_encode($array);
     }
    }
  }

  public function Get_reporte_ticket(){ 
    $array = array();
    $array['ticket_ciudad'] = $this->Show_ticket_by_city();
    $array['ticket_comunes'] = $this->Show_ticket_mas_comunes();
    $array['ticket_by_area'] = $this->Show_ticket_pendiente_by_area();
    $array['ticket_gestion'] = $this->Show_get_gestion();
    return $array;
  }

  public function Get_reporte_contrato(){
    $array = array();
    $array['contrat_cant'] = $this->Show_cant_contrato();
    $array['contrat_ciud'] = $this->Show_cant_contrato_by_ciudad();
    return $array;
  }

  public function Get_reporte_client(){
    $array = array();
    $array['client_cant'] = $this->Show_cant_clients();
    return $array;
  }

  public function Show_ticket_by_city(){
  	$data = $this->pqr->Get_ticket_by_ciudad();
    return $this->Arreglar_array($data);
  }

  public function Show_ticket_mas_comunes(){
  	$data = $this->pqr->Get_ticket_more_pedido();
    return $this->Arreglar_array($data);

  }
  
  public function Show_ticket_pendiente_by_area(){
  	$data = $this->pqr->Get_ticket_by_departament_pendiente();
    return $this->Arreglar_array($data);
  }

  public function Show_cant_contrato(){
  	$data = $this->contrato->Get_all_contrato_active();
    return $data;
  }

  public function Show_get_gestion(){
    $data = $this->pqr->Get_gestion_ticket();
    return $this->Arreglar_array($data);
  }

  public function Show_cant_contrato_by_ciudad(){
    $data = $this->contrato->Get_count_contrato_by_city();
    return $this->Arreglar_array($data); 
  }

  public function Show_ventas_by_month(){
  }

  public function Show_cant_clients(){ 
    $data = $this->cliente->Get_cant_client();
    return $data;
  }

  private function Arreglar_array($respon = array()){
    if(isset($respon)){
      if(isset($respon[0]) and is_array($respon[0])){
        $array = $respon;
      }else{
       $array[] = $respon;
      }
      return $array;
    }
  }
}
new Reporte();
?>