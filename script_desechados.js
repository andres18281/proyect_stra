var contrat = null;
  var Contrato = function(){
    var subservicio = 0;
    var tiempo_servi = 0;
    var fechini = '';
    var fechafin = '';
    var form_pag = 0;
    var cuot = 0;
    var servi_tec = '';
    var descuent = '';
    var costo_new = 0;
    var decrip_decuent = '';
    var id;
    var priori = 0;
    this.Set_id_contrato = function(id){ this.id = id;};
    this.Set_subservi = function(sub){ this.subservicio = sub;};
    this.Set_tiemp_serv = function(time){ this.tiempo_servi = time;};
    this.SetFechaIni = function(time){ this.fechini = time;};
    this.SetFechaFin = function(time){ this.fechafin = time;};
    this.Setformpag = function(pag){ this.form_pago = pag;};
    this.Set_cuota = function(cuo){ this.cuot = cuo;};
    this.Set_servi_tect = function(est){ this.servi_tec = est;};
    this.Set_prioridad = function(pri){ this.priori = pri;};
    this.Set_descuent = function(desc){ this.descuent = desc;};
    this.Set_cost = function(cost){ this.costo_new = cost;};
    this.Set_descrip_descuent = function(descr){ this.decrip_decuent = descri == ""? = descr:null;};
    this.Get_subservi = function(){ return this.subservicio;}; 
    this.Get_tiemp_serv = function(){ return this.tiempo_servi;};
    this.Get_fech_ini = function(){ return this.fechini;};
    this.Get_fech_fin = function(){ return this.fechafin; };
    this.Get_form_pago = function(){ return this.form_pag;};
    this.Get_cuota = function(){ return this.cuot;};
    this.Get_servi_tect = function(){ return this.servi_tec;};
    this.Get_descuent = function(){ return this.descuent;};
    this.Get_id = function(){ return this.id;};
    this.Set_ajax = function(){  
     var form = new FormData();  
     form.append("id",this.id);
     form.append("subservicio",this.subservicio);
     form.append("time_servi",this.tiempo_servi);
     form.append("fech_ini",this.fechini);
     form.append("fech_fin",this.fechafin);
     form.append("form_pago",this.form_pago);
     form.append("cuota",this.cuot);
     form.append("servi_tect",this.servi_tec);
     form.append("descuent",this.descuent);
     form.append("costo_new",this.costo_new);
     form.append("decrip_descuent",this.decrip_decuent);
     form.append("priori",this.priori);
     $.ajax({
        dataType:"json",
        type:"post",
        contentType: false,
        processData: false,
        url:"Controller/Router_contrato.php",
        data:form
     }).done(function(data){
        if(data.exito){
          alert("insertado con exito");
          $('#myButton').button('reset');
          $('#tr_'+form.get("id")).slideUp('slow');
        }
     });
    }
 };

  $(document).on('click',".btn_ver_contrat",function(){
    $("#home").load("View/template/contratos/contrato.html");
    var id = $(this).attr('id');
    $(".nav-tabs a:eq(0)").removeClass('disabled');
    $(".nav-tabs a:eq(1)").removeClass('disabled');
    $(".nav-tabs a:eq(0)").attr("data-toggle","tab");
    $(".nav-tabs a:eq(1)").attr("data-toggle","tab");
    contrat = new Contrato();
    contrat.Set_id_contrato(id);
    $.post("Controller/Router_contrato.php",{"contrato_sin_active":id},function(data){
        var datos = $.parseJSON(data);
        $("#inp_fech_in").val(datos.time_ini); 
        $("#inp_fech_fn").val(datos.time_fin); 
        contrat.SetFechaIni(datos.time_ini);
        contrat.SetFechaFin(datos.time_fin);
        contrat.Set_cost(datos.cost); 
        contrat.Set_cuota(datos.cuota);
        contrat.Set_tiemp_serv(datos.time_service);
        contrat.Setformpag(datos.Form_pago);
        contrat.Set_subservi(datos.id_servi);
        $("#inp_cuot").val(datos.cuota);
        $('#tip_servi option').each(function(){
                                if($(this).val() == datos.id_servi_princi){ 
                                    $(this).prop("selected", "selected"); 
                                    $(this).change();
                                } 
                               });
        $('#descrip_servi option').each(function(){
                                    if($(this).val() == datos.id_servi){ 
                                      $(this).prop("selected", "selected"); $(this).change();
                                    } 
                                  });
        $("#inp_time_servi").val(datos.tiempo_contrat);
        $("#slt_form_pag option").each(function(){
                                    if($(this).text() == datos.Form_pago){
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