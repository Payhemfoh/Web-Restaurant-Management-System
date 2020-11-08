<?php
	if(!isset($_SESSION))
		session_start();
	
	
	if(!empty($_SESSION['sess_username'])){
		$sess_username = $_SESSION['sess_username'];
		$sess_date = $_SESSION['sess_date'];
		$sess_position = $_SESSION['sess_position'];
		
		if(!empty($_SESSION['sess_timestamp'])){
			//user login will stand 2 hour long
			if(time() - $_SESSION['sess_timestamp'] > 7200){
				echo "<script>alert(\"You had been Log out! Please Login again in login page!\")</script>";
				unset($_SESSION);
				unset($sess_username);
			}
			$_SESSION['sess_timestamp'] = time();
		}
    }
?>