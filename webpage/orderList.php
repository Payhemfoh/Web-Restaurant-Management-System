<!DOCTYPE html>
<html lang="en">
    <head>
        <title>RMS | Menu</title>
        <?php
            require("../php/sessionFragment.php");
            require("../php/pageFragment.php");
            printHeadInclude();
        ?>
    </head>


<style>
body {
  font-family: "Lato", sans-serif;
}

.sidenav {
  width: 148px;
  margin-top: 70px;
  position: fixed;
  z-index: 1;
  top: 20px;
  left: 10px;
  background: #eee;
  padding: 8px 0;
}

.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 22px;
  color: #2196F3;
  display: block;
}

.sidenav a:hover {
  color: #064579;
}


@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>

    <body class="bg-light">
        <?php printHeader(basename(__FILE__)); ?>
        <br/>

        <div class="sidenav">
          <a href='#' style='color:black' class='nav_main py-0 my-0'>Menu</a><br>
        <?php

        //database connection
        $connect = new mysqli("localhost","root","","rms_database");

        //check connection
        if($connect->connect_error){
            die("Connection error : $connect->connect_errno : $connect->connect_error");
        }

        $sql = "SELECT category_name,category_id FROM menu_category";
        $result = $connect->query($sql);

        if ($result->num_rows > 0) 
        {
            // output data of each row
             
            while($row = $result->fetch_assoc()) 
            {
                echo "<a href='#' style='color:black' class='nav_menu py-0 my-0' value='".$row['category_id']."'>";
                echo $row["category_name"];
                echo "</a>";
            }
        }
        ?>
        </div>

        <div id="content" class="container bg-light col-md-9 rounded">
            <?php include("../webpage/categoryList.php");?>
        </div>
        <br/>
        <?php printModal(); ?>
        <?php printFooter(); ?>
        <script type="module" src="../javascript/orderList_script.js"></script>
    </body>
</html>
