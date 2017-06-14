<!DOCTYPE html>
<html>
	<head>
		<title>Main</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href=<?php global $root; echo "\"" . $root . "bootstrap-3.3.7-dist/css/bootstrap.css\"";?>>
		<link rel="stylesheet" type="text/css" href=<?php global $root; echo "\"" . $root . "bootstrap-3.3.7-dist/css/font-awesome.css\"";?>>
		<link rel="stylesheet" type="text/css" href=<?php global $root; echo "\"" . $root . "css/styel.css\"";?>>
		<link rel="stylesheet" type="text/css" href=<?php global $root; echo "\"" . $root . "bootstrap-3.3.7-dist/fonts/font-awesome-4.7.0/css/font-awesome.min.css\"";?>>
		<script src=<?php global $root; echo "\"" . $root . "bootstrap-3.3.7-dist/js/jquery-3.2.1.min.js\"";?>></script>
		<script src=<?php global $root; echo "\"" . $root . "bootstrap-3.3.7-dist/js/bootstrap.js\"";?>></script>
	</head>
	<body>
		<audio autoplay> 
		  <source src="login.mp3">
		  <source src="login.ogg">
		</audio>
		<nav class="navbar navbar-custom navbar-fixed-top ">
			<div class="container-fluid">
				<div class="navbar-header">
					<!-- Sigla site-ului-->
					<a href="#" class="navbar-brand" style="font-size:30px;font-family:Orange Juice;color:	#ee7777;top:0;">Dilly</a>
				</div>
				<!--Meniul din pagina homepage after login-->
				<ul class="nav navbar-nav navbar-right">
					<li><a  href="../addMoment/first.html"><i class="fa fa-rocket" aria-hidden="true"></i>&nbsp;Add Moments</a></li>
					<li><a  href="../Friends/pg.html"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;Friends</a></li>
					<!-- Notification bar-->
					<li class="dropdown"><a class="dropdown-toggle " data-toggle="dropdown" href="#"><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;Activity
					<span class="caret"></span></a>
						<ul class="dropdown-menu" style="background:orange;">
							<li class="alert alert-warning"><a href="#" class="close" data-dismiss="alert">x</a>First Notification</li>
							<!--<li class="divider"></li>-->
							<li class="alert alert-info"><a href="#" class="close" data-dismiss="alert">x</a>Second Notification</li>
							<!--<li class="divider"></li>-->
							<li class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">x</a>Third Notification</li>
							<!--<li class="divider"></li>-->
						</ul>
					</li>
					<!-- Profile bar-->
					<li class="dropdown"> <a href="#" class="dropdown-toggle " data-toggle = "dropdown"><i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;Account
					<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="../Friends/pg.html"> Friends </a></li>
							<li><a href="../settingsPage/settings.html"> Account Settings </a></li>
							<li><a href="../supportPage/support.html"> Help&Support </a></li>
							<li><a href="logout.php"> Logout </a></li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
		<header>
			<div class="text-center">
				<h1 style="font-size:70px">Dilly</h1>
				<p style="font-size:20px;">Keep your memories intact.</p>
			</div>
		</header>
		<div class="container-fluid acting">

			<div class="col-md-16 block-a">
				<div class="image">
					<img src="img3.jpg" class="img-responsive " style="display: block;margin: auto;width: 50%;">
					<h2 style="text-align:center"><span >My first Camera.
	</span></h2></div>

				<div class="col-md-4"></div>
			</div>
			<div class="col-md-16 block-b">
				<div class="image">
				<img src="img1.jpg" class="img-responsive " style="display: block;margin: auto;width: 50%;">
				<h2 style="text-align:center"><span >My brushes after my first painting class.</span></h2>
			</div>
			<div class="col-md-16 block-b">
				<div class="image">
				<img src="img5.jpg" class="img-responsive " style="display: block;margin: auto;width: 50%;">
				<h2 style="text-align:center"><span >My first gifts workshop.</span></h2>
			</div>
			<div class="col-md-16 block-b">
				<div class="image">
				<img src="img6.jpg" class="img-responsive " style="display: block;margin: auto;width: 50%;">
				<div class="description">
					<h2 style="text-align:center"><span >My best companinion.</span></h2>
				</div>
			</div>
			
		</div>
			<div class="footer" style="text-align:center">
			&copy; 2017 Dilly, All rights reserved
			</div>

	</body>
</html>