<?php
session_start();
include_once "Controller/constante.php";
if(isset($_SESSION['tipo_user_'])){
 if($_SESSION['tipo_user_'] != sha1(empleados_stra)){
   if($_SESSION['tipo_user_'] == sha1(clientes_stra)){
  	 header("location:cliente.php"); 	
   }else{
   	 header("location:login.php");
   }
 }
}else{
	header("location:login.php");
}
?>
<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie ie9" lang="en" class="no-js"> <![endif]-->
<!--[if !(IE)]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->


<!-- Mirrored from demo.thedevelovers.com/dashboard/queenadmin-1.2/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 03 May 2016 15:32:35 GMT -->
<head>
	<title>Perfil</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="QueenAdmin - Beautiful Bootstrap Admin Dashboard Theme">
	<meta name="author" content="The Develovers">
	<!-- CSS -->
	 
	<link href="View/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="View/assets/css/ionicons.css" rel="stylesheet" type="text/css">
	<link href="View/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="View/assets/css/main.css" rel="stylesheet" type="text/css">
	<!-- Google Fonts -->
	<link href='../../../fonts.googleapis.com/css5e3b.css?family=Open+Sans:400italic,300,400,700' rel='stylesheet' type='text/css'>
	<!-- Fav and touch icons -->
	<link rel="apple-touch-icon-precomposed" type="image/png" sizes="144x144" href="View/assets/ico/queenadmin-favicon144x144.png">
	<link rel="apple-touch-icon-precomposed" type="image/png" sizes="114x114" href="View/assets/ico/queenadmin-favicon114x114.png">
	<link rel="apple-touch-icon-precomposed" type="image/png" sizes="72x72" href="View/assets/ico/queenadmin-favicon72x72.png">
	<link rel="apple-touch-icon-precomposed" type="image/png" sizes="57x57" href="View/assets/ico/queenadmin-favicon57x57.png">
	<link rel="stylesheet" href="View/assets/css/skins/blue.css" type="text/css">
	<link rel="shortcut icon" href="View/assets/ico/favicon.ico">
	<link rel="stylesheet" href="View/css/fileinput.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap.datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
	<style type="text/css">
		#map-canvas {        
		 height: 400px;
		 width: 600px;        
		}
	</style>
