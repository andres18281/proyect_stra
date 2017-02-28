$(function(){
  $(document).on('click','#show_contrat_activar',function(){
    $("#menu1").load("View/Admin/Registro_completo_contrato.html");
    setTimeout(function(){
      Get_listado_contratos();
    },200);
  });

    function Get_listado_contratos(){
  	 var param = {"accion":"get_contrato_sin_activar"};
     $("#list_contrat").html("");
     $.post("Controller/GestionController.php",{"request":JSON.stringify(param)},function(data){
       var data = $.parseJSON(data);
       if(data[0].id){
         $.each(data,function(key,val){
           var id = val.id;
           var ide = id.split('-');
      	   var t = '<tr><td>'+val.id+'</td><td>'+val.cost+'</td><td>'+val.descrip+'</td><td><a href="#" class="btn btn-xs btn_ver_contrat_" data-id='+val.gest_id+' id='+ide[1]+'>Ver</a></td></tr>';
      	   $(t).appendTo($("#list_contrat"));
         });
       }else{
        var t = '<tr><td colspan="4"><div class="alert alert-danger"><strong>No hay solicitudes pendientes</strong></div></td></tr>';
        $("#list_contrat").append(t);
       } 
     });  
    }
    

    function Get_informe(id){
      var param = {"accion":"get_informe","id":id};
      $.ajax({
        url:"Controller/GestionController.php",
        dataType:"json",
        type:"post",
        async: false,
        data:{"request":JSON.stringify(param)}
      }).done(function(data){
          console.log(data);
          var text = data.descrip;
          var img = data.foto;
          var imag = img.split(',');
          $("#p_descripcion").text(text);
          $.each(imag,function(key,val){
            var image = 'View/img/img_reportes/'+val;
            var t = '<div class="item">\
                      <img alt="" title="" src='+image+'>\
                     </div>';
            $(t).appendTo($("#list_imagen"));
            var list = '<li class="" data-slide-to='+key+' data-target="#article-photo-carousel">\
                          <img alt="" src='+image+'>\
                        </li>';
            $(list).appendTo($("#list_indicator"));
          });
          $("#list_imagen").find('.item').eq(0).addClass('active');
          $("#list_indicator").find('li').eq(0).addClass('active');
      });  
    }

    function Get_materiales(id){
      var param = {"accion":"get_material","id":id};
      $.post("Controller/GestionController.php",{"request":JSON.stringify(param)},function(data){
        var data = $.parseJSON(data);
        if(data[0].nomb){
          $.each(data,function(key,val){
            var t = '<tr><td>'+val.nomb+'</td><td>'+val.cant+'</td><td><input type="number" required placeholder="diligencie el costo del material" class="form-control text_precio requerido_texto" id='+val.id+'></td><td><span class="glyphicon" id="span_'+val.id+'"></span></td></tr>';
            $(t).appendTo($("#list_material"));
          });
          var t = '<tr><td colspan="3"><a href="#" class="btn btn-default pull-right" id="btn_save_price_mate">Guardar</a></td></tr>';
          $(t).appendTo($("#list_material"));
        }
      });
    }

    function Cargar_plantilla(id){
      $(".nav-tabs a:eq(0)").removeClass('disabled');
      $(".nav-tabs a:eq(1)").removeClass('disabled');
      $(".nav-tabs a:eq(0)").attr("data-toggle","tab");
      $(".nav-tabs a:eq(1)").attr("data-toggle","tab");
      $("#panel_contrato").load("View/template/contratos/contrato.html");
      $.post("Controller/Route_config.php",{"all_service":"all"},function(data,status){
        if(data){
         var data = $.parseJSON(data);
         $.each(data,function(key,val){
          var t = '<option value='+val.id+'>'+val.nomb+'</option>';
          $(t).appendTo($("#tip_servi"));
         });
        }
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
        var templa = $('#panel_contrato').html();
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
        $('#panel_contrato').html(templa);
      });  
    }
   

  $(document).on('click',".btn_ver_contrat_",function(){
    $("input[name='id_num_contrat']").val($(this).attr('id'));
    var id = $(this).attr('id');
    var id_gest = $(this).attr('data-id');
    $(".panel_visible").css('display','block');
    $(".btn_activar").attr('id',id);
    Cargar_plantilla(id);
    Get_informe(id);
    Get_materiales(id_gest);
  });

  var total_ = 0;
  function Formatear(costo){
    var costo = parseInt(costo);
    var costo = costo.toFixed(0).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
    return "$ "+costo;
  }

  var llamar_pagos = function(id){
    var param = {"accion":"Get_pagos_by_contrat","id":id};
    $.post("Controller/ContratoController.php",{"request":JSON.stringify(param)},function(data){
      var data = $.parseJSON(data);
      $.each(data,function(key,val){ 
        var costo = val.costo;
        total_ += parseInt(costo);
        var costo = Formatear(costo);
        var t = '<tr><td>'+val.fecha_ini+'</td><td>'+val.fecha_end+'</td><td>'+costo+'</td></tr>';
        $(t).appendTo($("#list_pagos"));
        $("#td_total").text(Formatear(total_));
      });
      $(".btn_activar").attr('id','');
      $(".btn_activar").css('display','none');
      $("#myModal_msn").modal('show');
    }); 
  };

  $(document).on('click',".btn_activar",function(){
    var id = $(this).attr('id');
    if(id){
      var param = {"accion":"activar_contrato","id":id};
      $.post("Controller/GestionController.php",{"request":JSON.stringify(param)},function(data){
        var data = $.parseJSON(data);
        if(data.exito){
         llamar_pagos(id);
         Get_listado_contratos();
        }
      });
    }else{
      alert("ya se activo el contrato");
    }
  });

  $(document).on('keyup',".text_precio",function(e){
    var index = $(".text_precio").index($(this));
    $(".text_precio").eq(index).removeClass("requerido_texto");
  });

  $(document).on('click','#btn_save_price_mate',function(){
    var array = {};
    $(".text_precio").each(function(key,val){
      array[$(val).attr('id')] = $(val).val();
    });
    $.post("Controller/Router_materiales.php",{"update_price_material":JSON.stringify(array)},function(data){
      var data = $.parseJSON(data);
      if(data[0].last_cod_id){
        $.each(data,function(key,val){
          if("#span_"+val.last_cod_id){
            $("#span_"+val.last_cod_id).addClass('glyphicon-ok');
          } 
        });
      }
    });
  });
    
  $('.carousel').carousel({
    interval: false
  });
});