		
<div class="clear"></div>
	</div> <!--wrapper-->
	<div class="clear"></div>
	<footer class="footer">
		<div class="left_footer">
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="staff.php">Staff Section</a></li>
				<li><a href="index.php?subj=9">Contact Us</a></li>
			</ul>		
		</div>
		<div class="right_footer">
			@2013 Copyright Impact Studios
		</div>
	</footer>
</div><!--outer_wrapper-->		
</body>
</html>
<?php
//STEP 5 Close the connection
	if(isset($connection)) {
		mysql_close($connection);
	}
?>