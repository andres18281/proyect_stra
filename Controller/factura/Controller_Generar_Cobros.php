<?php
 include_once "../../Model/Contrato.php";
 class Controller_Generar_Cobros{

 	private $contrato = null;
 	function __construct(){
 		$this->contrato = new Contrato();
 	}

 	public function Generar_facturas($id){
 	  $response = $this->contrato->Get_contrato_per_add_pago($id); 
 	  $respose['Id_contrat'];
 	  $respose['Contra_id_client'];
 	  $respose['Contra_time'];
 	  $respose['Contra_time_ini'];	
 	  $respose['Contra_time_fin'];
 	  $respose['costo'];
 	  $respose['servicio_item'];
 	  $dia_inicio = date('d',$respose['Contra_time_ini']);
 	  if($respose['servicio_item'] == "dia"){
 	  	 $array = array("pago_fecha_inic"=>date('Y-m-d h:i:s'),
                   		"pago_fecha_fin"=>date('Y-m-d h:i:s'),
                   		"pago_id_contrat"=>$respose['Id_contrat'],
                   		"pago_id_client"=>$respose['Contra_id_client'],
                   		"pago_costo"=>$respose['costo'],
                   		"pago_confir"=>2);
 	  	$this->contrato->Set_pagos($array);
 	  }
 	  if($respose['servicio_item'] == "mes"){
 	  	$mes_actual = date('m');
 	  	$ano_actual = date('Y');
 	  	$mes_to_facturar = 0;
 	  	$ano_to_facturar = 0;
 	  	$cont_mes = 0;
 	  	for($i = 1;$i <= $respose['Contra_time']; $i++){
 	  	  $cont_mes++;
 	  	  $mes_to_facturar = $mes_actual + $cont_mes;
 	  	  if($mes_to_facturar > 12){
 	  	  	$ano_to_facturar = 1 + $ano_actual;
 	  	  	$cont_mes = 1;
 	  	  	$mes_actual = 0;
 	  	  }else{
 	  	  	$ano_to_facturar =  $ano_actual;
 	  	  }
 	  	  $array = array("pago_fecha_inic"=>$ano_to_facturar."-".$mes_to_facturar."-20 01:00:00",
                   		 "pago_fecha_fin"=>$ano_to_facturar."-".$mes_to_facturar."-30 12:00:00",
                   		 "pago_id_contrat"=>$respose['Id_contrat'],
                   		 "pago_id_client"=>$respose['Contra_id_client'],
                   		 "pago_costo"=>$respose['costo'],
                   		 "pago_confir"=>2);
 	  	  $this->contrato->Set_pagos($array);
 	  	}
 	  }
 	  if($respose['servicio_item'] == "trimestre"){
 	  	$mes_actual = date('m');
 	  	$ano_actual = date('Y');
 	  	$mes_to_facturar = 0;
 	  	$ano_to_facturar = 0;
 	  	$cont_mes = 0;
 	  	for($i = 1;$i <= $respose['Contra_time']; $i++){
 	  	  $cont_mes = $cont_mes + 3;
 	  	  $mes_to_facturar = $mes_actual + $cont_mes;
 	  	  if($mes_to_facturar > 12){
 	  	  	$ano_to_facturar = 1 + $ano_actual;
 	  	  	$cont_mes = 1;
 	  	  	$mes_actual = 0;
 	  	  }else{
 	  	  	$ano_to_facturar =  $ano_actual;
 	  	  }
 	  	  $array = array("pago_fecha_inic"=>$ano_to_facturar."-".$mes_to_facturar."-20 01:00:00",
                   		 "pago_fecha_fin"=>$ano_to_facturar."-".$mes_to_facturar."-30 12:00:00",
                   		 "pago_id_contrat"=>$respose['Id_contrat'],
                   		 "pago_id_client"=>$respose['Contra_id_client'],
                   		 "pago_costo"=>$respose['costo'],
                   		 "pago_confir"=>2);
 	  	  $this->contrato->Set_pagos($array);
 	  	}
 	  }
 	  if($respose['servicio_item'] == "semestre"){
 	  	$mes_actual = date('m');
 	  	$ano_actual = date('Y');
 	  	$mes_to_facturar = 0;
 	  	$ano_to_facturar = 0;
 	  	$cont_mes = 0;
 	  	for($i = 1;$i <= $respose['Contra_time']; $i++){
 	  	  $cont_mes = $cont_mes + 6;
 	  	  $mes_to_facturar = $mes_actual + $cont_mes;
 	  	  if($mes_to_facturar > 12){
 	  	  	$ano_to_facturar = 1 + $ano_actual;
 	  	  	$cont_mes = 1;
 	  	  	$mes_actual = 0;
 	  	  }else{
 	  	  	$ano_to_facturar =  $ano_actual;
 	  	  }
 	  	  $array = array("pago_fecha_inic"=>$ano_to_facturar."-".$mes_to_facturar."-20 01:00:00",
                   		 "pago_fecha_fin"=>$ano_to_facturar."-".$mes_to_facturar."-30 12:00:00",
                   		 "pago_id_contrat"=>$respose['Id_contrat'],
                   		 "pago_id_client"=>$respose['Contra_id_client'],
                   		 "pago_costo"=>$respose['costo'],
                   		 "pago_confir"=>2);
 	  	  $this->contrato->Set_pagos($array);
 	  	}
 	  }
 	  if($respose['servicio_item'] == "año"){
 	  	$mes_actual = date('m');
 	  	$ano_actual = date('Y');
 	  	$mes_to_facturar = 0;
 	  	$ano_to_facturar = 0;
 	  	$cont_mes = 0;
 	  	for($i = 1;$i <= $respose['Contra_time']; $i++){
 	  	  $cont_mes = $cont_mes + 12;
 	  	  $mes_to_facturar = $mes_actual + $cont_mes;
 	  	  if($mes_to_facturar > 12){
 	  	  	$ano_to_facturar = 1 + $ano_actual;
 	  	  	$cont_mes = 1;
 	  	  	$mes_actual = 0;
 	  	  }else{
 	  	  	$ano_to_facturar =  $ano_actual;
 	  	  }
 	  	  $array = array("pago_fecha_inic"=>$ano_to_facturar."-".$mes_to_facturar."-20 01:00:00",
                   		 "pago_fecha_fin"=>$ano_to_facturar."-".$mes_to_facturar."-30 12:00:00",
                   		 "pago_id_contrat"=>$respose['Id_contrat'],
                   		 "pago_id_client"=>$respose['Contra_id_client'],
                   		 "pago_costo"=>$respose['costo'],
                   		 "pago_confir"=>2);
 	  	  $this->contrato->Set_pagos($array);
 	  	}
 	  }
 	}
 }
?>