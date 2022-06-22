<?php
//redirectare user catre pagina de logare:
if (!isset($_SESSION['user_id'])) {
    header("location: " . URLROOT . '/users/register');
    exit;
}

require APPROOT . '/views/includes/head.php';
?>

<div id="section-landing">
    <?php
    require APPROOT . '/views/includes/navigation.php';
    ?>

    <div class="wrapper-landing">
        <h1>The more you know,</h1>
        <h2>the more you realize you know nothing.</h2>
    </div>
</div>
