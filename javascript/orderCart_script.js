import { errorModal } from "./errorFunction";
$(function () {
    $(".btn-detail").on("click", function () {
        var id = this.getAttribute("value");
        //post ajax call to print the information
        $.ajax("../webpage/makeOrder.php", {
            method: "POST",
            dataType: "HTML",
            data: { id: id },
            success: function (data, status, xhr) {
                $("#modal-title").text("Menu Information");
                $(".modal-body").html(data);
                $("#btnAgain").attr("data-dismiss", "modal");
                $("#modal").modal();
            },
            error: errorModal
        });
    });
});
