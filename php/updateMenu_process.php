<?php
    $name = $_POST['name'];
    $ingredients = $_POST['ingredients'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $newImg = $_POST['newImg'];
    $valid = true;
    
    if(empty($name)){
        echo "<p>Name has not entered yet</p>";
        $valid = false;
    }

    if(empty($ingredients)){
        echo "<p>Ingredients has not entered yet</p>";
        $valid = false;
    }

    if(empty($price)){
        echo "<p>Price has not entered yet</p>";
        $valid = false;
    }

    if(empty($description)){
        echo "<p>Description has not entered yet</p>";
        $valid = false;
    }

    if(empty($newImg)){
        echo "<p>New Image has not upload yet</p>";
        $valid = false;
    }

    if( $price < 0 ){
        echo"<p>Rice must not smaller than 0</p>";
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
        if($statement = $connect->prepare("UPDATE menu SET menu_name = ?, category_id=?, menu_description = ?, menu_price = ?, menu_picture=? WHERE menu_id = ?")){
            $statement->bind_param("ssdi",$name,$category,$description,$price,$picture,$id);
            $statement->execute();

            echo "<p>The data had been modified successfully.</p><br>";
            echo "<button id=\"btnAgain\" class=\"btn btn-block btn-lg btn-outline-primary\">Return to Menu</button>";
            $statement->close();
        }else{
            die("Failed to prepare SQL statement.");
        }
        $connect->close();
    }else{
        echo "<p>Failed to modify data! Click the button below to try again.</p><br>";
        echo "<button id=\"btnAgain\" class=\"btn btn-block btn-lg btn-outline-primary\">Try Again</button>";
    }
?>