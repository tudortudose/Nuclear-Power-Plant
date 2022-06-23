<?php
//redirectare user catre pagina de logare:
if (!isset($_SESSION['user_id'])) {
    header("location: " . URLROOT . '/users/register');
    exit;
}

require APPROOT . '/views/includes/head.php';
?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/map.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div id="section-landing">

    <div id="map"></div>

    <?php
    require APPROOT . '/views/includes/navigation.php';
    ?>

    <button aria-label="add-nuclear-plant" class="add-plant">Add nuclear power plant</button>

    <div class="search-container">
        <div>
            <input id="searchInput" type="text" placeholder="Search.." name="search">
            <button aria-label="search-nuclear-plant" id="searchBtn" type="submit"><i class="fa fa-search"></i></button>
        </div>
    </div>

    <!--img src=<?php echo URLROOT . "/public/ppImgs/default.jpg"; ?> id="imgTry" width="200" height="200"-->

    <div class="create-plant-container">
        <div class="create-plant" id="create-plant-info">
            <h1>Create <br> Power Plant</h1>
            <div class="create-plant-form">
                <p id="invalidName">

                </p>
                <input id="input2" type="text" name="name" placeholder="name" />

                <p id="invalidReactorCount">

                </p>
                <input id="input3" type="text" name="number_of_reactors" placeholder="number_of_reactors" />

                <p id="invalidReactorPower">

                </p>
                <input id="input4" type="text" name="reactor_power" placeholder="reactor_power (GW)" />

                <input id="input5" type="file" name="ppImage" />
                <button aria-label="place-nuclear-on-map" class="place-it">Place it on the map</button>
            </div>
        </div>
    </div>

    <div id="reactor_modal" class="modal">
        <div class="reactor_modal_content">
            <span class="close">&times;</span>
            <h1>Power Plant Info</h1>

            <input id="modal_input4" type="text" name="id" placeholder="id" readonly="readonly" />
            <input id="modal_input5" type="text" name="author_id" placeholder="author_id" readonly="readonly" />
            <p id="modal_invalidName">
            </p>
            <input id="modal_input1" type="text" name="name" placeholder="name" readonly="readonly" />
            <p id="modal_invalidReactorCount">
            </p>
            <input id="modal_input2" type="text" name="number_of_reactors" placeholder="number_of_reactors" readonly="readonly" />
            <p id="modal_invalidReactorPower">
            </p>
            <input id="modal_input3" type="text" name="reactor_power" placeholder="reactor_power" readonly="readonly" />
            <img src=<?php echo URLROOT . "/public/ppImgs/default.jpg"; ?> id="modalImg" width="200" height="200">

            <button aria-label="delete-nuclear-pp" id="modal_delete">Delete</button>
            <button aria-label="save-nuclear-pp" id="modal_edit_save">Edit</button>
            <button aria-label="config-page-pp" id="modal_config">Configuration</button>
        </div>
    </div>

</div>


<script src="<?php echo URLROOT ?>/public/js/map.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBiYEdMn9-RjmDrpLu6-UbLdB6Er0UZWR0&map_ids=451dc5b4c648ff34&callback=initMap">
</script>