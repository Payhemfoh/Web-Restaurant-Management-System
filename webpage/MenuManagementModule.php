<!DOCTYPE html>
<html lang="en">
    
    <head>
        <title>RMS | Menu Management Module</title>
        <?php 
            require("../php/sessionFragment.php");
            require("../php/pageFragment.php");
            printHeadInclude();

            if(!isset($sess_username) || $sess_position === "customer" || $sess_permission->menuManagementModule !== "T"){
                header('Refresh: 0; URL=../webpage/homepage.php');
            }
        ?>
    </head>

    <body class="bg-light">
        <?php
            printHeader(basename(__FILE__));
        ?>
        <br/>
        <div id="content" class="container-fluid py-5 bg-light rounded">
            <div class="h2 text-center">Menu Management Module</div>
            <br><br>
            <button class="btn btn-block btn-primary btn_add">Add New Menu</button><br>
            <table id="table" class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Category</th>
                        <th scope="col">Price</th>
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

                        if($statement = $connect->prepare("SELECT * FROM menu m,menu_category c WHERE m.category_id = c.category_id;")){
                            $statement->execute();
                            $result = $statement->get_result();

                            while($row = $result->fetch_array()){
                                printf( '<tr>
                                        <td scope="row"><img src="%s" class="img-thumbnail" width="300" height="200"></td>
                                        <td>%s</td>
                                        <td>%s</td>
                                        <td>%s</td>
                                        <td>RM%.2f</td>
                                        <td><button class="btn btn-primaryLight btn-primary btn_edit" value="%d">Edit</button></td>
                                        <td><button class="btn btn-primaryLight btn-primary btn_delete" value="%d">Delete</button></td>
                                    </tr>',
                                    $row['menu_picture'],
                                    $row['menu_name'],
                                    $row['menu_description'],
                                    $row['category_name'],
                                    $row['menu_price'],
                                    $row['menu_id'],
                                    $row['menu_id']);
                            }

                            $statement->close();
                        }else{
                            die("Failed to prepare SQL statement.");
                        }
                        $connect->close();
                    ?>
                </tbody>
            </table>
        </div>
        <br/>

        <?php printModal(); ?>
        <?php printFooter(); ?>

        <script type="module" src="../javascript/menuManagementModule_script.js"></script>
    </body>
</html>
