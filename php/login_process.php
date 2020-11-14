<?php
    function passwordEncrypt(string $password):string{
        return hash("sha256",$password."Welcome To Restaurant Management Module");
    }

    //This page receive the data from login.html.
    //It will receive username and password.

    $username = $_POST['username'];
    $password = $_POST['password'];
    $valid = true;
    //validate whether username and password is empty
    
    if (empty($username))
    {
        echo "<h3><font color = 'red'>Your username is empty.</font></h3>";
        $valid = false;
    }

    if(empty($password))
    {
        echo "<h3><font color = 'red'>Your password is empty.</font></h3>";
        $valid = false;
    }

    if($valid)
    {
        $found = false;
        //perform static password salting and hash encryption
        $hashed = passwordEncrypt($password);

        //database connection
        $connect = new mysqli("localhost","root","","rms_database");

        //check connection
        if($connect->connect_error){
            die("Connection error : $connect->connect_errno : $connect->connect_error");
        }

        //use parameterized query to prevent sql injection
        //check customer table
        if($statement = $connect->prepare("SELECT username,password FROM customer WHERE username LIKE ? AND password LIKE ? LIMIT 1")){
            $statement->bind_param("ss",$username,$hashed);
            $statement->execute();
            $result = $statement->get_result();
            if($result->num_rows>0){
                $found = true;
                $position = "customer";
            }

            if(!$found){
                //check staff table
                $statement = $connect->prepare("SELECT s.username,s.password,p.* FROM staff s,position p WHERE username LIKE ? AND password LIKE ? AND s.position_id = p.position_id LIMIT 1");
                $statement->bind_param("ss",$username,$hashed);
                $statement->execute();
                $result = $statement->get_result();
                if($result->num_rows>0){
                    $row = $result->fetch_array();
                    $position = $row['position_name'];
                    $access = array("customerManagementModule"=>$row['access_customer_module'],
                                "staffManagementModule"=>$row['access_staff_module'],
                                "paymentModule"=>$row['access_payment_module'],
                                "stockManagementModule"=>$row['access_stock_module'],
                                "menuManagementModule"=>$row['access_menu_module'],
                                "pickUpModule"=>$row['access_pickup_module'],
                                "deliveryModule"=>$row['access_delivery_module'],
                                "analysisModule"=>$row['access_analysis_module'],
                                "orderManagementModule"=>$row['access_orderChecking_module']);
                    $found = true;
                }
            }

            //create session and store the values
            if($found){
                session_start();
                date_default_timezone_set("Asia/Kuala_Lumpur");
                $_SESSION['sess_username'] = $username;
                $_SESSION['sess_position'] = $position;
                if($position !== "customer"){
                    if(isset($access)){
                        $_SESSION['sess_permission'] = json_encode($access);
                    }
                }
                $_SESSION['sess_date'] = date("d-m-Y: h:m:sA");
                $_SESSION['sess_timestamp'] = time();
                
                echo "<p>Hi! $username, you had login successfully.</p><br>";
                echo "<p>Click the button below to return to homepage</p><br>";
                echo "<a href=\"../webpage/homepage.php\" class=\"btn btn-block btn-lg btn-outline-primary\">Return to Homepage</a>";
            }else{
                echo "<p>Failed to login! Click the button below to try again.</p><br>";
                echo "<button id=\"btnAgain\" class=\"btn btn-block btn-lg btn-outline-primary\">Try Again</button>";
            }
            $statement->close();
        }else{
            die("Failed to prepare SQL statement.");
        }
        $connect->close();
    }
?>