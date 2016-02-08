<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('../Modelo/Factura.php');
require_once('../Controlador/Consultas.php'); 
	class Consulta_factura extends factura{
		
		private $consultas;
		private $codigo = 0;
		private $fecha = "";
		private $cedula = 0;
		private $total = 0;
		public function __construct($codigo){
			$this->consultas = new Consultas();
			$this->codigo = $codigo;
			$factu = $this->consultas->consulta_factura_codigo($this->codigo);
			$this->fecha = $factu["fecha"];
			$this->cedula = $factu["cedula"];
			$this->total = $factu["total"];
		}

		public function Consulta_Detalles(){
			$detalles = $this->consultas->consulta_factura_codigo($this->codigo);
			foreach($detalles as $array){
				parent::add_detalle($array["codigo"],$array["nombre"],$array["cantidad"],$array["costo"]);
			}
			return parent::mostrar();
		}

		public function get_cedula(){
			return $this->cedula;
		}

		public function get_fecha(){
			return $this->fecha;
		}
		public function get_total(){
			return $this->total;
		}
		public function cerrar_factura(){
			$this->consultas->cerrar_conexion();
		}

	}

?>