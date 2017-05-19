<?php 
if(isset($_POST['message'])){
		// Write the file to disk
		file_put_contents("db.txt", $_POST['message']);
		// echo file_get_contents($filename);
	}

?>