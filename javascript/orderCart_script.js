import { errorModal } from "./errorFunction.js";
$(function () {
    $(".btn-detail").on("click", function () {
        var id = this.getAttribute("value");
        //post ajax call to print the information
        $.ajax("../webpage/displayMenuDetail.php", {
            method: "POST",
            dataType: "HTML",
            data: { id: id },
            success: function (data, status, xhr) {
                $("#modal-title").text("Menu Information");
                $(".modal-body").html(data);
                $(".modal-footer").html('<button id="modal-cancel" class="btn btn-primary btn-primaryLight btn-block" ' +
                    'data-dismiss="modal">Return to Cart</button>');
                $("#modal").modal();
            },
            error: errorModal
        });
    });
    $("#btn_checkout").on("click", function () {
        var username = $("#username").val();
        $.ajax({
            url: "../php/sendOrderToKitchen.php",
            method: "post",
            dataType: "html",
            data: { username: username },
            success: function (data) {
                var form = $("<form action='../webpage/payment.php'></form>");
                $("body").append(form);
                form.trigger("submit");
            },
            error: errorModal
        });
    });
    $("#btn_payment").on("click", function () {
        var form = $("<form action='../webpage/payment.php'></form>");
        $("body").append(form);
        form.trigger("submit");
    });
    $("#btn_sendKitchen").on("click", function () {
        var username = $("#username").val();
        $.ajax({
            url: "../php/sendOrderToKitchen.php",
            method: "post",
            dataType: "html",
            data: {
                username: username
            },
            success: function (data) {
                document.cookie = "orderList=;path=/;expires=Thu, 01 Jan 1970 00:00:00 UTC;";
                $("#modal-title").text("Menu Information");
                $(".modal-body").html(data);
                $(".modal-footer").html('<button id="modal-cancel" class="btn btn-primary btn-primaryLight btn-block" ' +
                    'data-dismiss="modal">Return to Cart</button>');
                $("#modal").modal();
            },
            error: errorModal
        });
    });
});
