<?php
    const borderColor = 'rgba(54, 162, 235, 1)';
    const backgroundColor = 'rgba(54, 162, 235, 0.2)';

    $data = new stdClass();
    $data->labels = array();
    $data->datasets = array();
    $data->datasets[0] = new stdClass();
    $data->datasets[0]->backgroundColor = array();
    $data->datasets[0]->borderColor = array();
    $data->datasets[0]->data = array();
    $data->datasets[0]->label = "total order";
    $data->datasets[0]->borderWidth = 1;
    
    //database connection
    $connect = new mysqli("localhost","root","","rms_database");

    //check connection
    if($connect->connect_error){
        die("Connection error : $connect->connect_errno : $connect->connect_error");
    }

    if($statement = $connect->prepare("SELECT m.menu_name as x,SUM(quantity) as y 
                                        FROM order_item o, menu m 
                                        WHERE o.menu_id = m.menu_id
                                        GROUP BY m.menu_name
                                        ORDER BY y
                                        LIMIT 10")){
        $statement->execute();
        $result = $statement->get_result();
        while($row = $result->fetch_assoc()){
            $data->datasets[0]->data[] = $row['y'];
            $data->labels[]=$row['x'];
            $data->datasets[0]->backgroundColor[] = backgroundColor;
            $data->datasets[0]->borderColor[] = borderColor;
        }
        
        $statement->close();
    }else{
        die("Failed to prepare SQL statement.".$connect->error);
    }
    
    echo json_encode($data);

    $connect->close(); 
?>

