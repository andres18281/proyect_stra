$(function(){
    function Convertir_array_asociativo(form){
      var form =  $('form[name='+form+']').serializeArray();
      var json = {};
      $.each(form,function(key,val){
        json[val.name] = val.value; 
      });    
      return json;
    }

    $(document).on('submit','#form_contrato_create',function(e){
      e.preventDefault();
      var form = Convertir_array_asociativo("form_contrato_create");
      $.post("Controller/ContratoController.php",{"request":JSON.stringify(form)},function(data){
         var data = $.parseJSON(data);
         if(data.exito){
           alert("El contrato fue guardado con exito");
         }
      });
    });

    $(document).on('submit','form[name="form_modify_contrat"]',function(e){
      e.preventDefault();
      var form = Convertir_array_asociativo("form_modify_contrat");
      $.post("Controller/ContratoController.php",{"request":JSON.stringify(form)},function(data){
         var data = $.parseJSON(data);
         if(data.exito){
           alert("El contrato fue guardado con exito");
         }
      });
    });

    $(document).on('keyup',"input[name='inp_time_service']",function(){
      var valor = $("#descrip_servi","form#form_contrato_create").val();
      var selected = $("#descrip_servi","form#form_contrato_create").find('option:selected');
      var costo = selected.data('valor');
      var cant = $(this).val(); 
      $("#inp_calcu_cost").val(parseInt(costo * cant));
    });
     
 $(document).on('click',".btn_ver_contrat",function(){
    $("input[name='id_num_contrat']").val($(this).attr('id'));
    $("#home").load("View/template/contratos/contrato.html");
    var id = $(this).attr('id');
    $(".nav-tabs a:eq(0)").removeClass('disabled');
    $(".nav-tabs a:eq(1)").removeClass('disabled');
    $(".nav-tabs a:eq(0)").attr("data-toggle","tab");
    $(".nav-tabs a:eq(1)").attr("data-toggle","tab");
    $.post("Controller/Router_servicio.php",{"listar_servicios_principal":"all"},function(data,status){
     var data = $.parseJSON(data);
      $.each(data,function(key,val){
        var t = '<option value='+val.id+'>'+val.nomb+'</option>';
        $(t).appendTo($("#tip_servi"));
      });
    });

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

 function Actualizar_contratos(){
   $("#tbody_all_contrat").html("");
   $("#menu1").load("View/template/contratos/show_contratos.html");  
   setTimeout(function(){
    var param = {"accion":"Get_contrat_no_active"};
    $.post("Controller/ContratoController.php",{"request":JSON.stringify(param)},function(data){
      var data = $.parseJSON(data);
      if(data[0].id){
        $.each(data,function(key,val){
          var t = '<tr id="tr_'+val.no+"-"+val.id+'">\
                     <td class="agenda-date" class="active" rowspan="1">\
                        <div class="dayofmonth">'+val.dia+'</div>\
                        <div class="dayofweek">'+val.dia_letr+'</div>\
                        <div class="shortdate text-muted">'+val.mes_let+','+val.ano+'</div>\
                     </td>\
                     <td>'+val.no+"-"+val.id+'</td>\
                     <td class="agenda-time">'+val.hora+'</td>\
                     <td class="agenda-events">\
                        <div class="agenda-event">\
                          <i class="text-muted" title="Repeating event"></i>\
                           '+val.servicio+'\
                         </div>\
                     </td>\
                     <td class="agenda-events">\
                       <a href="#" class="btn btn-info btn-xs btn_ver_contrat" id='+val.id+"-"+val.no+'>Ver</a>\
                     </td>\
                   </tr>';
            $(t).appendTo($("#tbody_all_contrat"));
        });
      }else{
        var t = '<tr><td colspan="4"><div class="alert alert-success" style="text-align:center;"><strong style="color:red;">¡En buena Hora!, no hay contratos en este momento para revision</strong></div></td></tr>';
        $("#tbody_all_contrat").append(t);
      }
     });
   },100);
 }

 $(document).on('click','#btn_show_contrat',function(){
   Actualizar_contratos();
 });

 $(document).on('change','#tip_servi',function(){
    var id = $(this).val();
    $("#descrip_servi").html("");
    $.post("Controller/Router_servicio.php",{"list_servi_contratos":id},function(data){
     if(data){
      var data = $.parseJSON(data);
      if(data[0].id){
       $.each(data,function(key,val){
        var t = '<option value='+val.id+' data-valor='+val.costo+'>'+val.servicio+'</option>';
        $(t).appendTo($("#descrip_servi"));
       });
      }
     }
    });
 });



 $(document).on('change','.btn_descuen',function(){
 	var desc = $(this).val();
    if(desc == "si"){
 		$("#inp_cost_new").css('display','block');
 		$("#inp_report_desc").css('display','block');
 		$(".ocultar").css('display','block');
 	}
 	if(desc == "no"){
 		$("#inp_cost_new").css('display','none');
 		$("#inp_report_desc").css('display','none');
 		$(".ocultar").css('display','none');
        $(".nav-tabs a:eq(3)").addClass('disabled');
        $(".nav-tabs a:eq(3)").removeClass('active');
        $(".nav-tabs a:eq(4)").addClass('active');
        $(".nav-tabs a:eq(4)").attr("data-toggle","tab");
 	}
 });

 // guardar cambios hechos en modificar datos
 $(document).on('click','#btn_save_change',function(){ 
    $(".nav-tabs a:eq(0)").addClass('disabled');
    $(".nav-tabs a:eq(1)").addClass('disabled');
    $(".nav-tabs a:eq(2)").removeClass('disabled');
    $(".nav-tabs a:eq(1)").attr("data-toggle","tab");
    $(".nav-tabs a:eq(2)").attr("data-toggle","tab");
 });
 // servicio tecnico
 $(document).on('change','input[name="options"]',function(){
 	  var tecn = $(this).val();
 	  if(tecn == "si"){
      $("#panel_prioridad").css('display','block');
    }else{
      $("#panel_prioridad").css('display','none');
    }
 });

 $(document).on('click','#btn_save_servi_tect',function(){
    $(".nav-tabs a:eq(2)").removeClass('active');
    $(".nav-tabs a:eq(3)").attr("data-toggle","tab");
    var sltd = $("#slt_priori").val();
 });
 // fin de servicio tecnico

 $(document).on('click','#myButton',function(){
    var form = Convertir_array_asociativo("form_modify_contrat");
    $.post("Controller/ContratoController.php",{"request":JSON.stringify(form)},function(data){
      var data = $.parseJSON(data);
      $(this).button('loading');
      if(data.exito){
        alert("Guardado con exito");
         $(this).removeAttr('disabled');
         Actualizar_contratos();
      }
    });
    
 });
 $(document).on('click','#btn_save_config_descuent',function(){
    var costo = $("#inp_cost_new").val();
    var descrip = $("#inp_report_desc").val(); 
    if(costo > 0 && descrip.length > 0){
     $(".nav-tabs a:eq(3)").removeClass('active');
     $(".nav-tabs a:eq(4)").attr("data-toggle","tab");
    }else{
      alert("Uno de los campos no ha sido diligenciado correctamente, por favor reviselo");
    }
 });
});
 