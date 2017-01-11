<?php

# Metadata

function etq_meta() {
	$metas = '<meta http-equiv="Content-type" content="text/html; charset=utf-8" />';
	return $metas;
}

# JavaScript

function etq_js() {
	$jss = '<script type="text/javascript" src="js/jquery.js"></script>' .
			'<script type="text/javascript" src="js/bootstrap.js"></script>' .
			'<script type="text/javascript" src="js/jquery.form.js"></script>';
	return $jss;
}

# CSS

function etq_css() {
	$csss = '<link type="text/css" href="css/normalize.css" rel="stylesheet" />' .
			'<link type="text/css" href="css/bootstrap.css" rel="stylesheet" />' .
			'<link type="text/css" href="css/bootstrap-responsive.css" rel="stylesheet" />';
			
	return $csss;
}

function head_seg() {
	$menu = array(
		"Administración" => array(
			//"Usuarios" => "usuarios.php",
			"Clientes" => "clientes.php",
			"Domicilios" => "domicilios.php"
		),
		"Inventario" => array(
			"Categorias" => "categorias.php",
			"Unidades de medida" => "udms.php",
			"Materiales" => "materiales.php",
		),
		"Obras" => array(
			"Empleados" => "empleados.php",
			"Tipos de obra" => "otipos.php",
			"Obras" => "obras.php",
		)
	);
	$str = "";
	foreach ($menu as $cat => $eles) {
		if (is_array($eles)) {
			$str .= '<li class="dropdown">';
			$str .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown">' . $cat . '<b class="caret"></b></a>';
			$str .= '<ul class="dropdown-menu">';
			foreach ($eles as $menu => $url) {
				$str .= '<li><a href="' . $url . '">' . $menu . '</a></li>';
			}
			$str .= '</ul>';
			$str .= '</li>';
		} else {
			$str .= '<li><a href="' . $eles . '">' . $cat . '</a></li>';
		}
	}
	return '<div class="navbar navbar-inverse navbar-fixed-top">' .
			'<div class="navbar-inner">' .
			'<div class="container">' .
			'<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">' .
			'<span class="icon-bar"></span>' .
			'<span class="icon-bar"></span>' .
			'<span class="icon-bar"></span>' .
			'</button>' .
			'<a class="brand" href="home.php">SAVCO AdminControl</a>' .
			'<div class="nav-collapse collapse">' .
			'<ul class="nav">' . $str .
			'</ul>' .
			'<ul class="nav pull-right">' .
			'<li><a href="#"><i class="icon-user icon-white"> </i> ' . $_SESSION['usuario'] . '</a></li>' .
			'<li><a href="logout.php"><i class="icon-off icon-white"></i></a></li>' .
			'</ul>' .
			# '<p class="navbar-text pull-right">' . $_SESSION['usuario'] . '</p>'.
			'</div><!--/.nav-collapse -->' .
			'</div>' .
			'</div>' .
			'</div>';
}

function foot_seg() {
	return '<footer class="navbar navbar-inverse navbar-fixed-bottom">' .
			'<div class="navbar-inner">' .
			'<div class="container">' .
			'<p>Constructora Zurita &copy;</p>' .
			'</div>' .
			'</div>' .
			'</footer>';
}

function gen_page($act, $obj) {
	$does = array('insert' => 'Crear', 'update' => 'Modificar', 'delete' => 'Eliminar');
	return $does[$act] . ' ' . $obj;
}

?>