<?php
   require APPROOT . '/views/includes/head.php';
?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/register.css"/>

<div class="register_overlay">
    <div class="register_wrap">
    <h1>Sign Up</h1>
    <form action="<?php echo URLROOT; ?>/users/register" method="POST">
        <span class="invalidFeedback">
                <?php echo $data['usernameError']; ?>
        </span>
        <input type="text" name="username" placeholder="Username" required/>

        <span class="invalidFeedback">
                <?php echo $data['emailError']; ?>
        </span>
        <input type="email" name="email" placeholder="Email" required/>

        <span class="invalidFeedback">
                <?php echo $data['passwordError']; ?>
        </span>
        <input type="password" name="password" placeholder="Password" required/>

        <span class="invalidFeedback">
                <?php echo $data['confirm_passwordError']; ?>
        </span>
        <input type="password" name="confirm_password" placeholder="Confirm password" required/>

        <input type="submit" name="submit" value="Sign Up" />

        <a class="register_help" href="<?php echo URLROOT; ?>/users/login">Already have an account?</a>
    </form>
    </div>
</div>