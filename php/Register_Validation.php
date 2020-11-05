<?php

    //This page receive the data from register.html.
    //It will receive first name, last name, gender, DOB, phone number, email, username, password, confirm password.

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_Password = $_POST['confirm_Password'];


    //<---------------------Start Validation--------------------->

    if(empty($fname) || empty($lname) || empty($gender)  || empty($birthday) || empty($phone) || empty($email) || empty($username) || empty($password)|| empty($confirm_Password))
	{
            if(empty($fname))
		    {
			   echo "<h3><font color = 'red'>Your first name is empty.</font></h3>";
			}
			
			if(empty($lname)
			{
			   echo "<h3><font color = 'red'>Your last name is empty.</font></h3>";
            }
            
            if(empty($gender))
            {
                echo "<h3><font color = 'red'>Your gender is not selected.</font></h3>";
            }

            if(empty($birthday))
			{
			   echo "<h3><font color = 'red'>Your date of birth is empty.</font></h3>";
			}
			
			if (empty($phone))
			{
			   echo "<h3><font color = 'red'>Your phone number is empty.</font></h3>";
			}
			
			if (empty($email))
			{
			   echo "<h3><font color = 'red'>Your email is empty.</font></h3>";
            }
            
            if (empty($username))
		    {
			   echo "<h3><font color = 'red'>Your username is empty.</font></h3>";
            }
            
            if (empty($password))
		    {
			   echo "<h3><font color = 'red'>Your password is empty.</font></h3>";
            }
            
            if (empty($confirm_Password))
		    {
			   echo "<h3><font color = 'red'>Your confirm password is empty. This field is required.</font></h3>";
            }
    }
    else
    {
        $boolean = true;
        
            if(!ctype_alpha($fname))
		    {
		        echo "<h3><font color = 'red'>Your first name all must be alphabet.</font></h3>";
				$boolean = false;
            }
            
			if(!ctype_alpha($lname))
			{
				echo "<h3><font color = 'red'>Your last name all must be alphabet.</font></h3>";
				$boolean = false;
            }
            
			if(!ctype_digit($phone))
		    {
				echo "<h3><font color = 'red'>Your phone number all must be in digits.</font></h3>";
                $boolean = false;

                if(!preg_match("/^[0-9]{3}-[0-9]{7}$/", $phone))
                {
                    echo "<h3><font color = 'red'>Your phone number is invalid.</h3></font>";
                    $boolean = false;
                }
            }

            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                echo "<h3><font color = 'red'>Invalid email format.</h3></font>";
                $boolean = false;
            }

            if($boolean)
			{	
				echo "<h3>Congratulations, $fname $lname, your registration is successful!</h3>";   
			}
    }
