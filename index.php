<?php require_once ("includes/session.php"); ?>
<?php require_once ("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>

<?php find_selected_page(); ?>
<?php include("includes/header.php"); ?>
<nav>
	<?php echo public_navigation($sel_subject, $sel_page); ?>
</nav>
<div class="content">

		<?php if($sel_page) { ?>
			<h3><?php echo htmlentities($sel_page['menu_name']); ?></h3>
			<div class="page_content">
				<?php echo strip_tags(nl2br($sel_page['content']), "<b><br><p><a>"); ?>
			</div>	
		<?php } else { ?>
		<h2>Welcome to Impact Studios</h2>
		<p>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
			Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
		</p> 	
		<p>	
			Duis aute irure dolor 
			in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, 
			sunt in culpa qui officia deserunt mollit anim id est laborum.
		</p>
		<?php } ?>
</div><!--content-->
<?php include("includes/footer.php"); ?>

