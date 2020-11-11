<div class="row justify-content-center">
    <br>
    <?php
        $category = $_POST['id'];

        //database connection
        $connect = new mysqli("localhost","root","","rms_database");
        
        //check connection
        if($connect->connect_error){
            die("Connection error : $connect->connect_errno : $connect->connect_error");
        }

        if($statement = $connect->prepare("SELECT * FROM menu WHERE category_id = ?;")){
            $statement->bind_param("i",$category);
            $statement->execute();

            $result = $statement->get_result();

            while($row = $result->fetch_array()){
                printf("
                    <div class='card col-md-3 m-4'>
                    <br>
                    <img class='card-img-top card-img-height' src='%s'>
                    <div class='card-body'>
                        <div class='card-description-height'>
                            <p class='h4 card-title'>%s</p>
                        </div>
                        <p class='card-text bold'>RM %.2f</p>
                        <button class='btnOrder btn btn-block btn-outline-primary' value='%d'>Order</button>
                    </div>
                </div>
                ",$row['menu_picture'],$row['menu_name'],$row['menu_price'],$row['menu_id']);
            }
            $statement->close();
        }else{
            die("Failed to prepare SQL statement.");
        }

        $connect->close();
    ?>
</div>