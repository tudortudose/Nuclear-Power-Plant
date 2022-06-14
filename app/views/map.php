<?php
require APPROOT . '/views/includes/head.php';
?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/map.css" />

<div id="section-landing">
    <?php
    require APPROOT . '/views/includes/navigation.php';
    ?>


    <div id="map"></div>

</div>

<script>
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: 46.247974047191015,
                lng: 26.7737612614087
            },
            zoom: 13,
            mapId: '451dc5b4c648ff34',
            draggable: true
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBiYEdMn9-RjmDrpLu6-UbLdB6Er0UZWR0
        &map_ids=451dc5b4c648ff34&callback=initMap">
</script>