<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php  find_selected_page(); ?>

<?php require ("includes/header.php"); ?>


	<nav>
		<?php echo navigation($sel_subject, $sel_page); ?>
	</nav>

	<div class="content">
		<h2>Add Menu</h2>

		<form action="create_subject.php" method="post">
			<p>Subject Name: 
				<input type="text" name="menu_name" id="menu_name" />
			</p>
			<p>Position: 
				<select name="position">
					<?php 

					$subject_set = get_all_subjects();
					$subject_count = mysql_num_rows($subject_set);
					//$subject_count + 1 because we are adding a subject
					for($count = 1; $count <= $subject_count+1; $count++)
						echo "<option value=\"{$count}\">{$count}</option>"						
					?>

				</select>
			</p>

			<p>Visible:
				<input type="radio" name="visible" value="0" /> No
				&nbsp;
				<input type="radio" name="visible" value="1" /> Yes
			</p>
			<p>
				<input class="submit_btn" type="submit" value="Add Subject" />
			</p>
		</form>

		<br/>
		<a href="content.php">Cancel</a>
	</div><!--content-->

		<br/><br/>

<?php require ("includes/footer.php"); ?>
