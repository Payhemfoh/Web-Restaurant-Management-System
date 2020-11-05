"use strict";
$(function () {
    //register ajax call(when register button is clicked)
    $("#btn_register").on("click", function (e) {
        //cancel default submit function
        e.preventDefault();
        //validate all input
        var fname = $("#fname").val();
        var lname = $("#lname").val();
        var gender = $("#gender").val();
        var birthday = $("#birthday").val();
        var phone = $("#phone").val();
        var email = $("#email").val();
        var username = $("#username").val();
        var password = $("#password").val();
        var confirmPassword = $("#confirm_password").val();
        //perform post ajax call using jquery
        $.ajax("../webpage/register.php", {
            type: "POST",
            //return datatype from the processing code
            dataType: "HTML",
            //the data to be passed to the processing code
            data: {
                fname: fname,
                lname: lname,
                gender: gender,
                birthday: birthday,
                phone: phone,
                email: email,
                username: username,
                password: password,
                confirmPassword: confirmPassword
            },
            //action after the ajax call is success
            success: function (data, status, xhr) { console.log(data); },
            //action after the ajax call is failed
            error: function () { alert("Failed to connect to server! Please try again!"); }
        });
    });
});
