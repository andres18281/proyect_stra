<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<style type="text/css">
   
     .wizard_ {
    	margin: 20px auto;
    	background: #fff;
	}

    .wizard_ .nav-tabs {
        position: relative;
        margin: 40px auto;
        margin-bottom: 0;
        border-bottom-color: #e0e0e0;
    }

    .wizard_ > div.wizard-inner {
        position: relative;
        background-color: rgba(38, 155, 236, 0.3);
    }

.connecting-line {
    height: 2px;
    background: #e0e0e0;
    position: absolute;
    width: 80%;
    margin: 0 auto;
    left: 0;
    right: 0;
    top: 50%;
    z-index: 1;
}

.wizard_ .nav-tabs > li.active > a, .wizard_ .nav-tabs > li.active > a:hover, .wizard_ .nav-tabs > li.active > a:focus {
    color: #555555;
    cursor: default;
    border: 0;
    border-bottom-color: transparent;
}

span.round-tab {
    width: 70px;
    height: 70px;
    line-height: 70px;
    display: inline-block;
    border-radius: 100px;
    background: #fff;
    border: 2px solid #e0e0e0;
    z-index: 2;
    position: absolute;
    left: 0;
    text-align: center;
    font-size: 25px;
}
span.round-tab i{
    color:#555555;
}
.wizard_ li.active span.round-tab {
    background: #fff;
    border: 2px solid #5bc0de;
    
}
.wizard_ li.active span.round-tab i{
    color: #5bc0de;
}

span.round-tab:hover {
    color: #333;
    border: 2px solid #333;
}

.wizard_ .nav-tabs > li {
    width: 25%;
}

.wizard_ li:after {
    content: " ";
    position: absolute;
    left: 46%;
    opacity: 0;
    margin: 0 auto;
    bottom: 0px;
    border: 5px solid transparent;
    border-bottom-color: #5bc0de;
    transition: 0.1s ease-in-out;
}

.wizard_ li.active:after {
    content: " ";
    position: absolute;
    left: 46%;
    opacity: 1;
    margin: 0 auto;
    bottom: 0px;
    border: 10px solid transparent;
    border-bottom-color: #5bc0de;
}

.wizard_ .nav-tabs > li a {
    width: 70px;
    height: 70px;
    margin: 20px auto;
    border-radius: 100%;
    padding: 0;
}

    .wizard_ .nav-tabs > li a:hover {
        background: transparent;
    }

.wizard_ .tab-pane {
    position: relative;
    padding-top: 50px;
}

.wizard_ h3 {
    margin-top: 0;
}
.step1 .row {
    margin-bottom:10px;
}
.step_21 {
    border :1px solid #eee;
    border-radius:5px;
    padding:10px;
}
.step33 {
    border:1px solid #ccc;
    border-radius:5px;
    padding-left:10px;
    margin-bottom:10px;
}
.dropselectsec {
    width: 68%;
    padding: 6px 5px;
    border: 1px solid #ccc;
    border-radius: 3px;
    color: #333;
    margin-left: 10px;
    outline: none;
    font-weight: normal;
}
.dropselectsec1 {
    width: 74%;
    padding: 6px 5px;
    border: 1px solid #ccc;
    border-radius: 3px;
    color: #333;
    margin-left: 10px;
    outline: none;
    font-weight: normal;
}
.mar_ned {
    margin-bottom:10px;
}
.wdth {
    width:25%;
}
.birthdrop {
    padding: 6px 5px;
    border: 1px solid #ccc;
    border-radius: 3px;
    color: #333;
    margin-left: 10px;
    width: 16%;
    outline: 0;
    font-weight: normal;
}


