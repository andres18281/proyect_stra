$(function(){
  $(document).on('click',"#btn_add_servi",function(){ 
  	var id = $("#inp_id_servi").val();
  	var nomb = $("#inp_nom_servi").val(); 
    var params = {"id_item":id,"nomb_servi":nomb,"agregar_servicio":"sss"};
    $.post("Controller/Router_servicio.php",params,function(data){
     var data = $.parseJSON(data);
      if(data.exito != "" && data != null){
       var t = '<tr>\
              <td>'+id+'</td>\
              <td>'+nomb+'</td>\
            </tr>';
       $(t).appendTo($("#list_servi"));
      }else{
        alert("No ha crear el servicio, por favor consulte al administrador");
      } 
    });
  });

  $(document).on('click',"#add_servi_new",function(){
  	var cod_ser = $("#inp_cod_serv").val(); 
  	var nomb_ser = $("#inp_nomb_serv").val(); 
  	var tip_ser = $("#slt_tip_serv").val(); 
  	var cost_ser = $("#inp_cost_serv").val(); 
  	var select_tim = $("#slt_time_serv").val();
  	var form_regis = new FormData();
  	form_regis.append("id_ser",cod_ser);
  	form_regis.append("nomb_serv",nomb_ser);
  	form_regis.append("tipo_serv",tip_ser);
  	form_regis.append("cost_serv",cost_ser);
  	form_regis.append("select_tim",select_tim);
  	form_regis.append("registrar_servicio","si");
  	$.ajax({
  	   dataType:"json",
  	   type:"post",
  	   url:"Controller/Router_servicio.php",
  	   data:form_regis,
  	   contentType: false,
       processData: false,
  	}).done(function(data){
  	   if(data.exito){
  	   	 var ta = '<tr>\
  	   	 		   <td>'+cod_ser+'</td>\
  	   	 		   <td>'+nomb_ser+'</td>\
  	   	 		   <td>'+tip_ser+'</td>\
  	   	 		   <td>'+cost_ser+'</td>\
  	   	 		   <td>'+select_tim+'</td>\
  	   	 		  </tr>';
  	   	 $(ta).appendTo($("#row_list_servi"));
  	   }else{
  	   	alert("No ha crear el servicio, por favor consulte al administrador");
  	   }
  	});
  });
  function Listar_servicios_principales(){
     $("#slt_tip_serv").html("");
     $.post("Controller/Router_servicio.php",{"listar_servicios_principal":"st"},function(data){
      var data = $.parseJSON(data);
      if(data[0].id){
       $.each(data,function(key,val){
        var op = '<option value='+val.id+'>'+val.nomb+'</option>';
         $(op).appendTo($("#slt_tip_serv"));
       });
      }
     });
  }

  $("#add_servi").click(function(){
    setTimeout(function(){
      Listar_servicios_principales();
    },0);
  });
});