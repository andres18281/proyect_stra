$(function(){
 	function Convertir_array_asociativo(form){
   	  var form =  $('form[name='+form+']').serializeArray();
   	  var json = {};
   	  $.each(form,function(key,val){
     	json[val.name] = val.value; 
   	  });    
   	  return json;
 	}

 	$(document).on('submit','form#form_register_client',function(e){
		e.preventDefault();
		var form = Convertir_array_asociativo("form_register_client");   	  
		var params = {"form":form,"agregar_usuario":"acepta"};
		$.post("Controller/UsuarioController.php",{"request":JSON.stringify(params)},function(data){
	  		var data = $.parseJSON(data);
	  		if(data.exito){
	  	  	  alert(data.exito);
	  		  alert(form.id);
	  		  $("input[name='id_nit']","form#form_register_empresa").val(form.id);
	  		}
		});          
 	});

 	$(document).on('submit','form#form_register_empresa',function(e){
		e.preventDefault();
		var form = Convertir_array_asociativo("form_register_empresa");  
		var params = {"form":form,"agregar_empresa":"active"};
		$.post("Controller/UsuarioController.php",{"request":JSON.stringify(params)},function(data){
		  var data = $.parseJSON(data);
		  if(data.exito){
		  	$("input[name='id_nit']","form[name='form_file_client']").val(form.id_nit);
		  }
		});
    });

    $(document).on('click','#btn_add_file',function(e){
      e.preventDefault();
      var params = {"agregar_documento":"active"};
      var nit = $("input[name='id_nit']","form#form_file_client").val();
	  var file_data = $("#inp_file1")[0].files;
	  var file_data2 = $("#inp_file2")[0].files;
	  var file_data3 = $("#inp_fil3")[0].files;
      var data_file = new FormData();
      for(var i = 0;i < file_data.length;i++){
        data_file.append("file1[]", file_data[i]);
      }
      for(var i = 0;i < file_data2.length;i++){
        data_file.append("file2[]", file_data2[i]);
      }
      for(var i = 0;i < file_data3.length;i++){
        data_file.append("file3[]", file_data3[i]);
      }	
	  data_file.append('nit',nit);
	  data_file.append('request',JSON.stringify(params));
	  $.ajax({
	  	dataType:"json",
	   	type:"post",
	   	contentType: false,
        processData: false,
        url:"Controller/UsuarioController.php",
        data:data_file
	  }).done(function(data){
	  	if(data.exito){
	  	  alert(data.exito);
	  	}else{
	  	  alert("hubo un error");
	  	}
	  });
	});

});

	$(document).on('click','#btn_searh',function(){
	  $("#list_empre").html("");
	  var id_client = $("#inp_id_client").val();	 
	  if(id_client > 0){
	  	$.post("Controller/Router_usuario.php",{"id_client":id_client,"buscar_cliente":"asas"},function(data){
	  	 var data = $.parseJSON(data);
	  	 if(data[0].nit){ 
	  	  $.each(data,function(key,val){
	  	 	var t =
	  	  	 '<tr>\
                <td><a href="#" class="id_empre" id='+val.nit+'>'+val.nit+'</a></td>\
                <td>'+val.nomb+'<td>\
                <td>'+val.tel+'<td>\
                <td>'+val.dir+'<td>\
                <td><a href="#" id='+val.nit+' class="btn btn-primary btn-xs btn_ver_empre">Ver</a><td>\
               </tr>';	
            $(t).appendTo($("#list_empre"));	 	
	  	  });
	  	 }
	  	});
	  }else{
	  	alert("por favor digite la cedula del cliente");
	  }
	});	

	function Get_facturas_by_client(id,id_table){
		var param = {"accion":"get_factura_by_client","nit":id};
		$.post("Controller/FacturaController.php",{"request":JSON.stringify(param)},function(data){
		  var data = $.parseJSON(data);
		  if(data[0].id){
		    $.each(data,function(key,val){     
		  	  var t = '<tr>\
		  	 			<td>'+val.id+'</td><td>'+val.fecha+'</td><td>'+val.fech_final+'</td><td>'+val.total+'</td><td>'+val.estado+'</td>\
		  	 			<td><a href="ver.php?id_fact='+val.id+'" target="_BLANK" class="btn btn-primary btn-xs">Ver</a></td>\
		  	 		  </tr>';
		  	  $(t).appendTo($('#'+id_table));
		    });
		  }else{
		   	var t = '<tr>\
		  	 			<td colspan="5"><div class="alert alert-danger"><strong>No hay facturas generadas aun...</div></td>\
		  	 		  </tr>';
		  	$('#'+id_table).append(t);
		  }
		});
	}

	function Get_documentos_empresa(id){
	    var params = {"get_document":"active","nit":id};
	  	$("#list_document_empre").html("");
	  	$.post("Controller/UsuarioController.php",{"request":JSON.stringify(params)},function(data){
	  	   var data = $.parseJSON(data);
	  	   if(data.rut || data.camara || data.camara){
	  	     var t = '<tr><td>'+id+'</td><td><a target="_BLANK" href="View/img/documentos/'+data.camara+'">'+data.camara+'</a></td>\
	  	   				<td><a target="_BLANK" href="View/img/documentos/'+data.cedu+'">'+data.cedu+'</a></td>\
	  	   				<td><a target="_BLANK" href="View/img/documentos/'+data.rut+'">'+data.rut+'</a></td></tr>';
	  		}else{
	  		  var t = '<tr><td colspan="4"><div class="alert alert-danger"><strong>No hay documentos adjuntos de esta empresa</strong></td></tr>';	
	  		}
	  		$("#list_document_empre").append(t);
	  	});
	}

	function Get_contratos_by_client(id,id_table){
		$.post("Controller/Router_contrato.php",{"Get_all_contrato_by_empre":id},function(data){
	  	  var data = $.parseJSON(data);	
	  	  if(data[0].id){
	  	    $.each(data,function(key,val){ 
	  	     var clase = val.estado == 'Activo'?'warning':'success';
	  	     var t = '<tr class='+clase+'>\
	  	   			   <td>'+val.id+'</td>\
	  	   			   <td>'+val.servicio+'</td>\
	  	   			   <td>'+val.pagos+'</td>\
	  	   			   <td>'+val.total+'</td>\
	  	   			   <td>'+val.inicio+'</td>\
	  	   			   <td>'+val.fin+'</td>\
	  	   			   <td>'+val.estado+'</td>\
	  	   			   <td><a href="#" id='+val.id+' class="btn btn-primary btn-xs btn_show_pay">Ver pagos</a></td>\
	  	   		     </tr>';
	  	     $(t).appendTo($('#'+id_table));
	  	    });
	  	  }else{
	  	  	var t = '<tr><td colspan="7"><div class="alert alert-danger"><strong>No hay contratos</strong></div></td></tr>';
	  	  	$('#'+id_table).append(t);
	  	  }
	  	});
	}

	$(document).on('click','.btn_ver_empre',function(){
	  $("#list_contrat").html("");
	  var id = $(this).attr('id');
	  if(id){
	  	Get_documentos_empresa(id);
	  	Get_contratos_by_client(id,"list_contrat");
	  	Get_facturas_by_client(id,"list_fact_");
	  }	  	
	});

	$(document).on('click','.btn_show_pay',function(){
	  $("#list_fact").html("");	
	  var id = $(this).attr('id');
	  var param = {"accion":"Get_pagos_by_contrat","id":id};
	  $.post("Controller/ContratoController.php",{"request":JSON.stringify(param)},function(data){
	  	var data = $.parseJSON(data);
	  	$.each(data,function(key,val){
	  		var t = '<tr>\
	  				   <td>'+val.id+'</td>\
	  				   <td>'+val.fecha_ini+'</td>\
	  				   <td>'+val.fecha_end+'</td>\
	  				   <td>'+val.costo+'</td>\
	  				   <td>'+val.fecha_pago+'</td>\
	  				   <td>'+val.confir+'</td>\
	  				   <td></td>\
	  				 </td>';
	  		$(t).appendTo($("#list_fact"));
	  	});
	  });	  	
	});

	$(document).on('click','.id_empre',function(){
	 var nit_ = $(this).attr('id');	
	 $.ajax({
	   dataType:"json",
	   type:"post",
	   url:"Controller/Router_usuario.php",
	   data:{"id_empre":nit_,"listar_contratos":"dff"}
	 }).done(function(data){
	 	$("#list_contrat").html("");
	 	 if(Array.isArray(data[0])){
	 	   $.each(data,function(key,val){
	 	   	var t = 
	  	  	  '<tr>\
                <th class="glyphicon glyphicon-triangle-right"><a href="#" id="'+val[0]+'" class="id_contrat"> '+val[0]+'</a></th>\
                <th>'+val[1]+'</th>\
                <th>'+val[2]+'</th>\
                <th>'+val[3]+'</th>\
                <th>'+val[4]+'</th>\
                <th>'+val[5]+'</th>\
                <th>'+val[6]+'</th>\
                <th><span class="glyphicon glyphicon-paperclip"></span></th>\
               </tr>';
	  	  	 $(t).appendTo($("#list_contrat"));
	 	   }); 
	 	 }else if(Array.isArray(data)){
	 	 	var t = 
	  	  	   '<tr">\
                 <th class="glyphicon glyphicon-triangle-right"><a href="#" id="'+data[0]+'" class="id_contrat"> '+data[0]+'</a></th>\
                 <th>'+data[1]+'</th>\
                 <th>'+data[2]+'</th>\
                 <th>'+data[3]+'</th>\
                 <th>'+data[4]+'</th>\
                 <th>'+data[5]+'</th>\
                 <th>'+data[6]+'</th>\
                 <th></th>\
               </tr>';
	  	  	 $(t).appendTo($("#list_contrat"));
	 	 }
	 });
	});
	
	// busca contratos
	$(document).on('click','.id_contrat',function(){
	  var id = $(this).attr('id');
	   $.ajax({
	   dataType:"json",
	   type:"post",
	   url:"Controller/Router_usuario.php",
	   data:{"id_contra":id,"listar_factura":"fdf"}
	  }).done(function(data){
	  	if(Array.isArray(data[0])){
	  	 $.each(data,function(key,val){
	  	 var t = 
	  	  	  '<tr>\
                <th class="glyphicon glyphicon-triangle-right"><a href="#" id="'+val[0]+'" class="id_contrat"> '+val[0]+'</a></th>\
                <th>'+val[1]+'</th>\
                <th>'+val[2]+'</th>\
                <th>'+val[3]+'</th>\
                <th>'+val[4]+'</th>\
                <th>'+val[5]+'</th>\
                <th>'+val[6]+'</th>\
                <th><span class="glyphicon glyphicon-paperclip"></th>\
               </tr>';
	  		$(t).appendTo($("#list_fact"));
	  	 });
	  	}else if(Array.isArray(data)){
	  	  var t = 
	  	  	  '<tr>\
                <th class="glyphicon glyphicon-triangle-right"><a href="#" id="'+data[0]+'" class="id_contrat"> '+data[0]+'</a></th>\
                <th>'+data[1]+'</th>\
                <th>'+data[2]+'</th>\
                <th>'+data[3]+'</th>\
                <th>'+data[4]+'</th>\
                <th>'+data[5]+'</th>\
                <th>'+data[6]+'</th>\
                <th><span class="glyphicon glyphicon-paperclip"></span></th>\
               </tr>';
	  	  $(t).appendTo($("#list_fact"));	
	  	}
	  });
	});
	 