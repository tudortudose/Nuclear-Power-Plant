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
        <h1>One man's crappy software</h1>
        <h2>is another man's full-time job.</h2>
    </div>
</div>
