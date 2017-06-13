<!DOCTYPE html>
<html>
	<head>
		<script src="https://apis.google.com/js/platform.js" async defer></script>
		<meta name="google-signin-client_id" content="977594582694-7qal4i1tqsk6jvcm25qvvj2e1q29dn1p.apps.googleusercontent.com">
		<link rel="stylesheet" type="text/css" href="<?php global $root; echo $root."css/home-index.css"; ?>">
		<meta charset="UTF-8">
		<title>Deconectare</title>
	</head>
	<body>
	<div id="main">Deconectare...</div>
		<script>
			window.onload = function()
			{
				window.location.href = <?php global $root; echo "\"" . $root . "home/index" . "\"" ?>;
				function signOut(stare)
				{
					if(stare)
					{
						var auth2 = gapi.auth2.getAuthInstance();
						auth2.signOut().then(
							function ()
							{
								window.location.href = <?php global $root; echo "\"" . $root . "home/index" . "\"" ?>;
							}
						);
				  	}
			    }

				gapi.load('auth2', 
					function()
					{
        				auth2 = gapi.auth2.init({ client_id: '977594582694-7qal4i1tqsk6jvcm25qvvj2e1q29dn1p.apps.googleusercontent.com', cookiepolicy: 'single_host_origin'});
        				auth2.isSignedIn.listen(signOut);
      				}
      			);
			}
		</script>
	</body>
</html>