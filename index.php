<?php
require_once 'recursos.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<?php echo etq_meta(); ?>
		<?php echo etq_css(); ?>
		<?php echo etq_js(); ?>
		<title>Constructura Zurita</title>
                
                
                
		<script type="text/javascript" src="js/slides.jquery.js"></script>
		<script type="text/javascript" src="js/login.js"></script>
                <link href="css/estilos.css" rel="stylesheet" type="text/css"/>
                
                <!--  cambio Luis -->
                     <link rel="stylesheet" href="jqwidgets/styles/jqx.base.css" type="text/css" />
                    <script type="text/javascript" src="jqwidgets/jqxcore.js"></script>
                    <script type="text/javascript" src="jqwidgets/jqxwindow.js"></script>
                <!--  cambio Luis -->
                
		<script type="text/javascript">
			$(document).ready(function(){
				var opts = {
					preload: true,
					preloadImage: 'img/loading.gif',
					play: 5000,
					pause: 2500,
					hoverPause: true,
					animationStart: function(current){
						$('.caption').animate({bottom: -35}, 100);
					},
					animationComplete: function(current){
						$('.caption').animate({bottom: 0}, 200);
					},
					slidesLoaded: function() {
						$('.caption').animate({bottom: 0}, 200);
					}
				};
				$('#slides').slides(opts);
			});
		</script>
	</head>
	<body>
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner"> <!--  menu -->
				<div class="container">
                                    
                                    
					<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="brand" href="#">SAVCO AdminControl</a>


					<div id="menuSuperior">
						<div class="btn-group">
	                  <button type="button" class="dropdown-toggle" id="btn-clientes" data-toggle="dropdown" aria-expanded="false">
	                    Clientes <span class="arrow"></span>
	                  </button>
	                </div> 
	                <div class="btn-group" style="display:none">
	                  <button type="button" class="dropdown-toggle" id="btn-invantario" data-toggle="dropdown" aria-expanded="false">
	                    Inventario <span class="arrow"></span>
	                  </button>
	                  <ul class="dropdown-menu" role="menu">
	                    <li><a href="#" id="opt-materiales">Materiales</a></li>
	                    <li><a href="#" id="opt-unidad_medida">Unidades de medida</a></li>
	                  </ul>
	                </div> 
	                <div class="btn-group">
	                  <button type="button" class="dropdown-toggle" id="btn-obras" data-toggle="dropdown" aria-expanded="false">
	                    Obras <span class="arrow"></span>
	                  </button>
	                  <ul class="dropdown-menu" role="menu">
                              <li><a href="#" id="opt-jefe_obra" style="display:none">Jefe de obra</a></li>
	                  	<li><a href="#" id="opt-tipo_obra">Tipo de obra</a></li>
	                    <li><a href="#" id="opt-crear_obra">Crear obra</a></li>
	                  </ul>
	                </div>
	                <div id="detallesLogin">
	                	<span class="icon-user"></span>
	                	<p>Administrador</p>
	                	<span class="icon-switch"></span>
	                </div>
					</div>


					<div class="nav-collapse collapse">
						
						<div class="navbar-form pull-right" >
						
							<input class="span2" type="text" id="usuario" name="usuario" placeholder="Usuario">
							<input class="span2" type="password" id="contra"  name="contra" placeholder="Contraseña">
							<button class="btn btn-primary" id="login">Entrar</button>
						
                                                </div>
				</div>
                            </div>
                        </div>
		<div class="container" id="principal">
                    <!-- <div id="mostrar" style="height:200px; border:1px solid red"> </div> -->
                    
			<div class="row">
				<div id="slides">
					<div class="slides_container">
						<div class="slide">
							<img src="img/index/trees.jpg" />
							<div class="caption">Hola</div>
						</div>
						<div class="slide">
							<img src="img/index/trees_1.jpg" />
							<div class="caption">Mundo</div>
						</div>
						<div class="slide">
							<img src="img/index/trees_2.jpg" />
							<div class="caption">Cruel</div>
						</div>
					</div>
				</div>
				<h1>Constructora Zurita</h1>
			</div>
			<div class="row-fluid">
				<div class="span4">
					<h1>Misión</h1>
					<p>Hola</p>
				</div>
				<div class="span4">
					<h1>Visión</h1>
					<p>Hola</p>
				</div>
				<div class="span4">
					<h1>Valores</h1>
					<p>Hola</p>
				</div>
			</div>
		</div>
              </div>
                    
            <div id="bienvenido" style="display:none"> 
                <h2 style="width:200px;margin:300px auto;">Bienvenido</h2>
            </div>
	
			
			<div id="clientes-tabla">
			<h3 class='h3TablaCliente'>Clientes</h3>
				<table class="table table-bordered"> <!--" table-condensed">-->
				<thead>
					<tr>
						<th>Id</th>
						<th>Titulo</th>
						<th>Nombre</th>
						<th>Apellido paterno</th>
						<th>Apellido materno</th>
						<th>Razon social</th>
						<th>R.F.C.</th>
						<th>Domicilio</th>
                                                <th>Obra</th> <!-- cambio Luis -->
						<th colspan="2" class="tiny"><a href="#" id="crear-cliente" class="btn" id="btn_insert"><i class="icon-plus"></i></a></th>
					</tr>
				</thead>
				<tbody id="clientes-filas">
					
				</tbody>
			</table>
			</div>


            <div id="form-cliente">
            	<div class="container">
            		<h3 class="h1CrearCliente" style='margin:0px;padding:0px'> Crear Cliente</h3> <!--   Luis 2 -->
                        <h3 class="h1ModificarCliente" style='margin:0px;padding:0px' > Modificar Cliente</h3> <!--  Luis 2 -->
						<table id="form-tabla" style='margin-top:-20px;' > <!--  Luis 2 -->
							<tr>
								<td>
									<label class="control-label" for="cliente-titulo">Titulo</label> 
	            					<input id="cliente-titulo" name="cliente-titulo" type="text" value="" />
								</td>
								<td>
									<label class="control-label" for="cliente-nombre">Nombre</label>
            						<input id="cliente-nombre" name="cliente-nombre" type="text" value="" />
								</td>
								<td>
            						<label class="control-label" for="cliente-apellidop">Apellido paterno</label>
            						<input id="cliente-apellidop" name="cliente-apellidop" type="text" value="" />
								</td>
							</tr>
							<tr>
								<td>
            						<label class="control-label" for="cliente-apellidom">Apellido materno</label>
            						<input id="cliente-apellidom" name="cliente-apellidom" type="text" value="" />
								</td>
								<td>
            						<label class="control-label" for="cliente-razon_social">Razón social</label>
            						<input id="cliente-razon_social" name="cliente-razon_social" type="text" value="" />
									
								</td>
								<td>
            						<label class="control-label" for="cliente-rfc">R.F.C.</label>
            						<input id="cliente-rfc" name="cliente-rfc" type="text" value="" />
								</td>
							</tr>
							<tr>
								<td>
            						<label class="control-label" for="cliente-estado">Estado</label>
            						<input id="cliente-estado" name="cliente-estado" type="text" value="" />
								</td>
								<td>
            						<label class="control-label" for="cliente-municipio">Municipio</label>
            						<input id="cliente-municipio" name="cliente-municipio" type="text" value="" />
								</td>
								<td>
            						<label class="control-label" for="cliente-colonia">Colonia</label>
            						<input id="cliente-colonia" name="cliente-colonia" type="text" value="" />
								</td>
							</tr>
							<tr>
								<td>
            						<label class="control-label" for="cliente-calle">Calle</label>
            						<input id="cliente-calle" name="cliente-calle" type="text" value="" />
								</td>
								<td>
            						<label class="control-label" for="cliente-numero">Número</label>
            						<input id="cliente-numero" name="cliente-numero" type="text" value="" />
								</td>
								<td>
            						<label class="control-label" for="cliente-telefono">Teléfono</label>
            						<input id="cliente-telefono" name="cliente-telefono" type="text" value="" />
								</td>
							</tr>
							<tr>
								<td colspan="3">
		            				<a id="btn-cancel-clientes" class="btn" >Cancelar</a>
		            				<button id="btn-guardar-clientes" class="btn btn-primary" type="submit">Guardar</button>
                                                        <button id="btn-modificar-clientes" class="btn btn-primary" type="submit" data-idCliente='' style='display:none'>Modificar</button>
								</td>
							</tr>
						</table>
            	</div>
            </div>
            

			<div id="materiales-tabla">
				<table class="table table-bordered"> <!--" table-condensed">-->
					<thead>
						<tr>
							<th>Id</th>
							<th>Unidad de medida</th>
							<th>Materiales</th>
							<th>Precio</th>
							<th colspan="2" class="tiny" ><a href="#" id="crear-material" class="btn" id="btn_insert"><i class="icon-plus"></i></a></th>
						</tr>
					</thead>
					<tbody id="materiales-filas">
					</tbody>
				</table>
			</div>

             <div id="form-materiales">
             	<div>
             		<label class="control-label" for="sl-material-unidad_medida">Unidad de medida:</label>
					<select id="sl-material-unidad_medida" name="sl-material-unidad_medida">
						<option selected="seleceted" disabled="disabled">Selecciona una opción</option>
					</select>
	             	<label class="control-label" for="material-material">Material:</label>
	            	<input id="material-material" name="material-material" type="text" value="" />
	            	<label class="control-label" for="material-precio">Precio:</label>
	            	<input id="material-precio" name="material-precio" type="text" value="" />
             	</div>
             	<div>
	            	<a id="btn-cancel-materiales" class="btn" >Cancelar</a>
					<button id="btn-guardar-materiales" class="btn btn-primary" type="submit">Guardar</button>
             	</div>
             </div>


             <div id="unidad_medida-tabla">
				<table class="table table-bordered"> <!--" table-condensed">-->
					<thead>
						<tr>
							<th>Id</th>
							<th>Unidades de medida</th>
							<th colspan="2" class="tiny" ><a href="#" id="crear-unidad_medida" class="btn" id="btn_insert"><i class="icon-plus"></i></a></th>
						</tr>
					</thead>
					<tbody id="unidad_medida-filas">
					</tbody>
				</table>
			</div>

             <div id="form-unidad_medida">
             	<div>
	             	<label class="control-label" for="undad_medida-unidad_medida">Unidad de medida:</label>
	            	<input id="undad_medida-unidad_medida" name="undad_medida-unidad_medida" type="text" value="" />
             	</div>
             	<div>
	            	<a id="btn-cancel-unidad_medida" class="btn" >Cancelar</a>
					<button id="btn-guardar-unidad_medida" class="btn btn-primary" type="submit">Guardar</button>
					<button id="btn-modificar-unidad_medida" class="btn btn-primary" style="display:none;">Modificar</button>
             	</div>
             </div>






			<div id="jefe_obra-tabla">
				<h3> Jefes de obra </h3>
				<table class="table table-bordered"> <!--" table-condensed">-->
				<thead>
					<tr>
						<th>Id</th>
						<th>Titulo</th>
						<th>Nombre</th>
						<th>Apellido paterno</th>
						<th>Apellido materno</th>
						<th>Domicilio</th>
						<th>Obra</th>
						<th colspan="2" class="tiny"><a href="#" id="crear-jefe_obra" class="btn" id="btn_insert"><i class="icon-plus"></i></a></th>
					</tr>
				</thead>
				<tbody id="clientes-filas">
					
				</tbody>
			</table>
			</div>

            <div id="form-jefe_obra">
            	<div class="container">
            		<h3 class="h3CrearJefeObra">Crear Jefe de Obra</h3> <!-- Luis 2 -->
                        <h3 class="h3ModificarJefeObra">Modificar Jefe de Obra</h3> 
						<table id="form-tabla">
							<tr>
								<td>
									<label class="control-label" for="jefe-titulo">Titulo</label> 
	            					<input id="jefe-titulo" name="jefe-titulo" type="text" value="" />
								</td>
								<td>
									<label class="control-label" for="jefe-nombre">Nombre</label>
            						<input id="jefe-nombre" name="jefe-nombre" type="text" value="" />
								</td>
								<td>
            						<label class="control-label" for="jefe-apellidop">Apellido paterno</label>
            						<input id="jefe-apellidop" name="jefe-apellidop" type="text" value="" />
								</td>
							</tr>
							<tr>
								<td>
            						<label class="control-label" for="jefe-apellidom">Apellido materno</label>
            						<input id="jefe-apellidom" name="jefe-apellidom" type="text" value="" />
								</td>
								<td>
            						<label class="control-label" for="jefe-estado">Estado</label>
            						<input id="jefe-estado" name="jefe-estado" type="text" value="" />
								</td>
								<td>
            						<label class="control-label" for="jefe-municipio">Municipio</label>
            						<input id="jefe-municipio" name="jefe-municipio" type="text" value="" />
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label" for="jefe-colonia">Colonia</label>
            						<input id="jefe-colonia" name="jefe-colonia" type="text" value="" />
								</td>
								<td>
            						<label class="control-label" for="jefe-calle">Calle</label>
            						<input id="jefe-calle" name="jefe-calle" type="text" value="" />
								</td>
								<td>
            						<label class="control-label" for="jefe-telefono">Telefono</label> <!-- Luis 2-->
            						<input id="jefe-telefono" name="jefe-telefono" type="text" value="" /> <!-- Luis 2-->
								</td>      
							</tr>
							<tr>
								<td colspan="3">
		            				<a id="btn-cancel-jefe_obra" class="btn" >Cancelar</a>
		            				<button id="btn-guardar-jefe_obra" class="btn btn-primary" type="submit">Guardar</button>
		            				<button id="btn-modificar-jefe_obra" class="btn btn-primary" data-idJefe="" type="submit">Modifcar</button>  <!-- Luis 2-->
								</td>
							</tr>
						</table>
            	</div>
            </div>

				<div id="crear_obra-tabla"> <!--  Luis 3 copiar toda el div y la tabla -->
                                    <h3>Obras</h3>  
					<table class="table table-bordered"> <!--" table-condensed">-->
						<thead>
							<tr>
								<th>Id</th>
								<th>Nombre</th>
								<th>Tipo de obra</th>
								<th>Fecha Inicio</th>
								<th>Fecha Fin</th>
                                                                <th>Detalles de obra</th>
								<th>Seguimiento</th>
								<th>Reporte</th>
								<th colspan="2" class="tiny" ><a href="#" id="crear-crear_obra" class="btn" id="btn_insert"><i class="icon-plus"></i></a></th>
							</tr>
						</thead>
						<tbody id="obras-filas">
						</tbody>
					</table>
				</div>

	            <div id="form-crear_obra">        <!-- Luis 3 -->
            	<div class="container">
                    <h3 class="h3CrearObra" style="margin-top:-10px">Crear Obra</h3>
                        <h3 class="h3ModificarObra" style="margin-top:-10px">Modificar Obra</h3>
						<table id="form-tabla" width="100%" border="0" style="margin-top:-20px"> <!--  Luis 3 -->
							<tr>
								<td>
						       <label class="control-label" for="crear_obra-nombre">Nombre</label> 
	            					<input id="crear_obra-nombre" name="crear_obra-nombre" type="text" value="" />
								</td>
                                                             
								<td>
						        <label class="control-label" for="crear_obra-estado">Estado</label>
            						<input id="crear_obra-estado" name="crear_obra-estado" type="text" value="" />
								</td>
								<td>
            						<label class="control-label" for="crear_obra-municipio">Municipio</label>
            						<input id="crear_obra-municipio" name="crear_obra-municipio" type="text" value="" />
								</td>
                                                        
                                                         
                                                                <td>
            						<label class="control-label" for="crear_obra-ciudad">Ciudad</label>
            						<input id="crear_obra-ciudad" name="crear_obra-ciudad" type="text" value="" />
								</td>
							 </tr> 
							<tr>
								<td>
            						<label class="control-label" for="fec-inicio">Fecha de inicio</label><!--  Luis 3 -->
            						<input id="fec-inicio-obra" name="fec-inicio" type="date" /> <!--  Luis 3 -->
                                                        <span><a href="#" style="visibility:hidden" class="btn" ><i class="icon-plus"></i></a></span>
								</td>
								<td>
            						<label class="control-label" for="fec-fin">Fecha de fin</label><!--  Luis 3 -->
            						<input id="fec-fin-obra" name="fec-fin" type="date" /> <!--  Luis 3 -->
                                                        <span><a href="#" style="visibility:hidden" class="btn" ><i class="icon-plus"></i></a></span>
								</td>
								<td> <!-- Luis 3 -->
                                                                    <label class="control-label" for="sl-tipo-obra" >Tipo de obra:</label>
                                                                    <input id="sl-tipo-obra" name="sl-tipo-obra" style="margin-top:0px" readonly="readonly" data-id-tipo-obra=""> <!-- Luis 3-->
										<span ><a href="#" style="margin-top:10px" id="seleccionar-tipo-obra" class="btn" ><i class="icon-plus"></i></a></span>
                                                                                
										
									
								</td>
								<td>
									<label class="control-label" for="obra-cliente">Cliente</label>
                                                                        <input id="obra-cliente" name="obra-cliente" type="text" value="" readonly="readonly" data-id-cliente=""/>  <!--  Luis 3 -->
									<span><a href="#" id="seleccionar-cliente" class="btn" ><i class="icon-plus"></i></a></span>
								</td>
                                                        </tr>
							<tr>
