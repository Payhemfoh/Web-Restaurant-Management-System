<?php
    session_start();
	if(!empty($_SESSION['username'])){
		$sess_username = $_SESSION['username'];
		$sess_date = $_SESSION['date'];
		
		if(!empty($_SESSION['timestamp'])){
			//user login will stand 2 hour long
			if(time() - $_SESSION['timestamp'] > 7200){
				echo "<script>alert(\"You had been Log out! Please Login again in login page!\")</script>";
                session_unset();
				unset($sess_username);
			}
			$_SESSION['timestamp'] = time();
		}
    }
    session_destroy();
?>