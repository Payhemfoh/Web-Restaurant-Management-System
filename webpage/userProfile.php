<!DOCTYPE html>
<html lang="en">
    <head>
        <title>RMS | User Profile</title>
        <?php 
            require("../php/sessionFragment.php");
            require("../php/pageFragment.php");
            printHeadInclude();
        ?>
    </head>

    <body class="bg-light">
        <?php printHeader(basename(__FILE__));?>

        <br/>
        <div id="content" class="container bg-light col-md-9 rounded">
            <form>
                <?php
                    $id = 0;
                    $fname = "";
                    $lname = "";
                    $position="";
                    $address = "";
                    $gender = "";
                    $birthday = "";
                    $phoneNo = "";

                    //database connection
                    $connect = new mysqli("localhost","root","","rms_database");

                    //check connection
                    if($connect->connect_error){
                        die("Connection error : $connect->connect_errno : $connect->connect_error");
                    }

                    if($sess_position === "customer"){
                        if($statement = $connect->prepare("SELECT * FROM customer WHERE username=? LIMIT 1")){
                            $statement->bind_param("s",$sess_username);
                            $statement->execute();
                            $result = $statement->get_result();
                            if($row = $result->fetch_assoc()){
                                $id = $row['customer_id'];
                                $fname = $row['first_name'];
                                $lname = $row['last_name'];
                                $address = $row['address'];
                                $gender = $row['gender'];
                                $birthday = $row['date_of_birth'];
                                $phoneNo = $row['phone_number'];
                            }

                        }else{
                            die("Failed to prepare SQL statement.".$connect->error);
                        }
                    }else{
                        if($statement = $connect->prepare("SELECT s.*,p.position_name FROM staff s, position p WHERE username=? LIMIT 1")){
                            $statement->bind_param("s",$sess_username);
                            $statement->execute();
                            $result = $statement->get_result();
                            if($row = $result->fetch_assoc()){
                                $id = $row['staff_id'];
                                $fname = $row['first_name'];
                                $lname = $row['last_name'];
                                $address = $row['address'];
                                $gender = $row['gender'];
                                $birthday = $row['date_of_birth'];
                                $phoneNo = $row['phone_number'];
                                $position = $row['position_name'];
                            }
                        }else{
                            die("Failed to prepare SQL statement.".$connect->error);
                        }
                    }
                    
                ?>
                <br><h3 class="text-center">User Profile</h3><br>
                echo "<a href=\"../webpage/userOrderHistory.php\" class='btn btn-block btn-primaryLight btn-primary'>Order History</a><br>";
                echo "<hr>";
                
                <?php
                echo "
                <div class='row'>
                    <div class='form-group col'>
                        <label for = 'fname'><b>First Name:</b></label>
                        <input type = 'text' id = 'fname' name = 'fname' class='form-control' value='$fname'>
                        <div id='fname-feedback'></div>
                    </div>

                    <div class='form-group col'>
                        <label for = 'lname'><b>Last Name:</b></label>
                        <input type = 'text' id = 'lname' name = 'lname' class='form-control' value='$lname'>
                        <div id='lname-feedback'></div>
                    </div>
                </div>";

                    
                if ($sess_position !== 'customer')
                {
                    echo "<div class='form-group'>";
                    echo "<label for = 'position_id'><b>Position:</b></label>";
                    echo "<input type = 'text' id = 'position' name = 'position' readonly class='form-control' value='$position'>";
                    echo "<div id='position-feedback'></div>";
                    echo "</div>";
                }else{
                    echo "<input type = 'hidden' id = 'position' name = 'position' readonly class='form-control' value='$sess_position'>";
                }
                
                echo "
                <div class='form-group'>
                    <label for = 'gender'><b>Gender:</b></label>
                    <div class='form-check'>
                        <input type = 'radio' class='form-check-input' id = 'gender_male' name = 'gender' value = 'M'";
                        echo $gender==='M'?"checked":" ";
                        echo ">
                        <label for = 'male' class='form-check-label'>Male</label>
                    </div>
                    <div class='form-check'>
                        <input type = 'radio' class='form-check-input' id = 'gender_female' name = 'gender' value = 'F'";
                        echo $gender==='F'?"checked":" ";
                        echo " >
                        <label for = 'female' class='form-check-label'>Female</label>
                    </div>
                    <div id='gender-feedback'></div>
                </div>

                <div class='form-group'>
                    <label for = 'birthday'><b>Date of Birth:</b></label>
                    <input type = 'date' class='form-control' id = 'birthday' name = 'birthday' value='$birthday'>
                    <div id='birthday-feedback'></div>
                </div>

                <div class='form-group'>                    
                    <label for = 'phone'><b>Phone number:</b></label>
                    <input type = 'tel' class='form-control' id = 'phone' name = 'phone' placeholder = '012-3456789' value='$phoneNo'>
                    <div id='phone-feedback'></div>
                </div>

                <div class='form-group'>                    
                    <label for = 'address'><b>House Address:</b></label>
                    <input type = 'text' class='form-control' id = 'address' name = 'address' value='$address'>
                    <div id='address-feedback'></div>
                </div>

                <br><br>

                <button class='btn btn-block btn-primaryLight btn-primary' id='btn_update' value='$id'>Update</button>
                <a href=\"../webpage/homepage.php\" class='btn btn-block btn-primaryLight btn-primary'>Cancel</a><br>";
                ?>
            </form>
        </div>
        <br/>

        <?php printModal(); ?>
        <?php printFooter();?>

        <script type='module' src='../javascript/userProfile_script.js'></script>
    </body>
</html>
