$(function(){
  function Convertir_array_asociativo(form){
      var form =  $('form#'+form).serializeArray();
      var json = {};
      $.each(form,function(key,val){
        json[val.name] = val.value; 
      });    
      return json;
  }

  $(document).on('submit',"form#form_create_employed",function(e){
    e.preventDefault();
    var formulario = Convertir_array_asociativo("form_create_employed");
    var form = new FormData();
    var file = $("#file")[0].files;
    form.append("formu",JSON.stringify(formulario));
    form.append("file",file[0]);
    form.append("accion","create_employed");
    $.ajax({
         dataType:"json",
         type:"post",
         contentType: false,
         processData: false,
         data:form,
         url:"Controller/EmpleadosController.php"
    }).done(function(data){
      if(data.exito){
        alert(data.exito);
         $(".form-control").val("");
      }else{
       alert("hay un problema"+ data.error);
      }
    });
  });
  
  $(document).on('click',"#btn_buscar",function(){
      $("#tbody_list_employed").html("");
      var depart = $("#slt_all_depart").val();   
      $.post("Controller/Router_employed.php",{"get_employed_by_depart":depart},function(data){
       var data = $.parseJSON(data);
       if(data[0].id){
         $.get("View/template/empleados/listado.html",function(html){
          $.each(data,function(key,val){
           var templa = html;
           templa = templa.replace("{{id}}",val.id);
           templa = templa.replace("{{cargo}}",val.carg);
           templa = templa.replace("{{nombre}}",val.nomb);
           templa = templa.replace("{{email}}",val.email);
           templa = templa.replace("{{imagen}}",val.img);
           $(templa).appendTo($("#tbody_list_employed"));
          }); 
        });
       }else{
        $('<tr><td colspan="5"><div class="alert alert-danger"><strong>Aun no hay empleados en esta area</strong></div></td></tr>').appendTo($("#tbody_list_employed"));
       } 
      });
  });
});