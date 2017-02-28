<?php
if(file_exists("../Controller/conectar.php")){
 include_once('../Controller/conectar.php');    
}else if(file_exists("Controller/conectar.php")){
  include_once('Controller/conectar.php');   
}
class Empresa extends Conectar{
  
  public function __construct(){
  	parent::__construct();
  }

  public function Set_empresa($nit,$nomb,$tel,$dir,$ciud,$id){
  	$array = Array('Empres_nit'=>$nit,
  				   'Empres_nomb'=>$nomb, 
  				   'Empres_tel'=>$tel, 
  				   'Empres_dir'=>$dir, 
  				   'Empres_ciud'=>$ciud,
  				   'Empres_id_client'=>$id
  				  );
  	$respon = parent::inserta("empresa_stra",$array);
    return $respon;
  }

  public function Get_empresa($id){
  	$sql = 'SELECT Empres_nomb,Empres_dir,Empres_tel,Empres_dir,ciud.Ciudad_nomb as Empres_ciud,Empres_id_client
						FROM empresa_stra emp
            INNER JOIN ciudad ciud ON ciud.Ciudad_id = emp.Empres_ciud
            WHERE Empres_nit ='.$id;	
    $respon = parent::consultas($sql); 
  	return $respon;
  }

  public function Get_empresa_por_client($id){
  	$sql = 'SELECT Empres_nit,Empres_nomb,Empres_dir,Empres_ciud
            FROM empresa_stra 
            WHERE Empres_id_client = '.$id;
    $datos = parent::consultas($sql); 
  	return $datos;
  }

  public function Set_documentos($nit,$file1,$file2,$file3){
  	$array = Array("Document_id"=>$nit,
  				         "Document_cam_comer"=>$file1,
  				         "Document_fot_ced"=>$file2,
  				         "Document_rut"=>$file3);
  	$respon = parent::inserta("document_client",$array);
    return $respon;
  }
 
  public function Get_documentos($nit){
  	$sql = 'SELECT Document_cam_comer as camara,Document_fot_ced as cedu,Document_rut as rut
						FROM document_client
						WHERE Document_id = '.$nit;	
    $datos = parent::consultas($sql); 
  	return $datos;	
  }

  public function Get_contratos($nit){
  	 $sql = 'SELECT Id_contrat,Contra_id_client,Contra_id_contr,Contra_descrip,Contra_time_ini,Contra_time_fin,Contra_stado
		    FROM contrato
        WHERE Contra_id_client = '.$nit;	
    $datos = parent::consultas($sql); 
  	return $datos;	
  }

  public function Get_facturas($id_contrat){
     $sql = 'SELECT Fact_id,Fact_id_client,Fact_id_contrat,Fact_fecha,fact_fecha_final,Fact_total,Fact_cancelado
						FROM factura_stra 
            WHERE Fact_id_contrat = '.$id_contrat;	
     $respon = parent::consultas($sql);        
  	return $respon;	
  }
}



?>