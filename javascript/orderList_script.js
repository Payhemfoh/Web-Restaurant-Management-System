import { errorModal } from "./errorFunction";
$(function () {
    $(".category_row").on("click", function (e) {
        var id = parseInt(e.target.getAttribute("value"));
        displayMenu(id);
    });
});
function displayMenu(id) {
    $.ajax("../webpage/displayMenu.php", {
        method: "get",
        dataType: "html",
        data: { id: id },
        success: function (data) {
            $("#content").html(data);
            setupMenu();
        },
        error: function (xhr, status, error) {
            if (xhr && xhr.status != 200) {
                $("#content").html("Failed to send request to server: <br> " + xhr.responseText + "<br>Please try again.<br>");
            }
            else {
                alert("Failed to send request to server! Please try again!");
            }
        }
    });
}
function setupMenu() {
    $(".btnOrder").on("click", function () {
        var id = this.getAttribute("value");
        if (id != null) {
            $.ajax("../webpage/makeOrder.php", {
                method: "POST",
                dataType: "HTML",
                data: {
                    id: id
                },
                success: function (data, status, xhr) {
                    $("#modal-title").text("Menu Detail");
                    $(".modal-body").html(data);
                    $(".modal-footer").html('<button id="modal-cancel" class="btn btn-primary btn-primaryLight btn-block" ' +
                        'data-dismiss="modal">Cancel</button><br>' +
                        '<button id="modal-submit" class="btn btn-primary btn-primaryLight btn-block">Place Order</button>');
                    $("#modal-submit").on("click", function () {
                        var quantity = $("#orderQty").val();
                        $.ajax("../php/placeOrder.php", {
                            method: "post",
                            dataType: "HTML",
                            data: {
                                id: id,
                                qty: quantity
                            },
                            success: function (data, status, xhr) {
                                $("#modal-title").text("Order Placed");
                                $(".modal-body").html(data);
                                $(".modal-footer").html('<button id="modal-cancel" class="btn btn-primary btn-primaryLight btn-block" ' +
                                    'data-dismiss="modal">Return to Menu</button>');
                            },
                            error: errorModal
                        });
                    });
                    $("#modal").modal();
                },
                error: errorModal
            });
        }
    });
}
