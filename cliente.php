<?php
session_start();
include_once "Controller/constante.php";
if(isset($_SESSION['tipo_user_'])){
 if($_SESSION['tipo_user_'] != sha1(clientes_stra)){
  header("location:login.php");
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
							<img style="height:50px;width:60px;position:relative;" src="View/img/employed/<?php //echo $_SESSION['user_foto'];?>" alt="" /><span class="name"><?php //echo utf8_encode($_SESSION['user_nomb']); ?> <i class="icon ion-ios-arrow-down"></i></span>
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
					<h3>Menui</h3>
					<ul class="main-menu">
						<li class="has-submenu">
		  				  <a href="#" class="submenu-toggle"><i class="icon ion-ios-speedometer-outline"></i><span class="text">Ticket</span></a>
		  				   <ul aria-expanded="true" class="list-unstyled sub-menu collapse in">
		  				    <li id="btn_make_ticket"><a href="#"><span class="text">Crear Ticket</span></a></li>
		  					<li id="btn_show_historial"><a href="#"><span class="text">Revisar historial</span></a></li>
		  				   </ul>
						</li>		
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
				  

					<div class="container-fluid">
   	 <div class="container">
   	  <ul class="nav nav-tabs" role="tablist">
    	<li role="presentation" class="active"><a href="#registro" aria-controls="home" role="tab" data-toggle="tab">Registro de Cliente</a></li>
    	<li role="presentation"><a href="#historial" aria-controls="profile" role="tab" data-toggle="tab">Historial</a></li>
      <li role="presentation"><a href="#datos" aria-controls="datos" role="tab" data-toggle="tab">Datos de Empresa</a></li>
  	  </ul>
  	  <div class="tab-content">
    	<div role="tabpanel" class="tab-pane active" id="registro">
    	 <form name="form_ticket"> 
    	  <div class="container" style="margin-top: 30px;">
    	   <div class="container">
    	    <div class="col-md-3">
    	      <label> Tipo de servicio</label>
    	    </div>
    	    <div class="col-md-3">
    	      <select class="form-control input-md" required name="slt_tipo_serv">
    	      	<option></option>
    	      	<option value="1">Redes</option>
    	      	<option value="2">Hosting</option>
    	      	<option value="3">Internet</option>
    	      </select>	
    	    </div>
    	    <div class="col-md-3">
    	      <label> Tipo de Evento</label>
    	    </div>
    	    <div class="col-md-3">
    	      <select class="form-control input-md" required name="slt_tip_subtipo">
    	      	<option></option>
    	      </select>	
    	    </div>
    	   </div><!--container-->
          <div class="container salto">
           <div class="col-md-3"><label> Departamento</label></div>
           <div class="col-md-3">
            <select class="form-control" required name="slt_departa"> 
             <option></option>
             <option value="76">Valle del cauca</option>
             <option value="63">Armenia</option>
             <option value="05">Antioquia</option>
             <option value="25">Tolima</option>
            </select>
           </div>
            <div class="col-md-3"><label> Ciudad</label></div>
            <div class="col-md-3">
             <select class="form-control" required name="slt_ciudad"> 
              <option></option>
             </select>
            </div>
          </div><!--container-->
    	  <div class="container salto" style="margin-top: 5px;">
    	    <div class="col-md-6">
    	   	 <label>Telefono de Contacto</label><input type="text" required class="form-control" placeholder="Telefono" name="inp_tel"> 
    	   	</div>
    	   	<div class="col-md-6">
    	   	 <label>Celular de Contacto</label><input type="text" required class="form-control" placeholder="Celular" name="inp_cel">
    	   	</div>
    	  </div><!--row-->
    	  <div class="container salto">
            <div class="col-md-12">
    	   	 <label> Descripcion de la peticion</label>
    	   	 <textarea class="form-control" name="txt_descríp" required rows="6"></textarea>
    	    </div>
          </div>
    	  <div class="container salto">
            <div class="col-md-12">
             <div class="col-md-5 col-md-offset-7">
              <br>
              <button type="submit" class="btn btn-success btn-block" id="btn_save_ticket" style="display:block;">Guardar</button>
              <input type="hidden" name="create_ticket_client" value="">
             </div>
            </div>
    	   </div> 
    	  </div><!--container-->
    	 </form>
    	</div>
    	 <div role="tabpanel" class="tab-pane" id="historial">
 		     <div class="container-fluid">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>
                           Fecha
                        </th>
                        <th>
                            Estado
                        </th>
                        <th>
                            Nombre
                        </th>
                         <th>
                            Departamento
                        </th>
                      </tr>
                    </thead>
                    <tbody id="tbody_historial">
                    
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
         </div>
         <div class="container-fluid">
          <div class="panel panel-default">
           <div class="panel-heading">
             <h3 style="text-align: center;"> Historial</h3>
           </div>
           <div class="panel-body">
             <section class="comment-list">
             </section>
           </div>
          </div>
         </div>
    	 </div>
       <div role="tabpanel" class="tab-pane" id="datos">
         <div class="container">
          <div class="row">
            <section class="content">
              <h1>Datos De la empresa</h1>
                <div class="col-md-9">
                  <div class="panel panel-default">
                    <div class="panel-body">
                      <div class="form-group">
                        <label>Nombre de empresa</label>
                        <input type="text" class="form-control" id="inp_nomb_empre" readonly="true">
                      </div>
                      <div class="form-group">
                        <label>Direccion</label>
                        <input type="text" class="form-control" id="inp_dir_empre" readonly="true">
                      </div>
                      <div class="form-group">
                        <label>Telefono</label>
                        <input type="text" class="form-control" id="inp_tel_empre" readonly="true">
                      </div>
                      <div class="form-group">
                        <label>Ciudad</label>
                        <input type="text" class="form-control" id="inp_ciud_empre" readonly="true">
                      </div>
                      <div class="table-container">
                        <table class="table">
                          <tbody>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
            </section>
          </div>
         </div>
       </div>

   	  </div><!--tapcontent-->
     </div><!--container-->
    </div><!--container-fluid-->









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


<script src="View/js/menu_dropdown_session.js"></script>
<!--<script type="text/javascript" src="View/js/ticket.js"></script>-->
<script type="text/javascript" src="View/js/plugins/prettydate.js"></script>


<script type="text/javascript">
	$(function(){
	  var serealizar = function(form){
	  	var json = {};
	  	var form_ = $('form[name='+form+']').serializeArray();
	  	$.each(form_,function(key,val){
	  	  json[val.name] = val.value;	
	  	});
	  	return json;
	  };	
	  
	  $("form[name='form_ticket']").submit(function(e){
	  	e.preventDefault();
	    var form = serealizar('form_ticket');
	    var params = {"form":form}; 
	    $.post("Controller/ticket/TicketController.php",{"accion":JSON.stringify(params)},function(data){
	     var data = $.parseJSON(data);
	     if(data.exito){
	     	alert("Guardado con exito");
	     }	
	    });	
	  });

	  $("select[name='slt_tipo_serv']","form[name='form_ticket']").change(function(){
	  	var val = $(this).val();
	  	$("select[name='slt_tip_subtipo']","form[name='form_ticket']").html("");
	  	var params = {"get_subitem":"","id":val};
	  	$.post("Controller/ticket/TicketController.php",{"accion":JSON.stringify(params)},function(data){
	  	 var data = $.parseJSON(data);
	  	 $.each(data,function(key,val){
	  	 	var t = '<option value='+key+'>'+val+'</option>';
	  	 	$(t).appendTo($("select[name='slt_tip_subtipo']","form[name='form_ticket']"));
	  	 });
	  	});
	  });

	  $("select[name='slt_departa']","form[name='form_ticket']").change(function(){
	  	var id = $(this).val();
	  	$("select[name='slt_ciudad']","form[name='form_ticket']").html("");
	  	$.post("Controller/localizacion/departamento_ciudad.php",{"get_depart":id},function(data){
	  	  var data = $.parseJSON(data);
	  	  $.each(data,function(key,val){
	  	  	var t = '<option value='+key+'>'+val+'</option>';
	  	  	$(t).appendTo($("select[name='slt_ciudad']","form[name='form_ticket']"));
	  	  });
	  	});	
	  });	
	});	
</script>


<!-- http://bootsnipp.com/snippets/W7X6X-->
<!-- https://developers.google.com/maps/documentation/javascript/examples/?hl=es-419 -->