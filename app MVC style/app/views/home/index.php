<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Dilly with HTML5</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href=<?php global $root; echo "\"" . $root . "bootstrap-3.3.7-dist/css/bootstrap.min.css\"";?>>
		<link rel="stylesheet" type="text/css" href=<?php global $root; echo "\"" . $root . "css/homeCss.css\"" ?>>
	</head>
	<body>
		<div id="container">
			<header id="Head">Dilly</header>
			<nav>
				<a class="btn icon-btn btn-primary" href=<?php global $root; echo "\"" . $root . "home/index\""; ?>><span class="glyphicon btn-glyphicon glyphicon-home img-circle text-primary" style="color:#06c"></span>Home</a>
				<a class="btn icon-btn btn-success" href=<?php global $root; echo "\"" . $root . "support/index\""; ?>><span class="glyphicon btn-glyphicon glyphicon-info-sign img-circle text-success"></span>Support</a>
				<a class="btn icon-btn btn-info" href=<?php global $root; echo "\"" . $root . "faq/index\""; ?>><span class="glyphicon btn-glyphicon glyphicon-question-sign img-circle text-info"></span>FAQ</a>
				<a class="btn icon-btn btn-danger" href=<?php global $root; echo "\"" . $root . "login/index\""; ?>  style="float:right" ><span class="glyphicon btn-glyphicon glyphicon-expand img-circle text-warning" style="color:green "></span> Log in | Sign Up</a>
			</nav>
			<main style="margin-bottom:20px;">
				<header>
					<h3 style="text-align:center;color:#671e29;font-family:Orange Juice;font-size:75px;">Keep your memories intact.</h3>
				</header>
				<article style="margin-top:45px;margin-bottom:20px;font-size:40px;font-family:'Monotype Corsiva';margin-left:50px;border:1px solid black;background:	#fff0b1;width:60%">
					Here is the perfect place to keep your memories intact.
				</article>
				<section id="main">
					<article id="description">
						<p>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam tincidunt lacus at erat ultrices, quis aliquet eros pretium. Curabitur nec ligula diam. Nulla eu ullamcorper ligula. Proin ex risus, auctor ut augue vel, lacinia gravida sem. Maecenas at enim ligula. In tempor nulla vel velit placerat, vitae efficitur nisi vestibulum. Cras lobortis nibh interdum magna vulputate lacinia. Mauris vestibulum justo eget sapien lacinia, in dictum odio volutpat. Vivamus id lorem porta, scelerisque velit sed, pretium urna. Nullam dapibus id nunc quis vulputate. Vestibulum auctor volutpat purus vel molestie. Vivamus at metus eget arcu aliquet egestas at ut ex. Aenean condimentum pharetra tortor. Nulla sit amet quam imperdiet nunc congue congue et ut eros.
						</p>
					</article>
					<article id="image">
						<img src=<?php global $root;  echo "\"" . $root . "images/home/image.jpg\"";?> style="width:425px; height:430px;"/>
					</article>
				</section>
				<div style="clear:both;"></div>
			</main>
			<footer>
				<div id="lleft" style="float:left;">
					<a class="btn icon-btn " href=<?php global $root; echo "\"" . $root . "support/index\""; ?> style="color:black"><span class="glyphicon btn-glyphicon glyphicon-info-sign img-circle text-primary" ></span> Support</a>
					<a class="btn icon-btn " href=<?php global $root; echo "\"" . $root . "faq/index\""; ?> style="color:black"><span class="glyphicon btn-glyphicon glyphicon-question-sign img-circle text-info"></span> FAQ</a>
				</div>
				<div id="rright" style="float:right;">
					<table border="1px" style="float:right;background-color:white;">
						<thead>
							<th><a class="btn icon-btn " href=<?php global $root; echo "\"" . $root . "login/index\""; ?> ><span class="glyphicon btn-glyphicon glyphicon-expand " style="color:green "></span> Log in | Sign Up</a></th>
							<audio autoplay> 
								<source src="logout.mp3">
								<source src="logout.ogg">
							</audio>
						</thead>
					</table>
				</div>
				<div style="clear:both;"></div>
				<p align="center">&copy; 2017 Dilly, All rights reserved</p>
			</footer>
		</div>
	</body>
</html>

