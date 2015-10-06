<?php require("assets/init.php");  ?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		
		<!-- Title and Metadata -->
		<title><?php echo $site["info"]["name"]; ?></title>
		<meta http-equiv="content-type" content="<?php echo $site["info"]["content"]; ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta http-equiv="content-language" content="<?php echo $site["info"]["language"]; ?>" />
		<meta name="author" content="<?php echo $site["info"]["author"]; ?>" />
		<meta name="google" content="notranslate" />
		<meta name="description" content="<?php echo $site["info"]["description"]; ?>" />
		<meta name="keywords" content="<?php echo $site["info"]["keywords"]; ?>" />
		
		<!-- Styles and Graphics -->
		<link rel="stylesheet" type="text/css" href="assets/css/<?php echo $site["custom"]["theme"]; ?>" media="screen" />
		<link rel="apple-touch-icon" sizes="250x250" href="assets/images/patchy-apple-icon.png">
		<link rel="icon" href="assets/images/patchy.png" type="image/gif">
		<style type="text/css"> 
			body { 
				background:url('assets/images/bg.jpg') no-repeat center center fixed;-webkit-background-size:cover;-moz-background-size:cover;-o-background-size:cover;background-size:cover;
			}
		</style>
		
		<!-- Scripts and Libraries -->
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
		<script>
			// Fallback to local copies if vital Libraries are unreachable
			if (!window.jQuery) { 
				console.log("Failed to connect to JQuery CDN, using a local copy"); 
				document.write('<script src="assets/libs/jquery-2.1.4.min.js" type="text/javascript"><\/script>'); 
			} else {
				console.log("JQuery loaded successfully :)");
			}
		</script>
		
	</head>
	<body>
		
		<?php
			// Show different page depending on if user is logged in
			if(accountLoggedIn()) {
				if (!empty($_GET["p"])) {
					if ($_GET["p"] == "acc"){
						include("assets/php/views/account.php");
					} elseif ($_GET["p"] == "svr"){
						include("assets/php/views/servers.php");
					} elseif($_GET["p"] == "upl") {
						include("assets/php/views/upload.php");
					} elseif($_GET["p"] == "hlp") {
						include("assets/php/views/help.php");
					} elseif($_GET["p"] == "lgo") {
						 include("assets/php/scripts/logout.php");
					} elseif($_GET["p"] == "nfo") {
						include("assets/php/views/patchy.php");
					} else {
						include("assets/php/views/loggedIn.php");
					}
				} else {
					include("assets/php/views/loggedIn.php");
				}
			} else {
				include("assets/php/views/default.php");
			}
		?>
		
	</body>
</html>