$(function(){
 var id_empre = 0; 
 var id_ticket = 0;
 var esta;
  function calcularTiempoDosFechas(date1){
    d = new Date();
    var date1 = date1.replace("-","/"); 
    var date1 = date1.replace("-","/"); 
    start_actual_time = new Date(date1);
    
    var ano = parseInt(start_actual_time.getFullYear());
    var mes = parseInt(start_actual_time.getMonth());
    var dia = parseInt(start_actual_time.getDate());
    var hora = start_actual_time.getHours();
    var ano_now = parseInt(d.getFullYear());
    var mes_now = parseInt(d.getMonth());
    var dia_now = parseInt(d.getDate());
    var hora_now = d.getHours();
    var años = parseInt(ano - ano_now);
    var meses = Math.abs(parseInt(mes - mes_now));
    var dias = Math.abs(parseInt(dia - dia_now));
    var horas = Math.abs(parseInt(hora - hora_now));
    var msn = '';
    if(años > 0){
      if(años == 1){
        var mes_ = 12 - mes;
        var mes_ = mes_now + mes_;
        if(mes_ == 12){
          msn += ' 1 año ';    
        }else{
          msn += ' y '+mes_+' mes ';  
        }  
      }else if(años > 1){
        msn += ' '+años+' año ';
        msn += ' y '+mes_now+' mes ';
      }
    }else{
      if(meses > 0){
        var mes_ = 12 - mes;
        var mes_ = mes_now + mes_;
        msn += mes_+' mes ';
        if(dias > 0){
          msn += ' y '+dias+' dias ';
          msn  +=' '+Math.abs(horas)+'horas ';
        }else{
          msn += ' y 0 dias ';
          msn  +=' '+Math.abs(horas)+'hora ';
        }
      }else{
        //msn  =+' '+dias+'dia ';
        if(horas > 0){
          msn  +=' '+Math.abs(horas)+'hora ';
        }
      }
    }
    return msn;
  }
  
  function Actualizar_ticket(){
    $("#myModal").modal('hide');
    $("#tbody_ticket").html(""); 
    $(".timeline").html("");
    $.post("Controller/Ticket/Ticket.php",{"all_ticket":"jsd"},function(data){
      var data = $.parseJSON(data);
      if(data[0].id){
       $.each(data,function(key,val){
        console.log(val);
        var t = '<tr>\
            <td><a href="#">'+val.id+'</a></td>\
            <td><span class="label label-success">'+val.depart+'</span></td>\
            <td>'+val.event+'</td>\
            <td>'+val.fecha+'</td>\
            <td>'+calcularTiempoDosFechas(val.fecha)+'</td>\
            <td><span class="label label-warning">'+val.stado+'</span></td>\
            <td>'+val.ciud+'</td>\
            <td><button id='+val.id+' type="button" class="btn btn-success btn_ver_msn">Ver</button></td>\
            </tr>';     
         $(t).appendTo($("#tbody_ticket"));
       });
      }
    });
  }

  $(document).on('click','.btn_ver_msn',function(){
      $("#panel_mensaje").css("display","block");
      $("#panel_respuesta").css("display","block");
      var id = $(this).attr('id');
      $("input[name='id_ticket_hidden']").val(id);
      $("#msn_pqr").html("");
      $(".timeline").html("");
      $.ajax({
        dataType:"json",
        type:"post",
        url:"Controller/Ticket/Ticket.php",
        data:{"msn_ticket":id},
        success:function(data){
          var data_ = data[0];
          var t = '<li>\
                      <div class="timeline-badge primary"><a><i class="glyphicon glyphicon-record" rel="tooltip" title="11 hours ago via Twitter" id=""></i></a></div>\
                      <div class="timeline-panel">\
                       <div class="timeline-heading">\
                       </div>\
                       <div class="timeline-body">\
                        <p style="font-size:18px">'+data_.Ticket_Descrip+'</p>\
                       </div>\
                       <div class="timeline-footer">\
                        <a class="pull-right">Continuar Lendo</a>\
                       </div>\
                      </div>\
                   </li>';
          $(t).appendTo($(".timeline"));
        }
      });

      $.ajax({
        dataType:"json",
        type:"post",
        url:"Controller/Ticket/Ticket.php",
        data:{"id_ticket_respon":id},
        success:function(data){
         if(data[0].empleado){
          $.each(data,function(key,val){
            if(key% 2 == 0){
              var t = ' <li>\
          <div class="timeline-badge primary"><a><i class="glyphicon glyphicon-record" rel="tooltip" title="11 hours ago via Twitter" id=""></i></a></div>\
          <div class="timeline-panel">\
            <div class="timeline-body">\
              <p>'+val.respuesta+'</p>\
            </div>\
                <div class="col-xs-12 timeline-footer">\
                  <div clas="col-xs-6">\
                   <div class="col-xs-12">\
                    <div class="col-xs-6">\
                     <a href="#" class="label label-primary">'+val.empleado+'</a>\
                     <a href="#" class="label label-primary">'+val.departament+'</a>\
                    </div>\
                    <div class="col-xs-6">\
                     <label class="label label-info pull-right">'+val.fecha+" hora "+val.hora+'</label>\
                    </div>\
                   </div>\
                  </div>\
                </div>\
          </div>\
        </li>';
            }else if(key%2 != 0){
             var t = '<li class="timeline-inverted">\
          <div class="timeline-panel">\
            <div class="timeline-body">\
              <p>'+val.respuesta+'</p>\
              <div class="col-xs-12 timeline-footer">\
                <div clas="col-xs-6">\
                   <div class="col-xs-12">\
                    <div class="col-xs-6">\
                     <a href="#" class="label label-primary">'+val.empleado+'</a>\
                     <a href="#" class="label label-primary">'+val.departament+'</a>\
                    </div>\
                    <div class="col-xs-6">\
                     <label class="label label-info pull-right">'+val.fecha+" hora "+val.hora+'</label>\
                    </div>\
                   </div>\
                </div>\
              </div>\
            </div>\
          </div></li>';
            }
           $(t).appendTo($(".timeline"));
          });
         }
        }
      });
  });    

      
  function Enviar_respuesta(respon,id,esta,depart,employe){
        var params = {"respuesta":respon,"id_tick":id,"estado":esta,"departamento":depart,"employ":employe};
        $.post("Controller/Ticket/Ticket.php",params,function(data){
          var data = $.parseJSON(data);
          if(data.exito){
            alert("la respuesta fue enviada");
            $("#txt_respon_user").val("");
            Actualizar_ticket();
          }else{
            alert(data.error);
          }
        });
  }


      $(".estado_ticket").change(function(){
        if($(this).val() == 1){
         $(".sltd_opcion_departa").html("");  
         $(".sltd_opcion_departa").css("display","block");
          $.ajax({
            dataType:"json",
            type:"post",
            url:"Controller/Route_config.php",
            data:{"get_departament":"all"},
            success:function(data){
             $.each(data,function(key,val){
              var t = '<option value='+val.id+'>'+val.nomb+'</option>';
              $(t).appendTo($(".sltd_opcion_departa"));
             });
            }
          });
        }else{
         $(".sltd_opcion_departa").css("display","none"); 
         $(".sltd_empleado").css("display","none");
        }
      });
      

      $("#btn_save_respon").click(function(){
        var seleted = $(".estado_ticket:checked").val();
        var respon = $("#txt_respon_user").val();
        var depart = $(".sltd_opcion_departa").val(); 
        var employed = $(".sltd_empleado").val();
        var id = $("input[name='id_ticket_hidden']").val();
        if(seleted == 1){
         if(depart){
           Enviar_respuesta(respon,id,seleted,depart,employed);
           seleted = null;
          // alert("entra en 1");
         }else{
          alert("por favor, diligencia al departamento correspondiente");
         }
        }else if(seleted == 2){
          //alert("entra en 2");
          Enviar_respuesta(respon,id,seleted,null,null);
        }else{
          alert("por favor, seleccione la opcion correspondiente a la respuesta");
        }
        seleted = null; 
      });

    $(document).on('change',".sltd_opcion_departa",function(){ 
        $(".sltd_empleado").html("");
        $(".sltd_empleado").css("display","block");
        var opcion = $(this).val();
        $.post("Controller/Route_config.php",{"user_depart":opcion},function(data){
          var data = $.parseJSON(data);
          $.each(data,function(key,val){
            var t = '<option value='+val.id+'>'+val.nombre+'</opcion>';
            $(t).appendTo($(".sltd_empleado"));
          });
        });
    });



  $(document).on('click',"#menu_ticket,.notifi_ticket",function(){ 
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
          $.each(data,function(key,val){
            var t = '<option value="'+val.id+'">'+val.nomb+'</option>';
            $(t).appendTo($("#slt_area")); 
          });
        }
   
      });
      $.ajax({
        dateType:"json",
        type:"post",
        data:{"get_departament_pais":"all"},
        url:"Controller/Route_config.php",
        success:function(data){
          var data = $.parseJSON(data);  
          $.each(data,function(key,val){
            var t = '<option value="'+val.id+'">'+val.depart+'</option>';
            $(t).appendTo($("#slt_departa")); 
          });
        }
      });
     });
  $(document).on('click',"#btn_save_ticket",function(){
    var tip_tipo_serv = $("#slt_tip_subtipo").val();
    var ciud = $("#slt_ciudad").val();
    var tel = $("#inp_tel").val(); 
    var cel = $("#inp_cel").val();
    var ticke = $("#txt_descríp").val();
    var area = $("#slt_area").val(); 
    var emplo = $("#slt_employe").val();
   if(id_empre != 0 && ticke.length && tip_tipo_serv > 0){ 
    var form = new FormData(); 
    if(area == 0){
      area  = null;
    }
    form.append("event",tip_tipo_serv);
    form.append("ciudad",ciud);
    form.append("telefono",tel);
    form.append("celular",cel);
    form.append("descrip",ticke);
    form.append("area",area);
    form.append('id_recibe',id_recibe);
    form.append('id_employed',emplo);
    form.append('estado',1);
    form.append('add_pqr_nuevo',"sds");
    form.append('Nit_empresa',id_empre); 
      $.ajax({
        datatype:"json",
	      type:"post",
	      url:"controller/Route_PQR.php",
	      data:form,
	      contentType:false,
	      processData: false
  	 }).done(function(data){
        var data = $.parseJSON(data);
        console.log(data);
 	      if(data.exito != ""){
         if(area == null){
           $("#motivo_ticket").modal('show');
         }
        id_ticket = data.last_cod_id; 
 	   	  alert("insertado con exito");
 	   	  $("#slt_ciudad").val(0);
  		  $("#inp_tel").val(0); 
  		  $("#inp_cel").val("");
  		  $("#txt_descríp").val("");
  		  $("#slt_area").val(""); 
 	      }	
 	    });
     }else{
      alert("Uno de los campos falta por digitar");
     }
  });
  $(document).on('click',"#btn_respon_ticket",function(){
    var texto = $("#txt_respon_clien").val();
    if(texto.length > 5){
      $.ajax({
        dataType:"json",
        type:"post",
        url:"controller/Ticket/ticket.php",
        data:{"respuesta":texto,"id_tick":id_ticket,"estado":1}
      }).done(function(data){
        $("#motivo_ticket").modal('hide');
      });
    }else{
      alert("por favor, digite una respuesta");
    }
  });
  function Buscar_Empresa(id_empre){
    if(id_empre != 0){
      $.post("controller/Router_usuario.php",{"buscar_empresa":"dsd","nit":id_empre},function(data){
        var data = $.parseJSON(data);
        if(data.nomb){
            $("#btn_save_ticket").css("display","block");
            $("#inp_nomb_empre").val(data.nomb);
            $("#inp_dir_empre").val(data.dir);
            $("#inp_tel_empre").val(data.tel);
            $("#inp_ciud_empre").val(data.ciud);
        }else{
           alert("Empresa no existe");
        }
      });
      $.post("controller/Route_PQR.php",{"buscar_empresa":"yes","nit":id_empre},function(data){
        var data = $.parseJSON(data);
        if(data[0].nomb){
              $.each(data,function(key,val){
                var t = 
                '<tr>\
                <td>'+val.fecha+'</td>\
                <td>'+val.estado+'</td>\
                <td>'+val.nomb+'</td>\
                <td>'+val.depart+'</td>\
                <td><a href="#" id='+val.id+' class="btn btn-danger btn-xs btn_ver_ticket"><i class="glyphicon glyphicon-zoom-in"></i></a></td>\
                </tr>';  
                $(t).appendTo($("#tbody_historial"));
              });
         }
      });
    }
  }

  function Buscar_representante(id){
    $("#tbody_empresa").html("");
   if(id == null){
    alert("por favor digite el campo de texto");
   }else{
    $.post("Controller/Router_Usuario.php",{"show_all_empresa_by_client":id},function(data){
     var data = $.parseJSON(data);
     if(data[0].nit){
      $("#modal_buscar_empre").modal('show');
      $.each(data,function(key,val){
        var t = '<tr>\
                   <td><input type="radio" name="rdio_nit" class="rdio_nit" value='+val.nit+'></td>\
                  <td>'+val.nit+'</td>\
                  <td>'+val.nomb+'</td>\
                  <td>'+val.tel+'</td>\
                </tr>';
        $(t).appendTo($("#tbody_empresa"));
      });
     }else{
      alert("No existe el cliente");
     }
    });
   }
  }

  function Buscar_empresa_por_palabras(palabra){
    $.post("Controller/Router_Usuario.php",{"search_empresa_words":palabra},function(data){
      var data = $.parseJSON(data);
      if(data[0].nit){
       $("#modal_buscar_empre").modal('show');
       $.each(data,function(key,val){
        var t = '<tr>\
                   <td><input type="radio" name="rdio_nit" class="rdio_nit" value='+val.nit+'></td>\
                  <td>'+val.nit+'</td>\
                  <td>'+val.nomb+'</td>\
                  <td>'+val.tel+'</td>\
                </tr>';
        $(t).appendTo($("#tbody_empresa"));
       });
      }else{
       alert("No existe el cliente");
      }
    });
  }
 $(document).on('click','#btn_acept_nit_empre',function(){
    id_empre = $(".rdio_nit:checked").val();
    $("#modal_buscar_empre").modal('hide');
     Buscar_Empresa(id_empre);
 });

 $(document).on('click',"#btn_search_client",function(){
  id = $("#inp_id_empre").val();
  var opcion = $("input[name='option_tip']:checked").val();
  if(opcion == 1){
    Buscar_Empresa(id);
  }
  if(opcion == 2){
    Buscar_representante(id);
  }
  if(opcion == 3){
    Buscar_empresa_por_palabras(id);
  }

  $("#tbody_historial").html("");
 
 });
  
 $(document).on('click',".btn_ver_ticket",function(){
   $(".comment-list").html("");
   var id = $(this).attr('id');
   $.ajax({
     datatype:"json",
     type:"post",
     url:"controller/Route_PQR.php",
     data:{"id_ticket":id}
   }).done(function(data){
      var data = $.parseJSON(data);
      if(data.ticket_primary){ 
        var ticke =data.ticket_primary;
        var t = '<article class="row">\
             <div class="col-md-2 col-sm-2 hidden-xs">\
              <figure class="thumbnail">\
                <img class="img-responsive" src="View/img/employed/'+ticke.img+'"/>\
                <figcaption class="text-center">'+ticke.id_recibe+'</figcaption>\
              </figure>\
            </div>\
               <div class="col-md-10 col-sm-10">\
                <div class="panel panel-default arrow left">\
                  <div class="panel-body">\
                    <header class="text-left">\
                      <div class="comment-user"><i class="fa fa-user"></i><div class="alert alert-danger" role="alert"><strong>'+ticke.nomb+'</strong></div></div>\
                      <time class="comment-date" datetime=""><i class="fa fa-clock-o"></i>'+ticke.fecha+'</time>\
                    </header>\
                    <div class="comment-post">\
                      <p>\
                         '+ticke.descri+'\
                      </p>\
                    </div>\
                    <p>\
                        Remitido al area de : <strong>'+ticke.area+'</strong>\
                    </p>\
                  </div>\
                </div>\
               </div>\
              </article>';
        $(t).appendTo($(".comment-list"));
      }
      var respon = data.ticket_respon; 
      if(respon[0].nomb){
       $.each(respon,function(key,val){
         var t = '<article class="row">\
                    <div class="col-md-2 col-sm-2 col-md-offset-1 col-sm-offset-0 hidden-xs">\
                      <figure class="thumbnail">\
                        <img class="img-responsive" src="View/img/employed/'+val.img+'"/>\
                        <figcaption class="text-center">'+val.nomb+'</figcaption>\
                      </figure>\
                    </div>\
                    <div class="col-md-9 col-sm-9">\
                      <div class="panel panel-default arrow left">\
                        <div class="panel-heading right">'+val.estado+'</div>\
                        <div class="panel-body">\
                          <header class="text-left">\
                            <div class="comment-user"><i class="fa fa-user"></i></div>\
                              <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i>'+val.fecha+'</time>\
                          </header>\
                          <div class="comment-post">\
                            <p>\
                            '+val.descri+'\
                            </p>\
                          </div>\
                        </div>\
                      </div>\
                    </div>\
                  </article>';
         $(t).appendTo($(".comment-list"));
       });
      }
   });
 });

});

