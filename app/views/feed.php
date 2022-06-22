<?php
    $db = new Database;
    $db->query('SELECT name, reactorCount, reactorPower, altitude, latitude, longitude FROM power_plants');
    $result = $db->resultSetAssoc();

    header( "Content-type: text/xml");
    
    echo "<?xml version='1.0' encoding='UTF-8'?>
    <rss version='2.0'>
    <channel>
    <title></title>
    <link></link>
    <link></description>";

    foreach($result as $row){
        $name = $row['name'];
        $reactorCount = $row['reactorCount'];
        $reactorPower = $row['reactorPower'];
        $altitude = $row['altitude'];
        $latitude = $row['laltitude'];
        $longitude = $row['longitude'];

        $photo = "'http://localhost/NuclearGitProject/Nuclear-Power-Plant/public/ppImgs/" . $name . ".jpg'";

        echo "<item>
        <title>$name</title>
        <link></link>
        <description>
        <img alt='' border='0' src=" . $photo . "
        width='1' height='1' />
        </description>";
    }

    echo "</channel></rss>";