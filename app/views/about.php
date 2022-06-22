<?php
require APPROOT . '/views/includes/head.php';
?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/about.css" />

<div id="section-landing">
    <?php
    require APPROOT . '/views/includes/navigation.php';
    ?>

    <div class="wrapper_about_landing">
        <div class="about_cards">
            <div class="about_card">
                <div class="about_card_content_box">
                    <div class="about_card_content">
                        <h2>Ungureanu Alexandra<br>
                            <span>Nuclear Senior Reactor Operator</span>
                        </h2>
                        <div class="about_card_content_image_box">
                            <img src="<?php echo URLROOT ?>/public/img/ale.jpg" alt="Alexandra">
                        </div>
                        <div class="about_card_form">
                            <div class="about_card_form_email">
                                <input type="text" id="about_card_email_input1" required class="about_card_email">
                                <label for="about_card_email_input1" class="about_card_email_input_label">Email from</label>
                            </div><br><br><br>
                            <div class="about_card_form_email">
                                <input type="text" id="about_card_title_input1" required class="about_card_email">
                                <label for="about_card_title_input1" class="about_card_email_input_label">Title</label>
                            </div><br><br><br>
                            <div class="about_card_form_email">
                                <input type="text" id="about_card_message_input1" required class="about_card_email">
                                <label for="about_card_message_input1" class="about_card_email_input_label">Message</label>
                            </div>
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
                        <h2>Pricop Tudor<br>
                            <span>Nuclear Systems Engineer</span>
                        </h2>
                        <div class="about_card_content_image_box">
                            <img src="<?php echo URLROOT ?>/public/img/me.jpg" alt="TudorP">
                        </div>
                        <div class="about_card_form">
                            <div class="about_card_form_email">
                                <input type="text" id="about_card_email_input2" required class="about_card_email">
                                <label for="about_card_email_input2" class="about_card_email_input_label">Email from</label>
                            </div><br><br><br>
                            <div class="about_card_form_email">
                                <input type="text" id="about_card_title_input2" required class="about_card_email">
                                <label for="about_card_title_input2" class="about_card_email_input_label">Title</label>
                            </div><br><br><br>
                            <div class="about_card_form_email">
                                <input type="text" id="about_card_message_input2" required class="about_card_email">
                                <label for="about_card_message_input2" class="about_card_email_input_label">Message</label>
                            </div>
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
                        <h2>Tudose Tudor<br>
                            <span>Radiation Maintenance Expert</span>
                        </h2>
                        <div class="about_card_content_image_box">
                            <img src="<?php echo URLROOT ?>/public/img/dos.jpg" alt="TudorT">
                        </div>
                        <div class="about_card_form">
                            <div class="about_card_form_email">
                                <input type="text" id="about_card_email_input3" required class="about_card_email">
                                <label for="about_card_email_input3" class="about_card_email_input_label">Email from</label>
                            </div><br><br><br>
                            <div class="about_card_form_email">
                                <input type="text" id="about_card_title_input3" required class="about_card_email">
                                <label for="about_card_title_input3" class="about_card_email_input_label">Title</label>
                            </div><br><br><br>
                            <div class="about_card_form_email">
                                <input type="text" id="about_card_message_input3" required class="about_card_email">
                                <label for="about_card_message_input3" class="about_card_email_input_label">Message</label>
                            </div>
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