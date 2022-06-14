<?php
   require APPROOT . '/views/includes/head.php';
?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/login.css"/>

<div class="login_overlay">
    <div class="login_wrap">
    <h1>Login</h1>
    <form action="<?php echo URLROOT; ?>/users/login" method="POST">
        <span class="invalidFeedback">
                <?php echo $data['usernameError']; ?>
        </span>
        <input type="text" name="username" placeholder="Username" required/>

        <span class="invalidFeedback">
                <?php echo $data['passwordError']; ?>
        </span>
        <input type="password" name="password" placeholder="Password" required/>
            
        <input type="submit" name="submit" value="Sign In" />

        <a class="login_help" href="#">Forgotten Password?</a>
        <a class="login_help" href="<?php echo URLROOT; ?>/users/register">Create an Account</a>
    </form>
    </div>
</div>
