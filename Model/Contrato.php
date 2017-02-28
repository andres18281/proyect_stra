<?php
if(file_exists('Controller/conectar.php')){
  include_once('Controller/conectar.php');
}else if(file_exists('conectar.php')){
  include_once('conectar.php');
}else if(file_exists('../Controller/conectar.php')){
  include_once('../Controller/conectar.php');
}

Class Contrato extends Conectar{
  
  public function __construct(){
    parent::__construct();
  }


  public function Get_contratos_by_client($id){ 
    $sql = 'SELECT Id_contrat,Contra_id_contr,Contra_descrip,Contra_time,Contra_time_contrat,Contra_time_ini,Contra_time_fin,Contra_stado
            FROM contrato cont 
            INNER JOIN empresa_stra emp ON emp.Empres_nit = cont.Contra_id_client
            WHERE Empres_id_client = '.$id;  
    $respon = parent::consultas($sql);
    return $respon; 
  }
 
  public function Set_contrato($array_contrat = array(),$vende){
    $respon_cost = $this->Get_cost_by_service($array_contrat['slt_descrip_servi']);
    $prec_cost = 0;
    if(isset($respon_cost) and !empty($respon_cost)){
      $prec_cost = $respon_cost;
    }else{
     $prec_cost = str_replace($array_contrat['inp_calcu_cost'], "", ",");
     $prec_cost = str_replace($prec_cost,"", ".");
    }
    $array = array("Contra_id_no"=>date('ymd'),
                   "Contra_id_client"=>$array_contrat['inp_hid_id_client'],
                   "Contra_id_contr"=>$array_contrat['slt_descrip_servi'],
                   "Contra_descrip"=>$array_contrat['text_descrip'],
                   "Contra_time"=>$array_contrat['inp_time_service'],
                   "Contra_time_contrat"=>date('Y-m-d h:i:s'),
                   "Contra_time_ini"=>$array_contrat['inp_time_ini'],
                   "Contra_time_fin"=>$array_contrat['inp_time_fin'],
                   "Contra_Form_pago"=>$array_contrat['slt_tip_pago'], 
                   "Contra_id_vended"=>$vende,
                   "Contra_costo"=>$prec_cost,
                   "Contra_Form_cuota"=>$array_contrat['inp_time'],
                   "Contra_ciud"=>$array_contrat['slt_ciudad'],
                   "Contra_stado"=>2);
    $data = parent::inserta('contrato',$array);
    return $data;
  }

  public function Modify_contrato($array_ = array()){
    $servi = $array_['slt_descrip_servi'];
    $time = $array_['inp_time_servi'];
    $timeini = $array_['inp_fech_in'];
    $timefin = $array_['inp_fech_fn'];
    $form_pag = $array_['slt_form_pag'];
    $form_cuot = $array_['inp_cuot'];
    $servi_tect = $array_['options_']; //requiere servicio tecnico
    $pri = $array_['slt_priori']; // prioridad
    $cost = $array_['inp_cost_new']; // nuevo costo
    $descrp_report = $array_['inp_report_desc'];  //  
    $id = $array_['id_num_contrat'];
    $pos = strpos($id,"-");
    $fecha_id = substr($id,0,$pos);
    $num = substr($id,$pos+1,strlen($id));
    if($cost == 0 or $cost == null){
      $sql = 'SELECT Contra_costo
              FROM contrato 
              WHERE Id_contrat = '.$fecha_id.'
              AND Contra_id_no = '.$num;
      $result = parent::consultas($sql);
      $cost = $result[0]['Contra_costo'];
    }
    if($array_['options_'] == "si" and isset($descrp_report) and !empty($descrp_report)){
      $descript = strip_tags($descrp_report);
      $descript = utf8_encode($descript);
      $array_coment = array("Coment_id"=>$fecha_id."-".$num,
                            "Coment_tipo"=>1,
                            "Coment_text"=>$descript);
      $respon = parent::inserta("comentarios",$array_coment);
    }
    if(isset($pri) and !empty($pri)){
      if($pri == 0){
        $pri = null;
      }
    }else{
      $pri = null;
    }
    if($servi_tect == "si"){
      $stado = 3;
    }else if($servi_tect == "no"){
      $stado = 1;
    }
    $updat = 'UPDATE contrato 
              SET Contra_id_contr = '.$servi.',
              Contra_time = '.$time.',
              Contra_time_ini = "'.$timeini.'",
              Contra_time_fin = "'.$timefin.'",
              Contra_Form_pago = "'.$form_pag.'",
              Contra_costo = '.$cost.',
              Contra_servi_tecni = "'.$servi_tect.'",
              Contra_servi_tec_pri = '.$pri.',
              Contra_Form_cuota = "'.$form_cuot.'",
              Contra_stado = '.$stado.'
              WHERE Id_contrat = '.$num.'
              AND Contra_id_no = '.$fecha_id;
    $respon = parent::update_query($updat);         
    return $respon;
  }

  // buscar el costo del servicio por el codigo del contrato
  public function Get_cost_by_service($id){
    $sql = 'SELECT Servi_cost
            FROM servicios_prestado 
            WHERE Servi_id = '.$id;
    $response = parent::consultas($sql);
    return $response['Servi_cost'];
  }

  public function Get_contratos_by_state($state){
    $sql = 'SELECT Contra_id_contr 
        FROM contrato
        WHERE Contra_stado = '.$state; 
    $response = parent::consultas($sql);
    return $response;
  }

  public function Get_all_contrato_active(){
    $sql = 'SELECT COUNT(*) as cant
            FROM contrato 
            WHERE Contra_stado = 1';
    $response = parent::consultas($sql);
    return $response;
  }

  // obtiene la cantidad de contratos por ciudad
  public function Get_count_contrato_by_city(){
   $sql = 'SELECT CONVERT(ciu.Ciudad_nomb USING utf8) as nomb,COUNT(*) as cant
           FROM contrato cont 
           INNER JOIN ciudad ciu ON ciu.Ciudad_id = cont.Contra_ciud 
           GROUP BY 1';
   $response = parent::consultas($sql);
   return $response;
  }

  public function Get_all_contrato(){
    $sql = 'SELECT Id_contrat,Contra_id_client,Contra_id_contr,Contra_time,Contra_time_contrat, Contra_time_ini,Contra_time_fin,Contra_stado 
            FROM contrato';
    $response = parent::consultas($sql);
    return $response;
  }

  public function Get_id_contrato_by_id_gestion($id){
    $sql = 'SELECT Gestion_id_tip as id
            FROM gestion_stra 
            WHERE Gestion_id_auto = '.$id;
    $data = parent::consultas($sql);
    return $data;
  }
 

  // devuelve toda la informacion del contrato
  public function Get_contrato_by_id($id){
    if(strpos($id,"-") > 0){
      $v = explode("-",$id);
      $ide = $v[0];
    }else{
      $ide = $id;
    }
    $sql = 'SELECT CONCAT(Contra_id_no,"-",Id_contrat) as id,Contra_id_client as id_cli,Empres_nomb as nomb_empr
    ,CONCAT(emple_nomb," ",emple_apell) as employed,Contra_id_vended as id_vende,Contra_id_contr as id_servi,Servi_id_tip as id_servi_princi,Contra_time as tiempo_contrat,Contra_time_contrat as time_done,Contra_time_ini as time_ini,Contra_time_fin as time_fin,Contra_stado as estado,Contra_costo as cost, Servi_nomb as serv_nom,Servi_cost as servi_cost,Servi_tiem as time_service,Tipo_nomb as servi_princi,Contra_Form_cuota as cuota,Contra_Form_pago,CONCAT(cli.Client_nom," ",cli.Client_apell) as nomb_cli,cli.Client_email as mail_cli,cli.Client_dire as dir
      FROM contrato con  
      INNER JOIN empresa_stra em ON em.Empres_nit = con.Contra_id_client 
      INNER JOIN empleados emp ON emp.emple_id = con.Contra_id_vended 
      INNER JOIN clientes_stra cli ON cli.Client_id = em.Empres_id_client 
      INNER JOIN servicios_prestado sp ON sp.Servi_id = con.Contra_id_contr 
      INNER JOIN tipo_servicio ts ON ts.Tipo_id = sp.Servi_id_tip 
      WHERE Id_contrat = '.$ide;
      $response = parent::consultas($sql);
      return $response;
  }
  
  // Devuelve todos los contratos que no estan activos aun
  public function Get_all_contrato_without_active(){
    $sql = 'SELECT Id_contrat,Contra_id_no,Contra_time_contrat,Servi_nomb
            FROM contrato con
            INNER JOIN servicios_prestado sp ON sp.Servi_id = con.Contra_id_contr 
            WHERE Contra_stado = 2';
    $response = parent::consultas($sql);
    return $response;
  }

  public function Get_all_pagos_by_month($mes){
    $sql = "SELECT Id_contrat 
            FROM contrato 
            WHERE '.$mes.' BETWEEN (DATE_FORMAT(Contra_time_ini,'%Y-%m'),DATE_FORMAT(Contra_time_fin,'%Y-%m'))
            AND Contra_stado = 1";
    $response = parent::consultas($sql);
    return $response;
  }

  public function Get_all_contrato_by_empre($id){
    $sql = 'SELECT Id_contrat,sp.Servi_nomb as nombre_servicio,Contra_descrip,SUM(pago_costo) as pagos_abonados,Contra_time_ini,Contra_time_fin,Contra_time,Contra_Form_pago,Contra_costo,Contra_stado,Contra_cost_abona,sp.Servi_cost as total      
            FROM contrato contra 
            INNER JOIN servicios_prestado sp ON sp.Servi_id = contra.Contra_id_contr 
            LEFT JOIN pagos_str pag ON pag.pago_id_contrat = contra.Id_contrat 
            WHERE Contra_id_client = "'.$id.'"'; 
    $response = parent::consultas($sql);
    return $response;
  } 

 
  
}