<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('../Modelo/Factura.php');
require_once('Inserciones.php');


class Facturacion extends factura{

	private $id_factura = 0;
	public function __construct($cedula){
		parent::__construct($cedula);
		parent::set_fecha();
	}

	public function get_id_factura(){
		return $this->id_factura;

	}
	public function facturar_detalles(){
		foreach($_SESSION["carrito"] as $articulos){
			foreach($articulos as $art){
				parent::add_detalle($art["codigo"],$art["nombre"],$art["cantidad"],$art["costo"]);
	 		}
		}
	}

	public function agrega_facturacion_db(){
		$inserta = new Inserciones();
		$verificar = $inserta->inserta("Factura",array("Fact_cod"=>'',
										  "Fact_fecha"=>parent::get_fecha(),
										  "Fact_cod_client"=>parent::get_codigo_cliente(),
										  "Fact_total"=>parent::get_costo_total(),
										  "Fact_Cancelado"=>2)); //
		if(array_key_exists("exito",$verificar)){
			$this->id_factura = $verificar["last_cod_id"];
			foreach(parent::mostrar() as $fact){
				$verifica_detalle = $inserta->inserta("Orden_Compra",array("Ord_cod"=>'',
																		"Ord_Prod_cod"=>$fact["codigo"],
																		 "Ord_cant"=>$fact["cantidad"],
																		 "Ord_cost"=>$fact["costo"],
																		 "Ord_Fact_cod"=>$this->get_id_factura()));
			}
			if(array_key_exists("exito",$verifica_detalle)){
				echo $verifica_detalle["exito"];
			
			}elseif(array_key_exists("error",$verifica_detalle)){
				echo "Presenta un error en la insercion de detalles de compra";
			}	
								
		}elseif(array_key_exists("error",$verificar)){
			echo "Error numero: ".$verificar['error'];
		}else{
			echo "algo esta fallando";
		}
		$inserta->cerrar_conexion();
	}

}
?>