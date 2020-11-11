<!DOCTYPE html>
<html lang="en">
    <head>
        <title>RMS|Login</title>
        <?php 
            require("../php/sessionFragment.php");
            require("../php/pageFragment.php");
            printHeadInclude();

            if(!empty($_SESSION['sess_username']))
            {
                header('Refresh: 0; URL = ../webpage/homepage.php');
            }
        ?>
    </head>

    <body class="bg-light">
        <?php printHeader(basename(__FILE__));?>

        <br/>
        <div id="content" class="container bg-light col-md-6 rounded">
            <form>
                <fieldset>
                    <br>
                    <h3 class="text-center">Log In</h3><br>
                        <div class="form-group">
                            <lable for = "username"><b>Username:</b></label>
                            <input type = "text" class="form-control" id = "username" name = "username">
                            <div id="username-feedback"></div>
                        </div>

                        <div class="form-group">    
                            <label for = "password"><b>Password:</b></label>
                            <input type = "password" class="form-control" id = "pwd" name = "password">
                            <input type="checkbox" id="showpassword"> Show Password<br>
                            
                            <div id="password-feedback"></div>
                        </div>

                        <br><br>
                        <p>By login to RMS, you are agree with our <a href="../webpage/TermsCondition.php" target="_blank">Terms &amp; Conditions</a></p>
                        <input type = "submit" class="btn btn-block btn-primaryLight btn-primary" value = "LOGIN">
                        <input type = "reset" class="btn btn-block btn-primaryLight btn-primary" value = "CLEAR">
                        <p>Do not have an account? <a href="../webpage/register.php">Click here to Register.</a></p>
                        <br>
                        
                </fieldset>
            </form>
        </div>
        <br/>
        <?php printModal(); ?>
        <?php printFooter(); ?>
        <script  type="module" src="../javascript/login_script.js"></script>
    </body>
</html>
