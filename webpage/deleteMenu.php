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
                        <table class='table'>
                            <thead class='thead-light'>
                                <tr>
                                    <th><font size='6'>Image</font></th>					
                                    <th><font size='6'>Information</font></th>
                                </tr>	
                            </thead>
                            <tbody>
                                <tr>				
                                    <td>
                                        <div class='form-group'>
                                            <p>Current Picture:</p>
                                            <img src='".$row['menu_picture']."' class='img-thumbnail'><br><br>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='form-group'>
                                            <label for='name'>Name:</label>
                                            <input type='text' readonly class='form-control' name='name' value='".$row['menu_name']."'>
                                        </div>

                                        <div class='form-group'>
                                            <label for='name'>Ingredients:</label>
                                            <textarea readonly class='form-control' 
                                            name='ingredients'>Chicken,Rice,Cucumber,Soy Sauce,Cooking Oil, Chili Sauce</textarea>
                                        </div>

                                        <div class='form-group'>
                                            <label for='price'>Price(RM):</label>
                                            <input type='number' readonly step='0.01' class='form-control' name='price' value='".$row['menu_price']."'>
                                        </div>
                                        
                                        <div class='form-group'>
                                            <label for='description'>Description:</label>
                                            <textarea readonly class='form-control' name='description'>".$row['menu_description']."</textarea>
                                        </div>						
                                    </td>
                                </tr>
                            </tbody>        
                        </table>	
                        		
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