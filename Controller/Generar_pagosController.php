<?php 
include_once "../Model/Pagos.php";
$pagos = new Pagos();
if(isset($_GET['valor'],$_GET['cuota'],$_GET['tipo'])){
  $valor = $_GET['valor'];
  $cuot = $_GET['cuota'];
  $tipo = $_GET['tipo'];
}
$valor = $pagos->Generar_cuotas($valor,$cuot,$tipo);
 echo '<table style="width:100%" border="1">
 		<thead>
 		 <th>Valor</th>
 		 <th>Fecha inicio de pago</th>
 		 <th>Fecha fin de pago</th>
 		</thead>
 		<tbody>';
 foreach($valor as $val){
  echo '<tr style="text-align:center">
  		  <td>'.$val['valor'].'</td>
  		  <td>'.$val['fecha_ini'].'</td>
  		  <td>'.$val['fecha_fin'].'</td>
  		  <td></td>
  		</tr>';
	echo '<br>';
 }
echo '</tbody></table>';
?>