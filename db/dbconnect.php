<?php

// set up connection parameters
$dbHost 		= 'db706618300.db.1and1.com';
$databaseName 	= 'db706618300';
$username 		= 'dbo706618300';
$password 		= 'Kelseym1002!';

// make the database connection
$db = new PDO("mysql:host=$dbHost;dbname=$databaseName;charset=utf8", "$username", "$password");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 	// enable error handling
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 			// turn off emulation mode

?>