<!DOCTYPE html>
<html lang="en">
    <head>
        <title>RMS | Homepage</title>
        <?php
            require("../php/pageFragment.php");
            printHeadInclude();
        ?>
    </head>

    <body class="bg-light">
        <?php printHeader(basename(__FILE__));?>

        <br/>
        <div id="content" class="container bg-light col-md-9 rounded">
            <br><h3 class="text-center">Your Order List</h3><br>
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Details</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        //get cart from cookies
                        if(isset($_COOKIE['orderList'])){
                            $orderList = json_decode($_COOKIE['orderList']);

                            //databse connection
                            $connect = new mysqli("localhost","root","","rms_database");

                            echo "<tr>
                                <td scope=\"row\"><img src=\"../images/MenuManagement/chickenrice.jpg\" class=\"img-thumbnail\"></td>
                                <td>ChickenRice</td>
                                <td>2</td>
                                <td><button class=\"btn btn-info btn-detail\" value=\"1\">Details</button></td>
                            </tr>";
                        }else{
                            echo "No order found in the cart. Click the button below to start your order.<br>";
                            echo "<a href=\"../webpage/homepage.php\" class='btn btn-block btn-primaryLight btn-primary'>Start Order</a><br>";
                        }

                    ?>

                    <tr>
                        <td scope="row"><img src="../images/MenuManagement/chickenrice.jpg" class="img-thumbnail"></td>
                        <td>ChickenRice</td>
                        <td>2</td>
                        <td><button class="btn btn-info btn-detail" value="1">Details</button></td>
                    </tr>
                </tbody>
            </table>
            <button class="btn btn-block btn-primaryLight btn-primary">Place Order</button>
            <a href="payment.html" class="btn btn-block btn-primaryLight btn-primary">Make Payment</a><br><br>
        </div>
        <br/>

        <?php printModal(); ?>
        <?php printFooter();?>

        <script type="module" src="../javascript/orderCart_script.js"></script>
    </body>
</html>