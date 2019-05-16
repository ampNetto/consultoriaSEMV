
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Consultoria</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Free HTML5 Website Template by FreeHTML5.co" />
		<meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
		<meta name="author" content="FreeHTML5.co" />
		<meta property="og:title" content="" />
		<meta property="og:image" content="" />
		<meta property="og:url" content="" />
		<meta property="og:site_name" content="" />
		<meta property="og:description" content="" />
		<meta name="twitter:title" content="" />
		<meta name="twitter:image" content="" />
		<meta name="twitter:url" content="" />
		<meta name="twitter:card" content="" />

		<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700"rel="stylesheet">

		<!-- Animate.css -->
		<link rel="stylesheet" href="../view/css/animate.css">
		<!-- Icomoon Icon Fonts-->
		<link rel="stylesheet" href="../view/css/icomoon.css">
		<!-- Themify Icons-->
		<link rel="stylesheet" href="../view/css/themify-icons.css">
		<!-- Bootstrap  -->
		<link rel="stylesheet" href="../view/css/bootstrap.css">

		<!-- Magnific Popup -->
		<link rel="stylesheet" href="../view/css/magnific-popup.css">


		<!-- Owl Carousel  -->
		<link rel="stylesheet" href="../view/css/owl.carousel.min.css">
		<link rel="stylesheet" href="../view/css/owl.theme.default.min.css">
	</head>

	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed"
					data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
					aria-expanded="false">
					<span class="sr-only">Toggle navigation</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
				</button>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="../controle/home.php">Página Inicial</a></li>
					<li><a href="../controle/consulta_cliente.php">Consulta Cliente</a></li>
					<li role="separator" class="divider"></li>
				</ul>
			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container-fluid -->
	</nav>
	{if $msg|default:''}
		<div class="container">
			<div class="row">
				<div class="alert bg-{$msg.tipo}" role="alert">
					<em class="fa fa-lg fa-warning">&nbsp;</em> {$msg.mensagem} <a
						href="#" class="pull-right"><em class="fa fa-lg fa-close"></em></a>
				</div>
			</div>
		</div>
	{/if}
	<body>{include file=$content}</body>
	
	<script src="../view/js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="../view/js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="../view/js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="../view/js/jquery.waypoints.min.js"></script>
	<!-- Carousel -->
	<script src="../view/js/owl.carousel.min.js"></script>
	<!-- countTo -->
	<script src="../view/js/jquery.countTo.js"></script>
	<!-- Magnific Popup -->
	<script src="../view/js/jquery.magnific-popup.min.js"></script>
	<script src="../view/js/magnific-popup-options.js"></script>
	<!-- Main -->
	<script src="../view/js/main.js"></script>
	<!-- jquery mask -->
	
	<script src="../view/js/jquery.mask.min.js"></script>
	<!--  javaScript para as telas cliente e movimentação  -->
	<script src="../view/js/consulta_cliente.js"></script>
	<script src="../view/js/controle_cliente.js"></script>
	<script src="../view/js/controle_movimentacao.js"></script>

</html>