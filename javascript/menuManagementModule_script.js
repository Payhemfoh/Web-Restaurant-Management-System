import { errorModal } from "./errorFunction.js";
import { inValidInput, validInput } from "./form_handle.js";
$(function () {
    $("#table").DataTable();
    //add new stock button
    $(".btn_add").on("click", setAddButton);
    $(".btn_delete").on("click", setDeleteButton);
    $(".btn_edit").on("click", setEditButton);
});
function readFile() {
    var input = this;
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
function setAddButton() {
    $.ajax("../webpage/addNewMenu.php", {
        method: "post",
        dataType: "HTML",
        success: function (data, status, xhr) {
            $("#modal-title").text("Add New Menu Data");
            $(".modal-body").html(data);
            $(".modal-footer").html("");
            $("#newImg").on("change", readFile);
            $("#modal-submit").on("click", function (e) {
                e.preventDefault();
                //get user input
                var formData = new FormData();
                var name = $("#name_input").val();
                var category = ($("#category_input").val());
                var price = $("#price_input").val();
                var description = $("#description_input").val();
                var fileInput = document.getElementById("newImg");
                var valid = true;
                //validation
                if (name === "") {
                    inValidInput($("#name_input"), $("#name-feedback"), "The name should not be empty!");
                    valid = false;
                }
                else {
                    validInput($("#name_input"), $("#name-feedback"));
                }
                if (category < 0) {
                    inValidInput($("#category_input"), $("#category-feedback"), "The price should not be more than 0!");
                    valid = false;
                }
                else {
                    validInput($("#category_input"), $("#category-feedback"));
                }
                if (price < 0) {
                    inValidInput($("#price_input"), $("#price-feedback"), "The price should not be more than 0!");
                    valid = false;
                }
                else {
                    validInput($("#price_input"), $("#price-feedback"));
                }
                if (description === "") {
                    inValidInput($("#description_input"), $("#description-feedback"), "The description should not be empty!");
                    valid = false;
                }
                else {
                    validInput($("#description_input"), $("#description-feedback"));
                }
                if (fileInput.files && fileInput.files[0]) {
                    var image = fileInput.files[0];
                    formData.append("image", image);
                    formData.append("destination", "../images/MenuManagement/");
                }
                if (valid) {
                    formData.append("name", name);
                    formData.append("category", category.toString());
                    formData.append("price", price.toString());
                    formData.append("description", description);
                    //post ajax call
                    $.ajax("../php/addNewMenu_process.php", {
                        method: "post",
                        dataType: "html",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            $("#modal-title").text("Add New Stock Data");
                            $(".modal-body").html(data);
                            $(".modal-footer").html("");
                            $("#btnAgain").attr("data-dismiss", "modal");
                            $("#btnAgain").on("click", function () { return location.reload(); });
                        },
                        error: errorModal
                    });
                }
            });
            $("#modal-cancel").attr("data-dismiss", "modal");
            $("#modal").modal();
        },
        error: errorModal
    });
}
function setDeleteButton() {
    var id = this.getAttribute("value");
    $.ajax("../webpage/deleteMenu.php", {
        method: "post",
        dataType: "html",
        data: { id: id },
        success: function (data) {
            $("#modal-title").text("Delete Menu Data");
            $(".modal-body").html(data);
            $(".modal-footer").html("");
            $("#modal-submit").on("click", function (e) {
                e.preventDefault();
                $.ajax("../php/deleteMenu_process.php", {
                    method: "POST",
                    dataType: "HTML",
                    data: { id: id },
                    success: function (data) {
                        $("#modal-title").text("Menu Data Deleted");
                        $(".modal-body").html(data);
                        $(".modal-footer").html("");
                        $("#btnAgain").attr("data-dismiss", "modal");
                        $("#btnAgain").on("click", function () { return location.reload(); });
                    },
                    error: errorModal
                });
            });
            $("#modal-cancel").attr("data-dismiss", "modal");
            $("#modal").modal();
        },
        error: errorModal
    });
}
function setEditButton() {
    var id = this.getAttribute("value");
    $.ajax("../webpage/modifyMenu.php", {
        method: "post",
        dataType: "HTML",
        data: { id: id },
        success: function (data, status, xhr) {
            $("#modal-title").text("Modify Menu");
            $(".modal-body").html(data);
            $(".modal-footer").html("");
            $("#newImg").on("change", readFile);
            $("#modal-cancel").attr("data-dismiss", "modal");
            $("#modal-submit").on("click", function (e) {
                e.preventDefault();
                //get user input
                var formData = new FormData();
                var name = $("#name_input").val();
                var category = ($("#category_input").val());
                var price = $("#price_input").val();
                var description = $("#description_input").val();
                var fileInput = document.getElementById("newImg");
                var valid = true;
                //validation
                if (name === "") {
                    inValidInput($("#name_input"), $("#name-feedback"), "The name should not be empty!");
                    valid = false;
                }
                else {
                    validInput($("#name_input"), $("#name-feedback"));
                }
                if (fileInput.files && fileInput.files[0]) {
                    var image = fileInput.files[0];
                    formData.append("image", image);
                    formData.append("destination", "../images/MenuManagement/");
                }
                if (valid) {
                    formData.append("name", name);
                    formData.append("category", category.toString());
                    formData.append("price", price.toString());
                    formData.append("description", description);
                    formData.append("id", id);
                    //post ajax call
                    $.ajax("../php/updateMenu_process.php", {
                        method: "post",
                        dataType: "html",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            $("#modal-title").text("Add New Stock Data");
                            $(".modal-body").html(data);
                            $(".modal-footer").html("");
                            $("#btnAgain").attr("data-dismiss", "modal");
                            $("#btnAgain").on("click", function () { return location.reload(); });
                        },
                        error: errorModal
                    });
                }
            });
            $("#modal-cancel").attr("data-dismiss", "modal");
            $("#modal").modal();
        },
        error: errorModal
    });
}
