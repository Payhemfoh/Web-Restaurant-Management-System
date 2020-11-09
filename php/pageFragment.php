<?php
function printHeader($filename){
    require("../php/sessionFragment.php");
?>
    <header class="border rounded-bottom sticky-top bg-selfprimary">
        <nav class="clearfix">
            <div class="btn-group btn-group-lg float-left">
                <a href="../webpage/homepage.php" class="btn btn-primary py-3"><img src="../images/logo.png"/></a>
                <a href="../webpage/homepage.php" class="btn btn-primary py-3">RMS</a>
                <a href="../webpage/contactUs.php" class="btn btn-primary py-3">contact us</a>
                <a href="../webpage/aboutUs.php" class="btn btn-primary py-3">about us</a>
            </div>

            <div class="btn-group btn-group-lg float-right">
                <?php
                if(!empty($sess_username)){
                    if($sess_position !== "customer"){
                        echo '<button id="btnGroupDrop1" class="btn btn-primary dropdown-toggle py-3" data-toggle="dropdown">
                                Modules
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <a href="../webpage/CustomerManagementModule.php" class="dropdown-item">Customer Management Module</a>
                                    <a href="../webpage/StaffManagementModule.php" class="dropdown-item">Staff Management Module</a>
                                    <a href="../webpage/MenuManagementModule.php" class="dropdown-item">Menu Management Module</a>
                                    <a href="../webpage/StockManagementModule.php" class="dropdown-item">Stock Management Module</a>
                                </div>';
                    }
                    
                    echo '<a href="../webpage/orderCart.php" class="btn btn-primary py-3">Your Order List</a>';
                    echo '<a href="../webpage/userProfile.php" class="btn btn-primary py-3">Hi,'.$sess_username.'</a>';
                    echo '<button id="logout_menu" class="btn btn-primary py-3">Log Out</button>';
                }
                else{
                    //modify for the special cases in register page and login page when user is not login
                    if($filename === "register.php"){
                        echo '<a href="../webpage/login.php" class="btn btn-primary py-3">Log In</a>';
                    }else if($filename === "login.php"){
                        echo '<a href="../webpage/register.php" class="btn btn-primary py-3">Register</a>';
                    }else{
                        echo '<a href="../webpage/login.php" class="btn btn-primary py-3">Log In/Register</a>';
                    }
                }
                ?>
            </div>
        </nav>
    </header>
<?php
    if(!empty($sess_username)){
        echo "<script type='module' src='../javascript/logout_script.js'></script>";
    }
}
?>







<?php
function printFooter(){
?>
    <footer class="container-fluid pt-3 fix-bottom border rounded-top bg-selfprimary">
        <span class="row px-3">
            <div id="footer_link" class="col">
                <h1 class="text-light">Links</h1>
                <ul class="list-unstyled">
                    <li><a href="../webpage/contactUs.php" class="text-light">Contact Us</a></li>
                    <li><a href="../webpage/aboutUs.php" class="text-light">About Us</a></li>
                    <li><a href="../webpage/TermsCondition.php" class="text-light">Terms &amp; Conditions</a></li>
                <ul>
            </div>

            <div id="footer_contact" class="col">
                <h1 class="text-light">Contact Us</h1>
                <ul class="list-unstyled">
                    <li><a href="https://www.facebook.com" target="_blank" class="text-light">Facebook</a></li>
                    <li><a href="https://www.twitter.com" target="_blank" class="text-light">Twitter</a></li>
                    <li><a href="https://www.instagram.com" target="_blank" class="text-light">Instagram</a></li>
                    <li><a href="mailto:payhemfoh@gmail.com" class="text-light">Email</a></li>
                </ul>
            </div>
        </span>
        <p class="text-light px-3">This website is owned and under the maintenance of the RMS<sup>&copy;</sup> <i>2020 - current</i></p>
    </footer>
<?php
}
?>







<?php
function printHeadInclude(){
?>
    <meta charset="utf-8">
    <link rel="icon" href="../images/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" 
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" 
    crossorigin="anonymous">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
    src="https://code.jquery.com/jquery-3.5.1.js"
    integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" 
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" 
    crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" 
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" 
    crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/general.css">
    
<?php
}
?>









<?php
function printModal(){
?>
<!-- Modal -->
<div class="modal fade" id="modal" role="dialog">
    <div class="modal-dialog modal-lg">
    
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modal-title" class="m-0 ml-3"></h2>
                <button type="button" class="close" data-dismiss="modal">x</button>
            </div>
            <div class="modal-body" style="padding:40px 50px;">
                
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div> 
<?php
}
?>