<!DOCTYPE html>
<html lang="en">
    <?php
        session_start();

        if($_SESSION['sess_position'] == "customer" || $_SESSION['sess_position'] == NULL){
            header('Refresh: 0; URL=../webpage/homepage.php');
        }
    ?>
    <head>
        <title>RMS | Customer Management Module</title>
        <?php 
            require("../php/pageFragment.php");
            printHeadInclude();
        ?>
    </head>

    <body class="bg-light">
        <?php
            printHeader(basename(__FILE__));
        ?>
        <br/>
        <div id="content" class="container-fluid py-5 bg-light rounded">
            <div class="h2 text-center">Customer Management Module</div>
            <br><br>
            <button class="btn btn-block btn-primary btn_add">Add New Customer</button><br>
            <table id="table" class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Birthday</th>
                        <th scope="col">Phone No</th>
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

                        if($statement = $connect->prepare("SELECT * FROM customer;")){
                            $statement->execute();
                            $result = $statement->get_result();

                            while($row = $result->fetch_array()){
                                printf( '<tr>
                                        <td>%s</td>
                                        <td>%s</td>
                                        <td>%s</td>
                                        <td>%s</td>
                                        <td>%s</td>
                                        <td>%s</td>
                                        <td>%s</td>
                                        <td>%s</td>
                                        <td><button class="btn btn-primaryLight btn-primary btn_edit" value="%d">Edit</button></td>
                                        <td><button class="btn btn-primaryLight btn-primary btn_delete" value="%d">Delete</button></td>
                                    </tr>',
                                    $row['username'],
                                    $row['email'],
                                    $row['first_name'],
                                    $row['last_name'],
                                    $row['address'],
                                    $row['gender'],
                                    $row['date_of_birth'],
                                    $row['phone_number'],
                                    $row['customer_id'],
                                    $row['customer_id']);
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

        <script type="module" src="../javascript/customerManagementModule_script.js"></script>
    </body>
</html>
