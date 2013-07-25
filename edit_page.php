<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php
	if(intval($_GET['page']) == 0) {
		redirect_to('content.php');
	}
	
	include ("includes/form_functions.php");

	//START FORM processing
	// only excute the form processing if the form has been submitted	
	if(isset($_POST['submit'])) {
		// initialize an array to hold our errors
		$errors = array();

		//perform validations on the form fields
		$required_fields = array('menu_name', 'position', 'visible', 'content');
		$errors = array_merge($errors, check_required_fields($required_fields));

		$fields_with_lengths = array('menu_name' => 30);
		$errors = array_merge($errors, check_max_field_lengths($fields_with_lengths));

		//clean up the form data before putting it in the database

		$id = mysql_prep($_GET['page']);
		$menu_name = trim(mysql_prep($_POST['menu_name']));
		$position = mysql_prep($_POST['position']);
		$visible = mysql_prep($_POST['visible']);
		$content = mysql_prep($_POST['content']);

		//Database submissions only proceeds if there were NO errors
		if(empty($errors)) {
			$query = "UPDATE pages SET
					menu_name = '{$menu_name}',
					position = {$position},
					visible = {$visible},
					content = '{$content}'
				WHERE id = {$id}";
			$result = mysql_query($query, $connection);	
			// test to see if the update occurred	
			if(mysql_affected_rows() == 1) {
				// Success
				$message = "The page was succeffully updated";
			}	else {
				// Failed
				$message = "The page could not be updated.";
				$message .= "<br/>" . mysql_error() . "</br>";
			}
		} else {
			if(count($errors) == 1) {
				$message = "There was 1 error in the form.";
			} else {
				$message = "There were" . count($errors) . " error(s) in the form";
			}
		} 
		// END processing 
	}

?>
<?php find_selected_page(); ?>
<?php include("includes/header.php"); ?>
<nav>
	<?php echo navigation($sel_subject, $sel_page); ?>
	<br/>
	+ <a href="new_subject.php">Add a New Menu</a>
</nav>
<div class="content">
	<p>Edit Page: <?php echo $sel_page['menu_name'];?></p>

	<?php if(!empty($message)) { echo "<p class=\"message\">" . $message . "</p>"; } ?>
	<?php if(!empty($errors)) { display_errors($errors); } ?>

	<form action="edit_page.php?page=<?php echo $sel_page['id']; ?>" method="post">
		<?php include('page_form.php'); ?>
		<p><input class="submit_btn" type="submit" name="submit" value="Update Page" /></p>

	</form>
	
	<a style="float: left;" href="delete_page.php?page=<?php echo $sel_page['id']; ?>" onclick="return confirm('Are you sure you want to delete the page?')">Delete page</a>	

</div><!--content-->


<?php include("includes/footer.php"); ?>
