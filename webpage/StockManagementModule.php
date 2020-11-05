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
            <a href="addNewStock.html" class="btn btn-block btn-primary">Add New Stock</a><br>
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td scope="row"><img src="../images/StockManagement/egg.jpg" class="img-thumbnail"></td>
                        <td>Egg</td>
                        <td>fresh egg</td>
                        <td>100</td>
                        <td><a href="modifyStock.html" class="btn btn-primaryLight btn-primary">Edit</a></td>
                        <td><a href="deleteStock.html" class="btn btn-primaryLight btn-primary">Delete</a></td>
                    </tr>

                    <tr>
                        <td scope="row"><img src="../images/StockManagement/onion.jpg" class="img-thumbnail"></td>
                        <td>Onion</td>
                        <td>purple onion</td>
                        <td>200</td>
                        <td><a href="modifyStock.html" class="btn btn-primaryLight btn-primary">Edit</a></td>
                        <td><a href="deleteStock.html" class="btn btn-primaryLight btn-primary">Delete</a></td>
                    </tr>

                    <tr>
                        <td scope="row"><img src="../images/StockManagement/ginger.jpg" class="img-thumbnail"></td>
                        <td>Ginger</td>
                        <td>big ginger</td>
                        <td>20</td>
                        <td><a href="modifyStock.html" class="btn btn-primaryLight btn-primary">Edit</a></td>
                        <td><a href="deleteStock.html" class="btn btn-primaryLight btn-primary">Delete</a></td>
                    </tr>

                    <tr>
                        <td scope="row"><img src="../images/StockManagement/rice.jpg" class="img-thumbnail"></td>
                        <td>Rice</td>
                        <td>10kg package of the rice</td>
                        <td>20</td>
                        <td><a href="modifyStock.html" class="btn btn-primaryLight btn-primary">Edit</a></td>
                        <td><a href="deleteStock.html" class="btn btn-primaryLight btn-primary">Delete</a></td>
                    </tr>

                    <tr>
                        <td scope="row"><img src="../images/StockManagement/oil.jpg" class="img-thumbnail"></td>
                        <td>Cooking Oil</td>
                        <td>2 Litre of cooking oil</td>
                        <td>10</td>
                        <td><a href="modifyStock.html" class="btn btn-primaryLight btn-primary">Edit</a></td>
                        <td><a href="deleteStock.html" class="btn btn-primaryLight btn-primary">Delete</a></td>
                    </tr>

                    <tr>
                        <td scope="row"><img src="../images/StockManagement/soysauce.jpg" class="img-thumbnail"></td>
                        <td>Soy Sauce</td>
                        <td>200ml package of soy sauce</td>
                        <td>30</td>
                        <td><a href="modifyStock.html" class="btn btn-primaryLight btn-primary">Edit</a></td>
                        <td><a href="deleteStock.html" class="btn btn-primaryLight btn-primary">Delete</a></td>
                    </tr>

                    <tr>
                        <td scope="row"><img src="../images/StockManagement/chicken.jpg" class="img-thumbnail"></td>
                        <td>Chicken</td>
                        <td>the whole chicken</td>
                        <td>80</td>
                        <td><a href="modifyStock.html" class="btn btn-primaryLight btn-primary">Edit</a></td>
                        <td><a href="deleteStock.html" class="btn btn-primaryLight btn-primary">Delete</a></td>
                    </tr>

                    <tr>
                        <td scope="row"><img src="../images/StockManagement/tomato.jpg" class="img-thumbnail"></td>
                        <td>Tomato</td>
                        <td>big tomato</td>
                        <td>20</td>
                        <td><a href="modifyStock.html" class="btn btn-primaryLight btn-primary">Edit</a></td>
                        <td><a href="deleteStock.html" class="btn btn-primaryLight btn-primary">Delete</a></td>
                    </tr>

                    <tr>
                        <td scope="row"><img src="../images/StockManagement/potato.jpg" class="img-thumbnail"></td>
                        <td>Potato</td>
                        <td>fresh potato</td>
                        <td>50</td>
                        <td><a href="modifyStock.html" class="btn btn-primaryLight btn-primary">Edit</a></td>
                        <td><a href="deleteStock.html" class="btn btn-primaryLight btn-primary">Delete</a></td>
                    </tr>
                </tbody>
            </table>    
        </div>
        <br/>

        <?php printFooter(); ?>
    </body>
</html>
