<?php
//redirectare user catre pagina de logare:
if (!isset($_SESSION['user_id'])) {
    header("location: " . URLROOT . '/users/register');
    exit;
}
header("Cache-Control: max-age=31536000");
require APPROOT . '/views/includes/head.php';
?>
<link rel="stylesheet" href="<?php echo URLROOT ?> /public/css/reactor.css" />

<div id="section-landing">
    <?php
    require APPROOT . '/views/includes/navigation.php';
    ?>
    <div class="reactor_container">
        <div class="reactor_container_image">
            <!-- <img alt="powerplant_running" id="reactor_container_image_pp" src="<?php echo URLROOT ?> /public/img/pp.gif"> -->
            <video id="reactor_container_image_pp" autoplay loop muted playsinline>
                <source src="<?php echo URLROOT ?> /public/img/pp.webm" type="video/webm">
                <source src="<?php echo URLROOT ?> /public/img/pp.mpeg" type="video/mpeg">
            </video>
        </div>

        <div class="reactor_panel">
            <div class="reactor_control">
                <div class="reactor_wrapper_input">
                    <div class="reactor_input_label icon">&#10052;</div>
                    <div class="reactor_input_label low">Low</div>
                    <div class="slidershell" id="slidershell1">
                        <div class="slidertrack" id="slidertrack1"></div>
                        <div class="sliderfill" id="sliderfill1"></div>

                        <div class="sliderthumb" id="sliderthumb1"></div>

                        <input class="slider" id="slider1" type="range" min="0" max="100" value="0" oninput="showValue(value,1);" onchange="showValue(value,1);" />
                        <label for="slider1">Input cooling power</label>
                    </div>
                    <div class="reactor_input_label high">High Power</div>
                </div>
                <div class="reactor_wrapper_input">
                    <div class="reactor_input_label icon">&#9762;</div>
                    <div class="reactor_input_label low">Low</div>
                    <div class="slidershell" id="slidershell2">
                        <div class="slidertrack" id="slidertrack2"></div>
                        <div class="sliderfill" id="sliderfill2"></div>

                        <div class="sliderthumb" id="sliderthumb2"></div>

                        <input class="slider" id="slider2" type="range" min="0" max="100" value="0" oninput="showValue(value,2);" onchange="showValue(value,2);" />
                        <label for="slider2">Input core temperature</label>
                    </div>
                    <div class="reactor_input_label high">High Power</div>
                </div>
                <div class="reactor_wrapper_input">
                    <div class="reactor_input_label icon">&#9788;</div>
                    <div class="reactor_input_label low">Low</div>
                    <div class="slidershell" id="slidershell3">
                        <div class="slidertrack" id="slidertrack3"></div>
                        <div class="sliderfill" id="sliderfill3"></div>

                        <div class="sliderthumb" id="sliderthumb3"></div>

                        <input class="slider" id="slider3" type="range" min="0" max="100" value="0" oninput="showValue(value,3);" onchange="showValue(value,3);" />
                        <label for="slider3">Input energy output</label>
                    </div>
                    <div class="reactor_input_label high">High Power</div>
                </div>
                <svg>
                    <defs>
                        <filter id="goo1">
                            <feGaussianBlur id="blur1" in="SourceGraphic" result="blur1" stdDeviation="10" />
                            <feColorMatrix in="blur1" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 26 -9.5" result="goo" />
                        </filter>
                        <filter id="goo2">
                            <feGaussianBlur id="blur2" in="SourceGraphic" result="blur2" stdDeviation="10" />
                            <feColorMatrix in="blur2" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 26 -9.5" result="goo" />
                        </filter>
                        <filter id="goo3">
                            <feGaussianBlur id="blur3" in="SourceGraphic" result="blur3" stdDeviation="10" />
                            <feColorMatrix in="blur3" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 26 -9.5" result="goo" />
                        </filter>
                    </defs>
                </svg>
            </div>
            <div class="reactor_additional">
                <div class="reactor_additional_input">
                    <input type="number" id="nuclear_demand" required class="input">
                    <label for="nuclear_demand" class="reactor_additional_input_label">Power Demand</label>
                </div>
                <div class="reactor_button_container">
                    <h2>Initiate &rarr;</h2>
                    <!-- <button onclick="location.href='<?php //echo URLROOT 
                                                            ?>/index';" class="reactor_button_plus" id="reactor_btn"></button> -->
                    <button aria-label="initiate_configuration" class="reactor_button_plus" id="reactor_btn"></button>
                </div>
            </div>
        </div>
    </div>
    <div id="reactor_modal" class="modal">
        <div class="reactor_modal_content">
            <span class="close">&times;</span>
            <p>Monitoring current nuclear power-plant..</p>
            <canvas id="weather_chart"></canvas><br>
            <button aria-label="export_weather" id="weather_chart_export">
                Export to PNG
            </button><br>
            <canvas id="reactor_config_chart"></canvas><br>
            <button aria-label="export_config" id="reactor_config_chart_export">
                Export to PNG
            </button><br>
            <canvas id="efficiency_chart"></canvas><br>
            <button aria-label="export_efficiency" id="efficiency_chart_export">
                Export to PNG
            </button><br>
            <canvas id="health_chart"></canvas><br>
            <button aria-label="export_health" id="health_chart_export">
                Export to PNG
            </button><br>
        </div>
    </div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>
<script src="<?php echo URLROOT ?>/public/js/reactor.js">
</script>