<div id="main">
	
	<div id="navigation">
		<?php @include("navigation.php"); ?>
	</div>
	
	<div id="content">
		
		<div id="header">
			<h1>Patch Server Control</h1>
		</div>
		
		<?php
			if (!empty($_GET["msg"])) {
				if (is_numeric($_GET["msg"])) {
					$msg = trim($_GET["msg"]);
					switch ($msg){
						case 1:
							echo "<span class=\"statusMsg\">Patch deletion successful";
							break;
						case 2:
							echo "<span class=\"statusMsgErr\">Patch couldn't be deleted";
							break;
						default:
							echo "<span class=\"statusMsg\">Something happened";
							break;
					}
					echo "</span><br /><br />";
				}
			}
		?>
		
		<button class="button" onclick="window.location.href='?p=upl';">Upload a Patch</button>
		
		<?php
			if (makeServer($_SESSION["username"])) {
				echo '<br /><br /><span class="serverMessage">Patch Server Now Active!</span>';
			} else {
				readPatchFolder("patch/".$_SESSION["username"]."/");
			}
		?>
		
	</div>
	
</div>