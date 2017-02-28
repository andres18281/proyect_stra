<!DOCTYPE html>
<html>
<head>
	<title></title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
 <nav class="navbar navbar-default">
   <div class="container-fluid">
   	<!-- Brand and toggle get grouped for better mobile display -->
    <!-- Collect the nav links, forms, and other content for toggling -->
   	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
   	  <ul class="nav navbar-nav navbar-right">
      	<li class="dropdown">
       	  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu <span class="caret"></span></a>
       	  <ul class="dropdown-menu">         	  
            <li><a href="agregar_ticket.php">Agregar Tickets</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Salir</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
   </div><!-- /.container-fluid -->
 </nav>
<div class="container-fluid">
  <div class="row"> 
   <div class="col-md-3">
    <div class="panel panel-default">
     <div class="panel-heading" style="text-align: center">
  		<label style="font-size: 20px;" >Menu</label>
     </div>
     <div class="panel-body">
   	   <ul class="nav nav-pills nav-stacked">
        <li role="presentation" id="menu_0"><a href="#">Agregar Areas de Trabajo</a></li>
   	   	<li role="presentation" id="menu_1"><a href="#">Agregar Servicio</a></li>
  	   	<li role="presentation" id="menu_2"><a href="#">Agregar Evento</a></li>
  	   	<li role="presentation" id="menu_3"><a href="#">Listar</a></li>
        <li role="presentation" id="menu_4"><a href="#">Agregar Cargos</a></li>
        <li role="presentation" id="menu_5"><a href="#">Agregar Empleado</a></li>
   	   </ul>
   	 </div>
    </div>
   </div>
   <div class="col-md-9" id="menu"></div>
  </div><!--row-->
