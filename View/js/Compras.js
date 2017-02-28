$(function(){
  $(document).on('click','#show_list_solici',function(){ 
    var t = '<div class="panel container-fluid" style="padding:0px !important;">\
              <h3 style="color:black;font-weight:bold;">Confirmacion</h3>\
              <div class="alert alert-success"><strong>Aceptar peticion de compra de materiales</strong></div>\
              <input type="hidden" id="hidden_id_solici">\
              <a href="#" class="btn btn-default">Cerrar</a>\
              <a href="#" class="btn btn-success" id="btn_acept_soli">Aceptar</a>\
           </div>';
          $("#msn_info").html(t);

  	      $("#menu1").load("View/template/compras/list_solicitudes.html");
    setTimeout(function(){
     var param = {"accion":"get_solici_pendien"};
  	 $.post("Controller/ComprasController.php",{"request":JSON.stringify(param)},function(data){
  	   var data = $.parseJSON(data);
  	   if(data[0].id){
  	    $.each(data,function(key,val){
  	   	 var t = '<tr id="tr_'+val.id+'">\
            	     <td><strong>'+val.emple+'</strong></td>\
            	     <td>Solicitud de aprobacion</td>\
            	     <td><strong>'+val.fecha+'</strong></td>\
            	     <td><a href="#" id="'+val.id_contrat+'" data-id="'+val.id+'" class="btn btn-success btn-xs btn_ver">ver materiales solicitados</a>\
                   </td>\
         	        </tr>';
          $(t).appendTo($("#list_solicit"));
  	    });
  	   }else{
        var t = '<tr><td colspan="4"><div class="alert alert-danger"><strong>No hay solicitudes pendientes</strong></div></td></tr>';
        $(t).appendTo($("#list_solicit"));
       } 
  	 });
    },200);	
  });	
  var id = 0;
  $(document).on('click','.btn_ver',function(){
   $("#panel_opcion").css('display','block');
   id = $(this).attr('id');
   var id_contrat = $(this).attr('data-id');
   $("#hidden_id_solici").val(id_contrat);
   $("#listado").load("View/template/compras/list_productos.html");
    setTimeout(function(){
     $.post("Controller/Router_materiales.php",{"get_list_material":id},function(data){
      var data = $.parseJSON(data);
      if(data[0].id){
       $.each(data,function(key,val){ 
        var t = '<tr id="tr_'+val.id+'">\
                  <td>'+val.nomb+'</td>\
                  <td>'+val.cant+'</td>\
                 </tr>';   
        $(t).appendTo($("#tbody_material"));
       });
      }
     });
    },100);
  });
   
  $(document).on('click',".collp_id",function(){
    var id_contrat = $(this).attr('id');
   if(id_contrat != 0 || id_contrat != ""){
    $("#contrato").load("View/template/contratos/contrato.html");
    var param = {"accion":"Get_contrato","id":id_contrat};
    $.post("Controller/ContratoController.php",{"request":JSON.stringify(param)},function(data){
        var datos = $.parseJSON(data);
        var templa = $('#contrato').html();
        var templa =  templa.replace('{{id}}',datos.id);
        var  templa = templa.replace('{{servi_princi}}',datos.servi_princi);
        var  templa = templa.replace('{{fecha_inicio}}',datos.time_ini);
        var  templa = templa.replace('{{fecha_fin}}',datos.time_fin);
        var  templa = templa.replace('{{cuota}}',datos.cuota);
        var  templa = templa.replace('{{time_service}}',datos.time_service);
        var  templa = templa.replace('{{id_vende}}',datos.id_vende);
        var  templa = templa.replace('{{employed}}',datos.employed);
        var  templa = templa.replace('{{nomb_cli}}',datos.nomb_cli);
        var  templa = templa.replace('{{nomb_empr}}',datos.nomb_empr);
        var  templa = templa.replace('{{dir}}',"kr 8 c");
        var  templa = templa.replace('{{nit}}',datos.id_cli);
        var  templa = templa.replace('{{mail_cli}}',datos.mail_cli);
        var  templa = templa.replace('{{id_servi}}',datos.id_servi);
        var  templa = templa.replace('{{serv_nom}}',datos.serv_nom);
        var  templa = templa.replace('{{time_service}}',datos.time_service);
        var  templa = templa.replace('{{cost}}',datos.cost);
        var  templa = templa.replace('{{serv_nom}}',datos.serv_nom);
        $('#contrato').html(templa);
    });
   }else{
    alert("por favor, seleccione una de las solicitudes pendientes");
   }
  });

  $(document).on('click','#btn_autorizar',function(){
    $("#myModal_msn").modal('show');
  });
  
  $(document).on('click','#btn_acept_soli',function(){
    var id = $("#hidden_id_solici").val();
    $.post("Controller/Router_gestion.php",{"autoriza_solici":id},function(data){
      var data = $.parseJSON(data);
      if(data.exito){
        alert("Fue autorizado con exito");
        $("#myModal_msn").modal('hide');
        $("#tr_"+id).slideUp('slow');
        id = 0;
        id_contrat = 0;
        $("#panel_opcion").css('display','none');
      }else{
        alert(data.error);
      }
    });
  });
});


/* The Notification body */



// modal_title  modal_accion