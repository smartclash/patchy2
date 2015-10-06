<div id="main">
	
	<div id="navigation">
		<?php include("navigation.php"); ?>
	</div>

	<div id="content">
		
		<div id="header">
			<h1>Account Settings</h1>
		</div>
		<div id="accInfo">
			<h3>Current Info:</h3>
			<?php
				echo "<p>Username: <strong>" . $_SESSION["username"] . "</strong></p>";
				echo "<p>Email: <strong>" . $_SESSION["email"] . "</strong></p>";
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
			?>
		</div>
		
	</div>
	
</div>