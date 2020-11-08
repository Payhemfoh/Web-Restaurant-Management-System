"use strict";
$(function () {
    var orderQty = $("#orderQty");
    $("#btnLess").on("click", function (e) {
        e.preventDefault();
        var qty = orderQty.val();
        if (qty <= 1) {
            orderQty.val("1");
            alert("The minimum order is 1.");
        }
        else {
            orderQty.val(--qty);
        }
    });
    $("#btnMore").on("click", function (e) {
        e.preventDefault();
        var qty = orderQty.val();
        if (qty >= 10) {
            orderQty.val("10");
            alert("The maximum order each time is 10.");
        }
        else {
            orderQty.val(++qty);
        }
    });
});