</head>
<body class="fixed-top-active dashboard">
	<!-- WRAPPER -->
	<div class="wrapper">
		<!-- TOP NAV BAR -->
		<nav class="top-bar navbar-fixed-top" role="navigation">
			<div class="logo-area">
				<a href="#" id="btn-nav-sidebar-minified" class="btn btn-link btn-nav-sidebar-minified pull-left"><i class="icon ion-arrow-swap"></i></a>
				<a class="btn btn-link btn-off-canvas pull-left"><i class="icon ion-navicon"></i></a>
				
			</div>
			<form class="form-inline searchbox hidden-xs" role="form">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"><i class="icon ion-ios-search"></i></span>
						<input type="search" class="form-control" placeholder="search the site ...">
					</div>
				</div>
			</form>
			<div class="top-bar-right pull-right">
				<div class="action-group hidden-xs hidden-sm">
					<ul>
						<!-- skins -->
						
						<!-- end skins -->
						<!-- notification: inbox -->
						<li class="action-item inbox">
							<div class="btn-group">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon ion-ios-email-outline"></i><span class="count">0</span>
								</a>
								<div class="arrow"></div>
								<ul class="dropdown-menu" role="menu" id="menu_inform">
									<li class="menu-item-header">You have 2 unread messages</li>
									<li class="inbox-item clearfix">
										<a href="#">
											<div class="media">
												<div class="pull-left">
													<img class="media-object" src="View/assets/img/user1.png" alt="Antonio">
												</div>
												<div class="media-body">
													<h5 class="media-heading name">Antonius</h5>
													<p class="text">The problem just happened this morning. I can't see ...</p>
													<span class="timestamp text-muted">4 minutes ago</span>
												</div>
											</div>
										</a>
									</li>
									<li class="inbox-item unread clearfix">
										<a href="#">
											<div class="media">
												<div class="pull-left">
													<img class="media-object" src="View/assets/img/user2.png" alt="Antonio">
												</div>
												<div class="media-body">
													<h5 class="media-heading name">Michael</h5>
													<p class="text">Hey dude, cool theme!</p>
													<span class="timestamp text-muted">2 hours ago</span>
												</div>
											</div>
										</a>
									</li>
									<li class="inbox-item unread clearfix">
										<a href="#">
											<div class="media">
												<div class="pull-left">
													<img class="media-object" src="View/assets/img/user3.png" alt="Antonio">
												</div>
												<div class="media-body">
													<h5 class="media-heading name">Stella</h5>
													<p class="text">Ok now I can see the status for each item. Thanks! :D</p>
													<span class="timestamp text-muted">Oct 6</span>
												</div>
											</div>
										</a>
									</li>
									<li class="inbox-item clearfix">
										<a href="#">
											<div class="media">
												<div class="pull-left">
													<img class="media-object" src="View/assets/img/user4.png" alt="Antonio">
												</div>
												<div class="media-body">
													<h5 class="media-heading name">Jane Doe</h5>
													<p class="text"><i class="icon ion-reply text-muted"></i> Please check the status of your ...</p>
													<span class="timestamp text-muted">Oct 2</span>
												</div>
											</div>
										</a>
									</li>
									<li class="inbox-item clearfix">
										<a href="#">
											<div class="media">
												<div class="pull-left">
													<img class="media-object" src="View/assets/img/user5.png" alt="Antonio">
												</div>
												<div class="media-body">
													<h5 class="media-heading name">John Simmons</h5>
													<p class="text"><i class="icon ion-reply text-muted"></i> I've fixed the problem :)</p>
													<span class="timestamp text-muted">Sep 12</span>
												</div>
											</div>
										</a>
									</li>
									<li class="menu-item-footer">
										<a href="#">View All Messages</a>
									</li>
								</ul>
							</div>
						</li>
						<!-- end notification: inbox -->
						<!-- notification: general -->
						<li class="action-item general">
							<div class="btn-group">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon ion-ios-bell-outline"></i><span class="count" id="count_notify_tick">0</span>
								</a>
								<ul class="dropdown-menu" role="menu" id="notifi_all">
									<li class="menu-item-header">You have 8 notifications</li>
									
									
									<li class="menu-item-footer">
										<a href="#">View All Notifications</a>
									</li>
								</ul>
							</div>
						</li>
						<!-- end notification: general -->
					</ul>
				</div>
				<div class="logged-user">
					<div class="btn-group">
						<a href="#" class="btn btn-link dropdown-toggle" data-toggle="dropdown">
							<img style="height:50px;width:60px;position:relative;" src="View/img/employed/<?php echo $_SESSION['user_foto'];?>" alt="" /><span class="name"><?php echo utf8_encode($_SESSION['user_nomb']); ?> <i class="icon ion-ios-arrow-down"></i></span>
						</a>
						<ul class="dropdown-menu" role="menu">
							<li>
								<a href="#">
									<i class="icon ion-ios-person"></i>
									<span class="text">Perfil</span>
								</a>
							</li>
							<li>
								<a href="#">
									<i class="icon ion-ios-gear"></i>
									<span class="text">Configuracion</span>
								</a>
							</li>
							<li>
								<a href="#" id="log_out">
									<i class="icon ion-power" ></i>
									<span class="text">Cerrar Sesion</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="action-group visible-lg-inline-block">
					<ul>
						<li class="action-item chat">
							<a href="#" id="toggle-right-sidebar" class="toggle-right-sidebar"><i class="icon ion-ios-chatboxes-outline"></i><span class="count">5</span></a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- END TOP NAV BAR -->
		<!-- COLUMN LEFT -->
		<div id="col-left" class="col-left">
			<div class="main-nav-wrapper">
				<nav id="main-nav" class="main-nav">
					<h3>MAIN</h3>
					<ul class="main-menu">
						

								
					</ul>					
					<ul class="main-menu" id="menu_opcion">
					</ul>

				</nav>
			</div>
		</div>
		<!-- END COLUMN LEFT -->
		<!-- COLUMN RIGHT -->
		<div id="col-right" class="col-right ">
			<div class="container-fluid primary-content">
				<!-- PRIMARY CONTENT HEADING -->
				<div class="primary-content-heading clearfix">
					<h2>Principal</h2>
					<ul class="breadcrumb pull-left">
						<li><i class="icon ion-home"></i><a href="index.php">Inicio</a></li>
						
					</ul>
					
					<!-- quick task modal -->
					<div class="modal fade" id="quick-task-modal" tabindex="-1" role="dialog" aria-hidden="true">
						
					</div>
					<!-- end quick task modal -->
				</div>
				<!-- END PRIMARY CONTENT HEADING -->
				<div class="widget widget-no-header widget-transparent bottom-30px" id="menu1">
				  <?php
  				   if($_SESSION['user_carg'] == 1000 and $_SESSION['user_tipo'] == "Jefe"){
     				 include_once "View/template/opcion_administrativo.php";
  				   }
				  ?>  	  
				</div>
					<!-- END QUICK SUMMARY INFO -->
				
				
				
			<div class="right-sidebar">7
				<!-- CHAT -->
				<div class="widget widget-chat-contacts">
					<div class="widget-header clearfix">
						<h3 class="sr-only">CHAT</h3>
						<div class="btn-group btn-group-justified widget-header-toolbar visible-lg">
							<div class="btn-group">
								<button type="button" class="btn btn-primary btn-xs"><i class="icon ion-plus-circled"></i> Add</button>
							</div>
							<div class="btn-group">
								<button type="button" class="btn dropdown-toggle btn-xs btn-success" data-btnclass="btn-success" data-toggle="dropdown">Online <span class="caret"></span></button>
								<ul class="dropdown-menu dropdown-menu-right chat-status" role="menu">
									<li><a href="#" class="online" data-btnclass="btn-success">Online</a></li>
									<li><a href="#" class="away" data-btnclass="btn-warning">Away</a></li>
									<li><a href="#" class="busy" data-btnclass="btn-danger">Busy</a></li>
									<li><a href="#" class="offline" data-btnclass="btn-default">Offline</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="widget-content">
						<strong>Online (4)</strong>
						<ul class="list-unstyled chat-contacts">
							<li>
								<a href="#" id="theusername"><img src="View/assets/img/user1.png" class="img-circle" alt="Antonius">Antonius</a>
							</li>
							<li>
								<a href="#"><img src="View/assets/img/user2.png" class="img-circle" alt="Antonius">Michael Smith</a>
							</li>
							<li class="away">
								<a href="#"><img src="View/assets/img/user3.png" class="img-circle" alt="Antonius">Stella Ray</a>
							</li>
							<li class="busy">
								<a href="#"><img src="View/assets/img/user4.png" class="img-circle" alt="Antonius">Jane Doe</a>
							</li>
						</ul>
						<strong>Offline (6)</strong>
						<ul class="list-unstyled chat-contacts contacts-offline">
							<li>
								<a href="#"><img src="View/assets/img/user5.png" class="img-circle" alt="John Simmons">John Simmons</a>
							</li>
							<li>
								<a href="#"><img src="View/assets/img/user6.png" class="img-circle" alt="Jack Bay">Jack Bay</a>
							</li>
							<li>
								<a href="#"><img src="View/assets/img/user7.png" class="img-circle" alt="Daraiana">Daraiana</a>
							</li>
							<li>
								<a href="#"><img src="View/assets/img/user8.png" class="img-circle" alt="Alessio Ferrara">Alessio Ferrara</a>
							</li>
							<li>
								<a href="#"><img src="View/assets/img/user9.png" class="img-circle" alt="Sorana">Sorana</a>
							</li>
							<li>
								<a href="#"><img src="View/assets/img/user10.png" class="img-circle" alt="Regan Morton">Regan Morton</a>
							</li>
						</ul>
					</div>
				</div>
				<!-- END CHAT -->
			</div>
		</div>
		<!-- END COLUMN RIGHT -->
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->


	<script src="View/assets/js/jquery/jquery-2.1.0.min.js"></script>
	<script type="text/javascript">
	  $(document).ready(function(){
  	   $.ajax({
        url: "Controller/UserController.php",
        dataType: "html",
        async: false,           // <-- This is the key
        data:{"get_menu":"all"},
        type:"post"
       }).done(function(data){
        $(data).appendTo($("#menu_opcion"));
       });
      });
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMI0YtR9vefzDJmht_CK5Y9Cs0g_fmJIk&callback=initialize"></script>
    <script type="text/javascript" src="View/js/servicio_tecnico/google_mapa.js"></script>
    <script type="text/javascript" src="View/js/servicio_tecnico/viabilidad_tecnica.js"></script>
    
	<script src="View/assets/js/plugins/moment/moment.min.js"></script>
	<script src="View/assets/js/bootstrap/bootstrap.js"></script>
	<script src="View/assets/js/plugins/bootstrap-multiselect/bootstrap-multiselect.js"></script>
	<script src="View/assets/js/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="View/assets/js/queen-common.js"></script>
	<script src="View/assets/js/plugins/summernote/summernote.min.js"></script>
	<script src="View/assets/js/plugins/markdown/markdown.js"></script>
	<script src="View/assets/js/plugins/markdown/to-markdown.js"></script>
	<script src="View/assets/js/plugins/markdown/bootstrap-markdown.js"></script>
	<script src="View/assets/js/plugins/stat/flot/jquery.flot.min.js"></script>
	<script src="View/assets/js/plugins/stat/flot/jquery.flot.resize.min.js"></script>
	<script src="View/assets/js/plugins/stat/flot/jquery.flot.time.min.js"></script>
	<script src="View/assets/js/plugins/stat/flot/jquery.flot.orderBars.js"></script>
	<script src="View/assets/js/plugins/stat/flot/jquery.flot.tooltip.min.js"></script>
	<script src="View/assets/js/plugins/mapael/raphael/raphael-min.js"></script>
	<script src="View/assets/js/plugins/mapael/jquery.mapael.js"></script>
	<script src="View/assets/js/plugins/mapael/maps/world_countries.js"></script>
	<script src="View/assets/js/plugins/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
	<script src="View/assets/js/plugins/moment/moment.min.js"></script>
	<script src="View/assets/js/plugins/bootstrap-editable/bootstrap-editable.min.js"></script>
	<script src="View/assets/js/plugins/jquery-maskedinput/jquery.masked-input.min.js"></script>
	<script src="View/assets/js/queen-charts.js"></script>
	<script src="View/assets/js/queen-maps.js"></script>
	<script src="View/assets/js/queen-elements.js"></script>
	<script src="View/js/plugins/canvas-to-blob.min.js" type="text/javascript"></script>
	<script src="View/js/fileinput.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/bootstrap.datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

