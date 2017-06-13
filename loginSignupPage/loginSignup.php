<!DOCTYPE html>
<html >
 <head>
  <meta charset="UTF-8">
  <title>Welcome to Moments!!! </title>
  
  
  <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Macondo">
    <style>
      body {
        font-family: 'Macondo', cursive;
        font-size: 15px;
      }
	  #Head{
			   		 text-align:center;
					 font-family:'Orange Juice';
					 font-size:40px;
					 color:white;}

    </style>
   <link rel="stylesheet" href="loginSignupCss.css">
   
</head>

<body>
  <header id="Head"><a href="../homePage/home.html">Dilly</a></header>
  <div class="login-wrap">
	<div class="login-html">
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked>
				<label for="tab-1" class="tab">Sign In</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up">
				<label for="tab-2" class="tab">Sign Up</label>
		<div class="login-form">
			<div class="sign-in-htm">
			<form action="userInput.php" method="post">
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
				<div class="hr"></div>
				<div class="foot-lnk">
					<a href="forgotPassword.html">Forgot Password?</a>
				</div>
			</form>
			
			</div>
			
			<div class="sign-up-htm">
			<form action="signupdata.php" method="post">
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
					<input id="emailr" type="text" name ="newemail" required="required" class="input">
				</div>
				<div class="group">
					<label for="birthdate" class="label">Birthdate:</label>
					<input id="birthdate" type="date" name="newbdate" required="required" class="input">
				</div>
				<div class="group">
			
				<div class="group">
					<label for="gender" class="label">Genre:</label>
					<input id="gender" type="radio" value="male" class="input" name="sex">Male
					<input id="gender" type="radio" value="female" class="input" name="sex" checked>Female
				</div>
				<div class="group">
					<input type="submit" class="button" value="Sign Up" action="#">
				</div>
				<div class="hr"></div>
				<div class="foot-lnk">
					<label for="tab-1">Already Member?</label>
				</div>
				</form>
			</div>
		</div>
		
	</div>
	
</div>
<div>
<footer class="footer" align="center">&copy; 2017 Dilly, All rights reserved</footer>
</div>
</body>
</html>

