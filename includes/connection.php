<?php

require ("constants.php");

// STEP 1. Create a database connection

$connection = mysql_connect(DB_SERVER, DB_USER, DB_PASS);

if(!$connection) {
	die("Database connection failed: " . mysql_error());
} //else { echo "got it"; }

// STEP 2. Select a database to use

$db_select = mysql_select_db(DB_NAME, $connection);
if(!$db_select) {
	die("Could not able to select the database: " . mysql_error());
} //else { echo "worked"; }


//CONNECTION USING PDO

// try {
// 	$connection = new PDO('mysql:host=localhost;dbname=Impact_Studios', 
// 		$config['DB_USERNAME'], $config['DB_PASSWORD']);
// 	//$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// } catch(PDOException $e) {
// 	echo 'ERROR: ' . $e->getMessage();
// }






?>

