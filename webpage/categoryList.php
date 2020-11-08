<div class="h2 text-center">Category</div>
<table id="table" class="table table-hover">
<tbody>
<?php
    //database connection
    $connect = new mysqli("localhost","root","","rms_database");

    //check connection
    if($connect->connect_error){
        die("Connection error : $connect->connect_errno : $connect->connect_error");
    }

    if($statement = $connect->prepare("SELECT * FROM menu_category;")){
        $statement->execute();
        $result = $statement->get_result();

        while($row = $result->fetch_array()){
            printf( '<tr>
                    <td class="category_row" value="%d">%s</td>
                </tr>',
                $row['category_id'],
                $row['category_name']);
        }

        $statement->close();
    }else{
        die("Failed to prepare SQL statement.");
    }
    $connect->close();
?>
</tbody>
</table>