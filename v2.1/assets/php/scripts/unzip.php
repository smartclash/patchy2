<?php
require '../../init.php';
require '../main/db.php';

if (accountLoggedIn()) { // Only if account is logged in
	if (isset($_SESSION["fileUploaded"],$_SESSION["fileDestination"])) {
		// Set as local variables
		$file = $_SESSION["fileUploaded"];
		$dest = $_SESSION["fileDestination"];

		// Create new ZipArchive
		$zip = new ZipArchive;
		$zip->open($file);

		// Attempt Extraction
		if ($zip->extractTo($dest)) {
			$zip->close();
			
			// Delete the file if it worked
			if (file_exists($file)) {
				if (!unlink($file)) {
					header("Location: $fullPathToRoot?p=upl&msg=1&type=2");
					die("Redirecting");
				} else {
					$_SESSION["usedPatchInt"] = $_SESSION["usedPatchInt"] + 1;
					if (checkPatchAmount()) {
						$updatePatchCount = "UPDATE users SET usedPatches = usedPatches + 1 WHERE username='" . $_SESSION["username"] . "'";
						if ($conn->query($updatePatchCount)) {
							$conn->close();
							header("Location: $fullPathToRoot?p=upl&msg=5");
							die("Redirecting");
						} else {
							header("Location: $fullPathToRoot?p=upl&msg=9");
							die("Redirecting");
						}
					} else {
						header("Location: $fullPathToRoot?p=upl&msg=10");
						die("Redirecting");
					}
				}
			} else {
				$_SESSION["usedPatchInt"] = $_SESSION["usedPatchInt"] + 1;
				if (checkPatchAmount()) {
					$updatePatchCount = "UPDATE users SET usedPatches = usedPatches + 1 WHERE username='" . $_SESSION["username"] . "'";
					if ($conn->query($updatePatchCount)) {
						$conn->close();
						header("Location: $fullPathToRoot?p=upl&msg=5");
						die("Redirecting");
					} else {
						header("Location: $fullPathToRoot?p=upl&msg=9");
						die("Redirecting");
					}
				} else {
					header("Location: $fullPathToRoot?p=upl&msg=10");
					die("Redirecting");
				}
			}
			die("Yay :)");
		} else {
			header("Location: $fullPathToRoot?p=upl&msg=8");
			die("Redirecting");
		}
	} else {
		header("Location: $fullPathToRoot?p=upl&msg=7");
		die("Redirecting");
	}
} else {
	header("Location: $fullPathToRoot");
	die("You aren't logged in");
}
?>