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
                    <tr>
                        <td scope="row"><img src="MenuManagement/chickenrice.jpg" class="img-thumbnail"></td>
                        <td>ChickenRice</td>
                        <td>2</td>
                        <td><a href="makeOrder.html" class="btn btn-info">Details</a></td>
                    </tr>
                </tbody>
            </table>
            <button class="btn btn-block btn-primaryLight btn-primary">Place Order</button>
            <a href="payment.html" class="btn btn-block btn-primaryLight btn-primary">Make Payment</a><br><br>
        </div>
        <br/>

        <?php printFooter();?>
    </body>
</html>