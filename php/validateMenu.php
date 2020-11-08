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
        echo "<p>New menu have been updated into database";
    }
?>