</body>


<!-- Mirrored from demo.thedevelovers.com/dashboard/queenadmin-1.2/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 03 May 2016 15:33:27 GMT -->
</html>



<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Respuesta</h4>
      </div>
      <div class="modal-body">
        <div class="widget-content">
		  <p>Respuesta que se le dio al cliente</p>
		  <textarea class="form-control textarea-with-counter" rows="6" cols="30" maxlength="99" id="txt_respon_user"></textarea>
		  <p class="help-block text-right textarea-msg"><span class="text-muted"></span></p>
		</div>
		<div class="widget-content">
		 <label class="control-inline fancy-radio">
			<input name="inline-radio" class="estado_ticket" value="2" type="radio">
			<span name="" id="2"><i></i>Finalizar</span>
		 </label>	
		  <label class="control-inline fancy-radio">
			<input name="inline-radio" class="estado_ticket" value="1" type="radio">
			<span id="1"><i></i>Canalizar</span>
		  </label>
		  <div class="widget-content">
		 	<div class="form-group">
		 		<div class="control-inline">
		 			<select class="form-control sltd_opcion_departa"  style="display:none;">
		 				<option></option> 
		 			</select>	
		 		</div>
		 		<div class="control-inline">
		 			<select class="form-control sltd_empleado"  style="display:none;">
		 				<option></option>
		 			</select> 
		 		</div>
			</div>
		  </div>		
		</div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="id_ticket_hidden">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn_save_respon">Guardar</button>
      </div>
    </div>
  </div>
