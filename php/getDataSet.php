<?php
    $borderColor = array(
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
    );

    $backgroundColor = array(
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
    );

    

    $data = new stdClass();
    $data->labels = array();
    $data->datasets = array();
    $data->datasets[0] = new stdClass();
    $data->datasets[0]->backgroundColor = array();
    $data->datasets[0]->borderColor = array();
    $data->datasets[0]->data = array();
    $data->datasets[0]->borderWidth = 1;

    $dataType = $_POST['dataType'];
    $timeRange = $_POST['timeRange'];
    
    //database connection
    $connect = new mysqli("localhost","root","","rms_database");

    //check connection
    if($connect->connect_error){
        die("Connection error : $connect->connect_errno : $connect->connect_error");
    }

    switch($dataType){
        case "order":
            switch($timeRange){
                case "24hours":
                    $data->datasets[0]->label = "total order in last 24 hours";
                    $timeQuery = "AND o.date_time >= NOW() - INTERVAL 1 DAY";
                break;
                case "30days":
                    $data->datasets[0]->label = "total order in last 30 days";
                    $timeQuery = "AND o.date_time >= NOW() - INTERVAL 1 MONTH";
                break;
                case "12months":
                    $data->datasets[0]->label = "total order in last 12 months";
                    $timeQuery = "AND o.date_time >= NOW() - INTERVAL 1 YEAR";
                break;
                case "5years":
                    $data->datasets[0]->label = "total order in last 5 years";
                    $timeQuery = "AND o.date_time >= NOW() - INTERVAL 5 YEAR";
                break;
                case "norange":
                default:
                    $timeQuery = "";
            }
            $query = "SELECT m.menu_name as x,SUM(i.quantity) as y
                        FROM order_item i,menu m, orders o
                        WHERE i.menu_id = m.menu_id 
                        AND i.order_id = o.order_id
                        $timeQuery
                        GROUP BY m.menu_name
                        ORDER BY y DESC";
            break;  
        case "sales":
            switch($timeRange){
                case "24hours":
                    $data->datasets[0]->label = "total sales in each hours";
                    $query = "SELECT concat(date(o.date_time),' ',hour(o.date_time),':00:00') as x,CAST(SUM(p.total_price) AS DECIMAL(20,2)) as y
                                FROM orders o,payment p
                                WHERE o.payment_id = p.payment_id
                                AND o.date_time >= NOW() - INTERVAL 2 DAY
                                group by x
                                ORDER BY x";
                break;
                case "30days":
                    $data->datasets[0]->label = "total sales in each day";
                    $query = "SELECT date(o.date_time) as x,CAST(SUM(p.total_price) AS DECIMAL(20,2)) as y
                                FROM orders o,payment p
                                WHERE o.payment_id = p.payment_id
                                AND o.date_time >= NOW() - INTERVAL 1 MONTH
                                group by x
                                ORDER BY x";
                break;
                case "12months":
                    $data->datasets[0]->label = "total sales in each month";
                    $query = "SELECT concat(month(o.date_time),'-',year(o.date_time)) as x, CAST(SUM(p.total_price) AS DECIMAL(20,2)) as y
                                FROM orders o,payment p
                                WHERE o.payment_id = p.payment_id
                                AND o.date_time >= NOW() - INTERVAL 1 YEAR
                                group by month(o.date_time)
                                ORDER BY x";
                break;
                case "5years":
                    $data->datasets[0]->label = "total sales in each year";
                    $query = "SELECT year(o.date_time) as x, CAST(SUM(p.total_price) AS DECIMAL(20,2)) as y
                                FROM orders o,payment p
                                WHERE o.payment_id = p.payment_id
                                AND o.date_time >= NOW() - INTERVAL 5 YEAR
                                group by year(o.date_time)
                                ORDER BY x";
                break;
                case "norange":
                default:
                    $query = "";
            }
            break;
        default:
        $query = "";
        break;
    }
    if($statement = $connect->prepare($query)){
        $statement->execute();
        $result = $statement->get_result();
        $row_number = 0;
        while($row = $result->fetch_assoc()){
            $color_index = $row_number % 6;
            $data->datasets[0]->data[] = $row['y'];
            $data->labels[]=$row['x'];
            $data->datasets[0]->backgroundColor[] = $backgroundColor[$color_index];
            $data->datasets[0]->borderColor[] = $borderColor[$color_index];
            ++$row_number;
        }
        
        $statement->close();  
    }else{
        die("Failed to prepare SQL statement.".$connect->error);
    }
    
    echo json_encode($data);
    
    $connect->close(); 
?>

