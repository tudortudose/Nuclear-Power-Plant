<?php
    $db = new Database;
    $db->query('SELECT name, reactorCount, reactorPower, altitude, latitude, longitude FROM power_plants');
    $result = $db->resultSetAssoc();

    header( "Content-type: text/xml");
    
    echo "<?xml version='1.0' encoding='UTF-8'?>
    <rss version='2.0'>
    <channel>
    <name></name>
    <reactorCount></reactorCount>
    <reactorPower></reactorPower>
    <altitude></altitude>
    <latitude></latitude>
    <longetitude></longetitude>
    <language>en-us</language>";

    foreach($result as $row){
        $name = $row['name'];
        $reactorCount = $row['reactorCount'];
        $reactorPower = $row['reactorPower'];
        $altitude = $row['altitude'];
        $latitude = $row['laltitude'];
        $longitude = $row['longitude'];

        
        echo "<item>
        <name>$name</name>
        <reactorCount>$reactorCount</reactorCount>
        <reactorPower>$reactorPower</reactorPower>
        <altitude>$altitude</altitude>
        <latitude>$latitude</latitude>
        <longetitude>$longitude</longetitude>
            </item>";
    }

    echo "</channel></rss>";