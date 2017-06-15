<!DOCTYPE html>
<html>
	<head>
		<title>Main</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href=<?php global $root; echo "\"" . $root . "bootstrap-3.3.7-dist/css/bootstrap.css\"";?>>
		<link rel="stylesheet" type="text/css" href=<?php global $root; echo "\"" . $root . "bootstrap-3.3.7-dist/css/bootstrap-tagsinput.css\"";?>>
		<link rel="stylesheet" type="text/css" href=<?php global $root; echo "\"" . $root . "bootstrap-3.3.7-dist/css/font-awesome.css\"";?>>
		<link rel="stylesheet" type="text/css" href=<?php global $root; echo "\"" . $root . "css/styel.css\"";?>>
		<link rel="stylesheet" type="text/css" href=<?php global $root; echo "\"" . $root . "bootstrap-3.3.7-dist/fonts/font-awesome-4.7.0/css/font-awesome.min.css\"";?>>
		<script src=<?php global $root; echo "\"" . $root . "bootstrap-3.3.7-dist/js/jquery-3.2.1.min.js\"";?>></script>
		<script src=<?php global $root; echo "\"" . $root . "bootstrap-3.3.7-dist/js/bootstrap.js\"";?>></script>
		<script src=<?php global $root; echo "\"" . $root . "bootstrap-3.3.7-dist/js/bootstrap-tagsinput.js\"";?>></script>
		<script src=<?php global $root; echo "\"" . $root . "js/profile.js\"";?>></script>
	</head>
	<body>
		<nav class="navbar navbar-custom navbar-fixed-top ">
			<div class="container-fluid">
				<div class="navbar-header">
					<!-- Sigla site-ului-->
					<a href="#" class="navbar-brand" style="font-size:30px;font-family:Orange Juice;color:	#ee7777;top:0;">Dilly</a>
				</div>
				<!--Meniul din pagina homepage after login-->
				<ul class="nav navbar-nav navbar-right">
					<li><a  href="#" data-toggle="modal" data-target="#addMoment"><i class="fa fa-rocket" aria-hidden="true"></i>&nbsp;Add Moments</a></li>
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
							<li><a href=<?php global $root; echo "\"" . $root . "logout/index\""; ?>> Logout </a></li>
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
			
		</div>

		<div class="footer" style="text-align:center">
			&copy; 2017 Dilly, All rights reserved
		</div>

		<!-- Modal -->
		<div id="addMoment" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add Moment</h4>
					</div>
					<div class="modal-body">
						<ul class="nav nav-tabs">
							<li class="active"><a  href="#1" data-toggle="tab">From Computer</a></li>
							<li><a href="#2" data-toggle="tab">From Instagram</a></li>
						</ul>
							<div class="tab-content ">
								<div class="tab-pane active" id="1">
									<center class="continut">
										<form class="form-horizontal" action=<?php global $root; echo "\"" . $root . "/services/newMoment\"";?> method="POST" enctype="multipart/form-data">
											<div class="form-group">
												<label class="control-label col-sm-2">Title:</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="title" required="required" name="title">
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-sm-2">Date:</label>
												<div class="col-sm-10">
													<input type="date"  class="form-control" id="date" placeholder="Enter date" name="date">
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-sm-2">Tags:</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="tags" data-role="tagsinput" name="tags">
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-sm-2" for="email">Image:</label>
												<div class="col-sm-10">
													<input type="file" name="image" id="image">
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-sm-2"></label>
												<div class="col-sm-10">
													<button type="submit" class="btn btn-default form-control buton_submit">Submit</button>
												</div>
											</div>
										</form>
									</center>
								</div>
								<div class="tab-pane" id="2">
									<h3>Notice the gap between the content and tab after applying a background color</h3>
								</div>
							</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>