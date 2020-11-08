<?php
    //get post value from webpage
    $id = $_POST['id'];

    //validate
    if(!empty($id)){
        //database connection
        $connect = new mysqli("localhost","root","","rms_database");

        //check connection
        if($connect->connect_error){
            die("Connection error : $connect->connect_errno : $connect->connect_error");
        }

        //use parameterized query to prevent sql injection
        //delete data from stock table
        if($statement = $connect->prepare("DELETE FROM menu WHERE menu_id=?")){
            $statement->bind_param("i",$id);
            $statement->execute();

            if($statement->get_result()){
                echo "<p>The data had been removed from database.</p><br>";
                echo "<button id=\"btnAgain\" class=\"btn btn-block btn-lg btn-outline-primary\">Return to Menu</button>";
            }else{
                echo "<p>Failed to delete data!</p><br>";
                echo "<button id=\"btnAgain\" class=\"btn btn-block btn-lg btn-outline-primary\">Return to Menu</button>";
            }
            $statement->close();
        }else{
            die("Failed to prepare SQL statement.");
        }
        $connect->close();
    }else{
        echo "<p>Failed to delete data! Click the button below to try again.</p><br>";
        echo "<button id=\"btnAgain\" class=\"btn btn-block btn-lg btn-outline-primary\">Try Again</button>";
    }
?>