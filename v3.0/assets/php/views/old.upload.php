<div id="main">
	
	<div id="navigation">
		<?php @include("navigation.php"); ?>
	</div>
	
	<div id="content">
		
		<div id="header">
			<h1>Upload Patch</h1>
			<h3>Patch Server: <?php echo $site["server"]["host"] . "patch/" . $_SESSION["username"] . "/"; ?></h3>
		</div>
		
		<?php
			if (!empty($_GET["msg"])) {
				if (is_numeric($_GET["msg"])) {
					$msg = trim($_GET["msg"]);
					switch ($msg){
						case 1:
							echo '<span class="statusMsgErr" id="response_message">File exists, please contact support for help';
							break;
						case 2:
							echo '<span class="statusMsgErr" id="response_message">This patch breaks our file size limit of ' . $_SESSION["allowedPatchSizeStr"];
							break;
						case 3:
							echo '<span class="statusMsgErr" id="response_message">The file uploaded was not in .zip format!';
							break;
						case 4:
							echo '<span class="statusMsgErr" id="response_message">Files couldn\'t be moved, contact support';
							break;
						case 5:
							echo '<span class="statusMsg" id="response_message">File was uploaded successfully! <a href="?p=svr" title="Continue">Click to Continue</a>';
							break;
						case 6:
							echo '<span class="statusMsgErr" id="response_message">General file upload error, contact support asap';
							break;
						case 7:
							echo '<span class="statusMsgErr" id="response_message">Unable to locate the file to verify an upload success';
							break;
						case 8:
							echo '<span class="statusMsgErr" id="response_message">File may be corrupt or an invalid .zip archive';
							break;
						case 9:
							echo '<span class="statusMsgErr" id="response_message">Couldn\'t register your patch with the server';
							break;
						case 10:
							echo '<span class="statusMsgErr" id="response_message">We have a limit of ' . $_SESSION["allowedPatchInt"] . ' patches';
							break;
						case 11:
							echo '<span class="statusMsgErr" id="response_message">File uploaded cannot be read';
							break;
						default:
							echo '<span class="statusMsgErr" id="response_message">Unknown error #2';
							break;
					}
					echo "</span>";
				}
			}
		?>
		
		<div id="uploadArea">
			<p id="uploadSteps">
				Upload an <strong>individual</strong> patch<br />
				1) Archive the patch in .zip format<br />
				2) Press upload patch and select the .zip file you just made<br />
				3) Your patch should upload successfully and be usable
			</p>
			<form action="assets/php/scripts/upload.php" method="post" enctype="multipart/form-data">
				<label for="file"></label><input type="file" name="fileToUpload" id="fileToUpload" /><br /><br />
				<input type="submit" value="Upload Patch" class="button">
			</form>
		</div>
		
	</div>
	
</div>