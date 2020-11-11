"use strict";
$(function () {
    $.ajax("../php/loalOrderRequest.php", {
        method: "post",
        dataType: "html",
        success: function (data) {
            $("#order_requests").html(data);
        },
        error: function () {
            $("#order_requests").html("<h2>Failed to load data from database</h2>");
        }
    });
});