$(function(){
  $(document).on('change',"#slt_estado",function(){
    var id = $(this).val();
    if(id == 3){
     $("#panel_respuesta").css('display','block');
    }
  });

   

  $(document).on('change',"#slt_departa",function(){
    var id = $(this).val();
    $("#slt_ciudad").html("");
    $.ajax({
      dateType:"json",
      type:"post",
      data:{"get_ciudad_":id},
      url:"Controller/Route_config.php",
      success:function(data){
        var data = $.parseJSON(data);  
        $.each(data,function(key,val){
          var t = '<option value="'+val.id+'">'+val.ciudad+'</option>';
          $(t).appendTo($("#slt_ciudad")); 
        }); 
      }
    });  
  });

  $(document).on('change',"#slt_tipo_serv",function(){
    $("#slt_tip_subtipo").html("");
    var id = $(this).val();
    $.ajax({
       dateType:"json",
       type:"post",
       url:"Controller/Route_config.php",
       data:{'id_servi':id}
    }).done(function(data){
      var data = $.parseJSON(data);
      if(Object.prototype.toString.call(data) === '[object Array]'){
        $.each(data,function(key,val){
          var t = '<option value='+val.id+'>'+val.name+'</option>';
          $(t).appendTo($("#slt_tip_subtipo"));
        });
      }else if(Object.prototype.toString.call(data) === '[object Object]'){
        var t = '<option value='+data.id+'>'+data.name+'</option>';
        $(t).appendTo($("#slt_tip_subtipo"));
      }
    });
  });
 });


$(document).ready(function () {
  $('.star').on('click', function () {
    $(this).toggleClass('star-checked');
  });

  $('.ckbox label').on('click', function () {
    $(this).parents('tr').toggleClass('selected');
  });

  $('.btn-filter').on('click', function () {
    var $target = $(this).data('target');
    if ($target != 'all') {
      $('.table tr').css('display', 'none');
      $('.table tr[data-status="' + $target + '"]').fadeIn('slow');
    } else {
      $('.table tr').css('display', 'none').fadeIn('slow');
      }
    });
 });