/* according menu */
#accordion-container {
    font-size:13px
}
.accordion-header {
    font-size:13px;
    background:#ebebeb;
    margin:5px 0 0;
    padding:7px 20px;
    cursor:pointer;
    color:#fff;
    font-weight:400;
    -moz-border-radius:5px;
    -webkit-border-radius:5px;
    border-radius:5px
}
.unselect_img{
    width:18px;
    -webkit-user-select: none;  
    -moz-user-select: none;     
    -ms-user-select: none;      
    user-select: none; 
}
.active-header {
    -moz-border-radius:5px 5px 0 0;
    -webkit-border-radius:5px 5px 0 0;
    border-radius:5px 5px 0 0;
    background:#F53B27;
}
.active-header:after {
    content:"\f068";
    font-family:'FontAwesome';
    float:right;
    margin:5px;
    font-weight:400
}
.inactive-header {
    background:#333;
}
.inactive-header:after {
    content:"\f067";
    font-family:'FontAwesome';
    float:right;
    margin:4px 5px;
    font-weight:400
}
.accordion-content {
    display:none;
    padding:20px;
    background:#fff;
    border:1px solid #ccc;
    border-top:0;
    -moz-border-radius:0 0 5px 5px;
    -webkit-border-radius:0 0 5px 5px;
    border-radius:0 0 5px 5px
}
.accordion-content a{
    text-decoration:none;
    color:#333;
}
.accordion-content td{
    border-bottom:1px solid #dcdcdc;
}

#map-canvas {        
  height: 400px !important;
  width: 100% !important;   
  margin-top: 0px;
  margin-left: 0px;
}

@media( max-width : 585px ) {

    .wizard_ {
        width: 90%;
        height: auto !important;
    }

    span.round-tab {
        font-size: 16px;
        width: 50px;
        height: 50px;
        line-height: 50px;
    }

    .wizard_ .nav-tabs > li a {
        width: 50px;
        height: 50px;
        line-height: 50px;
    }

    .wizard_ li.active:after {
        content: " ";
        position: absolute;
        left: 35%;
    }
}
</style>
</head>
<body>
 

