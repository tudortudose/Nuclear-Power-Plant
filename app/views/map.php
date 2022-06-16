<?php
require APPROOT . '/views/includes/head.php';
?>
<link rel="stylesheet" href="<?php echo URLROOT ?> /public/css/map.css" />

<div id="section-landing">
    <?php
    require APPROOT . '/views/includes/navigation.php';
    ?>


    <div id="map"></div>

    <button class="add-plant">Add nuclear power plant</button>

    <div class="create-plant-container">
        <div class="form">
            <div class="create-plant" id="create-plant-info">
                <h1>Create Power Plant</h1>
                <div id="create-plant-form">
                    <input type="text" placeholder="Name" />
                    <input type="text" placeholder="Number of reactors" />
                    <input type="text" placeholder="Total power(GW)" />
                    <button class="place-it">Place it on the map</button>
                </div>
            </div>
        </div>
    </div>

</div>


<script src="<?php echo URLROOT ?>/public/js/map.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBiYEdMn9-RjmDrpLu6-UbLdB6Er0UZWR0
        &map_ids=451dc5b4c648ff34&callback=initMap">
</script>