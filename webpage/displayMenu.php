<div class="row justify-content-center">
    <br>
    <?php
        $category = $_GET['id'];

        //database connection
        $connect = new mysqli("localhost","root","","rms_database");
        
        //check connection
        if($connect->connect_error){
            die("Connection error : $connect->connect_errno : $connect->connect_error");
        }

        if($statement = $connect->prepare("SELECT * FROM menu WHERE category_id = ?;")){
            $statement->bind_param("i",$id);
            $statement->execute();

            $result = $statement->get_result();

            while($row = $result->fetch_array()){
                echo "
                    <div class='card col-md-3 m-4'>
                    <br>
                    <img class='card-img-top card-img-height' src='".$row['menu_picture']."'>
                    <div class='card-body'>
                        <div class='card-description-height'>
                            <p class='h4 card-title'>".$row['menu_name']."</p>
                            <p class='card-text'>".$row['menu_description']."</p>
                        </div>
                        <p class='card-text bold'>".$row['menu_price']."</p>
                        <button class='btnOrder btn btn-block btn-outline-primary' value='".$row['menu_id']."'>Order</button>
                    </div>
                </div>
                ";
            }
            $statement->close();
        }else{
            die("Failed to prepare SQL statement.");
        }

        $connect->close();
    ?>
    <div class="card col-md-3 m-4">
        <br>
        <img class="card-img-top card-img-height" src="../images/MenuManagement/chickenrice.jpg">
        <div class="card-body">
            <div class="card-description-height">
                <p class="h4 card-title">Chicken Rice</p>
                <p class="card-text">Delicious chicken rice</p>
            </div>
            <p class="card-text bold">RM7.00</p>
            <button class="btnOrder btn btn-block btn-outline-primary" value="1">Order</button>
        </div>
    </div>

    <div class="card col-md-3 m-4">
        <br>
        <img class="card-img-top card-img-height" src="../images/MenuManagement/laksa.jpg">
        <div class="card-body">
            <div class="card-description-height">
                <p class="h4 card-title">Laksa</p>
                <p class="card-text">Delicious Penang Laksa</p>
            </div>
            <p class="card-text bold">RM7.00</p>
            <button class="btnOrder btn btn-block btn-outline-primary" value="1">Order</button>
        </div>
    </div>

    <div class="card col-md-3 m-4">
        <br>
        <img class="card-img-top card-img-height" src="../images/MenuManagement/eggsandwich.jpg">
        <div class="card-body">
            <div class="card-description-height">
                <p class="h4 card-title">Egg Sandwich</p>
                <p class="card-text">Egg, Bread, Butter, Mayonese, Vegetables</p>
            </div>
            <p class="card-text bold">RM5.00</p>
            <button class="btnOrder btn btn-block btn-outline-primary" value="1">Order</button>
        </div>
    </div>

    <div class="card col-md-3 m-4">
        <br>
        <img class="card-img-top card-img-height" src="../images/MenuManagement/duckrice.jpg">
        <div class="card-body">
            <div class="card-description-height">
                <p class="h4 card-title">Duck Rice</p>
                <p class="card-text">Delicious duck rice</p>
            </div>
            <p class="card-text bold">RM7.00</p>
            <button class="btnOrder btn btn-block btn-outline-primary" value="1">Order</button>
        </div>
    </div>

    <div class="card col-md-3 m-4">
        <br>
        <img class="card-img-top card-img-height" src="../images/MenuManagement/chickenchop.jpg">
        <div class="card-body">
            <div class="card-description-height">
                <p class="h4 card-title">BBQ Chicken Chop</p>
                <p class="card-text">Delicious chicken chop with sweet bbq sauces</p>
            </div>
            <p class="card-text bold">RM12.00</p>
            <button class="btnOrder btn btn-block btn-outline-primary" value="1">Order</button>
        </div>
    </div>

    <div class="card col-md-3 m-4">
        <br>
        <img class="card-img-top card-img-height" src="../images/MenuManagement/fishchips.jpg">
        <div class="card-body">
            <div class="card-description-height">
                <p class="h4 card-title">Fish &amp; Chips</p>
                <p class="card-text">Delicious fried fish with tatar sauce</p>
            </div>
            <p class="card-text bold">RM12.00</p>
            <button class="btnOrder btn btn-block btn-outline-primary" value="1">Order</button>
        </div>
    </div>

    <div class="card col-md-3 m-4">
        <br>
        <img class="card-img-top card-img-height" src="../images/MenuManagement/grillchicken.jpg">
        <div class="card-body">
            <div class="card-description-height">
                <p class="h4 card-title">Grill Chicken Chop</p>
                <p class="card-text">Delicious chicken chop which is grilled and mix with the special made black pepper sauce.</p>
            </div>
            <p class="card-text bold">RM14.00</p>
            <a href="makeOrder.html" class="btn btn-block btn-outline-primary">Order</a>
        </div>
    </div>

    <div class="card col-md-3 m-4">
        <br>
        <img class="card-img-top card-img-height" src="../images/MenuManagement/lambchop.jpg">
        <div class="card-body">
            <div class="card-description-height">
                <p class="h4 card-title">Lamb Chop</p>
                <p class="card-text">Delicious grill lamb chop served with black pepper sauce.</p>
            </div>
            <p class="card-text bold">RM16.00</p>
            <a href="makeOrder.html" class="btn btn-block btn-outline-primary">Order</a>
        </div>
    </div>

    <div class="card col-md-3 m-4">
        <br>
        <img class="card-img-top card-img-height" src="../images/MenuManagement/nasilemak.jpg">
        <div class="card-body">
            <div class="card-description-height">
                <p class="h4 card-title">Nasi Lemak</p>
                <p class="card-text">Localize nasi lemak, the best choice for those who want to enjoy the Malaysia local style dishes.</p>
            </div>
            <p class="card-text bold">RM8.00</p>
            <a href="makeOrder.html" class="btn btn-block btn-outline-primary">Order</a>
        </div>
    </div>
</div>