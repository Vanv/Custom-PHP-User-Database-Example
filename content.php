<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php find_selected_page(); ?>
<?php require ("includes/header.php"); ?>

	<nav>
		<?php echo navigation($sel_subject, $sel_page); ?>
		<br/><br/>
		+ <a href="new_subject.php">Add a New Menu</a>
	</nav>

	<div class="content">
		<?php if (!is_null($sel_subject)) { //subject selected ?>	
			<h2><?php echo $sel_subject['menu_name']; ?></h2>
		<?php } elseif (!is_null($sel_page)) { //selected page ?>
			<h2><?php echo $sel_page['menu_name']; ?></h2>
			<div class="page_content">
				<?php echo $sel_page['content']; ?>

			<br/><br/>
			
			<a href="edit_page.php?page=<?php echo urlencode($sel_page['id']); ?>" />Edit Page</a> 	
			</div><!--page_content-->
		<?php } else { //nothin selected ?>
			<h2>Select a subject or page to edit</h2>	
		<?php } ?>	
	</div>

		<br/><br/>

<?php require ("includes/footer.php"); ?>

