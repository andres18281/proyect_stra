<?php
ob_start();
if(!isset($_SESSION)){
 session_start();
}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<style type="text/css">
		/*
Inspired by http://dribbble.com/shots/917819-iPad-Calendar-Login?list=shots&sort=views&timeframe=ever&offset=461
*/



</style>
</head>
<body style="background-image: url(http://www.mattarconsulting.com/wp-content/uploads/2012/12/dedo_tecnologico_ecm.jpg);background-repeat: no-repeat;background-size: 100% ;">
<div class="container-fluid">
 <div class="col-md-4" style="margin-top: 10%;">
   	
        <div class="panel panel-default" style="opacity: 1;" >
                    <div class="panel-heading" style="background-color: white !important;">
                        <img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcSiXU-4i7Xt8yvbIhka-SsMIRe1p8q1QrJMFN95qf5X7HN4nOVaxY9h6VGT">
                    </div>     

                    <div style="padding-top:30px" class="panel-body"  >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="loginform" class="form-horizontal" role="form" method="post">
                                    
                            <div style="margin-bottom: 25px" class="input-group" style="opacity: 1" >
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="Cuenta">                                        
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="input-group" style="opacity: 1">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="login-password" type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 control">
                                   <button class="btn btn-primary" name="btn_enviar">Ingresar</button>
                                </div>
                           
                            </div>    
                        </form>                          
                    </div>  
        </div>
 </div>
</div>
</body>
</html>
  <script src="https://code.jquery.com/jquery-2.2.0.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<?php
  if(isset($_POST['btn_enviar'])){
    include_once 'Controller/Login.php';
    if(isset($_POST['username'],$_POST['password'])){
    	$user = $_POST['username'];
    	$pass = $_POST['password'];
        $login = new Login($user,sha1($pass));
        $respon = $login->loguearse();
        if($respon){
          header("location:index.php");
        }else{
          echo "<script>alert('Usuario invalido');</script>";
        }
    }else{
        echo "no se conecta";
    }
  }
ob_end_flush(); 
?>