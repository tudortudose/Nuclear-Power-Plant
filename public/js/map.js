let add_button = document.getElementsByClassName("add-plant")[0];
let add_button_pressed = false;
let create_plant = document.getElementsByClassName("create-plant-container")[0];
let place_it = document.getElementsByClassName("place-it")[0];
let can_place = false;
let map;

let searchInput = document.getElementById("searchInput");
let searchBtn = document.getElementById("searchBtn");

let name = document.getElementById("input2");
let reactorCount = document.getElementById("input3");
let reactorPower = document.getElementById("input4");
let image = document.getElementById("input5");

let invalidName = document.getElementById("invalidName");
let invalidReactorCount = document.getElementById("invalidReactorCount");
let invalidReactorPower = document.getElementById("invalidReactorPower");

let altitudeErrorInfoWindow = null;

let markerList = [];
let infoWindowList = [];

display_pps();

searchBtn.addEventListener("click", () => {
    let searchText = searchInput.value;
    console.log(searchText);
    for (let i = 0; i < markerList.length; i++) {
        if (markerList[i].title == searchText) {

            map.setOptions({
                center: markerList[i].position,
                zoom: 7
            });
            infoWindowList[i].open(map, markerList[i]);
        }
    }
});

add_button.addEventListener("click", () => {
    if (add_button_pressed)
        create_plant.style.visibility = "hidden";
    else
        create_plant.style.visibility = "visible";
    add_button_pressed = !add_button_pressed;
});

place_it.addEventListener("click", () => {
    verifyInput();
});

function verifyPpName() {
    var xhr = new XMLHttpRequest();
    xhr.withCredentials = false;

    xhr.addEventListener("readystatechange", function() {
        if (this.readyState === 4) {
            let response = this.responseText;
            if (response == 'false') {
                can_place = true;
                create_plant.style.visibility = "hidden";
                add_button_pressed = false;
            } else {
                invalidName.innerHTML = 'This name already exists!';
            }
        }
    });

    xhr.open("GET", "http://localhost/NuclearGitProject/Nuclear-Power-Plant/powerplants/getByName?name=" + name.value);

    xhr.send();
}

function verifyInput() {
    let ok = 1;
    invalidName.innerHTML = '';
    invalidReactorCount.innerHTML = '';
    invalidReactorPower.innerHTML = '';
    if (name.value == '') {
        invalidName.innerHTML = 'This field is required!';
        console.log('here')
        ok = 0;
    }
    if (reactorCount.value == '') {
        invalidReactorCount.innerHTML = 'This field is required!';
        ok = 0;
    }
    if (reactorPower.value == '') {
        invalidReactorPower.innerHTML = 'This field is required!';
        ok = 0;
    }
    if (ok == 0) return false;

    if (isNaN(parseFloat(reactorCount.value))) {
        console.log(parseFloat(reactorCount.value));
        invalidReactorCount.innerHTML = 'This should be a number!';
        ok = 0;
    }

    if (isNaN(parseFloat(reactorPower.value))) {
        invalidReactorPower.innerHTML = 'This should be a number!';
        ok = 0;
    }
    if (ok == 0) return false;

    verifyPpName();
}

function display_pps() {
    var xhr = new XMLHttpRequest();
    xhr.withCredentials = false;

    xhr.addEventListener("readystatechange", function() {
        if (this.readyState === 4) {
            var results = JSON.parse(this.responseText);

            results.forEach(e => {
                console.log("author:" + e.author_id);
                constructPowerPlant(e.latitude, e.longitude, e.name);
            });
        }
    });

    xhr.open("GET", "http://localhost/NuclearGitProject/Nuclear-Power-Plant/powerplants/getAll");

    xhr.send();
}

function constructPowerPlant(lat, lng, ppName) {
    const marker = new google.maps.Marker({
        position: { lat: lat, lng: lng },
        map,
        draggable: true,
        title: ppName,
        icon: {
            url: "http://localhost/NuclearGitProject/Nuclear-Power-Plant/public/img/plant.png",
            scaledSize: new google.maps.Size(40, 35)
        },
        animation: google.maps.Animation.DROP
    });

    const infowindow = new google.maps.InfoWindow({
        content: "My power " + ppName,
    });

    marker.addListener("click", () => {
        infowindow.open(map, marker);
    });

    marker.addListener("dblclick", () => {
        window.location.href = "http://localhost/NuclearGitProject/Nuclear-Power-Plant/Pages/ppInfo?name=" + ppName;
    });

    markerList.push(marker);

    infoWindowList.push(infowindow);
}

function getInsertParams(alt, lat, lng) {
    let params = "";

    params += 'name=';
    params += name.value;
    params += '&';

    params += 'reactorCount=';
    params += reactorCount.value;
    params += '&';

    params += 'reactorPower=';
    params += reactorPower.value;
    params += '&';

    params += 'altitude=';
    params += alt;
    params += '&';

    params += 'latitude=';
    params += lat;
    params += '&';

    params += 'longitude=';
    params += lng;

    return params;
}

function sendInsertReq(alt, lat, lng) {
    var xhr = new XMLHttpRequest();
    xhr.withCredentials = false;

    xhr.addEventListener("readystatechange", function() {
        if (this.readyState === 4) {
            constructPowerPlant(lat, lng, name.value);
        }
    });

    xhr.open("POST", "http://localhost/NuclearGitProject/Nuclear-Power-Plant/powerplants/insert?" + getInsertParams(alt, lat, lng), true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.send();
}

function setAltitude(lat, lng) {
    var xhr = new XMLHttpRequest();
    xhr.withCredentials = false;

    xhr.addEventListener("readystatechange", function() {
        if (this.readyState === 4) {
            let alt = JSON.parse(this.responseText).results[0].elevation;
            console.log("ALtitude is " + alt);
            if (alt == '0') {

                if (altitudeErrorInfoWindow != null) {
                    altitudeErrorInfoWindow.setOptions({
                        position: { lat: lat, lng: lng }
                    });
                    altitudeErrorInfoWindow.open(map);
                } else {
                    altitudeErrorInfoWindow = new google.maps.InfoWindow({
                        content: "You can't place pp on water!",
                        position: { lat: lat, lng: lng }
                    });
                    altitudeErrorInfoWindow.open(map);
                }
            } else {
                if (altitudeErrorInfoWindow != null) {
                    altitudeErrorInfoWindow.close();
                }
                can_place = false;
                sendInsertReq(alt, lat, lng);
            }
        }
    });

    xhr.open("GET", "https://api.open-elevation.com/api/v1/lookup?locations=" +
        lat + "," + lng, true);

    xhr.send();
}

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 7,
        center: { lat: 46.247974047191015, lng: 26.7737612614087 },
        mapTypeId: "terrain",
    });
    let infowindow = new google.maps.InfoWindow({});

    infowindow.open(map);
    infowindow.setPosition({ lat: 46.247974047191015, lng: 26.7737612614087 });
    infowindow.setContent("<p>Hello</p> <p>this</p> is me  ewas");

    // Add a listener for the click event. Display the elevation for the LatLng of
    // the click inside the infowindow.
    map.addListener("click", (mapsMouseEvent) => {
        if (can_place) {
            setAltitude(mapsMouseEvent.latLng.lat(), mapsMouseEvent.latLng.lng());
        }
    });
}

window.initMap = initMap;