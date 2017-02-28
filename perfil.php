<?php
session_start();

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
									<i class="icon ion-ios-email-outline"></i><span class="count">2</span>
								</a>
								<div class="arrow"></div>
								<ul class="dropdown-menu" role="menu">
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
									<i class="icon ion-ios-bell-outline"></i><span class="count" id="count_notifi">0</span>
								</a>
								<ul class="dropdown-menu" role="menu">
									<li class="menu-item-header">You have 8 notifications</li>
									<li>
										<a href="#">
											<i class="icon ion-chatbubble text-success"></i>
											<span class="text">New comment on the blog post</span>
											<span class="timestamp text-muted">1 minute ago</span>
										</a>
									</li>
									<li>
										<a href="#">
											<i class="icon ion-person-add text-success"></i>
											<span class="text">New registered user</span>
											<span class="timestamp text-muted">12 minutes ago</span>
										</a>
									</li>
									<li>
										<a href="#">
											<i class="icon ion-chatbubble text-success"></i>
											<span class="text">New comment on the blog post</span>
											<span class="timestamp text-muted">18 minutes ago</span>
										</a>
									</li>
									<li>
										<a href="#">
											<i class="icon ion-ios-cart text-danger"></i>
											<span class="text">4 new sales order</span>
											<span class="timestamp text-muted">4 hours ago</span>
										</a>
									</li>
									<li>
										<a href="#">
											<i class="icon ion-edit yellow-font"></i>
											<span class="text">3 product reviews awaiting moderation</span>
											<span class="timestamp text-muted">1 day ago</span>
										</a>
									</li>
									<li>
										<a href="#">
											<i class="icon ion-chatbubble text-success"></i>
											<span class="text">New comment on the blog post</span>
											<span class="timestamp text-muted">3 days ago</span>
										</a>
									</li>
									<li>
										<a href="#">
											<i class="icon ion-chatbubble text-success"></i>
											<span class="text">New comment on the blog post</span>
											<span class="timestamp text-muted">Oct 15</span>
										</a>
									</li>
									<li>
										<a href="#">
											<i class="icon ion-alert-circled text-danger"></i>
											<span class="text text-danger">Low disk space!</span>
											<span class="timestamp text-muted">Oct 11</span>
										</a>
									</li>
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
							<img src="View/assets/img/user-loggedin.png" alt="Sebastian" /><span class="name">Sebastian <i class="icon ion-ios-arrow-down"></i></span>
						</a>
						<ul class="dropdown-menu" role="menu">
							<li>
								<a href="#">
									<i class="icon ion-ios-person"></i>
									<span class="text">Profile</span>
								</a>
							</li>
							<li>
								<a href="#">
									<i class="icon ion-ios-gear"></i>
									<span class="text">Settings</span>
								</a>
							</li>
							<li>
								<a href="#">
									<i class="icon ion-power"></i>
									<span class="text">Logout</span>
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
						<li class="has-submenu active">
							<a href="#" class="submenu-toggle"><i class="icon ion-ios-speedometer-outline"></i><span class="text">Ticket</span></a>
							<ul aria-expanded="true" class="list-unstyled sub-menu collapse in">
								<li class="active" id="menu_ticket"><a href="#"><span class="text">Tickets</span></a></li>
								<li id="menu_registro_ticket"><a href="#"><span class="text">Registrar Ticket</span></a></li>
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
						<li><i class="icon ion-home"></i><a href="#">Home</a></li>
						<li><a href="#">Dashboard</a></li>
						<li class="active">Dashboard v1</li>
					</ul>
					
					<!-- quick task modal -->
					<div class="modal fade" id="quick-task-modal" tabindex="-1" role="dialog" aria-hidden="true">
						
					</div>
					<!-- end quick task modal -->
				</div>
				<!-- END PRIMARY CONTENT HEADING -->
				<div class="widget widget-no-header widget-transparent bottom-30px" id="menu1">
					
					<!-- END QUICK SUMMARY INFO -->
					


				</div>
				
				
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
	<script src="View/assets/js/bootstrap/bootstrap.js"></script>
	<script src="View/assets/js/plugins/bootstrap-multiselect/bootstrap-multiselect.js"></script>
	<script src="View/assets/js/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="View/assets/js/queen-common.js"></script>
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
			<input name="inline-radio" class="estado_ticket" value="1" type="radio">
			<span name="" id="1"><i></i>Finalizar</span>
		 </label>	
		  <label class="control-inline fancy-radio">
			<input name="inline-radio" class="estado_ticket" value="2" type="radio">
			<span id="2"><i></i>Canalizar</span>
		 </label>
		 <select class="form-control" id="sltd_opcion_departa" style="display:none;">
		 	<option></option>
		 </select>		
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn_save_respon">Guardar</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	$(function(){
      var esta;
      $(".estado_ticket").change(function(){
        esta = $(this).val();

      	if($(this).val() == 2){
      	 $("#sltd_opcion_departa").html(""); 	
      	 $("#sltd_opcion_departa").css("display","block");
      	  $.ajax({
      	  	dataType:"json",
      	  	type:"post",
      	  	url:"Controller/Route_config.php",
      	  	data:{"get_departament":"all"},
      	  	success:function(data){
      	     $.each(data,function(key,val){
      	      var t = '<option value='+val.id+'>'+val.nomb+'</option>';
      	      $(t).appendTo($("#sltd_opcion_departa"));
      	     });
      	  	}
      	  });
      	}else{
      	 $("#sltd_opcion_departa").css("display","none");	
      	}
      });

	 function Actualizar_ticket(){	
	  $("tbody_ticket").html("");
	  $.ajax({
	  	dataType:"json",
	  	type:"post",
	  	url:"Controller/Ticket/Ticket.php",
	  	data:{"all_ticket":"jsd"},
	  	success:function(data){
	  	 if(data[0].id){	
	  	  $.each(data,function(key,val){
	  	  	var t = '<tr>\
						<td><a href="#">'+val.id+'</a></td>\
						<td>'+val.nombre+'</td>\
						<td>'+val.date+'</td>\
						<td>'+val.id_recibe+'</td>\
						<td><span class="label label-warning">'+val.estado+'</span></td>\
						<td><span class="label label-success">'+val.ciudad+'</span></td>\
						<td><button id='+val.id+' type="button" class="btn btn-success btn_ver_msn">Ver</button></td>\
				    </tr>';			
			$(t).appendTo($("#tbody_ticket"));
	  	  });
	  	 }
	  	}
	  });
	 }
	 	
     $("#menu_ticket").click(function(){
     	$("#menu1").load("View/template/ticket/ticket.html");
     	Actualizar_ticket(); 
     });

     $("#menu_registro_ticket").click(function(){
     	$("#menu1").load("View/template/ticket/registro_ticket.html");
     	$.ajax({
    	 dateType:"json",
    	 type:"post",
    	 data:{"all_service":"all"},
    	 url:"Controller/Route_config.php",
    	 success:function(data){
     	   var data = $.parseJSON(data);  
      	   if(data){
       		$.each(data,function(key,val){
         	 var t = '<option value="'+val.id+'">'+val.nomb+'</option>';
         	 $(t).appendTo($("#slt_tipo_serv")); 
       		});
      	   }  
    	 }
  		});

  		$.ajax({
    	  dateType:"json",
    	  type:"post",
    	  data:{"get_departament":"all"},
    	  url:"Controller/Route_config.php",
    	  success:function(data){
     	  	var data = $.parseJSON(data);  
      	  	if(Object.prototype.toString.call(data) === '[object Array]'){ 
       			$.each(data,function(key,val){
         			var t = '<option value="'+val.id+'">'+val.nomb+'</option>';
         			$(t).appendTo($("#slt_area")); 
       			});
      	  	}else if(Object.prototype.toString.call(data) === '[object Object]'){
        		var t = '<option value="'+data.id+'">'+data.nomb+'</option>';
        		$(t).appendTo($("#slt_area"));
      	  	}  
    	  }
  		});
  		$.ajax({
    	  dateType:"json",
    	  type:"post",
    	  data:{"get_departament_pais":"all"},
    	  url:"Controller/Route_config.php",
    	  success:function(data){
      		var data = $.parseJSON(data);  
      	    if(Object.prototype.toString.call(data) === '[object Array]'){ 
       		  $.each(data,function(key,val){
         		var t = '<option value="'+val.id+'">'+val.depart+'</option>';
         		$(t).appendTo($("#slt_departa")); 
       		  });
      		}else if(Object.prototype.toString.call(data) === '[object Object]'){
        		var t = '<option value="'+data.id+'">'+data.depart+'</option>';
        		$(t).appendTo($("#slt_departa"));
      		}  
    	   }
  		});
     });

	 
	 
	  $(document).on('click','.btn_ver_msn',function(){
	  	var id = $(this).attr('id');
	  	$("#msn_pqr").html("");
	  	$.ajax({
	  	  dataType:"json",
	  	  type:"post",
	  	  url:"Controller/Ticket/Ticket.php",
	  	  data:{"msn_ticket":id},
	  	  success:function(data){
	  	  	$("#msn_pqr").html(data.Ticket_Descrip);
	  	  }
	  	});

	  	$.ajax({
	  	  dataType:"json",
	  	  type:"post",
	  	  url:"Controller/Ticket/Ticket.php",
	  	  data:{"id_ticket_respon":id},
	  	  success:function(data){
	  	  	$("#respont_from_area").html("");
	  	  	$.each(data,function(key,val){
	  	  	 var t = '<div class="widget">\
				<div class="widget-header clearfix">\
				  <table><tr><td><span class="badge bg-success">'+val.empleado+'</span></td><td>\
				  	<span class="badge bg-primary">'+val.departament+'</span></td>\
				  	<span class="badge bg-info">fecha : '+val.fecha+' hora : '+val.hora+'</span></tr>\
				  </table>\
				</div>\
				<div class="widget-content">\
				 <p>'+val.respuesta+'</p>\
				</div>';
			  $(t).appendTo($("#respont_from_area"));
	  	  	});
	  	  }
	  	});
	  	
	  	function Enviar_respuesta(respon,id,esta,depart){
	  		$.ajax({
 			   dataType:"json",
 			   type:"post", 
 			   url:"Controller/Ticket/Ticket.php",
 			   data:{"respuesta":respon,"id_tick":id,"estado":esta,"departamento":depart},
 			   success:function(data){
 			   	 if(data.exito){
 			   	  alert("la respuesta fue enviada");
 			   	  $("#txt_respon_user").val("");
 			   	  Actualizar_ticket();
 			   	 }else{
 			   	 	alert(data.error);
 			   	 }
 			   }
 			});
	  	}
	  	$("#btn_save_respon").click(function(){
	  	  var respon = $("#txt_respon_user").val();
	  	  var depart = $("#sltd_opcion_departa").val();
	  	  if(esta == 2){
	  	   if(depart){
 			 Enviar_respuesta(respon,id,esta,depart);
	  	   }else{
	  	   	alert("por favor, diligencia al departamento correspondiente");
	  	   }
	  	  }else if(esta == 1){
	  	  	Enviar_respuesta(respon,id,esta,null);
	  	  }else{
	  	  	alert("por favor, seleccione la opcion correspondiente a la respuesta");
	  	  }	
	  	});
	  });
	});
</script>
<script type="text/javascript" src="View/js/ticket.js"></script>

