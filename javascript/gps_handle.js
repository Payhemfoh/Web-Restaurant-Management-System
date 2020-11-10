var map;
var customerMarker;
var geocoder;
$(function () {
    initMap();
    setStaffPosition();
});
function initMap() {
    geocoder = new google.maps.Geocoder();
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 0, lng: 0 },
        zoom: 16,
        streetViewControl: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    var location = $("#location").text();
    geocoder.geocode({ address: location }, markCustomerPosition);
}
function markCustomerPosition(result, status) {
    var location = result[0].geometry.location;
    map.setCenter(location);
    if (customerMarker == null) {
        customerMarker = new google.maps.Marker({
            position: location,
            map: map,
            title: "Your Location",
            animation: google.maps.Animation.BOUNCE
        });
    }
    else {
        customerMarker.setPosition(location);
        customerMarker.setAnimation(google.maps.Animation.BOUNCE);
    }
    setTimeout(function () { return customerMarker.setAnimation(null); }, 500);
}
function setStaffPosition() {
    $.ajax("../php/deliveryStatus_process.php", {
        method: "post",
        data: {},
        success: function (data) { }
    });
}
