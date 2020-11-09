import {} from "googlemaps";

let map : google.maps.Map;
let marker : google.maps.Marker;
let geocoder : google.maps.Geocoder;

$(function(){
    initMap();
});

function initMap():void{
    map = new google.maps.Map(document.getElementById("map") as HTMLElement,{
            center:{lat:0,lng:0},
            zoom:15,
            streetViewControl:false,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        });
    getLocation(showPosition);
    getLocation(markCurrentPosition);
}

function getLocation(func :PositionCallback): void{
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(func);
    }else{
        console.log("Geolocation is not supported by this browser");
    }
}

function showPosition(position: Position):void{
    let point = {lat:position.coords.latitude,
            lng:position.coords.longitude};
    map.setCenter(point);
}

function markCurrentPosition(position: Position):void{
    let location = {
                    lat:position.coords.latitude,
                    lng:position.coords.longitude
                };
    
    map.setCenter(location);
    
    if(marker == null){
        marker = new google.maps.Marker({
            position:location,
            map:map,
            title:"Your Location",
            animation:google.maps.Animation.BOUNCE
        });
    }else{
        marker.setPosition(location);
        marker.setAnimation(google.maps.Animation.BOUNCE);
    }

    setTimeout(()=>marker.setAnimation(null),500);
}

