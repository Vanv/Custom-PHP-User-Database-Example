<?php require_once ("includes/session.php"); ?>
<?php require_once ("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
	if(logged_in()){
		redirect_to("staff.php");
	}

	include_once("includes/form_functions.php");
	
	// START FORM PROCESSING
	if (isset($_POST['submit'])) { // Form has been submitted.
		$errors = array();

		// perform validations on the form data
		$required_fields = array('username', 'password');
		$errors = array_merge($errors, check_required_fields($required_fields, $_POST));

		$fields_with_lengths = array('username' => 30, 'password' => 30);
		$errors = array_merge($errors, check_max_field_lengths($fields_with_lengths, $_POST));

		$username = trim(mysql_prep($_POST['username']));
		$password = trim(mysql_prep($_POST['password']));
		$hashed_password = sha1($password);

		$username = stripslashes($username);
		$username = mysql_real_escape_string($username);
		$password = stripslashes($password);
		$password = mysql_real_escape_string($password);

		if ( empty($errors) ) {
			// Check database to see if username and the hashed password exist there.
			$query = "SELECT id, username ";
			$query .= "FROM users ";
			$query .= "WHERE username = '{$username}' ";
			$query .= "AND hashed_password = '{$hashed_password}' ";
			$query .= "LIMIT 1";
			$result_set = mysql_query($query);
			confirm_query($result_set);
			if (mysql_num_rows($result_set) == 1) {
				// username/password authenticated
				// and only 1 match
				$found_user = mysql_fetch_array($result_set);
				$_SESSION['user_id'] = $found_user['id'];
				$_SESSION['username'] = $found_user['username'];
				
				redirect_to("staff.php");
			} else {
				// username/password combo was not found in the database
				$message = "Username/password combination incorrect.<br />
					Please make sure your caps lock key is off and try again.";
			}
		} else {
			if (count($errors) == 1) {
				$message = "There was 1 error in the form.";
			} else {
				$message = "There were " . count($errors) . " errors in the form.";
			}
		}
		
	} else { // Form has not been submitted.
		if (isset($_GET['logout']) && $_GET['logout'] == 1) {
			$message = "You are now logged out.";
		} 
		$username = "";
		$password = "";
	}

?>

<?php include("includes/header.php"); ?>
<nav>
	<?php //echo public_navigation($sel_subject, $sel_page); ?>
	<a class="blue" href="staff.php">Return to Menu</a>
</nav>
<div class="content">
<h2>Staff Login</h2>
		<?php if(!empty($message)) {echo "<p class=\"message\">" . $message . "</p>"; } ?>

		<?php if(!empty($errors)) { display_errors($errors); } ?>

		<form action="login.php" method="post">


			<ul>
				<li>
					<label for="username">Username: </label> 
					<input type="text" name="username" maxlength="30" value="<?php echo htmlentities($username); ?>" />	
				</li>
				<li>
					<label for="username">Password:&nbsp; </label> 
					<input type="password" name="password" maxlength="30" value="<?php echo htmlentities($password); ?>"  />
				</li>
				<li>
					<input class="submit_btn" type="submit" name="submit" value="Login" />

		 		</li>
			</ul>		


		</form>

</div><!--content-->
<?php include("includes/footer.php"); ?>