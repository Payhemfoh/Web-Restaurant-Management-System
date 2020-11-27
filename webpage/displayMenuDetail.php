<?php
    //get id from webpage
    $id = $_POST['id'];

    //database connection
    $connect = new mysqli("localhost","root","","rms_database");
    
    //check connection
    if($connect->connect_error){
        die("Connection error : $connect->connect_errno : $connect->connect_error");
    }

    if($statement = $connect->prepare("SELECT * FROM menu WHERE menu_id=? LIMIT 1")){
        $statement->bind_param("i",$id);
        $statement->execute();

        $result = $statement->get_result();

        while($row = $result->fetch_array()){
            echo "
                    <form>
                        <div class='form-group'>
                            <p>Picture:</p>
                            <div class='text-center'>
                                <img src='".$row['menu_picture']."' class='img-thumbnail' width=\"300\" height=\"200\"><br><br>
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for='name'>Name:</label>
                            <input type='text' readonly class='form-control' name='name' value='".$row['menu_name']."'>
                        </div>

                        <div class='form-group'>
                            <label for='price'>Price(RM):</label>
                            <input type='number' readonly step='0.01' class='form-control' name='price' value='".$row['menu_price']."'>
                        </div>
                        
                        <div class='form-group'>
                            <label for='description'>Description:</label>
                            <textarea readonly class='form-control' name='description'>".$row['menu_description']."</textarea>
                        </div>	
                        
                        <div class='form-group'>
                            <label for='quantity'>Quantity:</label>
                            <div class='input-group'>
                                <div class='input-group-prepend'>
                                    <button id='btnLess' class='btn btn-count btn-outline-primary'>&lt;</button>
                                </div>
                                <input type='number' id='orderQty' class='numberInput form-control col-md-2 text-center' name='quantity' value = '".
                                (isset($_POST['qty'])? $_POST['qty']: 1)."' readonly>
                                <div class='input-group-postpend'>
                                    <button id='btnMore' class='btn btn-count btn-outline-primary'>&gt;</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <script src='../javascript/orderControl.js'></script>
                    ";
        }
        $statement->close();
    }else{
        die("Failed to prepare SQL statement.");
    }

    $connect->close();

?>