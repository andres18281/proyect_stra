<?php 
include_once "Model/Factura.php";
include_once "Model/Empresa.php";
class ver{
	private $fact = null;
	private $client = null;
	private $template = null;
	private $id_fact = null;
	
	function __construct(){
  	  $this->fact = new Factura();
      $this->client = new Empresa();	
	  if($_SERVER['REQUEST_METHOD'] == 'GET'){
	  	if(isset($_GET['id_fact'])){
	  	  $this->template = file_get_contents("factura.php");
	  	  $id_fact = $_GET['id_fact'];	
	  	  $data = $this->Show_factura($id_fact);
	  	  $this->Render($data);
	  	  echo $this->Imprimir();
	  	}
	  } 
	}

	private function Show_factura($id){
	  $respon_fact = $this->fact->Get_factura($id);   
  	  $respon_detalle = $this->fact->Get_datalle_factura($id);   
  	  if(isset($respon_detalle)){
  		$table = '';
  		if(isset($respon_detalle[0]) and is_array($respon_detalle[0])){
  	  	  foreach($respon_detalle as $val){ 
  	  		$table .= '<tr><td></td><td><strong>'.$val['descrip'].'</strong></td><td>'.$val['cost'].'</td><td>'.$val['cost'].'</td></tr>';
  	  	  }
  		}else{
  		    $table = '<tr><td></td><td style="text-align:center">'.$respon_detalle['descrip'].'</td><td>$ '.number_format($respon_detalle['cost']).'</td><td>$ '.number_format($respon_detalle['cost']).'</td></tr>';
  		}
  	  }
  	    $id_client = $respon_fact['client'];
  	    $respon_clie = $this->client->Get_empresa($id_client);
 		// $respon_fact['estado'];
  	    $array['detall_fact'] = $table;
  	    $array['fecha_ini'] = $respon_fact['fecha'];
  	    $array['fecha_fin'] = $respon_fact['fecha_fin'];
  	    $array['client_nomb'] = $respon_clie['Empres_nomb'];
  	    $array['direccion_'] = $respon_clie['Empres_dir'];
  	    $array['tele_'] = $respon_clie['Empres_tel'];
  	    $array['ciudad_'] = $respon_clie['Empres_ciud'];
  	    $array['nit_'] = $id_client;
  	    $array['id_fact'] = $id;
  		$array['subtotal'] = "$ ".number_format($respon_fact['total']);
  		$iva = number_format($respon_fact['total'] * 0.16);
  		$array['iva'] = "$ ".$iva;
  	    $array['total'] = "$ ".number_format($respon_fact['total'] + $iva);
  	    return $array;
	}

	private function Render($array = array()){
	  if(isset($array) and is_array($array)){
	  	foreach($array as $key=>$val){
	  	 $this->template = str_replace('{{'.$key.'}}', $val, $this->template);
	  	}
	  }	
	}

	private function Imprimir(){
	  return $this->template;
	}
}

new ver();

  

?>