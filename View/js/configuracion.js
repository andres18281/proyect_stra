$(function(){
 $(document).on('click','#btn_add_cargo',function(){
 	var nomb = $("#txt_carg").val();
 	var depart = $("#slt_depart_emp").val();
 	var emple = $("#slt_tipo_emple").val();
 	$.ajax({
 	  dataType:"json",
 	  type:"post",
 	  data:{"nombre_cargo":nomb,"departament_":depart,"tipo":emple},
 	  url:"Controller/Route_config.php"
 	}).done(function(data){
 	 if(data.exito){
 	 	var depar = $('#slt_depart_emp option[value='+depart+']').text();
 	 	var tipo = $('#slt_tipo_emple option[value='+emple+']').text();
 	 	var t = '<tr><td>'+nomb+'</td><td>'+depar+'</td><td>'+tipo+'</td><td><button class="btn btn-danger btn-xs btn_carg" id='+data.last_cod_id+'><span class="glyphicon glyphicon-share-alt"></span></button></td></tr>';
 	 	$(t).appendTo($("#tbo_list_carg"));
 	 }
 	});
 });	

 $(document).on('click',".btn_carg",function(){
 	$(this).attr('id');
 	$("#add_habili").css("display","block");
 });

 // agregar evento para ticket
 $(document).on('click','#btn_add_event',function(){
    var id = $("#id_evento").val();
    var slt_servi = $("#slt_servi option:selected").val();
    var text_servi = $("#slt_servi option:selected").text();
    var nomb = $("#txt_nomb_even").val();
    var descrip = $("#descrip_event").val();
    $.post("Controller/Route_config.php",{"cod_servi":id,"id_servi_":slt_servi,"nomb_servi":nomb,"descrip":descrip},function(data){
     var data = $.parseJSON(data);
     if(data.exito){
       var t = '<tr><td>'+id+'</td><td>'+text_servi+'</td><td>'+nomb+'</td></tr>';
       $(t).appendTo($("#tbody_event"));
       $("#id_evento").val("");
       $("#descrip_event").val("");
       $("#txt_nomb_even").val("");
     }
    });  
 });
 $(document).on('change',"#slt_depart_empre",function(){
 	$("#slt_carg_empre").html("");
 	var id = $(this).val();
 	$.ajax({
 	  dataType:"json",
 	  type:"post",
 	  url:"Controller/Route_config.php",
 	  data:{"id_departament":id}
 	}).done(function(data){
 	  $.each(data,function(key,val){
 	  	var t = '<option value='+val.id+'>'+val.nomb+'</option>';
 	  	$(t).appendTo($("#slt_carg_empre"));
 	  });
 	});
 });

 function addRow(input){
    var table = document.getElementById("myTable");
    var i = parseInt(input.id.substring(3, input.id.length));
    document.getElementById('icon' + i).className = "glyphicon glyphicon-minus";
    var row = table.insertRow(table.rows.length);
    row.id = "row" + (i + 1);
    var cell = row.insertCell(0);
    cell.innerHTML = '<div class="input-group">'+
                        '<input type="text" class="form-control" />'+
                        '<span class="input-group-btn">'+
                            '<button id="btn'+(i+1)+'" type="button" class="btn btn-primary" onclick="addRow(this)">'+
                                '<span id="icon'+(i+1)+'" class="glyphicon glyphicon-plus"></span>'+
                            '</button>'+
                        '</span>'+
                     '</div>';
    $('#btn'+i).attr('onclick', 'remRow(this)');
 }

 function remRow(input) {
    var table = document.getElementById("myTable");
    var i = parseInt(input.id.substring(3, input.id.length));
    var ind = table.rows["row" +i].rowIndex;
    table.deleteRow(ind);
 }

 $(document).on('click','#btn_add_depart',function(){
   var depart = $("#txt_departament").val();
   alert("hola");
   $.post("Controller/Route_config.php",{"departament":depart},function(data){
     var data = $.parseJSON(data);
     if(data.exito){
        alert("departamento agregado");
        var t = '<tr id="tr_'+data.last_cod_id+'"><td style="text-align:center;">'+depart+'</td><td><a href="#" class="btn btn-danger btn-xs btn_delete_area" id='+data.last_cod_id+'><span class="glyphicon glyphicon-trash"></span></a></td></tr>';
        $(t).appendTo($("#tbody_depart"));
     }
   });
 });
});