<div class="widget widget-no-header widget-transparent bottom-30px">
					<!-- QUICK SUMMARY INFO -->
					<div class="widget-content">
						<h3 class="sr-only">Informacion general</h3>
						<div class="row">
							<div class="col-sm-3 text-center">
								<div class="quick-info horizontal">
									<i class="icon ion-thumbsup pull-left bg-seagreen"></i>
									<p>0 <span>Me gusta</span></p>
								</div>
							</div>
							<div class="col-sm-3 text-center">
								<div class="quick-info horizontal">
									<i class="icon ion-arrow-graph-up-right pull-left bg-orange"></i>
									<p>27% <span>Crecimiento</span></p>
								</div>
							</div>
							<div class="col-sm-3 text-center">
								<div class="quick-info horizontal">
									<i class="icon ion-cash pull-left bg-green"></i>
									<p><strong id="cant_contrat">0</strong><span>Contratos</span></p>
								</div>
							</div>
							<div class="col-sm-3 text-center">
								<div class="quick-info horizontal">
									<i class="icon ion-person-stalker pull-left bg-blue"></i>
									<p><strong id="cant_client">0</strong> <span>Clientes</span></p>
								</div>
							</div>
						</div>
					</div>
					<!-- END QUICK SUMMARY INFO -->
				  </div>
				  <div class="row">
					<div class="col-md-8">
						<!-- CHART WITH JUSTIFIED TAB -->
						<div class="widget">
							<div class="widget-header clearfix no-padding">
								<h3 class="sr-only"><span>SALES AND VISITS STAT</span></h3>
								<ul id="dashboard-stat-tab" class="nav nav-pills nav-justified">
									<li class="active"><a href="#tab-sales" data-cid="#dashboard-sales-chart">Ventas</a></li>
									<li class=""><a href="#tab-visits" data-cid="#dashboard-visits-chart">Crecimiento</a></li>
								</ul>
							</div>
							<div id="dashboard-stat-tab-content" class="widget-content tab-content">
								<div class="tab-pane fade in active" id="tab-sales">
									<div class="flot-chart" id="dashboard-sales-chart"></div>
								</div>
								<div class="tab-pane fade" id="tab-visits">
									<div class="flot-chart" id="dashboard-visits-chart"></div>
								</div>
							</div>
						</div>
						<!-- END CHART WITH JUSTIFIED TAB -->
					</div>
					<div class="col-md-4">
						<!-- ORDER STATUS -->
						<div class="widget">
							<div class="widget-header clearfix">
								<h3><i class="icon ion-bag"></i> <span>Tickets</span></h3>
								<div class="btn-group widget-header-toolbar">
									<a href="#" title="Expand/Collapse" class="btn btn-link btn-toggle-expand"><i class="icon ion-ios-arrow-up"></i></a>
									<a href="#" title="Remove" class="btn btn-link btn-remove"><i class="icon ion-ios-close-empty"></i></a>
								</div>
							</div>
							<div class="widget-content">
								<table class="table table-condensed">
									<thead>
										<tr>
											<th>Estado</th>
											<th>Departamento</th>
											<th>Cantidad</th>
										</tr>
									</thead>
									<tbody id="tbody_list_ticket">
									</tbody>
								</table>
							</div>
						</div>
						
						<!-- TASK PROGRESS -->
						
						<!-- END TASK PROGRESS -->
					
						<!-- END ORDER STATUS -->
					</div>
					<div class="row">
					  <div class="col-md-6 ">
						<div class="widget">
							<div class="widget-header clearfix ">
								<h3><i class="icon ion-ios-grid-view-outline"></i> <span>Clientes</span></h3>
								<div class="btn-group widget-header-toolbar visible-lg ">
									<a href="#" title="Expand/Collapse" class="btn btn-link btn-toggle-expand"><i class="icon ion-ios-arrow-up"></i></a>
									<a href="#" title="Remove" class="btn btn-link btn-remove"><i class="icon ion-ios-close-empty"></i></a>
								</div>
							</div>
							<div class="widget-content ">
								<table class="table table-bordered ">
									<thead>
										<tr class="portlet portlet-blue">
											<th>#</th>
											<th>Ciudad</th>
											<th>Cantidad Contratos</th>
											<th>%</th>
										</tr>
									</thead>
									<tbody id="tbody_list_contrat_city">
									</tbody>
								</table>
							</div>
						</div>
						<div class="widget">
							<div class="widget-header clearfix">
								<h3><i class="icon ion-ios-grid-view-outline"></i> <span>Tickets</span></h3>
								<div class="btn-group widget-header-toolbar visible-lg">
									<a href="#" title="Expand/Collapse" class="btn btn-link btn-toggle-expand"><i class="icon ion-ios-arrow-up"></i></a>
									<a href="#" title="Remove" class="btn btn-link btn-remove"><i class="icon ion-ios-close-empty"></i></a>
								</div>
							</div>
							<div class="widget-content">
								<table class="table table-bordered">
									<thead>
										<tr class="portlet portlet-green">
											<th>#</th>
											<th>Ciudad</th>
											<th>Ticket Solucionado</th>
											<th>Sin solucionar</th>
											<th>Total</th>
										</tr>
									</thead>
									<tbody id="list_tickets_gestion">
									</tbody>
								</table>
							</div>
						</div>
					  </div>
					  <div class="col-md-6 ">
						<div class="widget">
							<div class="widget-header clearfix">
								<h3><i class="icon ion-android-list"></i> <span>Ticket mas frecuentes</span></h3>
								<div class="btn-group widget-header-toolbar">
									<a href="#" title="Expand/Collapse" class="btn btn-link btn-toggle-expand"><i class="icon ion-ios-arrow-up"></i></a>
									<a href="#" title="Remove" class="btn btn-link btn-remove"><i class="icon ion-ios-close-empty"></i></a>
								</div>
							</div>
							<div class="widget-content">
								<ul class="task-list list-unstyled" id="list_ticket_frecuent">
								</ul>
								<br>	
							</div>
						</div>
				       </div>	
					  
					</div>