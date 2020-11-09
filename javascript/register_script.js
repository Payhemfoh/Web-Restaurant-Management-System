import { errorModal } from "./errorFunction.js";
import { inValidInput, showPasswordSetting, validInput } from "./form_handle.js";
$(function () {
    //register ajax call(when register button is clicked)
    $("#btn_register").on("click", function (e) {
        //cancel default submit function
        e.preventDefault();
        //validate all input
        var fname = $("#fname").val().trim();
        var lname = $("#lname").val().trim();
        var gender = $("input[name='gender']:checked").val();
        var birthday = $("#birthday").val().trim();
        var phone = $("#phone").val().trim();
        var email = $("#email").val().trim();
        var username = $("#username").val().trim();
        var password = $("#password").val().trim();
        var confirmPassword = $("#confirm_password").val().trim();
        var valid = true;
        //validation
        if (fname === "") {
            inValidInput($("#fname"), $("#fname-feedback"), "First Name should not be empty!");
            valid = false;
        }
        else {
            validInput($("#fname"), $("#fname-feedback"));
        }
        if (lname === "") {
            inValidInput($("#lname"), $("#lname-feedback"), "Last Name should not be empty!");
            valid = false;
        }
        else {
            validInput($("#lname"), $("#lname-feedback"));
        }
        if (gender == undefined) {
            inValidInput($("#gender"), $("#gender-feedback"), "Gender should not be empty!");
            valid = false;
        }
        else {
            if (gender === "male") {
                gender = 'M';
                validInput($("#gender"), $("#gender-feedback"));
            }
            else if (gender === "female") {
                gender = 'F';
                validInput($("#gender"), $("#gender-feedback"));
            }
            else {
                valid = false;
                inValidInput($("#gender"), $("#gender-feedback"), "Invalid gender!");
            }
        }
        if (birthday === "") {
            inValidInput($("#birthday"), $("#birthday-feedback"), "Date Of Birth should not be empty!");
            valid = false;
        }
        else {
            validInput($("#birthday"), $("#birthday-feedback"));
        }
        if (phone === "") {
            inValidInput($("#phone"), $("#phone-feedback"), "Phone No should not be empty!");
            valid = false;
        }
        else {
            validInput($("#phone"), $("#phone-feedback"));
        }
        if (email === "") {
            inValidInput($("#email"), $("#email-feedback"), "Email should not be empty!");
            valid = false;
        }
        else {
            //the regex to check email format
            if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email)) {
                validInput($("#email"), $("#email-feedback"));
            }
            else {
                inValidInput($("#email"), $("#email-feedback"), "The email format is Invalid!");
                valid = false;
            }
        }
        if (username === "") {
            inValidInput($("#username"), $("#username-feedback"), "Username should not be empty!");
            valid = false;
        }
        else {
            validInput($("#username"), $("#username-feedback"));
        }
        if (password === "") {
            inValidInput($("#password"), $("#password-feedback"), "Password should not be empty!");
            valid = false;
        }
        else {
            if(/^(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z]).{8}$/.test(password)){
                validInput($("#password"), $("#password-feedback"));
            }else{
                inValidInput($("#password"), $("#password-feedback"), "Password must contain atleas one upper case, one lower case, one special character, one digit and more than 7 character!");
                valid = false;
            }
        }
        if (confirmPassword === "") {
            inValidInput($("#confirm_password"), $("#confirmPassword-feedback"), "Confirm Password should not be empty!");
            valid = false;
        }
        else {
            if (confirmPassword === password) {
                validInput($("#confirm_password"), $("#confirmPassword-feedback"));
            }
            else if (password === "") {
                inValidInput($("#confirm_password"), $("#confirmPassword-feedback"), "Password is not filled!");
                valid = false;
            }
            else {
                inValidInput($("#confirm_password"), $("#confirmPassword-feedback"), "Password do not match the Confirm Password!");
                valid = false;
            }
        }
        if (valid) {
            //perform post ajax call using jquery
            $.ajax("../php/register_process.php", {
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
                success: function (data, status, xhr) {
                    $("#modal-title").text("Register Status");
                    $(".modal-body").html(data);
                    $("#btnAgain").attr("data-dismiss", "modal");
                    $("#modal").modal();
                },
                //action after the ajax call is failed
                error: errorModal
            });
        }
    });
    showPasswordSetting($("#password"), $("#showpassword"));
    showPasswordSetting($("#confirm_password"), $("#showconfirmpassword"));
});
