$(function(){
     // contratos 

    function llenar_selete_departamento(){
      $.post("Controller/Route_config.php",{"get_departament_pais":"all"},function(data){
          var data = $.parseJSON(data);
          $.each(data,function(key,val){
            var t = '<option value='+val.id+'>'+val.depart+'</option>';
            $(t).appendTo($("#stl_departa","form#form_contrato_create"));
          });
        });
    }

    function llenar_seleted_servicios_principales(){
      $.post("Controller/Router_servicio.php",{"listar_servicios_principal":"all"},function(data,status){
        var data = $.parseJSON(data);
        $.each(data,function(key,val){
          var t = '<option value='+val.id+'>'+val.nomb+'</option>';
          $(t).appendTo($("#tip_servi","form#form_contrato_create"));
        });
      });
    }

    $(document).on('change',"#stl_departa",function(){
      var id = $(this).val();
      $("#slt_ciudad").html("");
      $.post("Controller/Route_config.php",{"get_ciudad_":id},function(data){
        var data = $.parseJSON(data);
        $.each(data,function(key,val){
          var t = '<option value='+val.id+'>'+val.ciudad+'</option>';
          $(t).appendTo($("#slt_ciudad"));
        });
      });
    });

    
    $("#add_contra").click(function(){
	 	 $("#menu1").load("View/Admin/Registrar_contrato.html");
      setTimeout(function(){ 
        llenar_seleted_servicios_principales();
        llenar_selete_departamento();
      },100);  
	  });

    var precio_ = null;
    var nit_empre = null;
    $(document).on('click','.id_empre',function(){
      nit_empre = $(this).attr('id'); 
      //$.post()
    });

    $(document).on('click','#btn_buscar_client',function(){
      $("#modal_body_opcion").html("");
      var ced = $("#inp_ced_client").val();
      $.post("Controller/Router_usuario.php",{"show_all_empresa_by_client":ced},function(data){
       var data = $.parseJSON(data);
        if(data[0].nit){
          $.each(data,function(key,val){
            var t = "<tr>\
                       <td>\
                        <input type='radio' name='opcion_empre_nit' class='radio_nit_empre' value="+val.nit+">\
                       </td>\
                       <td>\
                        <p style='color:black'><b>"+val.nit+"</b></p>\
                      </td>\
                      <td>\
                        <p style='color:black'><b>"+val.nomb+"</b></p>\
                      </td>\
                    </tr>";
            $(t).appendTo($("#modal_body_opcion"));
          });
          $("#modal_title_opcion").html("<p><b>Seleccione la empresa correspondiente al cliente</b></p>");
          $("#myModal_opcion").modal('show');
        }else{
          alert("no existe");
          $("#msn_info").html("<h4>El usuario no existe,por favor, creelo</h4>");
          $("#modal_accion").html("");
          $("#modal_accion").append('<button type="button" class="btn btn-primary" id="btn_acept_option_modal">Aceptar</button><button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>');  
          $("#myModal_msn").modal('show'); 
        }
      });
    });

    $(document).on('click',"#btn_acept_option_modal",function(){
      $("#myModal_msn").modal('hide');
      $("#menu1").load("View/Admin/Registra_usuario.html");
    });
    
    $(document).on('click','#btn_acept_option',function(){
      var nit_empre = $(".radio_nit_empre:checked").val();
      if(nit_empre){ 
       $("#btn_save_contrat").css("display","block");
       $("input[name='inp_hid_id_client']").val(nit_empre); 
       $("#myModal_opcion").modal('hide');
       var json = {"accion":"Get_all_contrato_by_empre","id":nit_empre};
       $.post("Controller/ContratoController.php",{"request":JSON.stringify(json)},function(data){
        $("#table_list_contrat").html("");
        var data = $.parseJSON(data);
        $.each(data,function(key,val){
          var resaltar = '';
          if(val.estado == "Activo"){
             resaltar = 'success';
          }else{
            resaltar = 'danger';
          }
          var t = '<tr class='+resaltar+'>\
                      <td><p style="color:black;text-align:center;"><b>'+val.id+'</b></td>\
                      <td><p style="color:black;text-align:center;">'+val.servicio+'</b></td>\
                      <td><p style="color:black;text-align:center;">'+val.form_pago+'</b></td>\
                      <td><p style="color:black;text-align:center;">'+val.inicio+'</b></td>\
                      <td><p style="color:black;text-align:center;">'+val.fin+'</b></td>\
                      <td><p style="color:black;text-align:center;">'+val.estado+'</b></td>\
                      <td><p style="color:black;text-align:center;">'+val.total+'</b></td>\
                      <td><p style="color:black;text-align:center;">'+val.pagos+'</b></td>\
                      <td><a href="#" id='+val.id+' class="btn btn-danger btn-xs btn_ver_pagos">Ver Pagos</a></td>\
                   </tr>';
          $(t).appendTo($("#table_list_contrat"));
        });
       });
      }
    });

    $(document).on('click','.btn_ver_pagos',function(){
      $("#list_fact_").html(""); 
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
               <td><a href="#" class="btn btn-xs btn-primary btn_ver_fact" id='+val.id+'>Ver</a></td>\
             </td>';
          $(t).appendTo($("#list_fact_"));
        });
      });     
    });

    $(document).on('click',".btn_ver_fact",function(){
      $("#myModal_msn").modal('show');
      $("#msn_info").load('factura2.html');
      setTimeout(function(){
        $("#panel_info_tribu").css('display',"none");
        $("#panel_observaciones").css('width','100%');
      },100);
    });

	  $(document).on('click',"#show_contrat",function(){
     $("#show_all_contrat").html("");
	 	 $("#menu1").load("View/Admin/Show_contratos.html");
     alert("hola");
     setTimeout(function(){
      $.post("Controller/Router_contrato.php",{"show_all_contrato":"all"},function(data){
         var data = $.parseJSON(data);
         $.each(data,function(key,val){
           var t = '<tr>\
                     <td>'+val.id+'</td>\
                     <td>'+val.client+'</td>\
                     <td>'+val.servi+'</td>\
                     <td>'+val.time+'</td>\
                     <td>'+val.timeini+'</td>\
                     <td>'+val.timefin+'</td>\
                     <td>'+val.estado+'</td>\
                     <td>\
                       <td><p data-placement="top" data-toggle="tooltip" title="Edit">\
                         <button class="btn btn-primary btn-xs" data-title="Edit" id='+val.id+' data-toggle="modal" data-target="#edit">\
                          <span class="glyphicon glyphicon-book"></span>\
                         </button></p>\
                       </td>\
                       <td><p data-placement="top" data-toggle="tooltip" title="Delete">\
                            <button class="btn btn-danger btn-xs" data-title="Delete" id='+val.id+' data-toggle="modal" data-target="#delete">\
                              <span class="glyphicon glyphicon-usd"></span>\
                            </button></p>\
                       </td>\
                     </tr>\
                      </td>\
                    </tr>';
              $(t).appendTo($("#tbody_list_contrat"));    
         });
      });
     },100);
	  });

   

	$("#add_event").click(function(){
	 	$("#menu1").load("View/Admin/add_servicios.html");
	});
	$("#confi_servi").click(function(){
	 	$("#menu1").load("View/Admin/item_servicios.html");
	});
	$("#menu_3").click(function(){
  	  $("#tbody_list_servi").html("");	
  	  $("#menu1").load("View/template/configuracion/listados.html");	
  });
  	$("#menu_2").click(function(){
  	  $("#menu1").load("View/template/configuracion/add_event.html");			
  	  $.ajax({
  	  	dateType:"json",
  	  	type:"post",
  	  	data:{"all_service":"all"},
  	  	url:"Controller/Route_config.php",
  	  	success:function(data){
  	  	 var data = $.parseJSON(data);	
  	  	  $.each(data,function(key,val){
  	  	    var t = '<option value="'+val.id+'">'+val.nomb+'</option>';
  	  	    $(t).appendTo($("#slt_servi"));	
  	  	  });
  	  	}
  	  });	
  	});

  	$("#add_servi").click(function(){
  	  $("#menu1").load("View/Admin/add_servicios.html");
  	});

  	$("#menu_4").click(function(){
      $("#menu1").load("View/template/configuracion/Registrar_cargo.html"); 
      $.ajax({
        dateType:"json",
        type:"post",
        url:"Controller/Route_config.php",
        data:{"get_departament":"all"},
        success:function(data){
          var data = $.parseJSON(data);
          $.each(data,function(key,val){
            console.log(key + " "+ val);
            var t = '<option value="'+val.id+'">'+val.nomb+'</option>';
            $(t).appendTo($("#slt_depart_emp"));
          });
        }
      });
    });

    $("#menu_5").click(function(){
      $("#menu1").load("View/template/configuracion/Registrar_empleado.html");  
      setTimeout(function(){
       $.post("Controller/Route_config.php",{"get_departament_pais":"all"},function(data){
        $(".inp_depart").html("");
          var data = $.parseJSON(data);
          $.each(data,function(key,val){ 
           if(val.id){
            var t = '<option value='+val.id+'>'+val.depart+'</option>';
            $(t).appendTo($(".inp_depart")); 
           }
          });
       });
       $.post("Controller/Route_config.php",{"get_departament":"all"},function(data){
        var data = $.parseJSON(data);
        if(data[0].id){
          $.each(data,function(key,val){
            var t = '<option value='+val.id+'>'+val.nomb+'</option>';
            $(t).appendTo($("#slt_depart_empre"));
          });
        }
       });
      },10); 

      $(document).on('change',".inp_depart",function(){
        var id = $(this).val();
        $.ajax({
          dateType:"json",
          type:"post",
          data:{"get_ciudad_":id},
          url:"Controller/Route_config.php",
          success:function(data){
            $.each(data,function(key,val){
              var t = '<option value="'+val.id+'">'+val.ciudad+'</option>';
              $(t).appendTo($(".inp_ciud_emp")); 
            });
          }
        });  
      });

      $(document).on('click','.thumbnail',function(){
        $('input[type="file"]').trigger('click');
      });
      
      $(document).on('change','input[type="file"]',function(){
        var file;
        var img;
        img = $('</img>', {
            id: 'dynamic',
            width:250,
            height:200
        });      
        file = this.files[0]; 
        var reader = new FileReader();
         reader.onload = function(e){        
           $("#dynamic").attr('src',"");    
           $("#dynamic").attr('src', e.target.result);
         }        
         reader.readAsDataURL(file);
      });
    });


    $("#menu_6").click(function(){
      $("#menu1").load("View/template/empleados/show_employed.html");
      $.post("Controller/Route_config.php",{"get_departament":"all"},function(data){
        var data = $.parseJSON(data);
        if(data[0].id){
          $.each(data,function(key,val){
            var t = '<option value='+val.id+'>'+val.nomb+'</option>';
            $(t).appendTo($("#slt_all_depart"));
          });
        }
      });
    });

    

    $("#add_usuario").click(function(){
	 	 $("#menu1").load("View/Admin/Registra_usuario.html");
      setTimeout(function(){
       $.post("Controller/Route_config.php",{"get_departament_pais":"all"},function(data){
        $(".inp_depart").html("");
          var data = $.parseJSON(data);
          $.each(data,function(key,val){ 
           if(val.id){
            var t = '<option value='+val.id+'>'+val.depart+'</option>';
            $(t).appendTo($(".inp_depart")); 
           }
          });
       });
       $("input[type='file']").fileinput({
        language: 'en',
        showCaption: true,
        showPreview: true,
        showRemove: true,
        showUpload: false, // <------ just set this from true to false
        showCancel: true,
        showUploadedThumbs: true
       });
      },10);
	  });

    $(document).on('change',".inp_depart",function(){
      var depart = $(this).val();
      $(".inp_ciud_emp").html("");
      $.post("Controller/Route_config.php",{"get_ciudad_":depart},function(data){
        if(data){
          var data = $.parseJSON(data);
          $.each(data,function(key,val){
           if(val.id){
            var t = '<option value='+val.id+'>'+val.ciudad+'</option>';
            $(t).appendTo($(".inp_ciud_emp"));
           }
          });
        }
      });
    });
	 // configuracion de area de trabajo
	$("#menu_0").click(function(){
      $("#menu1").load("View/template/configuracion/add_area_trabajo.html");
      $.ajax({
        dateType:"json",
        type:"post",
        url:"Controller/Route_config.php",
        data:{"get_departament":"all"}
      }).done(function(data){
        var data = $.parseJSON(data);
        if(data[0].nomb){ 
          $.each(data,function(key,val){
            var t = '<tr id="tr_'+val.id+'"><td style="text-align:center;">'+val.nomb+'</td>\
                     <td><a href="#" class="btn btn-danger btn-xs btn_delete_area" id='+val.id+'><span class="glyphicon glyphicon-trash"></span></a></td></tr>';
            $(t).appendTo($("#tbody_depart"));
          });
        }
      }); 
    });
    $(document).on('click','.btn_delete_area',function(){
      var id = $(this).attr('id');
      $.post("Controller/Route_config.php",{"Area_delete_id":id},function(data){
        var data = $.parseJSON(data);
        if(data.exito){
          alert("Area removida con exito");
          $('#tr_'+id).slideUp('slow');
        }else if(data.error == "1064"){
          alert("No se puede eliminar, existe personal en el area. Si va a eliminar esta area, porfavor modifique los empleados asignados al area");
        }
      });
    });
    function Convertir_array_asociativo(form){
      var form =  $("#"+form).serializeArray();
      var json = {};
      $.each(form,function(key,val){
        json[val.name] = val.value; 
      });    
      return json;
    }
    
    $(document).on('click',"#enviar_",function(e){
      e.preventDefault();
      var ticket = Convertir_array_asociativo("form_config_ticket");
      var contrat = Convertir_array_asociativo("form_config_contrat");
      var emple = Convertir_array_asociativo("form_config_empleado");
      var client = Convertir_array_asociativo("form_config_client");
      var provee = Convertir_array_asociativo("form_config_provee");
      var soport = Convertir_array_asociativo("form_config_soport");
      var id = $("#count_id").val();
      var params = {"add_modulo_employed":"","ticket":ticket,"contrat":contrat,"emple":emple,"client":client,"provee":provee,"soport":soport,"id_emplo":id};
      $.post("Controller/ModuloController.php",{"accion":JSON.stringify(params)},function(data){
        var data = $.parseJSON(data);
        if(data.exito){
          alert("Guardado con exito");
        }
      });
    });

    $(document).on('click','.btn_asig_modulo',function(e){
      var id = $(this).attr('id');
      $("#count_id").val(id);
      $("li[role='presentation']").eq(0).removeClass('active');
      $("li[role='presentation']").eq(1).addClass('active');
      $("a[href='#home']").attr('aria-expanded',false);
      $("a[href='#profile']").attr('aria-expanded',true);
      $("#home").removeClass('active');
      $("#profile").addClass('active');
    });
	});