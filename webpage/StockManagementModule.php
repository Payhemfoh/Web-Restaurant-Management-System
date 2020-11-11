<!DOCTYPE html>
<html lang="en">
    <head>
        <title>RMS | Stock Management Module</title>
        <?php 
            require("../php/sessionFragment.php");
            require("../php/pageFragment.php");
            printHeadInclude();

            if(!isset($sess_username) || $sess_position == "customer" || $sess_permission->stockManagementModule !=="T"){
                header('Refresh: 0; URL=../webpage/homepage.php');
            }
        ?>
    </head>

    <body class="bg-light">
        <?php printHeader(basename(__FILE__)); ?>

        <br/>
        <div id="content" class="container-fluid bg-light rounded">
            <br>
            <div class="h2 text-center">Stock Management Module</div>
            <br>
            <button class="btn btn-block btn-primary btn_add">Add New Stock</button><br>
            <table id="table" class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        //database connection
                        $connect = new mysqli("localhost","root","","rms_database");

                        //check connection
                        if($connect->connect_error){
                            die("Connection error : $connect->connect_errno : $connect->connect_error");
                        }
                        
                        //use parameterized query to prevent sql injection
                        //insert data into stock table
                        $statement = $connect->prepare("SELECT * FROM stock");
                        $statement->execute();

                        $result = $statement->get_result();
                        while($row = $result->fetch_array()){
                            echo "<tr>
                                    <td>".$row['stock_name']."</td>
                                    <td>".$row['stock_description']."</td>
                                    <td>".$row['quantity']."</td>
                                    <td><button class=\"btn btn-primaryLight btn-primary btn_edit\" value=\"".$row['stock_id']."\">Edit</button></td>
                                    <td><button class=\"btn btn-primaryLight btn-primary btn_delete\" value=\"".$row['stock_id']."\">Delete</button></td>
                                </tr>";
                        }
                    ?>
                </tbody>
            </table>    
        </div>
        <br/>

        <?php printModal(); ?>
        <?php printFooter(); ?>
        <script type="module" src="../javascript/stockManagementModule_script.js"></script>
    </body>
</html>
