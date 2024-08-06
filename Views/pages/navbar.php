<link rel="stylesheet" type="text/css" id="link_general" href="../../css/general.css?v=<?php echo (rand()); ?>" />
<link rel="stylesheet" type="text/css" href="../../css/navbar.css?v=<?php echo (rand()); ?>" />

<script src="../../js/jquery-3.6.4.min.js"></script>

<nav>

	<a href="../../pages/principal/inicio.php"><img class="Logo" src="../../imgs/logo.png" title="Pagina principal"></a>

	<ul>
		<li><a href="../../pages/productos/producto_view.php">Productos</a></li>

		<li><a href="../../pages/clientes/cliente_view.php">Clientes</a></li>

		<li><a href="../../pages/facturas/factura_view.php">Facturas</a></li>

		<li><a href="../../pages/usuarios/usuario_view.php">Usuarios</a></li>

	</ul>


	<div class="right_side">
		<img src="../../imgs/menu.png" class="menu_nav">

		<a class="cerrar_sesion" href="../../../cerrar_sesion.php" title="Cerrar sesión"><img src="../../imgs/salida.png"></a>
	</div>

</nav>

<script type="text/javascript">
	let menu_nav = document.querySelector('.menu_nav');
	let nav = document.querySelector('nav');

	menu_nav.onclick = function() {
		nav.classList.toggle('open');
	}
</script>