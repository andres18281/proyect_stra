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
   	    var contrat_ciud = contrat.contrat_ciud;
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
   	    	  var t = '<tr><td></td><td>'+val.nomb+'</td><td>'+val.cant+'</td><td>'+val.cant2+'</td><td>'+parseInt(val.cant+val.cant2)+'</td></tr>';
   	    	  $(t).appendTo($("#list_tickets_gestion"));
   	    	});
   	    }

   	    if(contrat_ciud){
   	    	$.each(contrat_ciud,function(key,val){
   	    	  var t = '<tr><td></td><td>'+val.nomb+'</td><td><a href="#">'+val.cant+'</a</td><td></td></tr>';	
   	    	  $(t).appendTo($("#tbody_list_contrat_city"));
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