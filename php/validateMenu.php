<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
    </head>

    <body>
        <?php>
            $name = $_POST['name'];
            $ingredients = $_POST['ingredients'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $newImg = $_POST['newImg'];

            if(isempty($name) || isempty($ingredients) || isempty($price) || isempty($description) || isempty($newImg)){
                
                if(isempty($name)){
                    echo "<p>Name has not entered yet</p>";
                }

                if(isempty($ingredients)){
                    echo "<p>Ingredients has not entered yet</p>";
                }

                if(isempty($price)){
                    echo "<p>Price has not entered yet</p>";
                }

                if(isempty($description)){
                    echo "<p>Description has not entered yet</p>";
                }

                if(isempty($newImg)){
                    echo "<p>New Image has not upload yet</p>";
                }
            }
            else if( $price < 0 ){
                echo"<p>Rice must not smaller than 0</p>";
            }
            else{
                echo "<p>New menu have been updated into database";
            }
        ?>
    </body>
</html>