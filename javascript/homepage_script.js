"use strict";
$(function () {
    //bind the buttons
    var dineIn = $("#dine-in");
    var takeAway = $("#take-away");
    var delivery = $("#delivery");
    //set click event for dine in button
    dineIn.on("click", function () {
        $("#modal-title").text("Welcome");
        $(".modal-body").html("<form action='../webpage/orderList.php' method='get'>" +
            "<div class=\"form-group\">" +
            "<label for = \"tableNo\">Please enter your table No:</label><br>" +
            "<input type='text' class = 'form-control' name='tableNo'>" +
            "</div>" +
            "<input type='hidden' name='service' value='dine_in'>" +
            "<input type = \"submit\" class=\"btn btn-block btn-primaryLight btn-primary\"" +
            "value = \"Start Order\"></form>");
        $(".modal-footer").html("<button id=\"cancel\" class=\"btn btn-block btn-primaryLight btn-primary\"" +
            "data-dismiss=\"modal\">Cancel</button>");
        $("#btnAgain").attr("data-dismiss", "modal");
        $("#modal").modal();
    });
    //set click event for take away button
    takeAway.on("click", function () {
        document.cookie = "service=take_away; path=/;";
        var link = $("<form action='../webpage/orderList.php'></a>");
        $("body").append(link);
        link.trigger("submit");
    });
    //set click event for delivery button
    delivery.on("click", function () {
        var form = $("<form action='../webpage/orderList.php' method='get'><input type='hidden' name='service' value='delivery'></form> ");
        $("body").append(form);
        form.trigger("submit");
    });
    $(".btn_edit").on("click", function () {
        ("#editModal").modal();
    });
});
