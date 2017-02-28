<!DOCTYPE html>
<html id="htm_fact">
<head>
	<title></title>
 <style type="text/css">
   @media screen and (max-width: 700px) {
 	   #panel_info_tribu{
 		  display:none;
 	   }
   }
   .centro{
    text-align: center;
   }
 	body#body{
 		padding-left: 20%;
 		padding-right: 20%;
 	}

 	#panel_factu,#panel_cliente{
 	 position: relative;
 	 width: 100%;
 	 padding-left: 2%;
 	 padding-right: 2%;
 	}
 	#panel_info_tribu{
 	  width: 56%;
 	  position:absolute;
 	  padding-left: 2%;
 	  padding-right: 2%;
 
 	}
 	#panel_observaciones{
 	  margin-top: -100px;
 	  width: 56%;
 	  position:absolute;
 	  padding-left: 2%;
 	  padding-right: 2%;
 	}
 	p.inf_tri{
 	  font-size: 10px;	
 	}
 	#htm_fact, body { height:100%;}
 	#htm_fact, tbody,tr{
 		height: 10px !important;
 		padding:0px;
 	}
 	#table_fact tbody{
 	 height: 80%;
 	}
 	#table_fact,tfoot,tr{
 		height: 10px !important;
 		padding: 0px;
 	}
 	#table_fact td + td{ border-left:2px solid black; }
 	#table_fact thead th{
 		border-left:2px solid black;
 	}

 </style>
</head>
<body id="body">
  <div id="cabecera">
  	 <img src="cabecera_fact.jpg" style="width: 100%;height: 200px;">
  </div>
  <div id="panel_cliente">
    <div style="float:left;width: 79%;">
  	 <table border="1" style="border-collapse: collapse; border: 1px solid black;width: 100%;">	
      <tbody>
       <tr>
        <td>Fecha de Venta : <span class="centro"><strong>{{fecha_ini}}</strong></span></td>
        <td colspan="2">Fecha de Vencimiento : <span class="centro"><strong>{{fecha_fin}}</strong></span></td>
       </tr>
       <tr>
       	<td colspan="3" style="width: 100%">Cliente: <span class="centro"><strong class="centro">{{client_nomb}}</strong></span></td>
       </tr>
       <tr>
       	<td>Direccion: <span class="centro"><strong class="centro">{{direccion_}}</strong></span></td>
       	<td colspan="2">Ciudad &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="centro"><strong class="centro">{{ciudad_}}</strong></span></td>
       </tr>
       <tr>
       	<td>Telefono: <span class="centro"><strong>{{tele_}}</strong></span></td>
       	<td>Nit: <span class="centro"><strong>{{nit_}}</strong></span></td>
       	<td>O.C</td>
       </tr>
      </tbody> 		
  	 </table>  
  	</div>
  	<div style="float:right;width: 20%;border-collapse: collapse; border: 1px solid black;position:relative;">
  	  <h4>Factura de Venta</h4>
  	  <h3 style="text-align: center">No {{id_fact}}</h3>	
  	</div>
  	<div style="clear: both;"></div> 
  </div>
  <div id="panel_factu" style="width: 100%;height: 300px;">
    <table id="table_fact" style="border-collapse: collapse; border: 1px solid black;height: 600px;overflow: auto;margin-top: 1%;">
      <thead>
        <th style="width: 5%;text-align: center;">Cantidad</th>
        <th style="width: 60%;text-align: center;">Descripcion</th>
        <th style="width: 15%;text-align: center;">Valor Unitario</th>
        <th style="width: 15%;text-align: center;">Valor Total</th>	
      </thead>
      <tbody>
       <tr>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
       </tr>
        {{detall_fact}}
        <tr>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
       </tr>

       
      </tbody>
      <tfoot>
      	<tr style="border-bottom:1px solid black">
      	  <td colspan="2" style="border-bottom:1px solid black">Total</td>
      	  <td colspan="1" >
      	  	 Subtotal
      	  </td>
      	  <td colspan="1">
      	  	{{subtotal}}
      	  </td>	
      	</tr>
      	<tr>
      	  <td colspan="2"></td>
      	  <td colspan="1">
      	  	 Iva 16%
      	  </td>
      	  <td colspan="1">
      	  	{{iva}}
      	  </td>	
      	</tr>
      	<tr>
      	  <td colspan="2"></td>
      	  <td colspan="1">
      	  	 Total a Pagar
      	  </td>
      	  <td colspan="1">
      	  	{{total}}
      	  </td>	
      	</tr>
      </tfoot>	
    </table>	
  </div>
  <div id="panel_observaciones">
  	 <div style="height: 100px">
  	  <label style="margin-top: 0;float:left;">Observaciones</label>
  	   <textarea style="width: 100%" rows="4"></textarea>	
  	 </div>
  </div>
  <div id="panel_info_tribu">
  	<div style="padding: 5px 5px 5px 5px;">
  		<p class="inf_tri"><strong>INFORMACION TRIBUTARIA:</strong> No osmos grandes contribuyentes. No somos auto retenedores. Somos responsables del I.V.A Regimen Comun.</p>
  		<p class="inf_tri">Esta es una factura cambiara de compra venta a la letra de cambio, segun el articuo 772 y siguentes del codigo de comiercio. Esta factura
  	 	cambiara de comrpa venta causara intereses de ley por mora a partir de su fecha de vencimient, mensual o proporsional a partir de la fecha acordada
  	 	para el pago.</p>
  	 	<p class="inf_tri">Factura impresa por computado, habilitacion numerica segun <strong>Resolucion DIAN Nº 50000349630 de 2013/10/10 rango 1001 a 10000</strong>
  	 	El (los) comprador(es), acepta haber cambiado real y materialmente el servicio descrito y acepta las condiciones y el pago de esta factura cambiara de compra venta.</p>
    </div>
  </div>
</body>
</html>