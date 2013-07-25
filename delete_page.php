<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php
	if(intval($_GET['page'] == 0 )) {
		redirect_to("content.php"); 
	}
	
	$id = mysql_prep($_GET['page']); 

	if($page = get_page_by_id($id)) {

		$query = "DELETE FROM pages WHERE id = {$id} LIMIT 1";
		$result = mysql_query($query, $connection);

		if(mysql_affected_rows() == 1) {
			redirect_to("content.php");
		} else {
			echo "<p>Page deletion failed</p>"; 
			echo "<p>" . mysql_error() . "</p>";
			echo "<a href=\"content.php\">Return to main page</a>";  
		}
	} 
?>

<?php //find_selected_page(); ?>
<?php //include("includes/header.php"); ?>

<nav>
	<?php //echo navigation($sel_subject, $sel_page);  ?>
</nav>

<!-- <div class="content">
<h2>Delete page</h2>



</div> --><!--content-->

<?php include("includes/footer.php"); ?>

<?php mysql_close($connection); ?>