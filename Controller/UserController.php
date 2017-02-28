
<?php 
session_start();
class UserController{
	function __construct(){
	 if($_SERVER['REQUEST_METHOD'] == "POST"){
	   if(isset($_POST['get_menu'])){
	   	//var_dump($_SESSION);
	     if($_SESSION['user_carg'] == 1000 and $_SESSION['user_tipo'] == "Jefe" and $_SESSION['user_depart_user'] == "313fff24a868186d47f9a86daed4c56c0179c5de"){
	  	   $vista = file_get_contents("../View/Admin/menu_admin_general.php");
	       echo $vista;
	     }
	     
	     if($_SESSION['user_carg'] == 1008 and $_SESSION['user_tipo'] == "empleado" and $_SESSION['user_depart_user'] == "3c40f18e470fd418aa069fc5f53bd1667697d3b7"){
	  	   $vista = file_get_contents("../View/template/Servicio_tecnico/Menu_servicio_tecnico.php");
	       echo $vista;
	     }

	     if($_SESSION['user_carg'] == 1008 and $_SESSION['user_tipo'] == "Jefe" and $_SESSION['user_depart_user'] == "3c40f18e470fd418aa069fc5f53bd1667697d3b7"){
	  	   $vista = file_get_contents("../View/template/Servicio_tecnico/Menu_servicio_tecnico_jefe.php");
	       echo $vista;
	     }
	   }
	 } 
	}
}
new UserController();