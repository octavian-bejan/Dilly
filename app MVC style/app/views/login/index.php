<!DOCTYPE html>
<html>
	<head>
		<script src="https://apis.google.com/js/api:client.js"></script>
		<meta name="google-signin-client_id" content="831718862572-ll0p8s0t48v9akf2st86nmpa821m19sb.apps.googleusercontent.com">
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="<?php global $root; echo $root."css/loginSignupCss.css"; ?>">
		<link rel="stylesheet" type="text/css" href=<?php global $root; echo "\"" . $root . "bootstrap-3.3.7-dist/css/bootstrap.min.css\"";?>>
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Macondo">
		<title>Conectează-te</title>
		<script>
  			var googleUser = {};

			function success(googleUser)
			{
				var id_token = googleUser.getAuthResponse().id_token;

				var form = document.createElement("form");
				form.method = "POST";
				form.action = <?php echo "\"" . $data[0] . "/login/login_callback_google\""; ?>;

				var element = document.createElement("input");
				element.type = "hidden";
				element.value = id_token;
				element.name="ID_TOKEN";

				form.appendChild(element);
				document.body.appendChild(form);
				form.submit();
			}

			var startApp = function()
			{
				gapi.load('auth2',
					function()
					{
				  		auth2 = gapi.auth2.init({ client_id: '831718862572-ll0p8s0t48v9akf2st86nmpa821m19sb.apps.googleusercontent.com', cookiepolicy: 'single_host_origin'});
				  		attachSignin(document.getElementById('customBtn'));
					}
				);
			};

			function attachSignin(element)
			{
				auth2.attachClickHandler(element, {},
				    function(googleUser)
				    {
				      success(googleUser);
				    },
				    function(error)
				    {
				    	console.log("error");
				    }
				);
			}
			function load() {
				setTimeout(function () { document.getElementById("message").style.visibility = "visible"; }, 500);
				setTimeout(function () { document.getElementById("message").style.visibility = "hidden"; }, 3000);
			}
			window.onload = load;
		</script>
	</head>
	<body>
		<?php
			if(array_key_exists("message",$data))
			{
				echo "<center id=\"message\" class=\"popup alert alert-danger\">\n";
				echo $data["message"];
				echo "</center>\n";
			}
		?>
		<header id="Head"><a href=<?php global $root; echo "\"" . $root . "home/index\""; ?>>Dilly</a></header>
		<div class="login-wrap">
			<div class="login-html">
				<input id="tab-1" type="radio" name="tab" class="sign-in" checked>
				<label for="tab-1" class="tab">Sign In</label>
				<input id="tab-2" type="radio" name="tab" class="sign-up">
				<label for="tab-2" class="tab">Sign Up</label>
				<div class="login-form">
					<div class="sign-in-htm">
						<form action=<?php echo "\"" . $data[0] . "/login/login_callback_classic\"";?> method="post">
							<div class="group">
								<label for="user" class="label" placeholder="Your e-mail/username..">E-mail/Username:</label>
								<input id="user" name="loginuser" required="required" type="text" class="input">
							</div>
							<div class="group">
								<label for="pass" class="label" placeholder= "Your password..">Password:</label>
								<input id="pass" type="password" name="loginpass" class="input" data-type="password">
							</div>
							<div class="group">
								<input type="submit" class="button" value="Sign In" >
							</div>
							<div class="foot-lnk">
								<a href="forgotPassword.html">Forgot Password?</a>
							</div>
							<div class="hr"></div>
						</form>
						<center>
							<button class="btn icon-btn btn-danger" id="customBtn">Connect With Google</button>
						</center>
					</div>
				
					<div class="sign-up-htm">
						<form action=<?php echo "\"" . $data[0] . "/login/sign_up\"";?> method="post">
							<div class="group">
								<label for="fname" class="label">Firstname:</label>
								<input id="fname" type="text" name="newfirstname" required="required" class="input">
							</div>
							<div class="group">
								<label for="lname" class="label">Lastname:</label>
								<input id="lname" type="text" name="newlastname" required="required" class="input">
							</div>
							<div class="group">
								<label for="userr" class="label">Username:</label>
								<input id="userr" type="text" name="newusername" required="required" class="input">
							</div>
							<div class="group">
								<label for="passr" class="label">Password:</label>
								<input id="passr" type="password" name="newpassword" required="required" class="input" data-type="password">
							</div>
							<div class="group">
								<label for="passrc" class="label">Repeat Password:</label>
								<input id="passrc" type="password" name="checkpassword" required="required" class="input" data-type="password">
							</div>
							<div class="group">
								<label for="emailr" class="label">Email Address:</label>
								<input id="emailr" type="email" name ="newemail" required="required" class="input">
							</div>
							<div class="group">
								<label for="birthdate" class="label">Birthdate:</label>
								<input id="birthdate" type="date" name="newbdate" required="required" class="input">
							</div>
							<div class="group">
								<input type="submit" class="button" value="Sign Up" action="#">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div>
			<footer class="footer" align="center">&copy; 2017 Dilly, All rights reserved</footer>
		</div>
		<script>startApp();</script>
	</body>
</html>