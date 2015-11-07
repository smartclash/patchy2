<div id="main">
	
	<div id="navigation">
		<?php include("navigation.php"); ?>
	</div>

	<div id="content">
		
		<div id="header">
			<h1>Account Settings</h1>
		</div>
		
		<?php
			if (!empty($_GET["msg"])) {
				if (is_numeric($_GET["msg"])) {
					$msg = trim($_GET["msg"]);
					switch ($msg){
						case 1:
							echo "<span class=\"statusMsg\">Data synced from server successfully!";
							break;
						case 2:
							echo "<span class=\"statusMsgErr\">Your account seems to be inactive";
							break;
						case 3:
							echo "<span class=\"statusMsgErr\">This action has been disabled";
							break;
						case 4:
							echo "<span class=\"statusMsgErr\">Database error";
							break;
						default:
							echo "<span class=\"statusMsgErr\">Unknown error";
							break;
					}
					echo "</span>";
				}
			}
		?>
		
		<div id="accInfo">
			<h3>Current Info:</h3>
			<?php
				echo "<p>Username: <strong>" . $_SESSION["username"] . "</strong></p>";
				echo "<p>Email: <strong>" . $_SESSION["email"] . "</strong><a onclick='changeEmail()'>(Change)</a></p>";
				echo "<p>Sign Up Date: <strong>" . $_SESSION["signUpDate"] . "</strong></p>";
				echo "<p>Sign Up IP: <strong>" . $_SESSION["createdIP"] . "</strong></p>";
				if ($_SESSION["accountType"] == 1) {
					echo "<p>Account Type: <strong>Free</strong>";
				} elseif ($_SESSION["accountType"] == 2) {
					echo "<p>Account Type: <strong>Special</strong>";
				} elseif ($_SESSION["accountType"] == 3) {
					echo "<p>Account Type: <strong>Important</strong>";
				} elseif ($_SESSION["accountType"] == 4) {
					echo "<p>Account Type: <strong>Administrator</strong>";
				} else {
					echo "<p>Account Type: <strong>Error</strong>";
				}
				echo "<p>Your account allows " . $_SESSION["allowedPatchInt"] . " patches of " .  $_SESSION["allowedPatchSizeStr"] . " each</p>";
				if ($site["features"]["allowAccountReload"] == true) {
					echo '<button class="button-alt" onclick="window.location.href=\'assets/php/scripts/update.php\'" title="Reloads session data">Reload Session</button>';
				} else {
					echo '<button class="button-alt" onclick="window.location.href=\'assets/php/scripts/logout.php\'">Logout</button>';
				}
			?>
		</div>
		
	</div>
	
</div>