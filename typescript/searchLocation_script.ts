import {} from "googlemaps";
import { errorModal } from "./errorFunction.js";

let map : google.maps.Map;
let marker : google.maps.Marker;
let geocoder : google.maps.Geocoder;
let location_id : string;
let location_address : string;

$(function(){
    geocoder = new google.maps.Geocoder();
    initMap();

    $("#btn_setLocation").on("click",(e)=>{
        e.preventDefault();
        getLocation(markCurrentPosition);
    });

    $("#location").on("input",()=>{geocoder.geocode({address:($("#location").val() as string)},searchLocation)});

    $("#submit-address").on("click",(e)=>{
        e.preventDefault();

        $.ajax("../php/setAddress.php",{
            method:'post',
            dataType:'html',
            data:{
                location_id:location_id,
                location_address:location_address
            },
            success:()=>{
                let content = $("body").html();
                content += `<form id='form' action='../webpage/deliveryStatus.php'></form>`;
                
                $("body").html(content);
                $("#form").trigger("submit");
                
            },
            error:errorModal
        })
    })
});

function initMap():void{
    map = new google.maps.Map(document.getElementById("map") as HTMLElement,{
            center:{lat:0,lng:0},
            zoom:15,
            streetViewControl:false,
            mapTypeId:google.maps.MapTypeId.ROADMAP
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
    geocoder.geocode({ location:location },getAddress);
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
    geocoder.geocode({location:position},getAddress);
}

function getAddress(result : google.maps.GeocoderResult[],status:google.maps.GeocoderStatus) : void{
    if(status === 'OK'){
        $("#location").val(result[0].formatted_address);

        location_id = result[0].place_id;
        location_address = result[0].formatted_address;
    }else{
        alert("Failed to find the address of the location.");
    }
}


function searchLocation(result : google.maps.GeocoderResult[],status:google.maps.GeocoderStatus) : void{
    if(status === 'OK'){
        let position = result[0].geometry.location;
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

        location_id = result[0].place_id;
        location_address = $("#location").val() as string;
        map.setCenter(position);
    
        setTimeout(()=>marker.setAnimation(null),500);
    }
}