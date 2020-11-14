"use strict";
$(function () {
    $(".btn_delivered").on("click", function (e) {
        e.preventDefault();
        var orderId = e.target.getAttribute("value");
        $.ajax({
            url: "../php/completePickup.php",
            method: "post",
            data: { orderId: orderId },
            success: function (data) {
                $("#modal-title").text("Order Done");
                $(".modal-body").html(data);
                $(".modal-footer").html("");
                $("#btnAgain").attr("data-dismiss", "modal");
                $("#btnAgain").on("click", function () { return location.reload(); });
                $("#modal").modal();
                setTimeout(function () { return $("#btnAgain").trigger("click"); }, 500);
            },
        });
    });
});
