<?php
    //database connection
    $connect = new mysqli("localhost","root","","rms_database");

    //check connection
    if($connect->connect_error){
        die("Connection error : $connect->connect_errno : $connect->connect_error");
    }

    if($statement = $connect->prepare("SELECT * 
                                        FROM menu m,order_item i,orders o 
                                        WHERE order_status LIKE 'preparing' 
                                        AND i.menu_id = m.menu_id
                                        AND i.order_id = o.order_id;")){
        $statement->execute();
        $result = $statement->get_result();

        while($row = $result->fetch_array()){
            echo "<tr>
                <td scope=\"row\"><img src=\"".$row['menu_picture']."\" class=\"img-thumbnail\" width=\"300\" height=\"200\"></td>
                <td>".$row['menu_name']."</td>
                <td>".$item->qty."</td>
                <td><button class=\"btn btn-info btn-detail\" value=\"".$row['menu_id']."\">Details</button></td>
            </tr>";
        }

        $statement->close();
    }else{
        die("Failed to prepare SQL statement.");
    }
?>