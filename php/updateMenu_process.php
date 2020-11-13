<?php
    const MBSIZE = 8 * 1024 * 1024;

    //get post value from webpoge
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $fileLocation = "";
    $valid = true;

    //validation
    if(empty($name)){
        echo "<p>Name has not entered yet</p>";
        $valid = false;
    }

    if(empty($category)){
        echo "<p>Category has not selected yet</p>";
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

    if( $price < 0 ){
        echo"<p>Rice must not smaller than 0</p>";
        $valid = false;
    }

    //file upload
    if($valid && isset($_FILES['image'])){

        if(file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name'])){
            $destination = $_POST['destination'];
            $filetype = $_FILES['image']['type'];
            $filename = $_FILES['image']['name'];
            $filesize = $_FILES['image']['size'];
            $fileError = $_FILES['image']['error'];
            $fileTmp = $_FILES['image']['tmp_name'];

            $allowedExts = array("gif", "jpeg", "jpg", "png");
            $temp = explode(".", $filename);
            $extension = strtolower(end($temp));

            $fileLocation = $destination.$filename;

            if ((($filetype == "image/gif")
            || ($filetype == "image/jpeg")
            || ($filetype == "image/jpg")
            || ($filetype == "image/pjpeg")
            || ($filetype == "image/x-png")
            || ($filetype == "image/png"))
            && ($filesize < MBSIZE)
            && in_array($extension, $allowedExts)) {
                if ($fileError > 0) {
                    echo "Return Code: " . $fileError . "<br>";
                } else {
                    $location = $fileLocation;
                    $counter = 0;
                    while (file_exists($location)) {
                        $location = $fileLocation.$counter;
                        $counter += 1;
                    }
                    $fileLocation = $location;

                    move_uploaded_file($fileTmp,$fileLocation);
                }
            } else {
                echo $filetype."<br>".$filesize."<br>".MBSIZE;
                echo "Invalid file";
                $valid = false;
            }    
        }
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

        if(!empty($fileLocation)){
            if($statement = $connect->prepare("UPDATE menu SET menu_name = ?, category_id=?, menu_description = ?, menu_price = ?, menu_picture=? WHERE menu_id = ?")){
                $statement->bind_param("sisdsi",$name,$category,$description,$price,$fileLocation,$id);
                $statement->execute();

                echo "<p>The data had been modified successfully.</p><br>";
                echo "<button id=\"btnAgain\" class=\"btn btn-block btn-lg btn-outline-primary\">Return to Menu</button>";
                $statement->close();
            }else{
                die("Failed to prepare SQL statement.");
            }
        }else{
            if($statement = $connect->prepare("UPDATE menu SET menu_name = ?, category_id=?, menu_description = ?, menu_price = ? WHERE menu_id = ?")){
                $statement->bind_param("sisdi",$name,$category,$description,$price,$id);
                $statement->execute();

                echo "<p>The data had been modified successfully.</p><br>";
                echo "<button id=\"btnAgain\" class=\"btn btn-block btn-lg btn-outline-primary\">Return to Menu</button>";
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