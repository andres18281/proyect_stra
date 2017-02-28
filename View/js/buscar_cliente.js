$(function(){
 $(document).on('click',"#btn_search_client_empre",function(){
  $("#tbody_client").html("");
  var client = $("#inp_search_client").val();
  $.ajax({
 	dataType:"json",
 	type:"post",
 	url:"Controller/Router_usuario.php",
 	data:{"buscar_cliente_por_caract":client}
  }).done(function(data){
   	 $.each(data,function(key,val){
   	   var t = '<tr><td><input type="radio" name="rdio_clien" value='+val.id+'></td><td>'+val.id+'</td><td>'+val.nomb+'</td><td>'+val.apell+'</td></tr>';	
   	   $(t).appendTo($("#tbody_client")).slideDown("slow").delay(1000).slideDown('slow');
   	 });
  });
 });
 $(document).on('click',"#btn_acept_id_clien",function(){
   client = $("input[name='rdio_clien']").val();
 }); 
});