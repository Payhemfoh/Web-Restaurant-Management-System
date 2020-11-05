"use strict";
$(function () {
    $("#table").DataTable();
    $(".btn_edit").on("click", function () {
        $("#modal").modal();
    });
});
function readUrl(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var imgData = (e.target).result;
            var imgName = (input.files)[0].name;
            input.setAttribute("data-title", imgName);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
