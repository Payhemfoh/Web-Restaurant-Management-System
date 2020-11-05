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
        <?php printHeader(basename(__FILE__)); ?>

        <br/>
        <div id="content" class="container bg-light col-md-9 rounded">
            <div class="row justify-content-center">
                <br>
                <div class="card col-md-3 m-4">
                    <br>
                    <img class="card-img-top card-img-height" src="MenuManagement/chickenrice.jpg">
                    <div class="card-body">
                        <div class="card-description-height">
                            <p class="h4 card-title">Chicken Rice</p>
                            <p class="card-text">Delicious chicken rice</p>
                        </div>
                        <p class="card-text bold">RM7.00</p>
                        <a href="makeOrder.html" class="btn btn-block btn-outline-primary">Order</a>
                    </div>
                </div>

                <div class="card col-md-3 m-4">
                    <br>
                    <img class="card-img-top card-img-height" src="MenuManagement/laksa.jpg">
                    <div class="card-body">
                        <div class="card-description-height">
                            <p class="h4 card-title">Laksa</p>
                            <p class="card-text">Delicious Penang Laksa</p>
                        </div>
                        <p class="card-text bold">RM7.00</p>
                        <a href="makeOrder.html" class="btn btn-block btn-outline-primary">Order</a>
                    </div>
                </div>

                <div class="card col-md-3 m-4">
                    <br>
                    <img class="card-img-top card-img-height" src="MenuManagement/eggsandwich.jpg">
                    <div class="card-body">
                        <div class="card-description-height">
                            <p class="h4 card-title">Egg Sandwich</p>
                            <p class="card-text">Egg, Bread, Butter, Mayonese, Vegetables</p>
                        </div>
                        <p class="card-text bold">RM5.00</p>
                        <a href="makeOrder.html" class="btn btn-block btn-outline-primary">Order</a>
                    </div>
                </div>

                <div class="card col-md-3 m-4">
                    <br>
                    <img class="card-img-top card-img-height" src="MenuManagement/duckrice.jpg">
                    <div class="card-body">
                        <div class="card-description-height">
                            <p class="h4 card-title">Duck Rice</p>
                            <p class="card-text">Delicious duck rice</p>
                        </div>
                        <p class="card-text bold">RM7.00</p>
                        <a href="makeOrder.html" class="btn btn-block btn-outline-primary">Order</a>
                    </div>
                </div>

                <div class="card col-md-3 m-4">
                    <br>
                    <img class="card-img-top card-img-height" src="MenuManagement/chickenchop.jpg">
                    <div class="card-body">
                        <div class="card-description-height">
                            <p class="h4 card-title">BBQ Chicken Chop</p>
                            <p class="card-text">Delicious chicken chop with sweet bbq sauces</p>
                        </div>
                        <p class="card-text bold">RM12.00</p>
                        <a href="makeOrder.html" class="btn btn-block btn-outline-primary">Order</a>
                    </div>
                </div>

                <div class="card col-md-3 m-4">
                    <br>
                    <img class="card-img-top card-img-height" src="MenuManagement/fishchips.jpg">
                    <div class="card-body">
                        <div class="card-description-height">
                            <p class="h4 card-title">Fish &amp; Chips</p>
                            <p class="card-text">Delicious fried fish with tatar sauce</p>
                        </div>
                        <p class="card-text bold">RM12.00</p>
                        <a href="makeOrder.html" class="btn btn-block btn-outline-primary">Order</a>
                    </div>
                </div>

                <div class="card col-md-3 m-4">
                    <br>
                    <img class="card-img-top card-img-height" src="MenuManagement/grillchicken.jpg">
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
                    <img class="card-img-top card-img-height" src="MenuManagement/lambchop.jpg">
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
                    <img class="card-img-top card-img-height" src="MenuManagement/nasilemak.jpg">
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
        </div>
        <br/>

        <?php printFooter(); ?>
    </body>
</html>