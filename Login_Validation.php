<?php

    //This page receive the data from login.html.
    //It will receive username and password.

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password))
    {
        if (empty($username))
        {
            echo "<h3><font color = 'red'>Your username is empty.</font></h3>";
        }

        if(empty($password))
        {
            echo "<h3><font color = 'red'>Your password is empty.</font></h3>";
        }
    }
    else
    {
        echo "<b>Congratulations! $username, your sign in is sucessful.</b>";
    }
?>