</div>
<div id="motivo_ticket" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="modal-header alert alert-warning fade in">
		  <i class="icon ion-alert-circled"></i>
		  <strong></strong> Por favor, indicar el motivo por el que no se canalizo en algun departamento
      </div>
		<form class="form-horizontal" role="form">
		  <div class="form-group">
			<label class="control-label sr-only">Descripcion</label>
			<div class="col-sm-12">
		  	 <textarea class="form-control" id="txt_respon_clien" name="task-description" rows="5" cols="30" placeholder="Resumen de respuesta al cliente"></textarea>
			</div>
		  </div>
		  <button type="button" class="btn btn-primary" id="btn_respon_ticket">Guardar Respuesta</button>
		</form>
	   </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_pregun" tabindex="-1" role="dialog" >
  <div class="modal-dialog">
    <div class="modal-content" style="width: 80%;">
      <div class="modal-header">
        <div class="alert alert-danger" role="alert"><strong>Por favor, Busque el representante de la empresa que va a registrar</strong></div>
        <div class="row">
          <div class="col-md-8">
          	<input type="text" class="form-control" id="inp_search_client">
          </div>
          <div class="col-md-4">
          	 <button class="btn btn-success btn-block" id="btn_search_client_empre"> <span class="glyphicon glyphicon-search"></span></button>
          	 </div>
        </div> 

      </div>
      <div class="modal-body">
        <div class="col-md-12">
      	  <div class="col-md-12">
      	    <table id="mytable" class="table table-bordred table-striped">
              <thead>     
               <th>Seleccionar</th>
               <th>Id del cliente</th>
               <th>Nombre</th>
               <th>Apellido</th>
              </thead>
    		  <tbody id="tbody_client">
    		  </tbody>
			</table>
      	  </div>
        </div>
      	<div class="modal-footer">
        	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        	<button type="button" class="btn btn-primary" data-dismiss="modal" id="btn_acept_id_clien">Aceptar</button>
      	</div>
      </div><!-- /.modal-content -->
  	</div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</div>

