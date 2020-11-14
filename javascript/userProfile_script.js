"use strict";
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
