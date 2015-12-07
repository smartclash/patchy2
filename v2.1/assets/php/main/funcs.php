<?php
function accountLoggedIn() {
	// If login set is true then return true
	if ($_SESSION["loginSet"] == true) {
		return True;
	} else {
		return False;
	}
}

function createUniqueSalt() {
	$rand = time()*rand(128,256);
	$hash = hash("sha512",$rand);
	return $hash;
}

function hashPassword($pw,$s1,$s2) {
	$toHash = $s1 . $pw . $s2;
	$hashPass1 = hash("sha512",$toHash);
	$hashPass2 = hash("sha512",$hashPass1 . $s1);
	$hashPass3 = hash("sha512",$hashPass2 . $s2);
	return $hashPass3;
}

function makeServer($user) {
	$structure = 'patch/' . $user . "/";
	if (!@mkdir($structure, 0777, true)) {
		return False;
	} else {
		return True;
	}
}

function readPatchFolder($dir) {
	$scan = @scandir($dir);
	$patches = count($scan)-2; // Remove . and  ..
	if ($patches > 0) {
		echo '
		<table id="patchTable" class="table">
			<thead>
				<tr>
					<th id="patchNameHeader">Patch Name</th>
					<th id="optionsHeader">Options</th>
				</tr>
			</thead>
			<tbody>';
		foreach($scan as $patch){
			if($patch != '.' && $patch != '..'){
				echo "<tr><td>" . $patch . "</td><td><a href='assets/php/scripts/delete.php?patch=$patch' class='white-link'>Delete</a></td></tr>";
			}
		}
		echo '
			</tbody>
		</table><br /><br /><span id="patchesFound">' . $patches . ' patches found</span>';
	}
}

function checkPatchyVersion() {
	// Check for updates..
	require "version.php";
	
	$url = file_get_contents("http://patchy-a.co.nf/api.php?action=updateCheck");
	$data = @json_decode($url);
	if ($versionType == "alpha") {
		if ($data->versions->alpha == $version) {
			return True;
		} else {
			return False;
		}
	} elseif ($versionType == "beta") {
		if ($data->versions->beta == $version) {
			return True;
		} else {
			return False;
		}
	} else {
		if ($data->versions->stable == $version) {
			return True;
		} else {
			return False;
		}
	}
}

function checkPatchAmount() {
	if ($_SESSION["usedPatchInt"] < $_SESSION["allowedPatchInt"]) {
		return True;
	} else {
		return False;
	}
} 

function checkIfCanDel() {
	if ($_SESSION["usedPatchInt"] > 0) {
		return True;
	} else {
		return False;
	}
}

function deletePatch($patch) {
	if (preg_match("/[^a-zA-Z0-9\_]/",$patch)) {
		return False;
	} else {
		$fullPatchPath = $_SESSION["delTarget"] . $patch;
		$cleanPath = str_replace("\assets\php\scripts\..\..\..","",$fullPatchPath);
		
		// <http://stackoverflow.com/a/3352564/3762917>
		$files = new RecursiveIteratorIterator(
			new RecursiveDirectoryIterator($cleanPath, RecursiveDirectoryIterator::SKIP_DOTS),
			RecursiveIteratorIterator::CHILD_FIRST
		);

		foreach ($files as $fileinfo) {
			$todo = ($fileinfo->isDir() ? 'rmdir' : 'unlink');
			$todo($fileinfo->getRealPath());
		}

		rmdir($cleanPath);
		// </http://stackoverflow.com/a/3352564/3762917>
		
		return True;
	}
}
?>