<div class="modal fade" id="modal_buscar_empre" tabindex="-1" role="dialog" >
  <div class="modal-dialog">
    <div class="modal-content" style="width: 80%;">
      <div class="modal-header">
      </div>
      <div class="modal-body">
        <div class="col-md-12">
      	  <div class="col-md-12">
      	    <table id="mytable" class="table table-bordred table-striped">
              <thead>    
               <th>Seleccionar</th>
               <th>Nit Empresa</th>
               <th>Telefono</th>
              </thead>
    		  <tbody id="tbody_empresa"> 
    		  </tbody>
			</table>
      	  </div>
        </div>
      	<div class="modal-footer">
        	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        	<button type="button" class="btn btn-primary"  id="btn_acept_nit_empre">Aceptar</button>
      	</div>
      </div><!-- /.modal-content -->
  	</div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</div>


<div id="myModal_opcion" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modal_title_opcion"></h4>
      </div>
      <div class="modal-body">
       <table class="table table-hover">
       	 <thead>
       	  <tr class="info">
       	   <th style="color:black"><b>Seleccionar</b></th>
       	   <th style="color:black"><b>Nit Empresa</b></th>
       	   <th style="color:black"><b>Empresa</b></th>
       	  </tr>
       	 </thead>
       	 <tbody id="modal_body_opcion">
       	 </tbody>
       </table>
        <p></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn_acept_option">Seleccionar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="myModal_msn" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modal_title"></h4>
      </div> 
      <div class="modal-body" id="msn_info">
      </div>
      <div class="modal-footer" id="modal_accion">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




<?php 
echo  "<script> var id_recibe = btoa(".$_SESSION['id_user'].");
	 		 	var id_cargo = btoa(".$_SESSION['user_carg'].");
	   </script>";
?>

<script src="View/js/menu_dropdown_session.js"></script>
<script type="text/javascript" src="View/js/ticket.js"></script>
<script type="text/javascript" src="View/js/plugins/prettydate.js"></script>
<script type="text/javascript" src="View/js/get_dashboard.js"></script>



<script type="text/javascript">
  $(function(){
	$('.fecha').datetimepicker();
	$("#datetimepicker1").data("DateTimePicker");
	function Peticion_ticket(){
	  $("#notifi_all").html("");	
	  $.post("Controller/Ticket/Ticket.php",{"ticket_by_employed":"as"},function(data){
	  	var data = $.parseJSON(data);
	   if(data[0].id){	
	  	$("#count_notify_tick").html(data.length);  
	  	$.each(data,function(key,val){
	     var t = '<li>\
			<a class="notifi_ticket" href="#">\
			  <i class="icon ion-chatbubble text-success"></i>\
			    <span class="text">Ticket Nuevo</span>\
			    <span class="timestamp text-muted">'+"fecha : "+val.fecha+" hora : "+val.hora+'</span>\
			</a>\
		   </li>';
		   $(t).appendTo($("#notifi_all"));
	  	});
	   }else{
	   	$("#count_notify_tick").html(0);  
	   	var t = '<li>\
			<a href="#">\
			  <i class="icon ion-chatbubble text-success"></i>\
			    <span class="text">No hay tickets nuevos</span>\
			</a>\
		   </li>';
		   $(t).appendTo($("#notifi_all"));
	   }
	  });
	}
	Peticion_ticket();
	setInterval(function(){
	  Peticion_ticket();
	},20000);
	$("#modal_write").modal('show');


	
  });
</script>

