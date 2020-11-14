<?php
    //get post value from webpage
    $id = $_POST['id'];
    $position = $_POST['position'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $phoneNo = $_POST['phone'];
    $address =$_POST['address'];
    $valid = true;

    //<---------------------Start Validation--------------------->
    if(empty($id))
    {
        echo "<h3><font color = 'red'>Your id is empty.</font></h3>";
        $valid = false;
    }

    if(empty($position))
    {
        echo "<h3><font color = 'red'>Your position is empty.</font></h3>";
        $valid = false;
    }

    if(empty($fname))
    {
        echo "<h3><font color = 'red'>Your first name is empty.</font></h3>";
        $valid = false;
    }
    
    if(empty($lname))
    {
        echo "<h3><font color = 'red'>Your last name is empty.</font></h3>";
        $valid = false;
    }
    
    if(empty($gender))
    {
        echo "<h3><font color = 'red'>Your gender is not selected.</font></h3>";
        $valid = false;
    }

    if(empty($birthday))
    {
        echo "<h3><font color = 'red'>Your date of birth is empty.</font></h3>";
        $valid = false;
    }
    
    if (empty($phoneNo))
    {
        echo "<h3><font color = 'red'>Your phone number is empty.</font></h3>";
        $valid = false;
    }

    //advance checking
    
    if(!ctype_alpha($fname))
    {
        echo "<h3><font color = 'red'>Your first name all must be alphabet.</font></h3>";
        $valid = false;
    }
    
    if(!ctype_alpha($lname))
    {
        echo "<h3><font color = 'red'>Your last name all must be alphabet.</font></h3>";
        $valid = false;
    }
    
    if(!preg_match("/^[0-9]{3}-[0-9]{7}$/", $phoneNo))
    {
        echo "<h3><font color = 'red'>Your phone number is invalid.</h3></font>";
        $valid = false;
    }


    if($valid){
        //database connection
        $connect = new mysqli("localhost","root","","rms_database");

        //check connection
        if($connect->connect_error){
            die("Connection error : $connect->connect_errno : $connect->connect_error");
        }
        
        //use parameterized query to prevent sql injection
        //insert data into stock table
        if($position === 'customer'){
            if($statement = $connect->prepare("UPDATE customer SET 
                                            first_name = ?,
                                            last_name = ?,
                                            gender = ?,
                                            date_of_birth = ?,
                                            phone_number = ?,
                                            address = ?
                                            
                                            WHERE customer_id = ?")){
            
                $statement->bind_param("ssssssd",
                                        $fname,
                                        $lname,
                                        $gender,
                                        $birthday,
                                        $phoneNo,
                                        $address,
                                        $id);

                $statement->execute();

                echo "<p>The data had been modified successfully.</p><br>";
                echo "<button id=\"btnAgain\" class=\"btn btn-block btn-lg btn-outline-primary\">Refresh</button>";
                
                $statement->close();
            }else{
                die("Failed to prepare SQL statement.");
            }
        }else{
            if($statement = $connect->prepare("UPDATE staff SET 
                                            first_name = ?,
                                            last_name = ?,
                                            gender = ?,
                                            date_of_birth = ?,
                                            phone_number = ?,
                                            address = ?
                                            
                                            WHERE staff_id = ?")){
            
                $statement->bind_param("ssssssd",
                                        $fname,
                                        $lname,
                                        $gender,
                                        $birthday,
                                        $phoneNo,
                                        $address,
                                        $id);

                $statement->execute();

                echo "<p>The data had been modified successfully.</p><br>";
                echo "<button id=\"btnAgain\" class=\"btn btn-block btn-lg btn-outline-primary\">Refresh</button>";
                
                $statement->close();
            }else{
                die("Failed to prepare SQL statement.");
            }
        }
        
        $connect->close();
    }else{
        echo "<p>Failed to modify data! Click the button below to try again.</p><br>";
        echo "<button id=\"btnAgain\" class=\"btn btn-block btn-lg btn-outline-primary\">Try Again</button>";
    }
?>