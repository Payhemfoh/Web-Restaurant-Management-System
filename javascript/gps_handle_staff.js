var map;
var customerMarker;
var staffMarker;
var geocoder;
$(function () {
    initMap();
    update();
});
function update() {
    setStaffPosition();
    setTimeout(update, 60000);
}
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
            title: "Customer Location"
        });
    }
    else {
        customerMarker.setPosition(location);
    }
}
function setStaffPosition() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(markStaffPosition);
    }
    else {
        $("map").html("Geolocation is not supported by this browser.");
    }
}
function markStaffPosition(position) {
    var currentLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
    var delivery_id = $("#delivery_id").val();
    if (staffMarker == null) {
        staffMarker = new google.maps.Marker({
            position: currentLocation,
            map: map,
            title: "Your Location"
        });
    }
    else {
        staffMarker.setPosition(currentLocation);
    }
    map.setCenter(currentLocation);
    $.ajax("../php/updateStaffLocation.php", {
        method: "post",
        data: {
            delivery_id: delivery_id,
            longitude: position.coords.longitude,
            latitude: position.coords.latitude
        }
    });
}