<?php
  if($_SESSION['user_carg'] == 1000 and $_SESSION['user_tipo'] == "Jefe"){ ?>
    <script type="text/javascript" src="View/js/contrato/contrato_para_activar.js"></script>
    <script type="text/javascript" src="View/js/confi_admin.js"></script>
    <script type="text/javascript" src="View/js/buscar_cliente.js"></script>
  	<script type="text/javascript" src="View/js/agregar_empleado.js"></script>
	<script type="text/javascript" src="View/js/agregar_cliente.js"></script>
	<script type="text/javascript" src="View/js/agregar_servicio.js"></script>
	<script type="text/javascript" src="View/js/configuracion.js"></script>
	<script type="text/javascript" src="View/js/contrato.js"></script>
	<<script type="text/javascript" src="View/js/Servicio_tecnico.js"></script>
	<script type="text/javascript" src="View/js/Compras.js"></script>
	<script type="text/javascript" src="View/js/registro_material.js"></script>-->
	<!--<script src="View/js/buscar_cliente.js"></script>-->
<?php  
  }

  if($_SESSION['user_carg'] == 1008){  ?>
    <script type="text/javascript" src="View/js/Servicio_tecnico.js"></script>
    <script type="text/javascript" src="View/js/registro_material.js"></script>
<?php
  }
?> 

<script type="text/javascript">
	$(function(){	
		$("input[type='file']").fileinput({
     		language: 'en',
     		showCaption: true,
     		showPreview: true,
     		showRemove: true,
     		showUpload: false, // <------ just set this from true to false
    		showCancel: true,
     		showUploadedThumbs: true
    	});
    	$("input[name='file']").fileinput({
    	 language: 'en',
    	 showCaption: true,
    	 showPreview: true,
    	 showRemove: true,
    	 showUpload: false, // <------ just set this from true to false
    	 showCancel: true,
    	 showUploadedThumbs: true
  	    });
	});
	$(document).ready(function(){
	 var my_posts = $("[rel=tooltip]");

	 var size = $(window).width();
	 for(i=0;i<my_posts.length;i++){
		the_post = $(my_posts[i]);

		if(the_post.hasClass('invert') && size >=767 ){
			the_post.tooltip({ placement: 'left'});
			the_post.css("cursor","pointer");
		}else{
			the_post.tooltip({ placement: 'rigth'});
			the_post.css("cursor","pointer");
		}
	 }
	 
});
</script> 



<script type="text/javascript">
  $(function(){
  	function Obtener_dashboard(){
	  var param = {"accion":"get_dashboard"};
	  $.post("Controller/Reporte/Reporte.php",{"request":JSON.stringify(param)},function(data){
   	    var data = $.parseJSON(data);
   	    var ticket = data.ticket;
   	    var client = data.client;
   	    var contrat = data.contrat;
   	    var ticket_ciudad = ticket.ticket_ciudad; 
   	    var ticket_comun = ticket.ticket_comunes; 
   	    var ticket_area = ticket.ticket_by_area;
   	    var ticket_gestion = ticket.ticket_gestion;
   	    var client_cant = client.client_cant;
   	    var contrat_cant = contrat.contrat_cant;
   	    if(ticket_comun){
   	    	$.each(ticket_comun,function(key,val){
   	    		// max event cant 
   	    	  var t = '<li>\
					    <p>'+val.event+'<span class="label label-danger">23%</span></p>\
										<div class="progress progress-xs">\
											<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="23" aria-valuemin="0" aria-valuemax="100" style="width:23%">\
												<span class="sr-only">23% Complete</span>\
											</div>\
										</div>\
									</li>';
   	    	  $(t).appendTo($("#list_ticket_frecuent"));
   	    	});
   	    }

   	    if(ticket_area){
   	    	$.each(ticket_area,function(key,val){
   	    	  var t = '<tr><td><span class="label label-warning">Pendiente</span></td><td>'+val.depart+'</td><td>'+val.cant+'</td></tr>';
   	    	  $(t).appendTo($("#tbody_list_ticket")); 
   	    	});
   	    }

   	    if(ticket_gestion){
   	    	$.each(ticket_gestion,function(key,val){
   	    	  var t = '<tr><td>'+val.nomb+'</td><td>'+val.cant+'</td><td>'+val.cant2+'</td></tr>';
   	    	  $(t).appendTo($("#list_tickets_gestion"));
   	    	});
   	    }

   	    if(client_cant){
   	      $("#cant_client").text(client_cant.cant)
   	    }
   	    if(contrat_cant){
   	      $("#cant_contrat").text(contrat_cant.cant);
   	    }
	  });
	}

	Obtener_dashboard();
  });	
</script>



<!-- https://developers.google.com/maps/documentation/javascript/examples/?hl=es-419 -->