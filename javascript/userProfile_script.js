import { inValidInput, validInput } from "./form_handle.js";
$(function () {
    $("#btn_update").on("click", function (e) {
        e.preventDefault();
        var id = e.target.getAttribute("value");
        var position = $("#position").val();
        var fname = $("#fname").val();
        var lname = $("#lname").val();
        var gender = $("input[name='gender']:checked").val();
        var birthday = $("#birthday").val();
        var phone = $("#phone").val();
        var address = $("#address").val();
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
            valid = false;
            inValidInput($("#gender"), $("#gender-feedback"), "Invalid gender!");
        }
        if (birthday === "") {
            inValidInput($("#birthday"), $("#birthday-feedback"), "Date Of Birth should not be empty!");
            valid = false;
        }
        else {
            validInput($("#birthday"), $("#birthday-feedback"));
        }
        if (address === "") {
            inValidInput($("#address"), $("#address-feedback"), "Address should not be empty!");
            valid = false;
        }
        else {
            validInput($("#address"), $("#address-feedback"));
        }
        if (phone === "") {
            inValidInput($("#phone"), $("#phone-feedback"), "Phone No should not be empty!");
            valid = false;
        }
        else {
            if (/^[0-9]{3}-[0-9]{7}$/.test(phone)) {
                validInput($("#phone"), $("#phone-feedback"));
            }
            else {
                inValidInput($("#phone"), $("#phone-feedback"), "Phone No format is Invalid!!");
                valid = false;
            }
        }
        if (valid) {
            $.ajax({
                url: "../php/updateUserProfile.php",
                method: "post",
                data: {
                    id: id,
                    position: position,
                    fname: fname,
                    lname: lname,
                    gender: gender,
                    birthday: birthday,
                    phone: phone,
                    address: address
                },
                success: function (data) {
                    $("#modal-title").text("Update Complete");
                    $(".modal-body").html(data);
                    $(".modal-footer").html("");
                    $("#btnAgain").attr("data-dismiss", "modal");
                    $("#btnAgain").on("click", function () { return location.reload(); });
                    $("#modal").modal();
                },
            });
        }
    });
});
