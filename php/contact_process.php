<?php
    //get post value from webpage
    $username = $_POST['username'];
    $email = $_POST['email'];
    $content = $_POST['content'];
    $valid = true;

    if (empty($username))
    {
        echo "<h3><font color = 'red'>Your username is empty.</font></h3>";
        $valid = false;
    }

    if (empty($email))
    {
        echo "<h3><font color = 'red'>Your email is empty.</font></h3>";
        $valid = false;
    }

    if (empty($content))
    {
        echo "<h3><font color = 'red'>Your content is empty.</font></h3>";
        $valid = false;
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        echo "<h3><font color = 'red'>Invalid email format.</h3></font>";
        $valid = false;
    }

    if($valid){
        // Set your email address where you want to receive emails. 
        $to = 'payhemfoh@gmail.com';
        $subject = 'Contact Request From Website';
        $headers = "From: ".$username." <".$email."> \r\n";
        $send_email = mail($to,$subject,$content,$headers);

        echo ($send_email) ? '<h3>The main had been sent to our mailbox.</h3>' : '<h3>Failed to send email. Please try again later.</h3>';
    }
?>