<?php
    //get id from webpage
    $id = $_POST['id'];

    //database connection
    $connect = new mysqli("localhost","root","","rms_database");
    
    //check connection
    if($connect->connect_error){
        die("Connection error : $connect->connect_errno : $connect->connect_error");
    }

    if($statement = $connect->prepare("SELECT * FROM stock WHERE stock_id=? LIMIT 1")){
        $statement->bind_param("i",$id);
        $statement->execute();

        $result = $statement->get_result();

        while($row = $result->fetch_array()){
            echo "<form>					
                <center><font size='6'>Delete Stock Data</font></center>

                <div class='form-group'>
                    <label for='name'>Name:</label>
                    <input type='text' readonly class='form-control' name='name' value='".$row['stock_name']."'>
                </div>

                <div class='form-group'>
                    <label for='quantity'>Quantity:</label>
                    <input type='number' readonly class='form-control' name='quantity' value='".$row['quantity']."'>
                </div>
                
                <div class='form-group'>
                    <label for='description'>Description:</label>
                    <textarea readonly class='form-control' name='description'>".$row['stock_description']."</textarea>
                </div>

                <button id='modal-submit' class='btn btn-block btn-primaryLight btn-primary'>Delete Data</button>
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