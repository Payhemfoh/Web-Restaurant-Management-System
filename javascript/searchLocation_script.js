import { errorModal } from "./errorFunction.js";
var map;
var marker;
var geocoder;
var location_id;
var location_address;
$(function () {
    geocoder = new google.maps.Geocoder();
    initMap();
    $("#btn_setLocation").on("click", function (e) {
        e.preventDefault();
        getLocation(markCurrentPosition);
    });
    $("#location").on("input", function () { geocoder.geocode({ address: $("#location").val() }, searchLocation); });
    $("#submit-address").on("click", function (e) {
        e.preventDefault();
        $.ajax("../php/setAddress.php", {
            method: 'post',
            dataType: 'html',
            data: {
                location_id: location_id,
                location_address: location_address
            },
            success: function () {
                var content = $("body").html();
                content += "<form id='form' action='../webpage/deliveryStatus.php'></form>";
                $("body").html(content);
                $("#form").trigger("submit");
            },
            error: errorModal
        });
    });
});
function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 0, lng: 0 },
        zoom: 15,
        streetViewControl: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    map.addListener("click", function (e) {
        markClickedPosition(e.latLng);
    });
    getLocation(showPosition);
    getLocation(markCurrentPosition);
}
function getLocation(func) {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(func);
    }
    else {
        console.log("Geolocation is not supported by this browser");
    }
}
function showPosition(position) {
    var point = { lat: position.coords.latitude,
        lng: position.coords.longitude };
    map.setCenter(point);
}
function markCurrentPosition(position) {
    var location = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
    };
    map.setCenter(location);
    if (marker == null) {
        marker = new google.maps.Marker({
            position: location,
            map: map,
            title: "Your Location",
            draggable: true,
            animation: google.maps.Animation.BOUNCE
        });
    }
    else {
        marker.setPosition(location);
        marker.setAnimation(google.maps.Animation.BOUNCE);
    }
    setTimeout(function () { return marker.setAnimation(null); }, 500);
    geocoder.geocode({ location: location }, getAddress);
}
function markClickedPosition(position) {
    if (marker == null) {
        marker = new google.maps.Marker({
            position: position,
            map: map,
            title: "Your Location",
            draggable: true,
            animation: google.maps.Animation.BOUNCE
        });
    }
    else {
        marker.setPosition(position);
        marker.setAnimation(google.maps.Animation.BOUNCE);
    }
    setTimeout(function () { return marker.setAnimation(null); }, 500);
    geocoder.geocode({ location: position }, getAddress);
}
function getAddress(result, status) {
    if (status === 'OK') {
        $("#location").val(result[0].formatted_address);
        location_id = result[0].place_id;
        location_address = result[0].formatted_address;
    }
    else {
        alert("Failed to find the address of the location.");
    }
}
function searchLocation(result, status) {
    if (status === 'OK') {
        var position = result[0].geometry.location;
        if (marker == null) {
            marker = new google.maps.Marker({
                position: position,
                map: map,
                title: "Your Location",
                draggable: true,
                animation: google.maps.Animation.BOUNCE
            });
        }
        else {
            marker.setPosition(position);
            marker.setAnimation(google.maps.Animation.BOUNCE);
        }
        location_id = result[0].place_id;
        location_address = $("#location").val();
        map.setCenter(position);
        setTimeout(function () { return marker.setAnimation(null); }, 500);
    }
}
