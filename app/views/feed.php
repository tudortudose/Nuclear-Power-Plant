<?php
    $db = new Database;
    $db->query('SELECT id, name, reactorCount, reactorPower, altitude, latitude, longitude FROM power_plants');
    $result = $db->resultSetAssoc();

    header( "Content-type: text/xml");
    
    echo "<?xml version='1.0' encoding='UTF-8'?>
    <rss version='2.0'>
    <channel>
    <title></title>
    <link></link>
    <description></description>";

    foreach($result as $row){
        $id = $row['id'];
        $name = $row['name'];
        $reactorCount = $row['reactorCount'];
        $reactorPower = $row['reactorPower'];
        $altitude = $row['altitude'];
        $latitude = $row['latitude'];
        $longitude = $row['longitude'];

        $db->query("SELECT putere_racire, putere_energie, temperatura_nucleu, putere_ceruta, putere_produsa FROM pp_states 
                    WHERE id_centrala = :id");
        $db->bind(':id', $id);

        $resultPowerPlant = $db->single();

        //echo "<script>console.log('Debug Objects 2: " . $resultPowerPlant->putere_racire . "' );</script>";

        if ($resultPowerPlant !== false && $resultPowerPlant->num_rows > 0){
            $putere_racire = $resultPowerPlant->putere_racire;
            $putere_energie = $resultPowerPlant->putere_enrgie;
            $temperatura_nucleu = $resultPowerPlant->temperatura_nucleu;
            $putere_ceruta = $resultPowerPlant->putere_ceruta;
            $putere_produsa = $resultPowerPlant->putere_produsa;
        }
        else{
            $putere_racire = "unknown";
            $putere_energie = "unknown";
            $temperatura_nucleu = "unknown";
            $putere_ceruta = "unknown";
            $putere_produsa = "unknown";
        }

        $photo = "'http://localhost/NuclearGitProject/Nuclear-Power-Plant/public/ppImgs/" . $name . ".jpg'";


        echo "<item>
        <title>$name</title>
        <link></link>
        <description>
            <p> 
            Numarul reactoarelor centralei: " . $reactorCount . " <br />
            Puterea unui reactor: " . $reactorPower . " <br />
            Altitudinea centralei: " . $altitude . " <br />
            Latitudine: " . $latitude . " <br />
            Longitude: " . $longitude . " <br /> 
            Putere racire: " . $putere_racire . " <br /> 
            Putere energie: " . $putere_energie . " <br /> 
            Temperatura nucleu: " . $temperatura_nucleu . " <br /> 
            Putere ceruta: " . $putere_ceruta . " <br /> 
            Putere produsa: " . $putere_produsa . " <br /> 
            </p>
        <img alt='' border='0' src=" . $photo . "
        width='1' height='1' />
        </description>
        </item>";
    }

    echo "</channel></rss>";