</div>
</body>
</html>
<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="View/js/configuracion.js"></script>
<script src="View/js/agregar_empleado.js"></script>
<script type="text/javascript">
  $(function(){
  	$("#menu_0").click(function(){
      $("#menu").load("View/template/configuracion/add_area_trabajo.html");
      $.ajax({
        dateType:"json",
        type:"post",
        url:"Controller/Route_config.php",
        data:{"get_departament":"all"}
      }).done(function(data){
        var data = $.parseJSON(data);
        if(Object.prototype.toString.call(data) === '[object Array]'){
          $.each(data,function(key,val){
            var t = '<tr><td style="text-align:center;">'+val.nomb+'</td></tr>';
            $(t).appendTo($("#tbody_depart"));
          });
        }else if(Object.prototype.toString.call(data) === '[object Object]'){
          var t = '<tr><td style="text-align:center;">'+data.nomb+'</td></tr>';
          $(t).appendTo($("#tbody_depart"));
        }
      }); 
    });

  	$("#menu_1").click(function(){
  	  $("#menu").load("View/template/configuracion/tipo_servicio.html");	
  	});

  	$("#menu_2").click(function(){
  	  $("#menu").load("View/template/configuracion/add_event.html");			
  	  $.ajax({
  	  	dateType:"json",
  	  	type:"post",
  	  	data:{"all_service":"all"},
  	  	url:"Controller/Route_config.php",
  	  	success:function(data){
  	  	 var data = $.parseJSON(data);	
  	     if(Object.prototype.toString.call(data) === '[object Array]'){
  	  	  $.each(data,function(key,val){
  	  	    var t = '<option value="'+val.id+'">'+val.nomb+'</option>';
  	  	    $(t).appendTo($("#slt_servi"));	
  	  	  });
  	  	 }else if(Object.prototype.toString.call(data) === '[object Object]'){
            var t = '<option value="'+data.id+'">'+data.nomb+'</option>';
            $(t).appendTo($("#slt_servi"));   
         }	
  	  	}
  	  });	
  	});

  	$("#menu_3").click(function(){
  	  $("#tbody_list_servi").html("");	
  	  $("#menu").load("View/template/configuracion/listados.html");	
  	});
    
    $("#menu_4").click(function(){
      $("#menu").load("View/template/configuracion/Registrar_cargo.html"); 
      $.ajax({
        dateType:"json",
        type:"post",
        url:"Controller/Route_config.php",
        data:{"get_departament":"all"}
      }).done(function(data){
        var data = $.parseJSON(data);
        if(Object.prototype.toString.call(data) === '[object Array]'){
          $.each(data,function(key,val){
            var t = '<option value='+val.id+'>'+val.nomb+'</option>';
            $(t).appendTo($("#slt_depart_emp"));
          });
        }else if(Object.prototype.toString.call(data) === '[object Object]'){
          var t = '<option value='+val.id+'>'+val.nomb+'</option>';
          $(t).appendTo($("#slt_depart_emp"));
        }
      }); 
    });

    $("#menu_5").click(function(){
       $("#menu").load("View/template/configuracion/Registrar_empleado.html");  
      $.ajax({
        dateType:"json",
        type:"post",
        url:"Controller/Route_config.php",
        data:{"get_departament":"all"}
      }).done(function(data){
        var data = $.parseJSON(data);
        if(Object.prototype.toString.call(data) === '[object Array]'){
          $.each(data,function(key,val){
            var t = '<option value='+val.id+'>'+val.nomb+'</option>';
            $(t).appendTo($("#slt_depart_empre"));
          });
        }else if(Object.prototype.toString.call(data) === '[object Object]'){
          var t = '<option value='+val.id+'>'+val.nomb+'</option>';
          $(t).appendTo($("#slt_depart_empre"));
        }
      });

      $.ajax({
        dateType:"json",
        type:"post",
        data:{"get_departament_pais":"all"},
        url:"Controller/Route_config.php",
        success:function(data){
          var data = $.parseJSON(data);  
          console.log(Object.prototype.toString.call(data));
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

      $(document).on('change',"#slt_departa",function(){
        var id = $(this).val();
        $.ajax({
          dateType:"json",
          type:"post",
          data:{"get_ciudad_":id},
          url:"Controller/Route_config.php",
          success:function(data){
            var data = $.parseJSON(data);  
            if(Object.prototype.toString.call(data) === '[object Array]'){ 
              $.each(data,function(key,val){
                var t = '<option value="'+val.id+'">'+val.ciudad+'</option>';
                $(t).appendTo($("#slt_ciudad")); 
              });
            }else if(Object.prototype.toString.call(data) === '[object Object]'){
              var t = '<option value="'+data.id+'">'+data.ciudad+'</option>';
              $(t).appendTo($("#slt_ciudad"));
            }  
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
  });
  	
  	$(document).on('click',"#bnt_add_servi",function(){
  	  var cod =	$("#inp_cod_servi").val(); 
  	  var nomb = $("#inp_nomb_servi").val();	 
  	  if(cod.length > 0 && nomb.length > 0){
  	  	$.ajax({
  	  		dateType:"json",
  	  		type:"post",
  	  		data:{"cod_serv":cod,"nomb_servi":nomb},
  	  		url:"Controller/Route_config.php"
  	  	}).done(function(data){
  	  		$("#inp_nomb_servi").val(""); 
  	  		$("#inp_cod_servi").val(""); 
  	  		var data = $.parseJSON(data);
  	  		if(data.exito){
  	  	  		var t = '<tr><td>'+cod+'</td><td>'+nomb+'</td></tr>';	
  	      		$(t).appendTo($("#tbody_servicio"));
  	  		}
  	  	});
  	  }else{
  	  	alert("por favor digitar el codigo y nombre del servicio");
  	  }
  	});

  	$(document).on('click','#btn_add_event',function(){
  	  var id_even = $("#id_evento").val();
  	  var slt_ser =	$("#slt_servi").val(); 
  	  var nomb_ser = $("#txt_nomb_even").val();
      var descrip = $("#descrip_event").val();
  	  if(id_even > 0 && slt_ser > 0 && nomb_ser.length > 0){
  	  	$.ajax({
  	  		dateType:"json",
  	  		type:"post",
  	  		data:{"cod_servi":id_even,"id_servi_":slt_ser,"nomb_servi":nomb_ser,"descrip":descrip},
  	  		url:"Controller/Route_config.php"
  	  	}).done(function(data){
  	  		var data = $.parseJSON(data);
  	  		if(data.exito){
  	  			var text_se = $('#slt_servi option[value='+slt_ser+']').text();
  	  	  	var t = '<tr><td>'+id_even+'</td><td>'+text_se+'</td><td>'+nomb_ser+'</td></tr>';
  	      	$(t).appendTo($("#tbody_event"));
            $("#id_evento").val("");
            $("#slt_servi").val(""); 
            $("#txt_nomb_even").val("");
            $("#descrip_event").val("");
  	  		}
  	  	});
  	  }else{
  	  	alert(" Uno de los campos no fue digitado correctamente");
  	  }
  	});


    $(document).on('click','#btn_add_depart',function(){
      var departament = $("#txt_departament").val();
      $.ajax({
        dateType:"json",
        type:"post",
        url:"Controller/Route_config.php",
        data:{"departament":departament}
      }).done(function(data){
        var data = $.parseJSON(data);
        if(data.exito){
          var t = '<tr style="background-color: rgba(113, 184, 82, 0.7);"><td style="text-align:center;">'+departament+'</td></tr>';
          $(t).appendTo($("#tbody_depart"));
        } 
      });  
    });
      



  	
</script>
<script type="text/javascript">

    $(document).ready(function() {
    var activeSystemClass = $('.list-group-item.active');

    //something is entered in search form
    $(document).on('keyup','#system-search',function(){
       var that = this;
        // affect all table rows on in systems table
        var tableBody = $('.table-list-search tbody');
        var tableRowsClass = $('.table-list-search tbody tr');
        $('.search-sf').remove();
        tableRowsClass.each( function(i, val) {
        
            //Lower text for case insensitive
            var rowText = $(val).text().toLowerCase();
            var inputText = $(that).val().toLowerCase();
            if(inputText != '')
            {
                $('.search-query-sf').remove();
                tableBody.prepend('<tr class="search-query-sf"><td colspan="6"><strong>Buscando por: "'
                    + $(that).val()
                    + '"</strong></td></tr>');
            }
            else
            {
                $('.search-query-sf').remove();
            }

            if( rowText.indexOf( inputText ) == -1 )
            {
                //hide rows
                tableRowsClass.eq(i).hide();
                
            }
            else
            {
                $('.search-sf').remove();
                tableRowsClass.eq(i).show();
            }
        });
        //all tr elements are hidden
        if(tableRowsClass.children(':visible').length == 0)
        {
            tableBody.append('<tr class="search-sf"><td class="text-muted" colspan="6">No entries found.</td></tr>');
        }
    });
});

</script>


