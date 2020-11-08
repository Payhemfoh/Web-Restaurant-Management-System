export { errorModal };
function errorModal(xhr, status, error) {
    if (xhr && xhr.status != 200) {
        $("#modal-title").text("Error");
        $(".modal-body").html("Failed to send request to server: <br> " + xhr.responseText + "<br>Please try again.<br>");
        $(".modal-footer").text("<button id=\"cancel\" class=\"btn btn-primary" +
            "btn-primaryLight btn-block\" data-dismiss=\"modal\">Cancel</button>");
        $("#modal").modal();
    }
    else {
        alert("Failed to send request to server! Please try again!");
    }
}
