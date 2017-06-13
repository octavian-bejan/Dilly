<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="<?php global $root; echo $root."css/home-index.css"; ?>">
		<title><?php echo $data["family_name"] . " " . $data["given_name"]; ?></title>
	</head>
	<body>
		<div id="main">
			<div id="top">
				<div id="title">
					<button id="titleBTN" style="background: url('<?php global $root; echo $root . "images/food/" . $data[2] . ".png"; ?>') no-repeat;" onclick="location.href=<?php global $root; echo "'" . $root . "home/index'"; ?>">Gastronomia Universală</button>
				</div>
				<div id="top-middle"></div>
			</div>
			<div id="middle">
				<div id="left_middle_container">
					<div id="left_middle">
						<button class="left_menu_item" id="left_menu_home" onclick="location.href=<?php global $root; echo "'" . $root . "home/index'"; ?>"">Acasă</button>
						<button class="left_menu_item" id="left_menu_forum" onclick="location.href=<?php global $root; echo "'" . $root . "forum/index'"; ?>"">Forum</button>
					</div>
					<?php echo $data["user_tools"]; ?>
					<?php echo $data["recipes_menu"]; ?>
				</div>
				<div id="middle_container">
					<div id="main_middle">
						<div id="profile_picture">
							<img src="<?php echo $data['picture']; ?>" height="100px" width="100px" class="profile_img">
						</div>
						<div id="profile_info">
							<?php echo "Nume: " . $data["family_name"] . " " . $data["given_name"] ?></br>
							<?php if(array_key_exists("email", $data)) { echo "Email: " . $data["email"] . "</br>"; } ?>
						</div>
					</div>
				</div>
			</div>
			<div id="bottom">
			</div>
		</div>
	</body>
</html>