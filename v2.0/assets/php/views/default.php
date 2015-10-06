<link rel="stylesheet" type="text/css" href="assets/css/default_home.css" media="screen" />

<div id="main">

	<div id="titleBar">
		<span class="mainTitle"><?php echo $site["info"]["name"]; ?></span>
		<span class="mainShortDesc"><?php echo $site["info"]["shortDesc"]; ?></span>
	</div>
	
	<div id="loginMessage" class="hidden overlay-page">Logging You In...</div>
	<div id="createMessage" class="hidden overlay-page">Creating Your Account...</div>
	
	<div id="notificationArea">&nbsp;</div>
	
	<div id="createAccountSide">
		<span class="createTitle">Create an account</span>
		<form action="#" method="post" name="createForm" id="createForm">
			<input type="text" class="formElement" placeholder="Email" name="createEmail" id="createEmail" required /><br />
			<input type="text" class="formElement" placeholder="Username" name="createUsername" id="createUsername" required /><br />
			<input type="password" class="formElement" placeholder="Password" name="createPassword" id="createPassword" required /><br />
			<input type="submit" id="createButton" value="Create Account" class="button" />
		</form>
	</div>
	
	<div id="loginAccountSide">
		<span class="loginTitle">Already have an account?</span>
		<form action="#" method="post" name="loginForm" id="loginForm">
			<input type="text" class="formElement" placeholder="Username or Email" name="loginIdentity" id="loginIdentity" /><br />
			<input type="password" class="formElement" placeholder="Password" name="loginPassword" id="loginPassword" /><br />
			<input type="submit" id="loginButton" value="Login" class="button" />
		</form><br /><br />
		<button class="button-alt" onclick="alert('Well... I\'d like to help but I can\'t at the moment')">Password Reset</button>
	</div>
	
	<script type="text/javascript" src="assets/libs/hashes.min.js"></script>
	<script type="text/javascript" src="assets/js/homePageAjax.js"></script>
	
	<div id="footer">
		<a href="https://github.com/jake-cryptic/patchy/" target="_blank" class="white-link">Patchy on github</a>
	</div>
	
</div>