<div class="container-fluid">
    <div class="container-fluid">
        <section>
        <div class="wizard_">
            <div class="wizard-inner">
                <div class="connecting-line"></div>
                <ul class="nav nav-tabs" role="tablist">

                    <li role="presentation" class="active">
                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-folder-open"></i>
                            </span>
                        </a>
                    </li>

                    <li role="presentation" class="disabled">
                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </span>
                        </a>
                    </li>
                   
                    <li role="presentation" class="disabled">
                        <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-ok"></i>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

            <div role="form">
                <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel" id="step1">
                     <div class="step1">
                        <div class="container-fluid">
                          <div class="col-xs-12">

                            <div class="col-xs-4">
                                <input type="text" class="form-control" id="inp_id_empre">
                                <div class="container-fluid">
                                 <label style="color:black;"> Nit
                                 <input type="radio" class="option_tip" name="option_tip" value="1"></label>
                                 <label style="margin-left:10px;color:black;"> Cedula
                                 <input type="radio" class="option_tip" name="option_tip" value="2"></label>
                                 <label style="margin-left:10px;color:black;"> Palabra clave
                                 <input type="radio" class="option_tip" name="option_tip" value="3"></label>
                                </div>
                            </div>
                            <div class="col-xs-2"> 
                               <a class="btn btn-danger btn-block" id="btn_search_client">Buscar</a>
                            </div>
                          </div>
                        </div>
                        <div class="container-fluid">
                         <form id="form_client">
                          <div class="row">
                            <div class="col-xs-6">
                              <label for="exampleInputEmail1">Nombre empresa</label>
                              <input type="text" class="form-control" name="inp_nomb_empre" id="inp_nomb_empre" placeholder="First Name">
                            </div>
                            <div class="col-xs-6">
                              <label for="exampleInputEmail1">Telefono</label>
                              <input type="email" class="form-control" name="inp_tel_empre" id="inp_tel_empre" placeholder="Last Name">
                            </div>
                           </div>
                           <div class="row">
                            <div class="col-xs-6">
                              <label for="exampleInputEmail1">Direccion</label>
                              <input type="email" class="form-control" name="inp_dir_empre" id="inp_dir_empre" placeholder="Email">
                            </div>
                            <div class="col-xs-6">
                              <label for="exampleInputEmail1">Ciudad</label>
                              <input type="email" class="form-control" name="inp_ciud_empre" id="inp_ciud_empre" placeholder="Email">
                              <input type="hidden" name="hidden_client">
                            </div>
                           </div>
                         </form>
                        </div>
                      </div>   
                      <ul class="list-inline pull-right">
                        <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
                      </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="step2">
                        <div class="step2">
                            <div class="step_21">
                                <div class="container-fluid">
                                  <div class="col-xs-3">
                                   <div class="container-fluid">
                                    <label>Direccion, ciudad o pais</label>
                                    <input type="text" class="form-control input-lg" id="inp_dir" style="width: 100%" placeholder="Diligenciar busqueda"></div>
                                    <div class="container-fluid">
                                      <label>Direccion directa</label>
                                      <input type="text" class="form-control input-lg" id="inp_dir_opcional" style="width: 100%" placeholder="Direccion">
                                    </div>
                                    <div class="container-fluid">
                                    <label>Latitud</label>
                                    <input type="text" class="form-control input-lg" id="id_text" style="width: 100%" placeholder="Latitud"></label></div>
                                    <div class="container-fluid">
                                     <label>Longitud</label>
                                    <input type="text" class="form-control input-lg" id="id_text2" style="width: 100%" placeholder="Longitud"></div>
                                    <div class="container-fluid">
                                      <a href="#" class="btn btn-success btn-block" id="btn_save_ubica">Guardar</a>
                                    </div>
                                  </div>
                                  <div class="col-xs-9">
                                    <div id="map-canvas"></div>	
                                  </div>  
                                </div>
                                <div class="container-fluid">
                                 <div class="col-xs-12" style="margin-left: 40px;margin-top: 20px;">
                                  <fieldset><legend>Ubicaciones para verificar viabilidad</legend><br>
                                   <div class="col-xs-8">
                                    <form id="form_ubicacion_viabili">
                                     <table class="table">
                                      <thead>
                                       <th>Ubicacion</th>
                                       <th>Longitud</th>
                                       <th>Latitud</th>
                                       <th>Direccion</th>
                                       <th>Tipo de IP</th>
                                       <th>Banda</th>
                                       <th>Velocidad</th>
                                       <th>Tipo enlace</th>
                                       <th>Slash</th>
                                       <th></th>  
                                      </thead>
                                      <tbody id="list_ubica">
                                      </tbody>
                                     </table>
                                    </form>
                                  </div>
                                  </fieldset>
                                 </div>
                                </div>
                            </div>
                            <div class="step-22">
                            
                            </div>
                        </div>
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                            <li><button type="button" class="btn btn-primary next-step" id="btn_save_solici">Guardar</button></li>
                        </ul>
                    </div>
                    
                    <div class="tab-pane" role="tabpanel" id="complete">
                        <div class="step44">
                            <h5>Completed</h5>            
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </section>
   </div>
</div>

</body>
</html>



