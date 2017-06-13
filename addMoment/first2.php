<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">

	<title>Add Moment</title>

	<link rel="stylesheet" href="../bootstrap-3.3.7-dist/css/bootstrap.css">
	<link rel="stylesheet" href="../bootstrap-3.3.7-dist/css/font-awesome.css">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="../bootstrap-3.3.7-dist/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<script src="../bootstrap-3.3.7-dist/js/jquery-3.2.1.min.js"></script>
	<script src="../bootstrap-3.3.7-dist/js/bootstrap.js"></script>
</head>
<body>

<div id="page">

	<nav class="navbar navbar-custom navbar-fixed-top ">
		<div class="container-fluid">
			<div class="navbar-header">
				<!-- Sigla site-ului-->
				<a href="../homepageAfterLogin/index.html" class="navbar-brand" style="font-size:30px;font-family:Orange Juice;color:	#ee7777;top:0;">Dilly</a>
			</div>
			<!--Meniul din pagina homepage after login-->
			<ul class="nav navbar-nav navbar-right">
				<li><a  href="../questions/questionsPage.html"><i class="fa fa-question" aria-hidden="true"></i>&nbsp;Questions</a></li>
				<li><a  href="../addMoment/addMoment.html"><i class="fa fa-rocket" aria-hidden="true"></i>&nbsp;Add Moments</a></li>
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
						<li><a href="../homepageAfterLogin\logout.php"> Logout </a></li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>

	<br><br><br><br><br><br><br>
	<h1 style="font-size:30px; color=orange"><b>Moments are everything! Don't let them fade away! It's your moment!</b></h1>
	<br><br><br>
</div>

</body>
</html>

<?php
include '../loginSignupPage/getuser.php';

$username = 'student';
$password = 'STUDENT';
$connection_string = 'localhost/xe';
$conn = oci_connect( $username, $password, $connection_string);

$sql='select id from app_users where username= ' .  '\'' . $user . '\'';

  $id = oci_parse($conn, $sql);
  $result = oci_execute($id);

while ($row = oci_fetch_array($id, OCI_RETURN_NULLS+OCI_ASSOC)) {
  
     foreach ($row as $item) {
 
        $logedUserId = $item;

     }
	 }

	 $filename=$_FILES["fileToUpload"]["name"];
		$description =  $_POST['add'];
		$momentname =  $_POST['what'];
		$data =  $_POST['date'];
		$filepath = '../Images/'.$filename;
		
$target_dir = '../Images/';
$target_file = $target_dir .$logedUserId.'-'.$momentname.'-'. basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

		$sql='select to_date(\''.$data.'\''.',\''.'YYYY-MM-DD'.'\''.') from dual';

		  $id = oci_parse($conn, $sql);
		  $result = oci_execute($id);

		while ($row = oci_fetch_array($id, OCI_RETURN_NULLS+OCI_ASSOC)) {
		  
			 foreach ($row as $item) {
		 
				$data = $item;

			 }
			 }
			 
		$sql='select to_date(\''.date("Y-m-d").'\''.',\''.'YYYY-MM-DD'.'\''.') from dual';


		  $id = oci_parse($conn, $sql);
		  $result = oci_execute($id);

		while ($row = oci_fetch_array($id, OCI_RETURN_NULLS+OCI_ASSOC)) {
		  
			 foreach ($row as $item) {
		 
				$current_date= $item;

			 }
			 }
			 
			 
		$sql='insert into app_content values ('.'\'' .$logedUserId.'-'.$momentname.'-'.$filename.'\''.','.$logedUserId.','.'\'' .$description.'\''.','.'\''.$current_date.'\''.','.'\''.$data.'\''.','.'\'' .$filepath.'\''.')';
		$id = oci_parse($conn, $sql);
		  $result = oci_execute($id);
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

?>

<html>
<body>
<br><br><br><br><br><br><br><br><br><br>
<footer align="center">&copy; 2017 Dilly, All rights reserved</footer>
</body>
</html>