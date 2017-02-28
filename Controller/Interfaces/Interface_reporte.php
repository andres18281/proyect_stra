<?php

interface Interface_reporte{
	public function Show_ticket_by_city();
	public function Show_ticket_mas_comunes();
	public function Show_ticket_pendiente_by_area();

	public function Show_cant_contrato();
	public function Show_cant_contrato_by_ciudad();
	public function Show_ventas_by_month();

	public function Show_cant_clients();
}

?>