<div class="modal fade" id="modal_configuracion" tabindex="-1" role="dialog" >
  <div class="modal-dialog">
    <div class="modal-content" style="width: 110%;">
      <div class="modal-header">
       <strong>Configuracion Basica</strong>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          
            <h5></h5>
                <hr>
                 <div class="row mar_ned">           
                 </div>
                           
                 <div class="row mar_ned">
                    <div class="col-md-4 col-xs-3">
                      <p align="right"><stong>Configuracon IP</stong></p>
                    </div>
                    <div class="col-md-8 col-xs-9">
                        <select name="slt_tipo_ip" id="visa_status"  class="dropselectsec1">
                            <option value="1">IPV4</option>
                            <option value="2">IPV6</option>
                        </select>
                    </div>
                  </div>
                  <div class="row mar_ned">
                    <div class="col-md-4 col-xs-3">
                     <p align="right"><strong>Acceso</strong></p> 
                    </div>
                    <div class="col-md-8 col-xs-9">
                      <label class="radio-inline">Kilobyte
                        <input type="radio" name="rdio_acceso" id="inlineRadio2" value="1"> </label>
                      <label class="radio-inline">Megabyte
                       <input type="radio" name="rdio_acceso" id="inlineRadio3" value="2"> </label>
                          <label class="radio-inline"> 
                            <select class="form-control" name="slt_megas" style="display: none;width: 100%;">
                             <option></option>
                             <option value="1">1mg</option>
                             <option value="2">2mg</option>
                             <option value="3">5mg</option>
                             <option value="4">10mg</option>
                             <option value="5">20mg</option>
                            </select>
                          </label>
                          <label class="radio-inline">
                            <select class="form-control" name="slt_kiloby" style="display: none;width: 100%;">
                              <option></option>
                              <option value="6">128kb</option>
                              <option value="7">256kb</option>
                              <option value="8">512kb</option>
                            </select>
                          </label>
                    </div>
                  </div>
                  <div class="row mar_ned">
                    <div class="col-md-4 col-xs-3">
                     <p align="right"><stong>Tipo de enlace</stong></p>
                    </div> 
                    <div class="col-md-8 col-xs-9">
                     <select name="slt_tipo_enlace" id="highest_qualification" class="dropselectsec">
                       <option></option>
                       <option value="1">Radio Laser</option>
                       <option value="2">Fibra</option>
                       <option value="3">Cobre</option>
                     </select>
                    </div>
                  </div>
                  <div class="row mar_ned">
                    <div class="col-md-4 col-xs-3">
                     <p align="right"><stong>Tipo de slash</stong></p>
                    </div>
                    <div class="col-md-8 col-xs-9">
                     <select name="slt_tipo_slash" id="highest_qualification" class="dropselectsec">
                       <option value="1">/29</option>
                       <option value="2">/30</option>
                     </select>
                    </div>
                  </div>           
                 </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary"  id="btn_add_ubica">Aceptar</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</div>

<div class="modal fade" id="modal_buscar_empre" tabindex="-1" role="dialog" >
  <div class="modal-dialog">
    <div class="modal-content" style="width: 80%;">
      <div class="modal-header">
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <div class="col-md-12">
            <table id="mytable" class="table table-bordred table-striped">
              <thead>    
               <th>Seleccionar</th>
               <th>Nit Empresa</th>
               <th>Telefono</th>
              </thead>
              <tbody id="tbody_empresa"> 
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary"  id="btn_acept_nit_empre">Aceptar</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</div>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMI0YtR9vefzDJmht_CK5Y9Cs0g_fmJIk&libraries=places"></script>
 <!--
<script src="http://maps.googleapis.com/maps/api/js" type="text/javascript"></script>	-->
<script
  src="https://code.jquery.com/jquery-2.2.4.js"
  integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
  crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>-->


 <script type="text/javascript">
