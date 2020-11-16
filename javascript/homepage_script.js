import { inValidInput, validInput } from "./form_handle.js";
$(function () {
    //bind the buttons
    var dineIn = $("#dine-in");
    var takeAway = $("#take-away");
    var delivery = $("#delivery");
    //set click event for dine in button
    dineIn.on("click", function () {
        document.cookie = "service=dine_in; path=/;";
        $("#modal-title").text("Welcome");
        $(".modal-body").html("<div class=\"form-group\">" +
            "<label for = \"tableNo\">Please enter your table No:</label><br>" +
            "<input type='text' class = 'form-control' id='tableNo' name='tableNo'>" +
            "</div>" +
            "<button id='modal-submit' class=\"btn btn-block btn-primaryLight btn-primary\">" +
            "Start Order</button>");
        $(".modal-footer").html("<button id=\"modal-cancel\" class=\"btn btn-block btn-primaryLight btn-primary\"" +
            "data-dismiss=\"modal\">Cancel</button>");
        $("#modalcancel").attr("data-dismiss", "modal");
        $("#modal-submit").on("click", function (e) {
            e.preventDefault();
            var tableNo = $("#tableNo").val();
            document.cookie = "tableNo=" + tableNo + "; path=/;";
            var link = $("<form action='../webpage/orderList.php'></form>");
            $("body").append(link);
            link.trigger("submit");
        });
        $("#modal").modal();
    });
    //set click event for take away button
    takeAway.on("click", function () {
        var date = new Date();
        var today = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate();
        document.cookie = "service=take_away; path=/;";
        $("#modal-title").text("Welcome");
        $(".modal-body").html("<div class=\"form-group\">" +
            "<label for = \"date\">Please enter your Expected Arrival Date:</label><br>" +
            "<input type='date' class = 'form-control' id='arrival_date' name='arrival_date' min='" +
            today + "'>" +
            "<div id='date-feedback'></div>" +
            "</div>" +
            "<div class=\"form-group\">" +
            "<label for = \"time\">Please enter your Expected Arrival Time:</label><br>" +
            "<input type='time' class = 'form-control' id='arrival_time' name='arrival_time'>" +
            "<div id='time-feedback'></div>" +
            "</div><br>" + "<button id='modal-submit' class=\"btn btn-block btn-primaryLight btn-primary\">" +
            "Start Order</button>" +
            "<button id=\"modal-cancel\" class=\"btn btn-block btn-primaryLight btn-primary\"" +
            "data-dismiss=\"modal\">Cancel</button>");
        $(".modal-footer").html();
        $("#modalcancel").attr("data-dismiss", "modal");
        $("#modal-submit").on("click", function (e) {
            e.preventDefault();
            var arrival_date = $("#arrival_date").val();
            var arrival_time = $("#arrival_time").val();
            var valid = true;
            if (arrival_date === "") {
                inValidInput($("#arrival_date"), $("#date-feedback"), "The date should not be empty");
                valid = false;
            }
            else {
                validInput($("#arrival_date"), $("#date-feedback"));
            }
            if (arrival_time === "") {
                inValidInput($("#arrival_time"), $("#time-feedback"), "The time should not be empty");
                valid = false;
            }
            else {
                validInput($("#arrival_time"), $("#time-feedback"));
            }
            if (valid) {
                document.cookie = "arrival=" + arrival_date + " " + arrival_time + "; path=/;";
                var link = $("<form action='../webpage/orderList.php'></form>");
                $("body").append(link);
                link.trigger("submit");
            }
        });
        $("#modal").modal();
    });
    //set click event for delivery button
    delivery.on("click", function () {
        document.cookie = "service=delivery; path=/;";
        var link = $("<form action='../webpage/orderList.php'></form>");
        $("body").append(link);
        link.trigger("submit");
    });
});
