<?php
require("../../init.php");

if (accountLoggedIn()) { // Only if account is logged in
	// Check if they can upload a patch
	if (checkPatchAmount()) {
		// Did they upload the file
		if($_FILES['fileToUpload']['name']) {
			
			// Check for errors
			if(!$_FILES['fileToUpload']['error']) {
				
				// Set the file name for later use
				$currentdir = getcwd();
				if ($usingLinux == false) {
					$target = $currentdir . '\..\..\..\patch\\' . $_SESSION["username"] . '\\' . basename($_FILES['fileToUpload']['name']);
					$destination = $currentdir . '\..\..\..\patch\\' . $_SESSION["username"] . '\\';
				} else {
					$target = $currentdir . '/../../../patch/' . $_SESSION["username"] . '/' . basename($_FILES['fileToUpload']['name']);
					$destination = $currentdir . '/../../../patch/' . $_SESSION["username"] . '/';
				}
				
				// Check the file is a zip archive
				$explodedFileName = explode(".",strtolower($_FILES["fileToUpload"]["name"]));
				$fileExtension = end($explodedFileName);
				if ($fileExtension == "zip") {
					$new_file_name = strtolower($_FILES['fileToUpload']['tmp_name']); // Rename the file
					if($_FILES['fileToUpload']['size'] > ($_SESSION["allowedPatchSize"])) { // Must be smaller than is allowed for accountType 
						$valid_file = false;
					} else { 
						$valid_file = true;
					}
					
					// If the file is OK
					if($valid_file) {
						if (file_exists($target)) {
							if (!unlink($target)) {
								header("Location: $fullPathToRoot?p=upl&msg=1");
								die("Redirecting");
							}
						}
						if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target)) {
							$_SESSION["fileUploaded"] = $target; // Set so unzip.php knows what to target
							$_SESSION["fileDestination"] = $destination; // Set so unzip.php knows other stuff
							header("Location: unzip.php");
							die("Redirecting");
						} else {
							header("Location: $fullPathToRoot?p=upl&msg=4");
							die("Redirecting");
						}
					} else {
						header("Location: $fullPathToRoot?p=upl&msg=2");
						die("Redirecting");
					}
				} else {
					header("Location: $fullPathToRoot?p=upl&msg=3");
					die("Redirecting");
				}
			} else {
				// Any more problems?
				header("Location: $fullPathToRoot?p=upl&msg=6");
				die("Redirecting");
			}
		} else {
			die("I don't know what your trying to upload but it ain't a file");
		}
	} else {
		header("Location: $fullPathToRoot?p=upl&msg=10");
		die("Redirecting");
	}
} else { 
	header("Location: $fullPathToRoot");
	die("You aren't logged in");
}
?>
