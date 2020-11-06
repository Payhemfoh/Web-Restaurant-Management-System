<!DOCTYPE html>
<html lang="en">
    <head>
        <title>RMS | Stock Management Module</title>
        <?php 
            require("../php/pageFragment.php");
            printHeadInclude();
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

                    <tr>
                        <td>Egg</td>
                        <td>fresh egg</td>
                        <td>100</td>
                        <td><button class="btn btn-primaryLight btn-primary btn_edit" value="1">Edit</button></td>
                        <td><button class="btn btn-primaryLight btn-primary btn_delete" value="1">Delete</button></td>
                    </tr>

                    <tr>
                        <td>Onion</td>
                        <td>purple onion</td>
                        <td>200</td>
                        <td><button class="btn btn-primaryLight btn-primary btn_edit" value="1">Edit</button></td>
                        <td><button class="btn btn-primaryLight btn-primary btn_delete" value="1">Delete</button></td>
                    </tr>

                    <tr>
                        <td>Ginger</td>
                        <td>big ginger</td>
                        <td>20</td>
                        <td><button class="btn btn-primaryLight btn-primary btn_edit" value="1">Edit</button></td>
                        <td><button class="btn btn-primaryLight btn-primary btn_delete" value="1">Delete</button></td>
                    </tr>

                    <tr>
                        <td>Rice</td>
                        <td>10kg package of the rice</td>
                        <td>20</td>
                        <td><button class="btn btn-primaryLight btn-primary btn_edit" value="1">Edit</button></td>
                        <td><button class="btn btn-primaryLight btn-primary btn_delete" value="1">Delete</button></td>
                    </tr>

                    <tr>
                        <td>Cooking Oil</td>
                        <td>2 Litre of cooking oil</td>
                        <td>10</td>
                        <td><button class="btn btn-primaryLight btn-primary btn_edit" value="1">Edit</button></td>
                        <td><button class="btn btn-primaryLight btn-primary btn_delete" value="1">Delete</button></td>
                    </tr>

                    <tr>
                        <td>Soy Sauce</td>
                        <td>200ml package of soy sauce</td>
                        <td>30</td>
                        <td><button class="btn btn-primaryLight btn-primary btn_edit" value="1">Edit</button></td>
                        <td><button class="btn btn-primaryLight btn-primary btn_delete" value="1">Delete</button></td>
                    </tr>

                    <tr>
                        <td>Chicken</td>
                        <td>the whole chicken</td>
                        <td>80</td>
                        <td><button class="btn btn-primaryLight btn-primary btn_edit" value="1">Edit</button></td>
                        <td><button class="btn btn-primaryLight btn-primary btn_delete" value="1">Delete</button></td>
                    </tr>

                    <tr>
                        <td>Tomato</td>
                        <td>big tomato</td>
                        <td>20</td>
                        <td><button class="btn btn-primaryLight btn-primary btn_edit" value="1">Edit</button></td>
                        <td><button class="btn btn-primaryLight btn-primary btn_delete" value="1">Delete</button></td>
                    </tr>

                    <tr>
                        <td>Potato</td>
                        <td>fresh potato</td>
                        <td>50</td>
                        <td><button class="btn btn-primaryLight btn-primary btn_edit" value="1">Edit</button></td>
                        <td><button class="btn btn-primaryLight btn-primary btn_delete" value="1">Delete</button></td>
                    </tr>
                </tbody>
            </table>    
        </div>
        <br/>

        <?php printModal(); ?>
        <?php printFooter(); ?>
        <script type="module" src="../javascript/stockManagementModule_script.js"></script>
    </body>
</html>