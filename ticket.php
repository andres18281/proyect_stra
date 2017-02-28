<!DOCTYPE html>
<html>
<head>

	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="View/css/timeline.css"/>
  <link rel="stylesheet" href="View/css/orden_pqrs.css"/>
  <style>
    .salto{
      margin-top: 5px;
    }
  </style>
</head>
<body>
 <div class="container-fluid">
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
  <div>
 
 <div class="container-fluid">
  <div class="col-md-3">
   <div class="col-md-12">
    
   	 <label> Cedula o nit</label>
   	  <input type="text" class="form-control" id="inp_id_empre">
     
   </div>
   <div class="col-md-5 col-md-offset-7">
      <button class="btn btn-danger btn-block" id="btn_search_client">Buscar</button>
   </div>
  </div>
  <div class="col-md-9">
    <div class="container-fluid">
   	 <div class="container">
   	  <ul class="nav nav-tabs" role="tablist">
    	<li role="presentation" class="active"><a href="#registro" aria-controls="home" role="tab" data-toggle="tab">Registro de Cliente</a></li>
    	<li role="presentation"><a href="#historial" aria-controls="profile" role="tab" data-toggle="tab">Historial</a></li>
      <li role="presentation"><a href="#datos" aria-controls="datos" role="tab" data-toggle="tab">Datos de Empresa</a></li>
  	  </ul>
  	  <div class="tab-content">
    	 <div role="tabpanel" class="tab-pane active" id="registro">
    	  <div class="container" style="margin-top: 30px;">
    	   <div class="container">
    	    <div class="col-md-3">
    	      <label> Tipo de servicio</label>
    	    </div>
    	    <div class="col-md-3">
    	      <select class="form-control input-md" id="slt_tipo_serv">
    	      	<option></option>
    	      </select>	
    	    </div>
    	    <div class="col-md-3">
    	      <label> Tipo de Evento</label>
    	    </div>
    	    <div class="col-md-3">
    	      <select class="form-control input-md" id="slt_tip_subtipo">
    	      	<option></option>
    	      </select>	
    	    </div>
    	   </div><!--container-->
         <div class="container salto">
           <div class="col-md-3"><label> Departamento</label></div>
           <div class="col-md-3">
            <select class="form-control" id="slt_departa"> 
             <option></option>
            </select>
           </div>
           <div class="col-md-3"><label> Ciudad</label></div>
           <div class="col-md-3">
            <select class="form-control" id="slt_ciudad"> 
             <option></option>
            </select>
           </div>
         </div><!--container-->
    	   <div class="container salto">
    	    <div class="col-md-6">
    	   	 <label>Telefono de Contacto</label><input type="text" class="form-control" placeholder="Telefono" id="inp_tel"> 
    	   	</div>
    	   	<div class="col-md-6">
    	   	 <label>Celular de Contacto</label><input type="text" class="form-control" placeholder="Celular" id="inp_cel">
    	   	</div>
    	   </div><!--row-->
    	   <div class="container salto">
          <div class="col-md-12">
    	   	 <label> Descripcion de la peticion</label>
    	   	 <textarea class="form-control" id="txt_descríp" rows="6"></textarea>
    	    </div>
         </div>
    	   <div class="container salto">
          <div class="col-md-12">
            <div class="col-md-7">
             <label> Area de destino</label>
             <select class="form-control" id="slt_area">
               <option></option>
             </select>
            </div>
    	      <div class="col-md-5">
    	        <br>
    	    	  <button class="btn btn-success btn-block" id="btn_save_ticket">Guardar</button>
    	      </div>
          </div>
    	   </div> 
    	  </div><!--container-->
    	 </div>
    	 <div role="tabpanel" class="tab-pane" id="historial">
 		     <div class="container-fluid">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>
                           Fecha
                        </th>
                        <th>
                            Estado
                        </th>
                        <th>
                            Nombre
                        </th>
                         <th>
                            Departamento
                        </th>
                      </tr>
                    </thead>
                    <tbody id="tbody_historial">
                    
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
         </div>
         <div class="container-fluid">
          <div class="panel panel-default">
           <div class="panel-heading">
             <h3 style="text-align: center;"> Historial</h3>
           </div>
           <div class="panel-body">
             <section class="comment-list">
             </section>
           </div>
          </div>
         </div>
    	 </div>
       <div role="tabpanel" class="tab-pane" id="datos">
         <div class="container">
          <div class="row">
            <section class="content">
              <h1>Datos De la empresa</h1>
                <div class="col-md-9">
                  <div class="panel panel-default">
                    <div class="panel-body">
                      <div class="form-group">
                        <label>Nombre de empresa</label>
                        <input type="text" class="form-control" id="inp_nomb_empre" readonly="true">
                      </div>
                      <div class="form-group">
                        <label>Direccion</label>
                        <input type="text" class="form-control" id="inp_dir_empre" readonly="true">
                      </div>
                      <div class="form-group">
                        <label>Telefono</label>
                        <input type="text" class="form-control" id="inp_tel_empre" readonly="true">
                      </div>
                      <div class="form-group">
                        <label>Ciudad</label>
                        <input type="text" class="form-control" id="inp_ciud_empre" readonly="true">
                      </div>
                      <div class="table-container">
                        <table class="table">
                          <tbody>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
            </section>
          </div>
         </div>
       </div>

   	  </div><!--tapcontent-->
     </div><!--container-->
    </div><!--container-fluid-->
  </div><!--col-md-9-->
 </div><!--container-fluid-->
</body>
</html>
<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.min.js" type="text/javascript"></script>
<script src="View/js/ticket.js"></script>
<script src="View/js/configuracion.js"></script>
<script src="View/js/agregar_empleado.js"></script>

<script>
 $(function(){
  $("#slt_estado").on('change',function(){
  	var id = $(this).val();
  	if(id == 3){
  	 $("#panel_respuesta").css('display','block');
  	}
  });

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

  $("#slt_departa").change(function(){
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



  $("#slt_tipo_serv").change(function(){
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


</script>

<!--

<div class="container" style="display:none;" id="panel_respuesta">
           <label> Solucion al cliente</label>
           <textarea class="form-control" rows="6"></textarea>
         </div>
         <div class="container">
          <div class="col-md-3">
            <label> Estado </label>
            <select class="form-control input-md" id="slt_estado">
              <option></option>
              <option value="1">Pendiente</option>
              <option value="2">En Proceso</option>
              <option value="3">Finalizado</option>
            </select> 
          </div>