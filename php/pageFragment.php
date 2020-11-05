<?php
function printHeader($filename){
?>
    <header class="border rounded-bottom sticky-top bg-selfprimary">
        <nav class="clearfix">
            <div class="btn-group btn-group-lg float-left">
                <a href="../webpage/homepage.php" class="btn btn-primary py-3"><img src="../images/logo.png"/></a>
                <a href="../webpage/homepage.php" class="btn btn-primary py-3">RMS</a>
                <a href="#" class="btn btn-primary py-3">contact us</a>
                <a href="#" class="btn btn-primary py-3">about us</a>
            </div>

            <div class="btn-group btn-group-lg float-right">
                <button id="btnGroupDrop1" class="btn btn-primary dropdown-toggle py-3" data-toggle="dropdown">
                    Modules
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <a href="../webpage/MenuManagementModule.php" class="dropdown-item">Menu Management Module</a>
                    <a href="../webpage/StockManagementModule.php" class="dropdown-item">Stock Management Module</a>
                </div>
                <a href="../webpage/orderCart.html" class="btn btn-primary py-3">Your Order List</a>
                <?php
                    //modify for the special cases in register page and login page when user is not login
                    if($filename === "register.php"){
                        echo '<a href="../webpage/login.php" class="btn btn-primary py-3">Sign in</a>';
                    }else if($filename === "login.php"){
                        echo '<a href="../webpage/register.php" class="btn btn-primary py-3">Register</a>';
                    }else{
                        echo '<a href="../webpage/login.php" class="btn btn-primary py-3">Login/Register</a>';
                    }
                ?>
            </div>
        </nav>
    </header>
<?php
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
                    <li><a href="#" class="text-light">Contact Us</a></li>
                    <li><a href="#" class="text-light">About Us</a></li>
                    <li><a href="#" class="text-light">Terms &amp; Conditions</a></li>
                <ul>
            </div>

            <div id="footer_contact" class="col">
                <h1 class="text-light">Contact Us</h1>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-light">Facebook</a></li>
                    <li><a href="#" class="text-light">Twitter</a></li>
                    <li><a href="#" class="text-light">Email</a></li>
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
                <h4 id="modal-title">Modify Menu</h4>
                <button type="button" class="close" data-dismiss="modal">x</button>
            </div>
            <div class="modal-body" style="padding:40px 50px;">
                <form action="#" method="post">
                    <table class="table">
                        <thead class="thead-primary">
                            <tr>
                                <th><font size='6'>Image</font></th>					
                                <th><font size='6'>Information</font></th>
                            </tr>	
                        </thead>
                        <tbody>
                            <tr>				
                                <td>
                                    <div class="form-group">
                                        <p>Current Picture:</p>
                                        <img src="MenuManagement/chickenrice.jpg" class="img-thumbnail"><br><br>
                                        <p>New Picture:</p>
                                        <div class="form-group inputDnD">
                                            <label class="sr-only" for="inputFile">File Upload</label>
                                            <input type="file" name="newImg" accept="image/*" class="form-control-file text-primary font-weight-bold"
                                        if="newImg" onchange="readFile(this)" data-title = "Click Here or Drag and Drop to Upload File">
                                        </div>           
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" class="form-control" name="name" value="Chicken Rice">
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Ingredients:</label>
                                        <textarea class="form-control" 
                                        name="ingredients">Chicken,Rice,Cucumber,Soy Sauce,Cooking Oil, Chili Sauce</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="price">Price(RM):</label>
                                        <input type="number" step="0.01" class="form-control" name="price" value="7.00">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="description">Description:</label>
                                        <textarea class="form-control" name="description">Delicious chicken rice</textarea>
                                    </div>					
                                </td>
                            </tr>
                        </tbody>        
                    </table>			
                </form>
            </div>
            <div class="modal-footer">
                <button id="cancel" class="btn btn-primary btn-primaryLight btn-block" data-dismiss="modal">Cancel</button><br>
                <button id="modal-submit" class="btn btn-primary btn-primaryLight btn-block">Modify</button>
            </div>
        </div>
    </div>
</div> 
<?php
}


function passwordEncrypt($password):string{
    return hash("sha256",$password+"Welcome To Restaurant Management Module");
}
?>