<!DOCTYPE html>
<html lang="en">
    <head>
        <title>RMS | Register</title>
        <?php 
            require("../php/pageFragment.php");
            printHeadInclude();
        ?>
    </head>

    <body class="bg-light">
        <?php printHeader(basename(__FILE__));?>

        <br/>
        <div id="content" class="container bg-light col-md-9 rounded">
            <form method="post" action="#">
                <fieldset>
                    <br><h3 class="text-center">Register</h3><br>
                    
                    <div class="row">
                        <div class="form-group col">
                            <label for = "fname"><b>First Name:</b></label>
                            <input type = "text" id = "fname" name = "fname" class="form-control">
                        </div>

                        <div class="form-group col">
                            <label for = "lname"><b>Last Name:</b></label>
                            <input type = "text" id = "lname" name = "lname" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for = "gender"><b>Gender:</b></label>
                        <div class="form-check">
                            <input type = "radio" class="form-check-input" id = "male" name = "gender" value = "male">
                            <label for = "male" class="form-check-label">Male</label>
                        </div>
                        <div class="form-check">
                            <input type = "radio" class="form-check-input" id = "female" name = "gender" value = "female">
                            <label for = "female" class="form-check-label">Female</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for = "birthday"><b>Date of Birth:</b></label>
                        <input type = "date" class="form-control" id = "birthday" name = "birthday">
                    </div>

                    <div class="form-group">                    
                        <label for = "phone"><b>Phone number:</b></label>
                        <input type = "tel" class="form-control" id = "phone" name = "phone" placeholder = "012-3456789">
                    </div>

                    <div class="form-group">
                        <label for = "email"><b>Email:</b></label>
                        <input type = "email" class="form-control" id = "email" name = "email" placeholder = "example@gmail.com">
                    </div>
                    
                    <div class="form-group">
                        <label for = "username"><b>Username:</b></label>
                        <input type = "text" class="form-control" id = "username" name = "username">
                    </div>

                    <div class="form-group">
                        <label for = "password"><b>Password:</b></label>
                        <input type = "password" class="form-control" id = "password" name = "password">
                    </div>

                    <div class="form-group">
                        <label for = "confirm_password"><b>Confirm Password:</b></label>
                        <input type = "password" class="form-control" id = "confirm_password" name = "password">
                    </div>

                    <input type = "submit" class="btn btn-block btn-primaryLight btn-primary" value = "REGISTER" id="btn_register">
                    <input type = "reset" class="btn btn-block btn-primaryLight btn-primary" value = "CLEAR">
                    <br><br>
                    <p>Already have an account? <a href="login.html">Click here to Login.</a></p><br>
                </fieldset>
            </form>
        </div>
        <br/>

        <?php printFooter();?>

        <script src="../javascript/register_script.js"></script>
    </body>
</html>