<!--								<td>
            						<label class="control-label" for="jefe-obra">Jefe de obra</label>
            						<input id="jefe-obra" name="jefe-obra" type="text" value="" />
									<span><a href="#" id="seleccionar-jefe_obra" class="btn" id="btn_insert"><i class="icon-plus"></i></a></span>
								</td>-->
                                                 <td> <!-- Luis 3 -->
                                                                    <label class="control-label" for="sl-regimen-contratacion" >Regimen de contratación:</label>
                                                                    <input id="sl-regimen-contratacion" name="sl-regimen-contratacion" style="margin-top:0px" readonly="readonly" data-id-regimen=""/>
										
                                                                    <span ><a href="#" style="margin-top:10px" id="seleccionar-regimen"   class="btn" ><i class="icon-plus"></i></a></span>
										
									
								</td>                 
                                                                <td colspan="3" >
                                                                    <label class="control-label" for="crear_obra-descripcion" >Descripción</label>
                                                                    <textarea id="crear_obra-descripcion" name="crear_obra-descripcion" style="width:50%;height:50px" maxlength="245" /> </textarea>
                                                       
								</td>
							</tr>
							<tr>
								<td colspan="4">
		            				<a id="btn-cancel-crear_obra" class="btn" >Cancelar</a>
		            				<button id="btn-guardar-crear_obra" class="btn btn-primary" type="submit">Guardar</button>
                                                        <button id="btn-modificar-crear_obra" class="btn btn-primary" type="submit" data-id-obra="" >Modificar</button>
								</td>
							</tr>
						</table>
            	</div>
            </div>
                    

				<div id="tipo-obra-tabla" style="display:none"> <!-- Luis 2-->
                <div class="container">
                <h3>Tipos de obra</h3>
				<table class="table table-bordered"> <!--" table-condensed">-->
					<thead>
						<tr>
							<th>Id</th>
							<th>Tipo de obra</th>
							<th colspan="2" class="tiny" ><a href="#" id="crear-tipo-obra" class="btn" id="btn_insert"><i class="icon-plus"></i></a></th>
						</tr>
					</thead>
					<tbody id="tipo-obra-filas">
					</tbody>
				</table>
                </div>
              </div>

                <div id="form-tipo-obra" > <!-- Luis 2-->
                  
                 <h3 id="h3CrearTipoObra" >Crear Tipo de obra</h3>
                 <h3 id="h3ModificarTipoObra" >Modificar Tipo de obra</h3>
             	<div>
	             	<label class="control-label" for="tipo-obra">Tipo de obra:</label>
	            	<input id="tipo-obra" name="tipo-obra" type="text" value="" />
             	</div>
             	<div style="margin-top:20px;">
	            	<a id="btn-cancel-tipo-obra" class="btn" >Cancelar</a>
					<button id="btn-guardar-tipo-obra" class="btn btn-primary" type="submit">Guardar</button>
                                        <button id="btn-modificar-tipo-obra" class="btn btn-primary" type="submit" data-id-obra="" >Modificar</button>
             	</div>
                 
             </div>  
		<?php echo foot_seg(); ?>
                    
                     <!--  Cambio Luis -->
             
             
             <!--  Modales -->
             
			
			<div id="MDomicilio">
                <div class="mdlDomicilioTitulo" ><strong>Domicilio: </strong> <span> </span></div>
            <div>
                <div>                    
                    <div>                                 
                        
                        
                            
                           <table class="table table-bordered"> <!--" table-condensed">-->
				<thead>
					<tr>
						<th>Estado</th>
						<th>Municipio</th>
						<th>Colonia</th>
						<th>Calle</th>
						<th>Número</th>
						<th>Teléfono</th>
					</tr>
				</thead>
				<tbody class="clientes-filas">
					
				</tbody>
			</table>
                            
                        
                         
                        
                         <div class="dvButtonsModal" style="width:100px; margin:40px auto;"><input class="btn btn-primary" type="button" value="Aceptar" id="btnMdlAceptarDomicilio"/> </div>  
                        
                    </div>
                </div>
            </div>
        </div>


            <div id="MDomicilioJefe">
                <div class="mdlDomicilioTitulo" ><strong>Domicilio: </strong> <span> </span></div>
            <div>
                <div>                    
                    <div>                                 
                        
                        
                            
                           <table class="table table-bordered"> <!--" table-condensed">-->
				<thead>
					<tr>
						<th>Estado</th>
						<th>Municipio</th>
						<th>Colonia</th>
						<th>Calle</th>
						<th>Teléfono</th>
					</tr>
				</thead>
				<tbody class="clientes-filas">
					
				</tbody>
			</table>
                            
                        
                         
                        <div class="dvButtonsModal" style="width:100px; margin:40px auto;"><input class="btn btn-primary" type="button" value="Aceptar" id="btnMdlAceptarDomicilioJefe"/> </div> 
                        
                    </div>
                </div>
            </div>
        </div>
             <!--  Cambio Luis -->
             
          <div id="MdlRelClienteObra">
                <div class="mdlDomicilioTitulo" ><strong>Detalles de obra: </strong> <span> </span></div>
            <div>
                <div>                    
                    <div>                                 
                        
                        
                            
                           <table class="table table-bordered"> <!--" table-condensed">-->
				<thead>
					<tr>
						<th>Nombre de la obra</th>
						<th>Descripción de la obra</th>
						<th>Estado</th>
						<th>Municipio</th>
						<th>Ciudad</th>
						<th>Tipo de obra</th>
						<th>Régimen de contratación</th>
						<th>Fecha de inicio</th>
						<th>Fecha final</th>
					</tr>
				</thead>
				<tbody class="clientesObra-filas">
					
				</tbody>
			</table>
                            
                        
                         
                        <div class="dvButtonsModal" style="width:100px; margin:40px auto;"><input class="btn btn-primary" type="button" value="Aceptar" id="btnMdlAceptarClienteObra"/> </div> 
                        
                    </div>
                </div>
            </div>
        </div>  
        <div id="seguimientoObra">
        </div>
            <div id="MdlMostrarClientes">  <!-- Luis 3-->
                <div class="Seleccionar Cliente" ><strong>Seleccionar cliente: </strong> <span> </span></div>
            <div>
                <div>                    
                    <div>                                 
                        
                         
                        <div class="contedor-tabla" style="overflow:auto;height:410px;">
                            <table class="table table-bordered"> <!--" table-condensed">-->
                                 <thead>
                                         <tr>
                                                 <th>Titulo</th>
                                                 <th>Nombre</th>
                                                 <th>Apellido Paterno</th>
                                                 <th>Apellido Materno</th>
                                                 <th>Razon Social</th>
                                                 <th>RFC</th>
                                                 <th>Seleccionar</th>
                                         </tr>
                                 </thead>
                                 <tbody class="clientes-filas">

                                 </tbody>
                            </table>
                        </div>
                        <div class="dvButtonsModal" style="width:100px; margin: 10px auto" ><input class="btn btn-primary" type="button" value="Aceptar" id="btnMdlAceptarSeleccionarCliente"/> </div>  
                        
                    </div>
                </div>
            </div>
        </div>
         
          <div id="MdlMostrarTiposDeObra">  <!-- Luis 3-->
                <div class="Seleccionar-Obra" ><strong>Seleccionar Tipo de Obra: </strong> <span> </span></div>
            <div>
                <div>                    
                    <div>                                 
                        
                         
                        <div class="contedor-tabla" style="overflow:auto;height:400px;">
                            <table class="table table-bordered"> <!--" table-condensed">-->
                                 <thead>
                                         <tr>
                                                 <th>Id</th>
                                                 <th>Tipo de obra</th>
                                                 <th>Selecionar</th>
                                                 
                                         </tr>
                                 </thead>
                                 <tbody class="tipo-obra-filas">

                                 </tbody>
                            </table>
                        </div>
                        <div class="dvButtonsModal" style="width:100px; margin: 10px auto" ><input class="btn btn-primary" type="button" value="Aceptar" id="btnMdlAceptarTipoDeObra"/> </div>  
                        
                    </div>
                </div>
            </div>
        </div>
            
             
              <div id="MdlRegimenObra">  <!-- Luis 3-->
                <div class="regimen-obra" ><strong>Regimen de contratación: </strong> <span> </span></div>
            <div>
                <div>                    
                    <div>                                 
                        
                         
                        <div class="contedor-tabla" style="overflow:auto;height:400px;">
                            <table class="table table-bordered"> <!--" table-condensed">-->
                                 <thead>
                                         <tr>
                                             <th>Id</th>
                                              <th>regimen de contratacion</th>
                                               <th>Selecionar</th>
                                                 
                                         </tr>
                                 </thead>
                                 <tbody class="tipo-regimen-obra">

                                 </tbody>
                            </table>
                        </div>
                        <div class="dvButtonsModal" style="width:100px; margin: 10px auto" ><input class="btn btn-primary" type="button" value="Aceptar" id="btnMdlAceptarRegimenObra"/> </div>  
                        
                    </div>
                </div>
            </div>
        </div>     
             
             
             <div id="MdlDetallesObra">  <!-- Luis 3-->
                <div class="detalles-obra" ><strong>Detalles de la obra: </strong> <span> </span></div>
            <div>
                <div>                    
                    <div>                                 
                        
                         
                        <div class="contedor-tabla" style="overflow:auto;height:200px;">
                            <table class="table table-bordered" id="tblDetallesObra"> <!--" table-condensed">-->
                                 <thead>
                                         <tr>
                                             <th>Obra</th>
                                              <th>Descricpion</th>
                                               <th>Estado</th>
                                               <th>Municipio</th>
                                               <th>Ciudad</th>
                                               <th>Tipo de obra</th>
                                               <th>Regimen Contratación</th>
                                               <th>Fecha Inicio</th>
                                               <th>Fecha Fin</th>
                                               <th>Cliente</th>  
                                         </tr>
                                 </thead>
                                 <tbody class="cuerpo-detalles-obra">

                                 </tbody>
                            </table>
                        </div>
                        <div class="dvButtonsModal" style="width:100px; margin: 10px auto" ><input class="btn btn-primary" type="button" value="Aceptar" id="btnMdlAceptarDetallesObra"/> </div>  
                        
                    </div>
                </div>
            </div>
        </div>     
             
             
	</body>
</html>
