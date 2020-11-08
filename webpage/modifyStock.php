<?php
    //get id from webpage
    $id = $_POST['id'];

    //database connection
    $connect = new mysqli("localhost","root","","rms_database");
    
    if($connect->connect_error){
        die("Connection error : $connect->connect_errno : $connect->connect_error");
    }

    if($statement = $connect->prepare("SELECT * FROM stock WHERE stock_id=? LIMIT 1")){
        $statement->bind_param("i",$id);
        $statement->execute();

        $result = $statement->get_result();

        while($row = $result->fetch_array()){
            echo "<form>
                    <font size='6'>Edit Stock Data</font>
                    <div class='form-group'>
                        <label for='name'>Name:</label>
                        <input type='text' id='name_input' class='form-control' name='name' value='".$row['stock_name']."'>
                        <div id='name-feedback'></div>
                    </div>
                
                    <div class='form-group'>
                        <label for='quantity'>Quantity:</label>
                        <input type='number' id='quantity_input' class='form-control' name='quantity' value='".$row['quantity']."'>
                        <div id='quantity-feedback'></div>
                    </div>
                    
                    <div class='form-group'>
                        <label for='description'>Description:</label>
                        <textarea class='form-control' id='description_input' name='description'>".$row['stock_description']."</textarea>
                        <div id='description-feedback'></div>
                    </div>
                
                    <button id='modal-submit' class='btn btn-block btn-primaryLight btn-primary'>Modify</button>
                    <button id='modal-cancel' class='btn btn-block btn-primaryLight btn-primary'>Cancel</button>			
                </form>
            ";
        }
    }else{
        die("Failed to prepare SQL statement.");
    }

    $statement->close();
    $connect->close();
?>