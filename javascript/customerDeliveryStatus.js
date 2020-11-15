$(function () {
    loadOrder();
    update();
});
function update() {
    checkOrderStatus();
    setTimeout(update, 60000);
}
function checkOrderStatus() {
    $.ajax({
        url: "../php/checkOrderStatus.php",
        method: "post",
        dataType: "json",
        success: function (data) {
            if (data.status != null) {
                var bar = $("#progress_bar");
                switch (data.status) {
                    case "order received":
                        bar.attr("aria-valuenow", "1");
                        bar.css("width", "25%");
                        bar.text("25%");
                        if (!$("#waiting").hasClass("active"))
                            $("#waiting").addClass("active");
                        if ($("#preparing").hasClass("active"))
                            $("#preparing").removeClass("active");
                        if ($("#delivering").hasClass("active"))
                            $("#delivering").removeClass("active");
                        if ($("#arrived").hasClass("active"))
                            $("#arrived").removeClass("active");
                        break;
                    case "preparing":
                        bar.attr("aria-valuenow", "2");
                        bar.css("width", "50%");
                        bar.text("50%");
                        if ($("#waiting").hasClass("active"))
                            $("#waiting").removeClass("active");
                        if (!$("#preparing").hasClass("active"))
                            $("#preparing").addClass("active");
                        if ($("#delivering").hasClass("active"))
                            $("#delivering").removeClass("active");
                        if ($("#arrived").hasClass("active"))
                            $("#arrived").removeClass("active");
                        break;
                    case "delivering":
                        bar.attr("aria-valuenow", "3");
                        bar.css("width", "75%");
                        bar.text("75%");
                        if ($("#waiting").hasClass("active"))
                            $("#waiting").removeClass("active");
                        if ($("#preparing").hasClass("active"))
                            $("#preparing").removeClass("active");
                        if (!$("#delivering").hasClass("active"))
                            $("#delivering").addClass("active");
                        if ($("#arrived").hasClass("active"))
                            $("#arrived").removeClass("active");
                        break;
                    case "arrived":
                        bar.attr("aria-valuenow", "4");
                        bar.css("width", "100%");
                        bar.text("100%");
                        if ($("#waiting").hasClass("active"))
                            $("#waiting").removeClass("active");
                        if ($("#preparing").hasClass("active"))
                            $("#preparing").removeClass("active");
                        if ($("#delivering").hasClass("active"))
                            $("#delivering").removeClass("active");
                        if (!$("#arrived").hasClass("active"))
                            $("#arrived").addClass("active");
                        //set click event for dine in button
                        $("#modal-title").text("Order Arrived");
                        $(".modal-body").html("<h4 class='text-center'>Your order had arrived</h4><br>" +
                            "<button id='modal-submit' class=\"btn btn-block btn-primaryLight btn-primary\">" +
                            "Complete Order</button>");
                        $("#modal-submit").attr("data-dismiss", "modal");
                        $("#modal-submit").on("click", function (e) {
                            e.preventDefault();
                            document.cookie = 'orderId=;path=/;expires=Thu, 01 Jan 1970 00:00:00 UTC;';
                            document.cookie = 'service=;path=/;expires=Thu, 01 Jan 1970 00:00:00 UTC;';
                            document.cookie = 'delivery_id=;path=/;expires=Thu, 01 Jan 1970 00:00:00 UTC;';
                            var link = $("<form action='../webpage/homepage.php'></form>");
                            $("body").append(link);
                            link.trigger("submit");
                        });
                        $("#modal").modal();
                        break;
                }
            }
        }
    });
}
function loadOrder() {
    var orderId = $("#orderId").val();
    $.ajax({
        url: "../php/loadOrderItem.php",
        method: "post",
        dataType: "html",
        data: { orderId: orderId },
        success: function (data) { return $("#order_item_list").html(data); }
    });
}
