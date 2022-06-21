<?php
//redirectare user catre pagina de logare:
if (!isset($_SESSION['user_id'])) {
    header("location: " . URLROOT . '/users/register');
    exit;
}

require APPROOT . '/views/includes/head.php';
?>
<link rel="stylesheet" href="<?php echo URLROOT ?> /public/css/map.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div id="section-landing">

    <div id="map"></div>

    <?php
    require APPROOT . '/views/includes/navigation.php';
    ?>

    <button class="add-plant">Add nuclear power plant</button>

    <div class="search-container">
        <div>
            <input id="searchInput" type="text" placeholder="Search.." name="search">
            <button id="searchBtn" type="submit"><i class="fa fa-search"></i></button>
        </div>
    </div>

    <!--img src=<?php echo URLROOT . "/public/ppImgs/default.jpg"; ?> id="imgTry" width="200" height="200"-->

    <div class="create-plant-container">
        <div class="create-plant" id="create-plant-info">
            <h1>Create Power Plant</h1>
            <div class="create-plant-form">
                <p id="invalidName">

                </p>
                <input id="input2" type="text" name="nume" placeholder="nume" />

                <p id="invalidReactorCount">

                </p>
                <input id="input3" type="text" name="numar_reactoare" placeholder="numar_reactoare" />

                <p id="invalidReactorPower">

                </p>
                <input id="input4" type="text" name="putere_reactor" placeholder="putere_reactor (GW)" />

                <input id="input5" type="file" name="ppImage" placeholder="image" />
                <button class="place-it">Place it on the map</button>
            </div>
        </div>
    </div>

    <div id="reactor_modal" class="modal">
        <div class="reactor_modal_content">
            <span class="close">&times;</span>
            <h3>Power Plant Info</h3>

            <input id="modal_input1" type="text" name="nume" placeholder="nume" />
            <input id="modal_input2" type="text" name="numar_reactoare" placeholder="numar_reactoare" />
            <input id="modal_input3" type="text" name="putere_reactor" placeholder="putere_reactor" />

            <img src=<?php echo URLROOT . "/public/ppImgs/default.jpg"; ?> id="imgTry" width="200" height="200">

        </div>
    </div>

</div>


<script src="<?php echo URLROOT ?>/public/js/map.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBiYEdMn9-RjmDrpLu6-UbLdB6Er0UZWR0
        &map_ids=451dc5b4c648ff34&callback=initMap">
</script>