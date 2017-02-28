$(function(){
  var cant_auto = 0;
  var cant_canali = 0;
  var cant_gest = 0;
  var cant_termi = 0;
  $(document).on('click','#menu_solicit',function(){ 
  	$("#menu1").load("View/template/Servicio_tecnico/solicit_instalacion.html");
    setTimeout(function(){
      var t = '<tr>\
                <th>Id Contrato</th>\
                <th>Servicio</th>\
                <th>Prioridad</th>\
                <th>Accion</th>\
              </tr>';
        $("#thead_title").append(t);
        var json = {"accion":"get_solicitud_soport"};
  	    $.post("Controller/GestionController.php",{"request":JSON.stringify(json)},function(data){
  	        var data = $.parseJSON(data);
  	        if(data[0].id){
  	  	      $.each(data,function(key,val){
  	  	        var t = '<li>\
  	  	  			     <a href="#">\
  	  	  			       <i class="icon ion-wrench text-success"></i>\
  	  	  			       <span class="text">Solicitud Servicio Tecnico : '+val.servi+'</span>\
  	  	  			     </a>\
  	  	  		         </li>';
  	  	        $(t).appendTo($("#notifi_all"));
  	  	      });
  	  	      $.each(data,function(key,val){
  	  	        var priori = '';
  	  	        if(val.priori == "Bajo"){
  	  	  	     var priori =  '<span class="label label-warning">Bajo</span>';
  	  	        }else if(val.priori == "Medio"){
  	  	  	     var priori =  '<span class="label label-success">Medio</span>';
  	  	        }else if(val.priori == "Alto"){
  	  	  	     var priori =  '<span class="label label-danger">Alto</span>';
  	  	        }
  	  	        var t = '<tr id="tr_'+val.id+'">\
		  		                <td><a href="#">'+val.id+'</a></td>\
		  		                <td>'+val.servi+'</td>\
		  		                <td>'+priori+'</td>\
		  		                <td><a href="#" class="btn btn-info btn-xs btn_ver" id='+val.id+'>Ver <span class="glyphicon glyphicon-share-alt"> </span></a>\
		  		  	               <a href="#" class="btn btn-danger btn-xs btn_canalizar" id='+val.id+'>Canalizar <span class="glyphicon glyphicon-pushpin"></span></a>\
		  		                </td>\
				                </tr>';
			          $(t).appendTo($("#body_servi_tecn"));	
		          });
  	        }
  	    });
    },200);
  });
  var nit = 0;
  $(document).on('click','.btn_ver',function(){
  	var id = $(this).attr('id');
    $("#home").load("View/template/contratos/contrato.html");
  	var x = {"accion":"Get_contrato","id":id};
    $.post("Controller/ContratoController.php",{"request":JSON.stringify(x)},function(data){
        var datos = $.parseJSON(data);
        $("#inp_fech_in","form[name='form_modify_contrat']").val(datos.time_ini); 
        $("#inp_fech_fn","form[name='form_modify_contrat']").val(datos.time_fin); 
        $("#inp_cuot","form[name='form_modify_contrat']").val(datos.cuota);
        $('#tip_servi option',"form[name='form_modify_contrat']").each(function(){
                                if($(this).val() == datos.id_servi_princi){ 
                                    $(this).prop("selected", "selected"); 
                                    $(this).change();
                                } 
                               });
        $('#descrip_servi option',"form[name='form_modify_contrat']").each(function(){
                                    if($(this).val() == datos.id_servi){ 
                                      $(this).prop("selected", "selected"); $(this).change();
                                    } 
                                  });
        $("#inp_time_servi","form[name='form_modify_contrat']").val(datos.tiempo_contrat);
        $("#slt_form_pag option","form[name='form_modify_contrat']").each(function(){
                                    if($(this).text() == datos.Contra_Form_pago){ 
                                      $(this).prop("selected", "selected");     
                                      $(this).attr("selected", "selected");
                                    }
                                  });   
        var templa = $('#home').html();
        var templa = templa.replace('{{id}}',datos.id);
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
        $('#home').html(templa);
    });
  });
  
  $(document).on('click','.btn_canalizar',function(){
    solici = $(this).attr('id');
    $("#msn_info").html("");
    $("#myModal_msn").modal('show');
     var t = '<div class="container-fluid">\
                <form id="form_canalizar_tecnico">\
                 <div class="col-md-4">\
                  <label>Seleccione el Area</label>\
                  <select class="form-control" name="slt_areas" id="slt_areas"><option></option></select>\
                 </div>\
                 <div class="col-md-4">\
                  <label>Seleccione el Cargo</label>\
                  <select class="form-control" name="slt_carg" id="slt_carg"><option></option></select>\
                 </div>\
                 <div class="col-md-4">\
                  <label>Empleado</label>\
                  <select class="form-control" name="slt_person" id="slt_person"><option></option></select>\
                 </div>\
                 <div class="container-fluid">\
                  <div class="col-md-8" style="margin-top:10px;">\
                    <textarea class="form-control" name="txt_coment" id="txt_coment"></textarea>\
                  </div>\
                  <div class="col-md-4" style="margin-top:10px;">\
                    <button type="submit" class="btn btn-success" id="btn_asig">Asignar</button>\
                    <input type="hidden" name="hidden_solicitud" value='+solici+'>\
                    <input type="hidden" name="accion" value="canalizar">\
                  </div>\
                 </div>\
                </form>\
              </div>';
     $(t).appendTo($("#msn_info")); 
     $.post("Controller/Route_config.php",{"get_departament":"all"},function(data){
       var data = $.parseJSON(data);
       if(data[0].id){
         $.each(data,function(key,val){
          var t = '<option value='+val.id+'>'+val.nomb+'</option>';
          $(t).appendTo($("#slt_areas"));
         });
       }
     });
  });

  $(document).on('change',"#slt_areas",function(){
    $("#slt_carg").html("<option></opton>");
    var id = $(this).val();
    $.ajax({
      dataType:"json",
      type:"post",
      url:"Controller/Route_config.php",
      data:{"id_departament":id}
    }).done(function(data){
      $.each(data,function(key,val){
        var t = '<option value='+val.id+'>'+val.nomb+'</option>';
        $(t).appendTo($("#slt_carg"));
      });
    });
  });

  $(document).on('change','#slt_carg',function(){
    $("#slt_person").html("<option></option>");
    var id = $(this).val();
    $.post("Controller/Router_employed.php",{"get_employed_by_cargo":id},function(data){
      var data = $.parseJSON(data);
      $.each(data,function(key,val){
        var t = '<option value='+val.id+'>'+val.nombre+'</option>';
        $(t).appendTo($("#slt_person"));
      });
    });
  });

  function agregar(form){
    var vari = {};
    var form = $("form#"+form).serializeArray();
    $.each(form,function(key,val){
      vari[val.name] = val.value;
      if(val.value){
        verifi = true;  
      }
    });
    return vari;
  }

  $(document).on('submit',"form#form_canalizar_tecnico",function(e){
    e.preventDefault();
    var form = agregar("form_canalizar_tecnico");
    alert("enviando");
    $.post("Controller/GestionController.php",{"request":JSON.stringify(form)},function(data){
      var data = $.parseJSON(data);
      var solici = $("input[name='hidden_solicitud']").val();
      if(data.exito){
        $("#tr_"+solici).slideUp('slow');
        alert("Solicitud canalizada con exito");
      }
    });
  });


  $("#menu_soporte_tec").click(function(){
    $("#list_gestion").html("");
    $("#body_servi_tecn").html("");
    $("#list_gestion").html("");
    var param = {"accion":"get_solicitud_tect"};
    $.post("Controller/GestionController.php",{"request":JSON.stringify(param)},function(data){
      var data = $.parseJSON(data); 
      if(data[0].id){
        $.each(data,function(key,val){
          console.log(val);
          var t = '<li class="notify_gestion" id='+val.id+'>\
                    <a href="#">\
                     <i class="icon ion-chatbubble text-success"></i>\
                     <span class="text">Nueva solicitud para soporte</span>\
                    </a>\
                   </li>';
          $(t).appendTo($("#menu_inform"));
        });
      }
    });
    $("#menu1").load("View/template/Servicio_tecnico/table_servi_tecnico.html"); 
      setTimeout(function(){
        var t =  '<tr>\
               <th>Id solicitud</th>\
               <th>Id contrato</th>\
               <th>descripcion</th>\
               <th>fecha</th>\
               <th>Estado</th>\
               <th>Ver</th>\
              </tr>';
        $("#thead_title").append(t);
        var param = {"accion":"get_solicitud_employed"};
        $.post("Controller/GestionController.php",{"request":JSON.stringify(param)},function(data){
          var data = $.parseJSON(data); 
         if(data[0].id){
          var veri_cana = false;
          $.each(data,function(key,val){
            if(val.estado == "Autorizado"){
             cant_canali++; 
              var t = '<tr id="list_'+val.id+'">\
                        <td><label>'+val.id+'</label></td>\
                        <td><label>'+val.descrip+'</label></td>\
                        <td><label>'+val.fecha+'</label></td>\
                        <td><label>'+val.estado+'</label></td>\
                        <td><a href="#" class="btn btn-info btn-xs btn_autori" id='+val.id+'><span class="glyphicon glyphicon-ok"></span></a>\
                            <a href="#" class="btn btn-success btn-xs btn_ver_autori" id='+val.id+'><span class="glyphicon glyphicon-zoom-in"></span></a>\
                        </td>\
                       </tr>';
              $(t).appendTo($("#list_autori"));
            }else if(val.estado == "Canalizado"){
              veri_cana = true;
              cant_canali++;
              var t = '<tr id="tr_'+val.id+'">\
                      <td>'+val.id+'</td>\
                      <td class="td_contrat_'+val.id+'"  id='+val.id_con+'>'+val.id_con+'</td>\
                      <td>'+val.descrip+'</td>\
                      <td>'+val.fecha+'</td>\
                      <td>'+val.estado+'</td>\
                      <td><a href="#" class="btn btn-danger btn-xs btn_ver_coment" id='+val.id+'><span class="glyphicon glyphicon-share-alt"></span></a></td>\
                     </tr>';
              $(t).appendTo($("#body_servi_tecn"));
            }else if(val.estado == "Gestion"){
              cant_gest++;
              var t = '<tr id="tr_'+val.id+'">\
                      <td class="td_contrat_'+val.id+'"  id='+val.id_con+'>'+val.id_con+'</td>\
                      <td>'+val.descrip+'</td>\
                      <td>'+val.fecha+'</td>\
                      <td>'+val.estado+'</td>\
                      <td><a href="#" class="btn btn-danger btn-xs btn_gestion_ver" id='+val.id+'><span class="glyphicon glyphicon-share-alt"></span></a></td>\
                     </tr>';
              $(t).appendTo($("#list_gestion"));       
            }else if(val.estado == "Terminado"){
              cant_termi++;
              var t = '<tr id="tr_'+val.id+'">\
                        <td>'+val.id+'</td>\
                        <td class="td_contrat_'+val.id+'" id='+val.id_con+'>'+val.id_con+'</td>\
                        <td>'+val.descrip+'</td>\
                        <td>'+val.fecha+'</td>\
                        <td>'+val.estado+'<td>\
                       </tr>';
              $(t).appendTo($("#list_historial"));
            }
            $("#span_cant_soli").text(cant_canali); 
            $("#span_cant_auto").text(cant_auto); 
            $("#span_cant_gestion").text(cant_gest); 
            $("#span_cant_historial").text(cant_termi);
          });
         }else{
            var t = '<tr>\
                      <td colspan="6"><div class="alert alert-success"><strong>No hay solicitudes pendientes</strong></div></td>\
                     </tr>';
            $("#body_servi_tecn").append(t); 
         } 
        });
      },200);
  });

  $(document).on('click','.btn_ver_coment',function(){
    var id = $(this).attr('id');
    $.post("Controller/Router_gestion.php",{"get_info_request_tecni":id},function(data){
      var data = $.parseJSON(data);
      var t = '<div class="panel panel-default">\
                <div class="panel-heading">\
                 <label>Descripcion de la solicitud</label>\
                </div>\
                <div class="panel-body">\
                 <p>Empresa que requiere el servicio  <label class="label label-primary">'+data.empre+'</label></p>\
                 <div class="alert alert-success">\
                 <strong>'+data.coment+'</strong>\
                 </div>\
                </div>\
                <div class="container-fluid">\
                  <a href="#" class="btn btn-warning btn-xs btn_solici">Solicitar Material de trabajo</a>\
                </div>\
               </div>';
      $('#panel_show_solicitud_serv_tec').html(t);
      var action = '<a href="#" class="btn btn-info btn_send_product" id='+id+'>Solicitar</a>';
      $("#modal_accion").html(action);
    });
  });

  $(document).on('click','.btn_ver_autori',function(){
    var id = $(this).attr('id');
    $("#subtab_auto").html("");
    $.post("Controller/Router_materiales.php",{"get_list_material":id},function(data){
      var data = $.parseJSON(data);
      $.each(data,function(key,val){ 
        var t = '<tr>\
                  <td><label style="color:black;">'+val.nomb+'</label></td>\
                  <td><label style="color:black;">'+val.cant+'</label></td>\
                </tr>';
        $(t).appendTo($("#subtab_auto"));
      });
    });
  });

  $(document).on('click','.btn_solici',function(){
    $("#myModal_msn").modal('show');
    $("#modal_title").text("Agregar productos a solicitar");
    $("#msn_info").load("View/template/Servicio_tecnico/solicitud_materiales.html");
  });

  $(document).on('click','.btn_send_product',function(){
    var valor = [];
    var id = $(this).attr('id');
    $(".inp_name_produc").each(function(key,val){
      var nomb = $(this).val();
      var cant = $(".inp_cant_produc").eq(key).val();
      if(nomb){
       var json = {"nomb":nomb,"cant":cant};
       valor.push(json);
      }
    });
    $.post("Controller/Router_gestion.php",{"product":JSON.stringify(valor),"id_solici":id},function(data){
      var data = $.parseJSON(data);
      console.log(data);
      $("#myModal_msn").modal('hide');
      $("#tr_"+id).slideUp('slow');
      $("#home").slideUp("slow");
    });
  });

  // boton de autorizar //
  var id;
  $(document).on('click','.btn_autori',function(){
    id = $(this).attr('id');
    setTimeout(function(){
      var t = '<div class="container-fluid">\
                <div class="alert alert-warning">\
                 <strong> Al darle click en Inicio de instalacion, esta aceptando que la instalacion se llevara a cabo a partir de este momento</strong>\
                </div>\
               </div>';
      var c = '<a href="#" class="btn btn-success btn_begin_install">Inicio de instalacion</a>\
               <a href="#" data-dismiss="modal" class="btn btn-default">Cerrar</a>';
      $("#msn_info").html(t);
      $("#modal_accion").html(c);
    },100);
    $("#myModal_msn").modal('show');
  });

  $(document).on('click','.btn_begin_install',function(){
    var param = {"accion":"set_inicio_obra","id":id};
    $.post("Controller/GestionController.php",{"request":JSON.stringify(param)},function(data){
      var data = $.parseJSON(data);
      if(data.exito){
        $('#list_'+id).slideUp('slow');
        alert("exito, ha indicado que se activo el trabajo");
        $("#myModal_msn").modal('hide');
      }
    });
  });

  var id_gestion = 0;
  $(document).on('click','.btn_gestion_ver',function(){
    var id = $(this).attr('id');
    var id_contrat = $(".td_contrat_"+id).attr('id');
    $("#list_up_files").load("View/template/Servicio_tecnico/subir_archivos.html"); 
    setTimeout(function(){
      $("#hidden_id_contrat").val(id_contrat);
      $("input[type='file']").fileinput({
        language: 'en',
        showCaption: true,
        showPreview: true,
        showRemove: true,
        showUpload: false, // <------ just set this from true to false
        showCancel: true,
        showUploadedThumbs: true 
      }); 
    },200);
    id_gestion = $(this).attr('id');
  });

  $(document).on('click','.btn_subir_file',function(){
   if(id_gestion > 0){ 
    var file_data = $('#inp_file1')[0].files;
    var text = $("#txt_area_coment").val();
    var id_contrat = $("#hidden_id_contrat").val();
    alert(id_contrat);
    var form = new FormData();
    for(var i = 0;i < file_data.length;i++){
      form.append("img[]", file_data[i]); 
    }
    form.append("coment",text);
    form.append("id",id_gestion);
    form.append("id_contrat",id_contrat);
    $.ajax({
         datatype:"json",
         url:"Controller/Router_archivos.php",
         type:"post",
         data:form,
         contentType: false,
         processData: false,
          success:function(data){
            alert("subido con exito");
            $('#tr_'+id_gestion).slideUp('slow');
            console.log($("#tr_"+id_gestion));
            $(".fileinput-remove").trigger('click');
          }
    });
   }else{
    alert("Seleccione el contrato");
   }   
  });
});
$(function(){
  $(document).on('mouseover','.list-group-item',function(event) {
    event.preventDefault();
    $(this).closest('li').addClass('open');
  });
  $(document).on('mouseout','.list-group-item',function(event) {
    event.preventDefault();
    $(this).closest('li').removeClass('open');
  });
});