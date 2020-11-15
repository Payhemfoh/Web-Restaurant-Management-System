<?php
    //get id from webpage
    $id = $_POST['id'];

    //database connection
    $connect = new mysqli("localhost","root","","rms_database");
    
    //check connection
    if($connect->connect_error){
        die("Connection error : $connect->connect_errno : $connect->connect_error");
    }

    if($statement = $connect->prepare("SELECT * FROM menu WHERE menu_id = ? LIMIT 1")){
        $statement->bind_param("i",$id);
        $statement->execute();

        $result = $statement->get_result();

        while($row = $result->fetch_array()){
            echo "
                    <form>
                        <div class='form-group'>
                            <p>Current Picture:</p>
                            <img src='".$row['menu_picture']."' class='img-thumbnail'><br><br>
                        </div>
                        <div class='form-group'>
                            <label for='name'>Name:</label>
                            <input type='text' readonly class='form-control' name='name' value='".$row['menu_name']."'>
                        </div>

                        <div class='form-group'>
                <label for='category'>Category:</label>
                <select id='category_input' class='form-control' name='category'>";
            

                if($statement2 = $connect->prepare("SELECT * FROM menu_category")){
                    $statement2->execute();
                    $result2 = $statement2->get_result();

                    while($row2 = $result2->fetch_array()){
                        if($row2['category_id'] === $row['category_id']){
                            echo '<option value='.$row2['category_id'].' selected>'.$row2['category_name'].'</option>';
                        }
                    }

                    $statement2->close();
                }else{
                    die("Failed to prepare SQL statement.");
                }

                echo    "</select>
                        </div>
                        
                        <div class='form-group'>
                            <label for='price'>Price(RM):</label>
                            <input type='number' readonly step='0.01' class='form-control' name='price' value='".$row['menu_price']."'>
                        </div>
                        
                        <div class='form-group'>
                            <label for='description'>Description:</label>
                            <textarea readonly class='form-control' name='description'>".$row['menu_description']."</textarea>
                        </div>	
                        		
                        <button id='modal-submit' class='btn btn-block btn-primaryLight btn-primary' value='".$row['menu_id']."'>Delete</button>
                        <button id='modal-cancel' class='btn btn-block btn-primaryLight btn-primary'>Cancel</button>
                    </form>
                    ";
        }
        $statement->close();
    }else{
        die("Failed to prepare SQL statement.");
    }

    $connect->close();

?>