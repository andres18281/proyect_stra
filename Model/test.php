<!DOCTYPE html>
<html>
<head>
<?php
session_start();
 if(!isset($_SESSION['conta'])){
  $_SESSION['conta'] = 0;
 }
 if(!isset($_SESSION["validar"])){
   $_SESSION["validar"] = "no";	
 }

  echo "valor de validar ".$_SESSION['validar'].'<br>';
  echo "TotalAmount  = ".$_SESSION["TotalAmount"].'<br>'; 
  echo "TotalAmount_old = ".$_SESSION['TotalAmount_old'].'<br>';
  if(isset($_REQUEST['validator']) and $_REQUEST['validator'] == "LV5MAY14" and $_SESSION['validar'] == "no"){
    $total = $_SESSION["TotalAmount"]; 
    $_SESSION['TotalAmount_old'] = $total;
    $descuent = $total* 0.20;
    $total = $total - $descuent;
    $_SESSION["TotalAmount"] = $total;
    $_SESSION["validar"] = "si";
    $data['exito'] = "exito";
    echo "precio viejo = ".$_SESSION['TotalAmount_old'].'<br>';
    echo "precio nuevo = ".$_SESSION["TotalAmount"].'<br>';
  }else{
    $_SESSION['conta'] = $_SESSION['conta'] + 1;  
    if($_SESSION['conta'] == 5){
  	$data['exito'] = "limit";
    }else{
      $data['exito'] = "falla";
    }
  }
  echo json_encode($data);

 
?>


	<title></title>
</head>
<body>

</body>
</html>
