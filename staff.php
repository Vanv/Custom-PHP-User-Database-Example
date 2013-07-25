<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php include ("includes/header.php"); ?>
	<nav>
		<?php //echo navigation($sel_subject, $sel_page); ?>
		<br/><br/>
		<!-- <a href="new_subject.php">+ Add a New Subject</a> -->
	</nav>

	<div class="content">
	<h3>Staff Menu</h3>
	<h4>Welcome to the staff area, <?php echo $_SESSION['username']; ?></h4>
		<div class="staff_menu">

			>> <a href="content.php">Manage Website Content</a> <br/><br/>
			>> <a href="new_user.php">Add Staff user</a><br/><br/>
			>> <a href="logout.php">Logout</a>
		</div>
	</div><!--content-->

		<br/><br/>

<?php require ("includes/footer.php"); ?>