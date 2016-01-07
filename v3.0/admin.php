<?php
require("assets/init.php");

// Kick them off if they aren't an admin
if(accountLoggedIn()) {
	if ($_SESSION["accountType"] != 4) {
		header("Location: /");
		die("This is a local admin script for local admins, we don't want your kind here");
	} else {
		session_regenerate_id(); 
	}
} else {
	header("Location: /");
	die("This is a local admin script for local admins, we don't want your kind here");
}
?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		
		<!-- Title and Metadata -->
		<title><?php echo $sitePrefix . $site["info"]["name"]; ?></title>
		<meta http-equiv="content-type" content="<?php echo $site["info"]["content"]; ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta http-equiv="content-language" content="<?php echo $site["info"]["language"]; ?>" />
		<meta name="author" content="<?php echo $site["info"]["author"]; ?>" />
		<meta name="google" content="notranslate" />
		<meta name="description" content="<?php echo $site["info"]["description"]; ?>" />
		<meta name="keywords" content="<?php echo $site["info"]["keywords"]; ?>" />
		
		<!-- Styles and Graphics -->
		<link rel="stylesheet" type="text/css" href="<?php echo $site["custom"]["theme_location"]; ?>global.css" media="screen" />
		<style type="text/css">  body { background:url('<?php echo $site["custom"]["theme_location"]; ?>background.jpg') no-repeat center center fixed;-webkit-background-size:cover;-moz-background-size:cover;-o-background-size:cover;background-size:cover; } </style>
		<link rel="apple-touch-icon" sizes="250x250" href="<?php echo $site["custom"]["appleicon_location"]; ?>">
		<link rel="icon" href="<?php echo $site["custom"]["favicon_location"]; ?>" type="image/gif">
		
		<!-- Scripts and Libraries -->
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="assets/libs/hashes.min.js"></script>
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
		
		<div id="main">
			<?php 
				if (!isset($_SESSION["isVerifiedAdmin"])) {
			?>
			<div id="navigation">
				<a href="index.php?p=home" class="nav_link"><div class="nav_item left">Home</div></a>
				<a href="index.php?p=lgo" class="nav_link"><div class="nav_item right">Logout</div></a>
			</div>
			
			<div id="verifyMessage" class="hidden overlay-page">Checking your password</div>
			
			<div id="content">
				
				<div id="notificationArea">&nbsp;</div>
				
				<div id="header">
					<div class="a-cp-tarea">
						<h1><?php echo $site["info"]["name"] . " $version - AdminCP"; ?></h1>
						<h2>To continue as <?php echo $_SESSION["username"]; ?>, enter your password</h2>
						<form action="#" method="post" name="verificationAdmin" id="verificationAdmin">
							<input type="password" class="formElement" placeholder="Password" name="verifyPassword" id="verifyPassword" /><br />
							<input type="submit" id="verifyButton" value="Login" class="button" />
						</form>
					</div>
				</div>
				
			</div>
			
			<script src="assets/js/adminPageAjax.js" type="text/javascript"></script>
			
			<?php 
				} elseif ($_SESSION["isVerifiedAdmin"] == true) {
					if (empty($_GET["c"])) {
			?>
			
			<div id="navigation">
				<a href="index.php?p=home" class="nav_link"><div class="nav_item left">Home</div></a>
				<a href="admin.php?c=usr" class="nav_link"><div class="nav_item left">Users</div></a>
				<a href="admin.php?c=hlp" class="nav_link"><div class="nav_item left">Site Help</div></a>
				<a href="index.php?p=lgo" class="nav_link"><div class="nav_item right">Logout</div></a>
			</div>
			
			<div id="content">
				
				<div id="notificationArea">&nbsp;</div>
				
				<div id="header">
					<div class="a-cp-tarea">
						<h1><?php echo $site["info"]["name"] . " $version - AdminCP"; ?></h1>
						<h2>Logged in as <?php echo $_SESSION["username"]; ?></h2>
						<h4><?php if (!checkPatchyVersion()) { echo "<span id=\"update-me\">A newer version of Patchy is available <a href='https://github.com/jake-cryptic/patchy2'>here</a></span>"; } else { echo "Patchy is up to date"; } ?></h4>
					</div>
				</div>
				
			</div>
			
			<?php
					} else {
						if ($_GET["c"] == "usr") {
			?>
			
			<div id="navigation">
				<a href="index.php?p=home" class="nav_link"><div class="nav_item left">Home</div></a>
				<a href="admin.php?c=usr" class="nav_link"><div class="nav_item left">Users</div></a>
				<a href="admin.php?c=hlp" class="nav_link"><div class="nav_item left">Site Help</div></a>
				<a href="index.php?p=lgo" class="nav_link"><div class="nav_item right">Logout</div></a>
			</div>
			
			<div id="content">
				
				<div id="notificationArea">&nbsp;</div>
				
				<div id="header">
					<div class="a-cp-tarea">
						<h1><?php echo $site["info"]["name"] . " $version - Users"; ?></h1>
					</div>
					
					<script type="text/javascript">
					function editUser(url) {
						window.location.href = "<?php echo $fullPathToRoot; ?>" + url;
					}
					</script>
					
					<table class="table table-small">
						<thead>
							<tr>
								<th>UserID</th>
								<th>Username</th>
								<th>Email</th>
								<th>Is Active</th>
								<th>Account Type</th>
								<th>Create IP</th>
								<th>Used Patches</th>
								<th>Sign Up Date</th>
							</tr>
						</thead>
						<tbody>
							<?php
							require "assets/php/main/db.php";
							$getUsers = "SELECT user_id, username, email, isActive, isAccountType, accountCreatedIP, usedPatches, signUpDate FROM users";
							$listUsers = $conn->query($getUsers);
							
							while($item = $listUsers->fetch_object()) {
								if($item->isActive == 1) { 
									$activeState = "Active"; 
								} else { 
									$activeState = "Inactive";
								}
								
								switch($item->isAccountType) {
									case 1:
										$accountType = "User";
										break;
									case 2:
										$accountType = "Special";
										break;
									case 3:
										$accountType = "Semi-Admin";
										break;
									case 4:
										$accountType = "Admin";
										break;
									default:
										die("Unknown Account type for user " . $item->username . " (ID: " . $item->user_id . ")");
										break;
								}
								
								echo "<tr onclick='editUser(\"admin.php?c=acc&i=" . $item->user_id . "&u=" . $item->username . "\")'>
									<td>" . $item->user_id . "</td>
									<td>" . $item->username . "</td>
									<td>" . $item->email . "</td>
									<td>" . $activeState . "</td>
									<td>" . $accountType . "</td>
									<td>" . $item->accountCreatedIP . "</td>
									<td>" . $item->usedPatches . "</td>
									<td>" . $item->signUpDate . "</td>
								</tr>";
							}
							if ($site["security"]["debug"] == true) {
								echo $conn->error;
							}
							
							$conn->close();
							?>
						</tbody>
					</table>
				</div>
				
			</div>
			
			<?php
						} elseif ($_GET["c"] == "acc") {
			?>
			
			<div id="navigation">
				<a href="index.php?p=home" class="nav_link"><div class="nav_item left">Home</div></a>
				<a href="admin.php?c=usr" class="nav_link"><div class="nav_item left">Users</div></a>
				<a href="admin.php?c=hlp" class="nav_link"><div class="nav_item left">Site Help</div></a>
				<a href="index.php?p=lgo" class="nav_link"><div class="nav_item right">Logout</div></a>
			</div>
			
			<div id="content">
				<?php
					if (empty($_GET["i"]) || !is_numeric($_GET["i"])) {
						echo '<div id="header">
					<div class="a-cp-tarea">
						<h1>Error</h1>
						<h2>Couldn\'t find that user</h2> 
					</div>
				</div>';
					} else {
						require "assets/php/main/db.php";
						$specifiedID = $conn->real_escape_string($_GET["i"]);
						$getUser = "SELECT user_id, username, email, isActive, isAccountType, accountCreatedIP, usedPatches, signUpDate FROM users WHERE user_id='{$specifiedID}'";
						$userDetails = $conn->query($getUser);
					
						while($user = $userDetails->fetch_object()) {
							if($user->isActive == 1) { 
								$activeState = "Active";
								$activeStateButton = "Deactivate";
							} elseif ($user->isActive == 2) { 
								$activeState = "<strong>Pending Deletion</strong>";
								$activeStateButton = "Delete";
							} else {
								$activeState = "Inactive";
								$activeStateButton = "Activate";
							}
							
							switch($user->isAccountType) {
								case 1:
									$accountType = "User";
									break;
								case 2:
									$accountType = "Special";
									break;
								case 3:
									$accountType = "Semi-Admin";
									break;
								case 4:
									$accountType = "Admin";
									break;
								default:
									die("Unknown Account type for user " . $user->username . " (ID: " . $user->user_id . ")");
									break;
							}
							
							echo "
								<h1>User - " . $user->username . "</h1>
								<table id=\"user_details\">
									<tr><td>User ID</td><td id=\"user_detail_id\">" . $user->user_id . "</td></tr>
									<tr><td>Email</td><td id=\"user_detail_em\">" . $user->email . "</td></tr>
									<tr><td>State</td><td id=\"user_detail_as\">" . $activeState . "</td></tr>
									<tr><td>Type</td><td id=\"user_detail_at\">" . $accountType . "</td></tr>
									<tr><td>IP</td><td id=\"user_detail_ip\">" . $user->accountCreatedIP . "</td></tr>
									<tr><td>Used Patches</td><td id=\"user_detail_up\">" . $user->usedPatches . "</td></tr>
									<tr><td>Sign Up</td><td id=\"user_detail_su\">" . $user->signUpDate . "</td></tr>
								</table>
								<br /><br />
								<button class=\"button\">Edit User</button> <button class=\"button\">$activeStateButton</button> <button class=\"button\">Remove Account</button>";
						}
						if ($site["security"]["debug"] == true) {
							echo $conn->error;
						}
						
						$conn->close();
					}
				?>
			</div>
			
			<script>
			$("button").click(function(){
				alert("Feature not implemented");
			});
			</script>
			
			<?php
						} elseif ($_GET["c"] == "hlp") {
							echo "<h1>Loading Official Help</h1><script type='text/javascript'> window.location.href='http://patchy-a.co.nf/help.php'; </script>";
						} else {
							header("Location: admin.php");
						}
					}
				} else { die("This is a local shop for local people we don't want your kind here"); }
			?>
		</div>
	
	</body>
</html>