$(function(){
 	function google_mapa(){	
  		// create a Google Maps map variable 
		var map;
		// create a location variables
		var myLocation = new google.maps.LatLng(3.3950619 , -76.5957039);
		// create a pop-up window variable
		var myInfoWindow = new google.maps.InfoWindow();	
		// A function to create the marker and InfoWindow
		function createMarkerAndInfoWindow(location, name, html) {
			// create marker for location provided
			var marker = new google.maps.Marker({
			position : myLocation,
			map: map,
			title: 'This is the default tooltip!',
			draggable: true,
            mapTypeId: google.maps.MapTypeId.ROADMAP
			});
			// Add listener on market which will show infoWindow when clicked
			google.maps.event.addListener(marker, "click", function() {
			  myInfoWindow.setContent(html);
			  myInfoWindow.open(marker.getMap(), marker);
			});
			// Add listener on 'drag end' event, add logitude and latitude to beginning of table
			google.maps.event.addListener(marker, 'dragend', function(evt){	
				//alert("latitud"+evt.latLng.lat().toFixed(5) +" longitud"+ evt.latLng.lng().toFixed(5));	
				document.getElementById('id_text').value = evt.latLng.lat().toFixed(5);
				document.getElementById('id_text2').value = evt.latLng.lng().toFixed(5);
			});
			// listener on drag event
			google.maps.event.addListener(marker, 'dragstart', function(evt){
				// nothing for now
			});	


            var input = document.getElementById('inp_dir');
            var searchBox = new google.maps.places.SearchBox(input);
           

            // Bias the SearchBox results towards current map's viewport.
            map.addListener('bounds_changed', function() {
                searchBox.setBounds(map.getBounds());
            });
            var markers = [];
            // [START region_getplaces]
            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener('places_changed', function() {
              var places = searchBox.getPlaces();

              if (places.length == 0) {
                return;
              }

              // Clear out the old markers.
              markers.forEach(function(marker) {
               marker.setMap(null);
              });
              markers = [];

              // For each place, get the icon, name and location.
              var bounds = new google.maps.LatLngBounds();
              places.forEach(function(place) {
                var icon = {
                 url: place.icon,
                 size: new google.maps.Size(71, 71),
                 origin: new google.maps.Point(0, 0),
                 anchor: new google.maps.Point(17, 34),
                 scaledSize: new google.maps.Size(25, 25)
                };

                // Create a marker for each place.
                markers.push(new google.maps.Marker({
                  map: map,
                  icon: icon,
                  title: place.name,
                  position: place.geometry.location
                }));

                if(place.geometry.viewport) {
                  // Only geocodes have viewport.
                  bounds.union(place.geometry.viewport);
                } else {
                  bounds.extend(place.geometry.location);
                }
              });
              map.fitBounds(bounds);
  });
			return marker;
		}
		function initialize() {
			var mapOptions = {
				zoom : 8,
				center : myLocation,
				draggable: true,
				mapTypeId : google.maps.MapTypeId.ROADMAP
			};
			// create the map
			map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
			// add marker
			var marker = createMarkerAndInfoWindow(myLocation, "myMarkerName", 
				"You can add all sorts of <br/> <b>formattted</b> content to the <br/>InfoWindow!");
			marker.setMap(map);	
		}
	
		// add a listener to the window object, which as soon as the load event is 
		// triggered (i.e. "the page has finished loading") executes the function "initialize"
		google.maps.event.addDomListener(window, 'load', initialize);
 	}		
  google_mapa();

  $("#btn_save_ubica").click(function(){
    $("#modal_configuracion").modal('show');
  });  
  $(document).on('click','.btn_remove',function(){
    var index = $(this).index('.btn_remove');
    $("#list_ubica").find('tr').eq(index).remove();
  });
});
// https://developers.google.com/maps/documentation/javascript/examples/place-search?hl=es-419 para listar puntos de instalacion
</script>
<script type="text/javascript">
  $(function(){
    function Convertir_array_asociativo(form){
      var form =  $('form#'+form).serializeArray();
      var json = {};
      $.each(form,function(key,val){
        json[val.name] = val.value; 
      });    
      return json;
    }
    $("#btn_search_client").click(function(){
      var id = $("#inp_id_empre").val();
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
    
    function Buscar_Empresa(id_empre){
     if(id_empre != 0){
      $.post("controller/Router_usuario.php",{"buscar_empresa":"dsd","nit":id_empre},function(data){
        var data = $.parseJSON(data);
        if(data.nomb){
            $("#inp_nomb_empre").val(data.nomb);
            $("#inp_dir_empre").val(data.dir);
            $("#inp_tel_empre").val(data.tel);
            $("#inp_ciud_empre").val(data.ciud);
            $("input[name='hidden_client']").val(id_empre);
        }else{
           alert("Empresa no existe");
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
    var id_empre = $(".rdio_nit:checked").val();
    $("#modal_buscar_empre").modal('hide');
    $("input[name='hidden_client']").val(id_empre);
     Buscar_Empresa(id_empre);
  });

    $("input[name='rdio_acceso']").change(function(){
     if($(this).val() == 1){
        $("select[name='slt_megas']").css('display','block');
        $("select[name='slt_kiloby']").css('display','none');
     }else{
        $("select[name='slt_kiloby']").css('display','block');
        $("select[name='slt_megas']").css('display','none');
     }
    });

    $("#btn_add_ubica").click(function(){
      var dir = $("#inp_dir").val();
      var long = $("#id_text").val();
      var lati = $("#id_text2").val();
      var direct = $("#inp_dir_opcional").val();
      var direct_ = long+","+lati;
      $("#inp_dir").val("");
      $("#id_text").val("");
      $("#id_text2").val("");
      $("#inp_dir_opcional").val("");
      var slt_tip_ip =  $("select[name='slt_tipo_ip']").val();
      var slt_transf_kilo = $("select[name='slt_kiloby']").val();
      var slt_transf_mega = $("select[name='slt_megas']").val();
      var slt_enla = $("select[name='slt_tipo_enlace']").val();
      var text_tip_ip = $("select[name='slt_tipo_ip'] option:selected").text();
      var slt_tip_enla = $("select[name='slt_tipo_slash']").val();
      var text_tip_slash = $("select[name='slt_tipo_slash'] option:selected").text();
      var rdio_acceso_text = $("input[name='rdio_acceso']:checked").parent().text();
      var rdio_acceso = $("input[name='rdio_acceso']:checked").val();
      var text_enla = $("select[name='slt_tipo_enlace'] option:selected").text();
      var text_transf_kilo =  $("select[name='slt_kiloby'] option:selected").text();
      var text_transf_mega = $("select[name='slt_megas'] option:selected").text();
      var trans =  text_transf_kilo === null || text_transf_kilo == ""?text_transf_mega:text_transf_kilo;
      var val_trans = slt_transf_kilo === null || slt_transf_kilo == null?slt_transf_mega:slt_transf_kilo;
      var t = '<tr><td>'+dir+'</td>\
                   <td>'+long+'</td>\
                   <td>'+lati+'</td>\
                   <td>'+direct+'</td>\
                   <td>'+text_tip_ip+'</td>\
                   <td>'+rdio_acceso_text+'</td>\
                   <td>'+trans+'</td>\
                   <td>'+text_enla+'</td>\
                   <td>'+text_tip_slash+'</td>\
                   <td><a href="#" class="btn btn-default btn_remove"><span class="glyphicon glyphicon-remove"></span></a></td>\
                     <input type="hidden" name="hidden_dir" value='+dir+'>\
                     <input type="hidden" name="hidden_long" value='+long+'>\
                     <input type="hidden" name="hidden_lati" value='+lati+'>\
                     <input type="hidden" name="hidden_direc" value='+direct+'>\
                     <input type="hidden" name="hidden_tip_ip" value='+slt_tip_ip+'>\
                     <input type="hidden" name="hidden_tip_velo" value='+rdio_acceso+'>\
                     <input type="hidden" name="hidden_tip_transf" value='+val_trans+'>\
                     <input type="hidden" name="hidden_tip_enlac" value='+slt_tip_enla+'>\
                     <input type="hidden" name="hidden_tip_slash" value='+slt_enla+'>\
                   </tr>';
      $(t).appendTo($("#list_ubica")); 
    });

    $("#btn_save_solici").click(function(){
      var nit = $("input[name='hidden_client']").val();  
      var form_ubica = Convertir_array_asociativo("form_ubicacion_viabili");
      var params = {"create_viabilidad":"","nit":nit,"form":form_ubica};
      $.post("Controller/ViabilidadController.php",{"request":JSON.stringify(params)},function(data){
       var data = $.parseJSON(data);
       console.log(data);
      });   
    });
    

  });
</script>

<?php
//$data = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=Cali,Valle+del+Cauca,+Colombia&key=AIzaSyAuHopz7FvwAmoS7jFQggIad927lYrOydg');
?>
<!--https://developers.google.com/maps/documentation/javascript/examples/places-searchbox?hl=es-419-->