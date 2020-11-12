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
function markStaffPosition(position) {
    if (staffMarker == null) {
        staffMarker = new google.maps.Marker({
            position: position,
            map: map,
            title: "Staff Location"
        });
    }
    else {
        staffMarker.setPosition(position);
    }
}
function setStaffPosition() {
    var delivery_id = $("#delivery_id").val();
    $.ajax("../php/getStaffLocation.php", {
        method: "post",
        dataType: "json",
        data: {
            id: delivery_id
        },
        success: function (data) {
            if (data.longitude != null && data.latitude != null) {
                markStaffPosition(new google.maps.LatLng(data.longitude, data.latitude));
            }
        }
    });
}
