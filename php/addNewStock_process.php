<?php
    //get post value from webpage
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];
    $valid = true;

    //validation
    if (empty($name))
    {
        echo "<h3><font color = 'red'>name is empty.</font></h3>";
        $valid = false;
    }

    if (empty($quantity))
    {
        echo "<h3><font color = 'red'>quantity is empty.</font></h3>";
        $valid = false;
    }

    if (empty($description))
    {
        echo "<h3><font color = 'red'>description is empty.</font></h3>";
        $valid = false;
    }

    if ($quantity < 0)
    {
        echo "<h3><font color = 'red'>quantity should not be less than 0.</font></h3>";
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
        if($statement = $connect->prepare("INSERT INTO stock VALUES(0,?,?,?);")){
            $statement->bind_param("ssd",$name,$description,$quantity);
            $statement->execute();

            echo "<p>The data had been added into database.</p><br>";
            echo "<button id=\"btnAgain\" class=\"btn btn-block btn-lg btn-outline-primary\">Return to Menu</button>";
            $statement->close();
        }else{
            die("Failed to prepare SQL statement.");
        }
        $connect->close();
    }else{
        echo "<p>Failed to insert data! Click the button below to try again.</p><br>";
        echo "<button id=\"btnAgain\" class=\"btn btn-block btn-lg btn-outline-primary\">Try Again</button>";
    }
?>