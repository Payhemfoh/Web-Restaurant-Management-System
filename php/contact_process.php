<?php
    //get post value from webpage
    $username = $_POST['username'];
    $email = $_POST['email'];
    $content = $_POST['content'];


    // Set your email address where you want to receive emails. 
    $to = 'payhemfoh@gmail.com';
    $subject = 'Contact Request From Website';
    $headers = "From: ".$username." <".$email."> \r\n";
    $send_email = mail($to,$subject,$content,$headers);

    echo ($send_email) ? '<h3>The main had been sent to our mailbox.</h3>' : '<h3>Failed to send email. Please try again later.</h3>';

?>