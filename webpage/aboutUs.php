<!DOCTYPE html>
<html lang="en">
    <head>
        <title>RMS | About Us</title>
        <?php 
            require("../php/sessionFragment.php");
            require("../php/pageFragment.php");
            printHeadInclude();
        ?>
    </head>

    <body class="bg-light">
        <?php printHeader(basename(__FILE__)); ?>

        <br/>
        <div id="content" class="container bg-light col-md-9 rounded">
            <br><h2 class="text-center">About Us</h2><br>
            <hr></hr>
            <p><b>Restaurant Management System (RMS)</b> is one of the top restaurant systems in Malaysia. We combine our own family recipes with 
                style and personal flair to create a unique experience every time you visit us. We strive to make each visit satisfying and memorable.</p>
            <p>RMS has continually provided each of its guests with finest menus since 2010. RMS in creating a uniquely thoughtful atmosphere, 
                which will not only excite one's tastes, but provide the perfect dining experience.</p>
            <p>Our restaurant, is located at Karpal Singh Dr, Jelutong, Pulau Pinang. There are features dishes ranging from mouthwatering chicken rice, nasi lemak, 
                grill chicken chop and many more. Everything on the RMS's delicious breakfast, lunch and dinner menus are always cooked to perfection.</p>
            <br><br>
            <p><img src="../images/AboutUs/restaurantView.jpg" width = "550" height = "350" style="margin:0px 50px 0px 0px">This is the inside view (dining area) of the restaurant. </p>
            <p>This is the back view which is the kitchen of the restaurant.<img src="../images/AboutUs/kitchen.jpg" width = "550" height = "350" style="margin:0px 0px 0px 50px"></p>
            <p><img src="../images/AboutUs/food.jpg" width = "555" height = "350" style="margin:0px 50px 0px 0px">Malaysia's famous food are served in our RMS.</p>
            <br>
            <hr></hr>
            <center>
            <p>Furthermore, other than dine in services, RMS also provides <b>delivery</b> and <b>take away services</b>.</p>
            </center>
            <br><br>
            <p><img src="../images/AboutUs/delivery.jpg" width = "555" height = "350" style="margin:0px 20px 0px 0px"><img src="../images/AboutUs/takeAway.jpg" width = "400" height = "450"></p>
            <br>
        </div>
        <br/>
        <?php printModal(); ?>
        <?php printFooter(); ?>
        <script src="../javascript/homepage_script.js" ></script>
    </body>
</html>
