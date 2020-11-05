<!DOCTYPE html>
<html lang="en">
    <head>
        <title>RMS | Menu Management Module</title>
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
            <div class="h2 text-center">Menu Management Module</div>
            <br><br>
            <a href="addNewMenu.html" class="btn btn-block btn-primary">Add New Menu</a><br>
            <table id="table" class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Ingredients</th>
                        <th scope="col">Price</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td scope="row"><img src="../images/MenuManagement/chickenrice.jpg" class="img-thumbnail"></th>
                        <td>Chicken Rice</td>
                        <td>Delicious chicken rice</td>
                        <td>Chicken,Rice,Cucumber,Soy Sauce,Cooking Oil, Chili Sauce</td>
                        <td>RM7.00</td>
                        <td><a class="btn btn-primaryLight btn-primary btn_edit">Edit</a></td>
                        <td><a class="btn btn-primaryLight btn-primary btn_delete">Delete</a></td>
                    </tr>

                    <tr>
                        <td scope="row"><img src="../images/MenuManagement/laksa.jpg" class="img-thumbnail"></th>
                        <td>Laksa</td>
                        <td>Delicious Penang Laksa</td>
                        <td>Noodles,Shrimp Paste, Fish, Vegetables, Chili, Onion, Ginger</td>
                        <td>RM7.00</td>
                        <td><a class="btn btn-primaryLight btn-primary btn_edit">Edit</a></td>
                        <td><a class="btn btn-primaryLight btn-primary btn_delete">Delete</a></td>
                    </tr>

                    <tr>
                        <td scope="row"><img src="../images/MenuManagement/eggsandwich.jpg" class="img-thumbnail"></th>
                        <td>Egg Sandwich</td>
                        <td>Delicious sandwich</td>
                        <td>Egg, Bread, Butter, Mayonese, Vegetables</td>
                        <td>RM5.00</td>
                        <td><a class="btn btn-primaryLight btn-primary btn_edit">Edit</a></td>
                        <td><a class="btn btn-primaryLight btn-primary btn_delete">Delete</a></td>
                    </tr>

                    <tr>
                        <td scope="row"><img src="../images/MenuManagement/duckrice.jpg" class="img-thumbnail"></th>
                        <td>Duck Rice</td>
                        <td>Delicious duck rice</td>
                        <td>Duck, Rice, Soy Sauce, Vegetables, Cooking Oil</td>
                        <td>RM7.00</td>
                        <td><a class="btn btn-primaryLight btn-primary btn_edit">Edit</a></td>
                        <td><a class="btn btn-primaryLight btn-primary btn_delete">Delete</a></td>
                    </tr>

                    <tr>
                        <td scope="row"><img src="../images/MenuManagement/chickenchop.jpg" class="img-thumbnail"></th>
                        <td>BBQ Chicken Chop</td>
                        <td>Delicious chicken chop with sweet bbq sauces</td>
                        <td>Chicken, Fries, Salad, BBQ Sauce</td>
                        <td>RM12.00</td>
                        <td><a class="btn btn-primaryLight btn-primary btn_edit">Edit</a></td>
                        <td><a class="btn btn-primaryLight btn-primary btn_delete">Delete</a></td>
                    </tr>

                    <tr>
                        <td scope="row"><img src="../images/MenuManagement/fishchips.jpg" class="img-thumbnail"></th>
                        <td>Fish &amp; Chips</td>
                        <td>Delicious fried fish with tatar sauce</td>
                        <td>Fish, Fries, Salad, Tatar Sauce</td>
                        <td>RM12.00</td>
                        <td><a class="btn btn-primaryLight btn-primary btn_edit">Edit</a></td>
                        <td><a class="btn btn-primaryLight btn-primary btn_delete">Delete</a></td>
                    </tr>

                    <tr>
                        <td scope="row"><img src="../images/MenuManagement/grillchicken.jpg" class="img-thumbnail"></th>
                        <td>Grill Chicken Chop</td>
                        <td>Delicious chicken chop which is grilled and mix with the special made black pepper sauce.</td>
                        <td>Grill Chicken, Fries, Salad, Black Pepper Sauce</td>
                        <td>RM14.00</td>
                        <td><a class="btn btn-primaryLight btn-primary btn_edit">Edit</a></td>
                        <td><a class="btn btn-primaryLight btn-primary btn_delete">Delete</a></td>
                    </tr>

                    <tr>
                        <td scope="row"><img src="../images/MenuManagement/lambchop.jpg" class="img-thumbnail"></th>
                        <td>Lamb Chop</td>
                        <td>Delicious grill lamb chop served with black pepper sauce.</td>
                        <td>Lamb, Fries, Salad, Black Pepper Sauce</td>
                        <td>RM16.00</td>
                        <td><a class="btn btn-primaryLight btn-primary btn_edit">Edit</a></td>
                        <td><a class="btn btn-primaryLight btn-primary btn_delete">Delete</a></td>
                    </tr>

                    <tr>
                        <td scope="row"><img src="../images/MenuManagement/nasilemak.jpg" class="img-thumbnail"></th>
                        <td>Nasi Lemak</td>
                        <td>Localize nasi lemak, the best choice for those who want to enjoy the Malaysia local style dishes.</td>
                        <td>Coconut Milk, Rice, Egg, Anchovies, Cucumber, Sambal, Chicken, Peanuts</td>
                        <td>RM8.00</td>
                        <td><a class="btn btn-primaryLight btn-primary btn_edit">Edit</a></td>
                        <td><a class="btn btn-primaryLight btn-primary btn_delete">Delete</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br/>

        <?php printModal(); ?>

        <?php printFooter(); ?>

        <script type="module" src="menuManagementModule_script.js"></script>
    </body>
</html>