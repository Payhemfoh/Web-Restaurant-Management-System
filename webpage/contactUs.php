<!DOCTYPE html>
<html lang="en">
    <head>
        <title>RMS | Contact Us</title>
        <?php 
            require("../php/sessionFragment.php");
            require("../php/pageFragment.php");
            printHeadInclude();
        ?>
        <link rel="stylesheet" 
		href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" 
		integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" 
		crossorigin="anonymous">
    </head>

    <body class="bg-light">
        <?php printHeader(basename(__FILE__)); ?>

        <br/>
        <div id="content" class="container bg-light col-md-9 rounded">
            <br><h2 class="text-center">Contact Us</h2><br>
            <hr>
            <div id='contact_buttons'>
	        <center>
                <p id='text'>For more information, please do follow us on our following social media:</p>
		    </center>
                <div class="row">
                    <div class="col p-4">
                        <a class='media' href='https://www.facebook.com' target='_blank'><i class='fab fa-facebook-f'></i></a>
                    </div>
                    <div class="col p-4">
                        <a class='media' href='https://www.twitter.com' target='_blank'><i class='fab fa-twitter'></i></a>
                    </div>
                    <div class="col p-4">
                        <a class='media' href='https://www.instagram.com' target='_blank'><i class='fab fa-instagram'></i></a>
                    </div>
                </div>
            </div>

	    <hr>
		
            <div id='contact_form'>
                
                <p>RMS would like to hear from you as your feedback is valuable to us for further improvement and to provide you a better service. Kindly fill up the details below and 
                    we will answer you queries as soon as possible.</p>
		<center>
                    <p>Thank you for dining at <b>Restaurant Management System (RMS).</b></p>
                </center>
		    
                <form method='post' action='ContactUs.php'>
                
                    <div class='form-group'>
                        <label for='username'>Username</label><br>
                        <input type='text' class='form-control' placeholder='Username' id='username' tabindex='1'>
                        <div id='username-feedback'></div>
                    </div>
                    <div class='form-group'>
                        <label for='email'>Email</label><br>
                        <input type='email' class='form-control' placeholder='Email' id='email' tabindex='2'>
                        <div id='email-feedback'></div>
                    </div>

                    <div class='form-group'>
                        <label for='content'>Content</label><br>
                        <textarea class='form-control' id='content' placeholder='You may enter the text into the textbox.' tabindex='3'></textarea>
                        <div id='content-feedback'></div>
                    </div>
                    
                    <button id='send-mail' class='btn btn-block btn-primaryLight btn-primary'>Send</button><br><br>
                </form>
            </div>
        </div>
        <br/>
        <?php printModal(); ?>
        <?php printFooter(); ?>
        <script type="module" src="../javascript/contact_script.js" ></script>
    </body>
</html>
