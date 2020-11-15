var map;
var customerMarker;
var staffMarker;
var geocoder;
var directionService;
var directionRender;
function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 0, lng: 0 },
        zoom: 16,
        streetViewControl: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    directionService = new google.maps.DirectionsService();
    geocoder = new google.maps.Geocoder();
    directionRender = new google.maps.DirectionsRenderer({ map: map });
}
function setCustomerLocation() {
    var location = $("#location").text();
    geocoder.geocode({ address: location }, markCustomerPosition);
}
function markCustomerPosition(result, status) {
    var location = result[0].geometry.location;
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
function markStaffPosition(position) {
    var currentLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
    var delivery_id = $("#delivery_id").val();
    if (staffMarker == null) {
        staffMarker = new google.maps.Marker({
            position: currentLocation,
            map: map,
            title: "Staff Location"
        });
    }
    else {
        staffMarker.setPosition(currentLocation);
    }
    $.ajax("../php/updateStaffLocation.php", {
        method: "post",
        data: {
            delivery_id: delivery_id,
            longitude: position.coords.longitude,
            latitude: position.coords.latitude
        }
    });
}
function calcRoute() {
    if (staffMarker != null && customerMarker != null) {
        staffMarker.setMap(null);
        customerMarker.setMap(null);
        var start = staffMarker.getPosition();
        var end = customerMarker.getPosition();
        var request = {
            origin: start,
            destination: end,
            travelMode: google.maps.TravelMode.DRIVING,
            optimizeWaypoints: true,
            unitSystem: google.maps.UnitSystem.METRIC,
            provideRouteAlternatives: true,
            avoidFerries: true,
        };
        directionService.route(request, function (result, status) {
            if (status == 'OK') {
                directionRender.setDirections(result);
            }
        });
    }
}
$(function () {
    initMap();
    setCustomerLocation();
    update();
});
function update() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(markStaffPosition);
    }
    else {
        $("map").html("Geolocation is not supported by this browser.");
    }
    setTimeout(calcRoute, 1000);
    setTimeout(update, 10000);
}
