<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php

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

		if ( empty($errors) ) {
			$query = "INSERT INTO users (
							username, hashed_password
						) VALUES (
							'{$username}', '{$hashed_password}'
						)";
			$result = mysql_query($query, $connection);
			if ($result) {
				$message = "The user was successfully created.";
			} else {
				$message = "The user could not be created.";
				$message .= "<br />" . mysql_error();
			}
		} else {
			if (count($errors) == 1) {
				$message = "There was 1 error in the form.";
			} else {
				$message = "There were " . count($errors) . " errors in the form.";
			}
		}
	} else { // Form has not been submitted.
		$username = "";
		$password = "";
	}


?>

<?php include("includes/header.php"); ?>
<nav>
	<?php //echo public_navigation($sel_subject, $sel_page); ?>
	<a href="staff.php">Return to Menu</a>
</nav>
<div class="content">
<h2>Create User</h2>
		<?php if(!empty($message)) {echo "<p class=\"message\">" . $message . "</p>"; } ?>

		<?php if(!empty($errors)) { display_errors($errors); } ?>

		<form action="new_user.php" method="post">


			<ul>
				<li>
					<label for="username">Username: </label> 
					<input type="text" name="username" maxlength="30" value="<?php echo htmlentities($username); ?>" />	
				</li>
				<li>
					<label for="password">Password:&nbsp; </label>
					<input type="password" name="password" maxlength="30" value="<?php echo htmlentities($password); ?>"  />
				</li>
				<li>
					<input class="submit_btn" type="submit" name="submit" value="Create User" />

		 		</li>
			</ul>		


		</form>

</div><!--content-->
<?php include("includes/footer.php"); ?>

