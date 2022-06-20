<nav class="top-nav">
    <div class='pulse'>
        <div class='pulse_bar'></div>
        <div class='pulse_bar'></div>
        <div class='pulse_bar'></div>
        <div class='pulse_bar'></div>
        <div class='pulse_bar'></div>
        <div class='pulse_bar'></div>
        <div class='pulse_bar'></div>
        <div class='pulse_bar'></div>
        <div class='pulse_bar'></div>
        <div class='pulse_bar'></div>
    </div>
    <ul>
        <li>
            <a href="<?php echo URLROOT; ?>/index">Home</a>
        </li>
        <li>
            <a href="<?php echo URLROOT; ?>/Pages/about">About</a>
        </li>
        <li>
            <a href="<?php echo URLROOT; ?>/Pages/map">Map</a>
        </li>
        <li>
            <a href="<?php echo URLROOT; ?>/Pages/reactor">Blog</a>
        </li>
        <li>
            <a href="<?php echo URLROOT; ?>/contact">Contact</a>
        </li>

        <li class="btn-login">
            <?php if (isset($_SESSION['user_id'])) : ?>
                <a href="<?php echo URLROOT; ?>/users/logout">Log out</a>
            <?php else : ?>
                <a href="<?php echo URLROOT; ?>/users/login">Login</a>
            <?php endif; ?>
        </li>
    </ul>
</nav>