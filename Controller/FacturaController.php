<?php
include_once "../Model/Factura.php";
class FacturaController{
  private $factura = null;
  function __construct(){
	if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
	   $this->factura = new Factura();	
	   $request = json_decode($_POST['request'],true);
	   if(isset($request['accion']) and $request['accion'] == "get_factura_by_client"){
	   	 $nit = $request['nit'];
	   	 $respon = $this->Get_factura_by_client($nit);
	     echo json_encode($respon);
	   }

	   if(isset($request['accion']) and $request['accion'] == "get_detalle_fact"){
	   	 $id = $request['id'];
	   	 $respon = $this->Get_detalles_by_fact($id);
	   	 echo json_encode($respon);
	   }
	}
  }

  private function Get_factura_by_client($nit){
  	$respon = $this->factura->Get_facturas_by_empresa($nit);
  	$array = $this->Arreglar_array($respon);
    return $array;
  }

  private function Get_detalles_by_fact($id){
  	$respon = $this->factura->Get_datalle_factura($id);
    $array = $this->Arreglar_array($respon);
    return $array;
  }


  // funcion que verifica si varios arrays o solo un arrays 
  // sirve para el recorrido de los arrays en loops
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

new FacturaController();


?>