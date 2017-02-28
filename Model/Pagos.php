<?php
include_once('../Controller/conectar.php');
class Pagos extends Conectar{

  function __construct(){
    parent::__construct();
  }

  function Get_info_contrato($id){
    $sql = 'SELECT Contra_id_client as id_client,Contra_Form_pago as form_pago,Contra_costo as cost,Contra_Form_cuota as cuot,Contra_time as tiemp
            FROM contrato
            WHERE Id_contrat = '.$id;
    $response = parent::consultas($sql);
    return $response;
  }

  function Generar_cuotas($id_contrat){
    if(strpos($id_contrat,"-") > 0){
      $v = explode("-",$id_contrat);
      $id_contrat = $v[1];
    }
    $respon = $this->Get_info_contrato($id_contrat);
    if(isset($respon)){
  	  $valor = $respon['cost'];
      $cuota = $respon['cuot'];
      $tipo_ = $respon['form_pago'];
      $id_empre =  $respon['id_client'];
      if($tipo_ == "Mensual"){ $tipo = 1; }
      if($tipo_ == "Trimestral"){ $tipo = 2; }
      if($tipo_ == "Semestral"){ $tipo = 3; }
      if($tipo_ == "Anual"){ $tipo = 4; }
      $valor_cuot = $valor / $cuota;
  	  $valor_dia = $valor_cuot / 30;
      $dia = date('d');
      $cuota_ = array();
  	  if($dia < 30){
  	    $valor_primer_mes = $valor_dia * (30 - $dia);
        $respon['pagos'] = $this->Set_pagos(date('Y-m-d'),date('Y-m-30'),$id_contrat,$id_empre,$valor_primer_mes);
        $fecha = new DateTime();
  	    for($i = 1;$i < $cuota;$i++){  
          if($tipo == 1){ // mensual
            $intervalo = new DateInterval('P1M');
          }
          if($tipo == 2){ // trimestral
            $intervalo = new DateInterval('P3M');
          }
          if($tipo == 3){ // semestral
            $intervalo = new DateInterval('P6M');
          }
          if($tipo == 4){ // anual
            $intervalo = new DateInterval('P1Y');
          }
          $fecha_fin = $fecha->add($intervalo);
          $fecha_ini = $fecha->format('Y-m-01');
  	      $fecha_fin_ = $fecha->format('Y-m-30');
          $respon['pagos'] = $this->Set_pagos($fecha_ini,$fecha_fin_,$id_contrat,$id_empre,$valor / $cuota);
        }
  	  }else if($dia == 30){
  	    for($i = 0;$i < $cuota;$i++){
           $fecha = new DateTime();
  	       if($tipo == 1){ // mensual
             $intervalo = new DateInterval('P1M');
           }
          if($tipo == 2){ // trimestral
            $intervalo = new DateInterval('P3M');
          }
          if($tipo == 3){ // semestral
            $intervalo = new DateInterval('P6M');
          }
          if($tipo == 4){ // anual
            $intervalo = new DateInterval('P1Y');
          }
          $fecha_fin = $fecha->add($intervalo);
          $fecha_ini = $fecha->format('Y-m-01');
          $fecha_fin_ = $fecha->format('Y-m-30');
  	      $respon['pagos'] = $this->Set_pagos($fecha_ini,$fecha_fin_,$id_contrat,$id_empre,$valor / $cuota);
        }
  	  }	
      return $respon;
    }
  }

  public function Set_pagos($fech_ini,$fech_fin,$id_contrat,$id_empre,$cost){
    $array = array("pago_fecha_inic"=>$fech_ini,
                  "pago_fecha_fin"=>$fech_fin,
                  "pago_id_contrat"=>$id_contrat,
                  "pago_id_empre"=>$id_empre,
                  "pago_costo"=>$cost,
                  "pago_confir"=>2);
    $response = parent::inserta('pagos_str',$array);
    return $response;
  }

  public function Get_all_pago_by_contrato($id){  
    $sql = 'SELECT pagos_id as id,pago_fecha_pago as fecha_pago,pago_fecha_inic as fecha_ini,
            pago_fecha_fin as fecha_end,pago_costo as costo,pago_confir as confir
            FROM pagos_str 
            WHERE pago_id_contrat = '.$id;
    $response = parent::consultas($sql);
    return $response;
  }



}


/*
  $d = date('Y')."-".date('m')."-".date('d');
	$fecha = new DateTime();
	echo $fecha->format('Y-m-d').'<br>';
	$intervalo = new DateInterval('P1Y');
	$fecha->add($intervalo);
	echo $fecha->format('Y-m-d') . "\n";

meses
$intervalo = new DateInterval('P1M');
$intervalo = new DateInterval('P3M');
$intervalo = new DateInterval('P6M');
$intervalo = new DateInterval('P1Y');

http://php.net/manual/es/class.dateinterval.php
	y
Número de años.

m
Número de meses.

d
Número de días.

h
Número de horas.

i
Número de minutos.

s
Número de segundos.



*/

?>