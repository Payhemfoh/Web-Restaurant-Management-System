import { errorModal } from "./errorFunction.js";
$(function () {
    loop();
});
function loop() {
    update();
    setTimeout(loop, 3600);
}
function update() {
    var username = $("#username").val();
    $.ajax("../php/loadDeliveryRequest.php", {
        method: "post",
        dataType: "html",
        data: {
            username: username
        },
        success: function (data) {
            $("#delivery_requests").html(data);
            $(".btn_accepted").on("click", function (e) {
                var deliveryId = e.target.getAttribute("value");
                $.ajax("../php/acceptDeliveryRequest.php", {
                    dataType: "html",
                    method: "post",
                    data: {
                        username: username,
                        deliveryId: deliveryId
                    },
                    success: function (data) {
                        $("#modal-title").text("Delivery Request Accepted");
                        $(".modal-body").html(data);
                        $(".modal-footer").html("");
                        $("#btnAgain").attr("data-dismiss", "modal");
                        $("#btnAgain").on("click", function () {
                            update();
                        });
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
