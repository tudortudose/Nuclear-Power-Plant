<?php
require APPROOT . '/views/includes/head.php';
?>
<link rel="stylesheet" href="<?php echo URLROOT ?> /public/css/reactor.css" />

<div id="section-landing">
    <?php
    require APPROOT . '/views/includes/navigation.php';
    ?>
    <div class="reactor_container">
        <div class="reactor_container_image">
            <img src="<?php echo URLROOT ?> /public/img/pp.gif">
        </div>

        <div class="reactor_panel">
            <div class="reactor_control">
                <div class="reactor_wrapper_input">
                    <div class="reactor_input_label low">Low Power</div>
                    <div class="slidershell" id="slidershell1">
                        <div class="slidertrack" id="slidertrack1"></div>
                        <div class="sliderfill" id="sliderfill1"></div>

                        <div class="sliderthumb" id="sliderthumb1"></div>

                        <input class="slider" id="slider1" type="range" min="0" max="100" value="0" oninput="showValue(value,1);" onchange="showValue(value,1);" />
                    </div>
                    <div class="reactor_input_label high">High Power</div>
                </div>
                <div class="reactor_wrapper_input">
                    <div class="reactor_input_label low">Low Power</div>
                    <div class="slidershell" id="slidershell2">
                        <div class="slidertrack" id="slidertrack2"></div>
                        <div class="sliderfill" id="sliderfill2"></div>

                        <div class="sliderthumb" id="sliderthumb2"></div>

                        <input class="slider" id="slider2" type="range" min="0" max="100" value="0" oninput="showValue(value,2);" onchange="showValue(value,2);" />
                    </div>
                    <div class="reactor_input_label high">High Power</div>
                </div>
                <div class="reactor_wrapper_input">
                    <div class="reactor_input_label low">Low Power</div>
                    <div class="slidershell" id="slidershell3">
                        <div class="slidertrack" id="slidertrack3"></div>
                        <div class="sliderfill" id="sliderfill3"></div>

                        <div class="sliderthumb" id="sliderthumb3"></div>

                        <input class="slider" id="slider3" type="range" min="0" max="100" value="0" oninput="showValue(value,3);" onchange="showValue(value,3);" />
                    </div>
                    <div class="reactor_input_label high">High Power</div>
                </div>
                <svg>
                    <defs>
                        <filter id="goo">
                            <feGaussianBlur id="blur" in="SourceGraphic" result="blur" stdDeviation="10" />
                            <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 26 -9.5" result="goo" />
                        </filter>
                    </defs>
                </svg>
            </div>
            <div class="reactor_additional">
                <div class="reactor_button_container">
                    <h2>Initiate &rarr;</h2>
                    <button onclick="location.href='<?php echo URLROOT ?>/index';" class="reactor_button_plus"></button>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="<?php echo URLROOT ?>/public/js/reactor.js">
</script>