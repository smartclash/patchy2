<?php
namespace Patchy\Plugins;

session_name("InstallerSession");
session_start();

class PatchyInstaller {
	private function showWelcome() {
		echo '<div id="titleBox">
			<span id="PatchyInstallerTitle">Patchy Installer</span><br />
			<span id="PatchyInstallerVersion">Intended for Patchy 2.1</span><br />
			<button class="button" onclick="window.location.href=\'install.php?c=2\'">Start Setup</button>
			</div>
		';
	}
	private function getDbInfo() {
		echo '<div id="titleBox">
			<span id="PatchyInstallerTitle">Database</span><br />
			<span id="PatchyInstallerVersion">Enter your database logins</span><br />
			<form action="install.php?c=3" method="post" name="installForm">
				<input class="text-input" type="text" id="db-host" name="db-host" placeholder="Host (Database server; such as 127.0.0.1 or localhost)" /><br />
				<input class="text-input" type="text" id="db-port" name="db-port" placeholder="Port (Optional)" /><br />
				<input class="text-input" type="text" id="db-dbse" name="db-dbse" placeholder="Database Name (If it exists!)" /><br />
				<input class="text-input" type="text" id="db-user" name="db-user" placeholder="Username" /><br />
				<input class="text-input" type="password" id="db-pass" name="db-pass" placeholder="Password (Use is recommended)" /><br />
				<input type="submit" class="button" value="Install Patchy" />
			</form>
			</div>
		';
	}
	private function attemptInstall() {
		// Attempt an install
		echo '<div id="titleBox" style="margin:0 25% 0 25%;width:50%;border-bottom:1px dashed rgba(0,0,0,0.9);"><span id="PatchyInstallerTitle">Installing</span><br /></div><br />';ob_flush();flush();
		if (!empty($_POST)) {
			echo "<span style='color:green;font-size:1.2em;'>Post isn't empty</span><br />"; ob_flush();flush();
			if (!empty($_POST["db-host"] || $_POST["db-user"] || $_POST["db-pass"])) {
				
				// Clean up the details.. For no reason in particular
				$host = filter_var($_POST["db-host"], FILTER_SANITIZE_URL);
				$user = filter_var($_POST["db-user"], FILTER_SANITIZE_SPECIAL_CHARS);
				$pass = trim($_POST["db-pass"]);
				if (!empty($_POST["db-port"])) {
					$port = filter_var($_POST["db-port"], FILTER_SANITIZE_NUMBER_INT);
				} else {
					echo "<span style='color:orange;font-size:1.2em;'>Port wasn't set, setting as 3306</span><br />"; ob_flush();flush();
					$port = 3306;
				}
				if (!empty($_POST["db-dbse"])) {
					$dbse = filter_var($_POST["db-dbse"], FILTER_SANITIZE_SPECIAL_CHARS);
					$shouldUseDB = true;
				} else {
					echo "<span style='color:orange;font-size:1.2em;'>Database wasn't set, setting as Patchy</span><br />"; ob_flush();flush();
					$dbse = "patchy";
					$shouldUseDB = false;
				}
				echo "<span style='color:green;font-size:1.2em;'>Data was accepted</span><br />"; ob_flush();flush();
				// Now attempt a connection
				if ($shouldUseDB) {
					$conn = new \mysqli($host,$user,$pass,$dbse,$port); // HOST, USER, PASS, DB, PORT, SOCKET
				} else {
					$conn = new \mysqli($host,$user,$pass,null,$port); // HOST, USER, PASS, DB, PORT, SOCKET
				}

				if ($conn->connect_error) {
					unset($conn);
					die("<span style='color:red;font-size:1.2em;'>Server connection failed - Aborting install</span><br />");
				} else {
					$conn->set_charset("utf8");
					echo "<br /><span style='color:green;font-size:1.25em;font-weight:bold;'>Connected to server " . $host . " on port " . $port . "</span><br /><br />"; ob_flush();flush();
				}
				
				// Create the queries!
				$createDatabase = "CREATE DATABASE IF NOT EXISTS $dbse";
				$createTable = "CREATE TABLE IF NOT EXISTS `users` (
								  `user_id` int(11) NOT NULL,
								  `isActive` int(1) NOT NULL DEFAULT '1',
								  `isAccountType` int(1) NOT NULL DEFAULT '1',
								  `uniqueSalt` varchar(512) NOT NULL,
								  `otherUniqueSalt` varchar(512) NOT NULL,
								  `username` varchar(50) NOT NULL,
								  `email` varchar(255) NOT NULL,
								  `password` varchar(384) NOT NULL,
								  `accountCreatedIP` varchar(15) NOT NULL,
								  `signUpDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
								  `usedPatches` int(11) NOT NULL DEFAULT '0'
								) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;";
				$modifyTableUID = "ALTER TABLE `users` ADD PRIMARY KEY (`user_id`);";
				$modifyUserID = "ALTER TABLE `users` MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;";
				$addTestAccount = "INSERT INTO `users` (`user_id`, `isActive`, `isAccountType`, `uniqueSalt`, `otherUniqueSalt`, `username`, `email`, `password`, `accountCreatedIP`, `signUpDate`, `usedPatches`) VALUES(1, 1, 4, '42b296da40f465f98f6ee9207ecb0c8f63351bd27a2dba50242988cde2849d5f65306d377577c447121d95944a672469cc23a9c03d50f9d9346b5882732ec09a', '428bfd1bd8134a7e8ea1efded1b5d6b6c38b4491f3c16321ae0b0faae56986ccf1d06809f90d50fd5b977cf716aa49d2dbc633f17cafd9e76ca122427c2705e4', 'patchy_self_admin', 'e4a3f6f7@opayq.com', '993cc243147d8366e1ce002848b2760adbcb7ad709079bd568f718ca45f756fa53a0368853db9c0071a335c9276f8394988096aa694b40430385c89b67453bc0', '::1', '2015-10-10 19:37:36', 0);";
				
				// Now to run the queries... Yay!
				if ($shouldUseDB) {
					$r = $conn->select_db($dbse);
					if ($r) {
						echo "<span style='color:green;font-size:1.2em;'>Database Selected</span><br /><br />"; ob_flush();flush();
					} else {
						die("<span style='color:red;font-size:1.2em;'>Database couldn't be selected - Aborting install</span><br />");
					}
				} else {
					$r = $conn->query($createDatabase);
					if ($r) {
						echo "<span style='color:green;font-size:1.2em;'>Database Created</span><br />"; ob_flush();flush();
						$r = $conn->select_db($dbse);
						if ($r) {
							echo "<span style='color:green;font-size:1.2em;'>Database Selected</span><br /><br />"; ob_flush();flush();
						} else {
							die("<span style='color:red;font-size:1.2em;'>Database couldn't be selected - Aborting install</span><br />");
						}
					} else {
						die("<span style='color:red;font-size:1.2em;'>Database couldn't be created - Aborting install</span><br />");
					}
				}
				
				$r = $conn->query($createTable);
				if ($r) {
					echo "<span style='color:green;font-size:1.2em;'>Table Created</span><br /><br />"; ob_flush();flush();
				} else {
					die("<span style='color:red;font-size:1.2em;'>Table creation failure - Aborting install</span><br />");
				}
				
				$r = $conn->query($modifyTableUID);
				if ($r) {
					echo "<span style='color:green;font-size:1.2em;'>Added primary key to user_id</span><br />"; ob_flush();flush();
				} else {
					die("<span style='color:red;font-size:1.2em;'>Primary Key couldn't be added to user_id - Aborting install</span><br />");
				}
				
				$r = $conn->query($modifyUserID);
				if ($r) {
					echo "<span style='color:green;font-size:1.2em;'>Special parameters added to user_id</span><br />"; ob_flush();flush();
				} else {
					die("<span style='color:red;font-size:1.2em;'>Special parameters couldn't be added to user_id - Aborting install</span><br /><br />");
				}
				
				$r = $conn->query($addTestAccount);
				if ($r) {
					echo "<span style='color:green;font-size:1.2em;'>Write Permissions OK; An account was successfully created</span><br /><br />"; ob_flush();flush();
				} else {
					die("<span style='color:orange;font-size:1.2em;'>Patchy may not be able to write to the database - Please try making an account</span><br /><br />");
				}
				
				$r = $conn->close();
				if ($r) {
					echo "<span style='color:green;font-size:1.3em;'>Patchy Installed Successfully</span><br />"; ob_flush();flush();
					unset($r);
					sleep(3);
					echo "<script type='text/javascript'> window.location.href='install.php?c=4'; </script>";
				} else {
					die("<span style='color:green;font-size:1.3em;'>Patchy Installed :)</span><br />");
				}
			} else {
				header("Location: install.php?c=5");
			}
		} else {
			header("Location: install.php?c=5");
		}
		// If it works create the db.php file
	}
	private function installSuccess() {
		echo '<div id="titleBox">
			<span id="PatchyInstallerTitle">Patchy 2.0 Installed Successfully</span><br />
			<span id="PatchyInstallerVersion">Make sure to delete this install file</span><br />
			<button class="button" onclick="window.location.href=\'index.php?installSuccess\'">Load patchy</button>
			</div>
		';
	}
	private function installError() {
		if (empty($_GET["e"])){
			$_GET["e"] = 0;
		}
		if (is_numeric($_GET["e"])) {
			switch($_GET["e"]) {
				case 1:
					$errMsg = "Missing required information";
					break;
				case 2:
					$errMsg = "Couldn't connect to database";
					break;
				default:
					$errMsg = "Unknown Error";
					break;
			}
			echo '<div id="titleBox">
				<span id="PatchyInstallerTitle">Patchy Install Failed</span><br />
				<span id="PatchyInstallerVersion">' . $errMsg . '</span><br />
				<button class="button" onclick="history.go(-1)">Go Back</button>
				</div>
			';
		} else {
			echo "That's not an error..?";
		}
		
	}
	public function run() {
		if (isset($_GET["c"]) && is_numeric($_GET["c"])) {
			switch($_GET["c"]) {
				case 1:
					$this->showWelcome();
					break;
				case 2:
					$this->getDbInfo();
					break;
				case 3:
					$this->attemptInstall();
					break;
				case 4:
					$this->installSuccess();
					break;
				case 5:
					$this->installError();
					break;
				default:
					header("Location: install.php?c=1");
					break;
			}
		} else {
			$this->showWelcome();
		}
	}
}
?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
	
		<title>Patchy Installer</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<style type="text/css">
			* { margin-top:2em; text-align:center; font-family:sans-serif; }
			#titleBox { margin-top:2.1em; }
			#PatchyInstallerTitle { font-size:2.1em; }
			#PatchyInstallerVersion { font-size:1.2em; }
			.button {padding:6px 12px;font-size:.875em;font-weight:400;line-height:1.42857143;white-space: nowrap;cursor:pointer;user-select:none;background-color:#000;color:#FFF;border:1px solid transparent;border-radius:5px;}
			.text-input { margin:0 11.5% 0 11.5%;display:block;width:75%;height:34px;padding:6px 12px;font-size:14px;line-height:1.42857143;color:#555;background-color:#fff;background-image:none;border:1px solid #ccc;border-radius:5px; }
		</style>
	
	</head>
	<body>
	
		<?php 
			$i = new PatchyInstaller;
			$i->run();
		?>
		
	</body>
</html>