<?php
 session_start();
 if($_SESSION['user_carg'] == 1000 and $_SESSION['user_tipo'] == "Jefe"){ 
  echo '<li class="has-submenu active">
		  <a href="#" class="submenu-toggle"><i class="icon ion-ios-speedometer-outline"></i><span class="text">Ticket</span></a>
			<ul aria-expanded="true" class="list-unstyled sub-menu collapse in">
		  	 <li class="active" id="menu_ticket"><a href="#"><span class="text">Configuracion</span></a></li>
			 <li id="menu_registro_ticket"><a href="#"><span class="text">Registrar Ticket</span></a></li>
			</ul>
		</li>';
 }


?>