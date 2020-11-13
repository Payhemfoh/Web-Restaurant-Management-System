<?php
    const borderColor = 'rgba(54, 162, 235, 1)';
    const backgroundColor = 'rgba(54, 162, 235, 0.2)';

    $data = new stdClass();
    $data->label = array();
    $data->dataset = array();
    $data->dataset[0] = new stdClass();
    $data->dataset[0]->backgroundColor = array();
    $data->dataset[0]->borderColor = array();
    $data->dataset[0]->data = array();
    $data->dataset[0]->label = "total order";
    $data->dataset[0]->borderWidth = 1;
    
    //database connection
    $connect = new mysqli("localhost","root","","rms_database");

    //check connection
    if($connect->connect_error){
        die("Connection error : $connect->connect_errno : $connect->connect_error");
    }

    if($statement = $connect->prepare("SELECT DISTINCT(menu_id) as x,SUM(quantity) as y 
                                        FROM order_item")){
        $statement->execute();
        $result = $statement->get_result();
        while($row = $result->fetch_assoc()){
            $data->dataset[0]->data[] = $row;
            $data->label[]=$row['x'];
            $data->dataset[0]->backgroundColor[] = backgroundColor;
            $data->dataset[0]->borderColor[] = borderColor;
        }
        
        $statement->close();
    }else{
        die("Failed to prepare SQL statement.".$connect->error);
    }
    
    echo json_encode($data);

    $connect->close(); 
?>

