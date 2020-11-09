import {} from "googlemaps";

let map : google.maps.Map;
let marker : google.maps.Marker;

$(function(){
    initMap();

    $("#btn_setLocation").on("click",(e)=>{
        e.preventDefault();
        getLocation(markCurrentPosition);
    });

    
});

function initMap():void{
    map = new google.maps.Map(document.getElementById("map") as HTMLElement,{
            center:{lat:0,lng:0},
            zoom:15,
        });
    map.addListener("click",(e)=>{
        markClickedPosition(e.latLng);
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
            draggable:true,
            animation:google.maps.Animation.BOUNCE
        });
    }else{
        marker.setPosition(location);
        marker.setAnimation(google.maps.Animation.BOUNCE);
    }

    setTimeout(()=>marker.setAnimation(null),500);
}

function markClickedPosition(position: google.maps.LatLng):void{

    if(marker == null){
        marker = new google.maps.Marker({
            position:position,
            map:map,
            title:"Your Location",
            draggable:true,
            animation:google.maps.Animation.BOUNCE
        });
    }else{
        marker.setPosition(position);
        marker.setAnimation(google.maps.Animation.BOUNCE);
    }

    setTimeout(()=>marker.setAnimation(null),500);
}

