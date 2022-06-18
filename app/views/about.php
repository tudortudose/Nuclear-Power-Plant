<?php
require APPROOT . '/views/includes/head.php';
?>
<link rel="stylesheet" href="<?php echo URLROOT ?> /public/css/about.css" />

<div id="section-landing">
    <?php
    require APPROOT . '/views/includes/navigation.php';
    ?>

    <div class="wrapper-landing">
        <div class="about_cards">
            <div class="about_card">
                <div class="about_card_content_box">
                    <div class="about_card_content">
                        <h2>Princess Cleopatra<br>
                            <span>Bow before me</span>
                        </h2>
                        <div class="about_card_content_image_box">
                            <img src="<?php echo URLROOT ?> /public/img/ale.jpg">
                        </div>
                    </div>
                </div>
                <div class="about_card_toggle">
                    <span></span>
                </div>
            </div>
            <div class="about_card">
                <div class="about_card_content_box">
                    <div class="about_card_content">
                        <h2>King of the world<br>
                            <span>It's me bitches</span>
                        </h2>
                        <div class="about_card_content_image_box">
                            <img src="<?php echo URLROOT ?> /public/img/me.jpg">
                        </div>
                    </div>
                </div>
                <div class="about_card_toggle">
                    <span></span>
                </div>
            </div>
            <div class="about_card">
                <div class="about_card_content_box">
                    <div class="about_card_content">
                        <h2>P.I.M.P<br>
                            <span>Smoke weed everyday</span>
                        </h2>
                        <div class="about_card_content_image_box">
                            <img src="<?php echo URLROOT ?> /public/img/dos.jpg">
                        </div>
                    </div>
                </div>
                <div class="about_card_toggle">
                    <span></span>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo URLROOT ?>/public/js/about.js"></script>