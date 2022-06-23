<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Power Plant Cron Statistics</title>
</head>

<body>

    <script>
        //FOR CHRON JOBS UPDATING CONFIGURATIONS:
        //first get request for health:
        var health;
        var coreTemperature;
        var coolTemperature;
        var powerOutput;
        var powerDemand;
        var xhr1 = new XMLHttpRequest();
        xhr1.withCredentials = false;

        const params = new URLSearchParams(window.location.search);
        var idCentrala = 13; //valoare default pentru id centrala
        if (params.has("id")) {
            idCentrala = params.get("id");
        }

        xhr1.addEventListener("readystatechange", function() {
            if (this.readyState === 4) {
                console.log(this.statusText + ' ' + JSON.parse(this.responseText)[0]);
                health = JSON.parse(this.responseText)[0].reactoare_active;
                health = health > 0 ? health - 1 : 0;
                coreTemperature = JSON.parse(this.responseText)[0].temperatura_nucleu;
                coolTemperature = JSON.parse(this.responseText)[0].putere_racire;
                powerOutput = JSON.parse(this.responseText)[0].putere_energie;
                powerDemand = JSON.parse(this.responseText)[0].putere_ceruta;

                var xhrHealthUpdate = new XMLHttpRequest();
                xhrHealthUpdate.withCredentials = false;
                xhrHealthUpdate.addEventListener("readystatechange", function() {
                    if (this.readyState === 4) {

                    }
                });
                xhrHealthUpdate.open(
                    "PUT",
                    "http://localhost/NuclearGitProject/Nuclear-Power-Plant/states/insert?id_centrala=" +
                    idCentrala + 
                    "&temperatura_nucleu=" +
                    coreTemperature + 
                    "&putere_racire="+
                    coolTemperature +
                    "&putere_produsa=" +
                    powerOutput * coreTemperature * coolTemperature +
                    "&putere_ceruta=" +
                    powerDemand +
                    "&putere_energie=" + 
                    powerOutput + 
                    "&reactoare_active=" +
                    health ,
                    true
                );
                xhrHealthUpdate.setRequestHeader("Content-Type", "application/json");

                xhrHealthUpdate.send();

                //get request for geographic coordinates for weather:
                var latitude;
                var longitude;
                var xhr2 = new XMLHttpRequest();
                xhr2.withCredentials = false;

                xhr2.addEventListener("readystatechange", function() {
                    if (this.readyState === 4) {
                        latitude = JSON.parse(this.responseText).latitude;
                        longitude = JSON.parse(this.responseText).longitude;
                        //console.log('herehere'+latitude+' '+longitude);

                        //console.log(latitude + " " + longitude + "merge");
                        var weather;
                        var xhr3 = new XMLHttpRequest();
                        xhr3.withCredentials = false;

                        xhr3.addEventListener("readystatechange", function() {
                            if (this.readyState === 4) {
                                weather = JSON.parse(this.responseText).current.condition.text;
                                //console.log("herherher" + weather);

                                //then post request with new inputs:
                                var xhr = new XMLHttpRequest();
                                xhr.withCredentials = false;

                                xhr.addEventListener("readystatechange", function() {
                                    if (this.readyState === 4) {
                                        console.log(this.status + " " + this.responseText);
                                    }
                                });

                                xhr.open(
                                    "POST",
                                    "http://localhost/NuclearGitProject/Nuclear-Power-Plant/configurations/insert?id_centrala=" +
                                    idCentrala +
                                    "&reactoare_active=" +
                                    health +
                                    "&temperatura_nucleu=" +
                                    coreTemperature +
                                    "&putere_racire=" +
                                    coolTemperature +
                                    "&putere_produsa=" +
                                    coreTemperature * coolTemperature * powerOutput +
                                    "&putere_ceruta=" +
                                    powerDemand +
                                    "&vreme=" +
                                    weather +
                                    "&putere_energie=" +
                                    powerOutput,
                                    true
                                );
                                xhr.setRequestHeader(
                                    "Content-Type",
                                    "application/x-www-form-urlencoded"
                                );

                                xhr.send();
                            }
                        });

                        xhr3.open(
                            "GET",
                            "http://api.weatherapi.com/v1/current.json?key=ecfaaa0d77c544219a3100819221706&q=" +
                            latitude +
                            "," +
                            longitude +
                            "&aqi=yes"
                        );

                        xhr3.send();
                    }
                });

                xhr2.open(
                    "GET",
                    "http://localhost/NuclearGitProject/Nuclear-Power-Plant/powerplants/getbyid?id=" +
                    idCentrala,
                    true
                );
                xhr2.setRequestHeader("Content-Type", "application/json");

                xhr2.send();
            }
        });

        xhr1.open(
            "GET",
            "http://localhost/NuclearGitProject/Nuclear-Power-Plant/states/central?id=" +
            idCentrala,
            true
        );
        xhr1.setRequestHeader("Content-Type", "application/json");

        xhr1.send();
    </script>

</body>

</html>