import { errorModal } from "./errorFunction.js";
$(function () {
    loop();
});
function loop() {
    update();
    setTimeout(loop, 60000);
}
function update() {
    $.ajax("../php/loadOrderRequest.php", {
        method: "post",
        dataType: "html",
        success: function (data) {
            $("#order_requests").html(data);
            $(".btn_done").on("click", function (e) {
                var itemId = e.target.getAttribute("value");
                $.ajax("../php/completeOrderItem", {
                    dataType: "html",
                    method: "post",
                    data: {
                        id: itemId
                    },
                    success: function (data) {
                        $("#modal-title").text("Order Done");
                        $(".modal-body").html(data);
                        $(".modal-footer").html("");
                        $("#btnAgain").attr("data-dismiss", "modal");
                        setTimeout(function () { return $("#btnAgain").trigger("click"); }, 1000);
                    },
                    error: errorModal
                });
            });
        },
        error: function () {
            $("#order_requests").html("<h3 class='text-center'>Failed to load data from database</h3>");
        }
    });
}
