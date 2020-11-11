<?php
    const MBSIZE = 8 * 1024 * 1024;

    //get post value from webpoge
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
    if($valid){

        $destination = $_POST['destination'];
        
        if(file_exists($FILES['image']['tmp_name']) ||is_uploaded_file($_FILES['image']['tmp_name'])){
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
                    if (file_exists($fileLocation)) {
                        echo $filename . " already exists. ";
                    } else {
                        move_uploaded_file($fileTmp,$fileLocation);
                        echo "Stored in: $fileLocation";
                    }
                }
            } else {
                echo "Invalid file";
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

        if($statement = $connect->prepare("INSERT INTO menu(menu_id,menu_name,category_id,menu_description,menu_price,menu_picture)".
                                            " VALUES (0,?,?,?,?,?);")){
            $statement->bind_param("sisds",$name,$category,$description,$price,$fileLocation);
            $statement->execute();

            $statement->close();
        }else{
            die("Failed to prepare SQL statement.");
        }
        $connect->close();
    }
?>