import {} from "googlemaps";

let map : google.maps.Map;

$(function(){
    initMap();
});

function initMap():void{

    map = new google.maps.Map(document.getElementById("map") as HTMLElement,{
            center:{lat:0,lng:0},
            zoom:15
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

    const marker = new google.maps.Marker({
        position:location,
        map:map,
        title:"Your Current Location"
    })
}

