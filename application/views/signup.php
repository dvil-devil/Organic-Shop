<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organic Shop: Let’s order fresh items for you.</title>

    <link rel="shortcut icon" href="assets/images/organic_shop_favicon.ico" type="image/x-icon">

    <script src="../assets/js/vendor/jquery.min.js"></script>
    <script src="../assets/js/vendor/popper.min.js"></script>
    <script src="../assets/js/vendor/bootstrap.min.js"></script>
    <script src="../assets/js/vendor/bootstrap-select.min.js"></script>
    <link rel="stylesheet" href="../assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/vendor/bootstrap-select.min.css">

    <script src="../assets/js/global/global.js"></script>
    <link rel="stylesheet" href="../assets/css/custom/global.css">
    <link rel="stylesheet" href="../assets/css/custom/signup.css">
</head>
<script>
    $(document).ready(function() {
        /* prototype add */
        $("form").submit(function(event) {
            var isValid = true;
            $('input[type="text"], input[type="email"], input[type="password"]').each(function() {
                if ($(this).val() === '') {
                    $(this).addClass('error');
                    isValid = false;
                } else {
                    $(this).removeClass('error');
                }
            });

            if ($('input[name="password"]').val() !== $('input[name="confirm_password"]').val()) {
                $('input[name="confirm_password"]').addClass('error');
                isValid = false;
            } else {
                $('input[name="confirm_password"]').removeClass('error');
            }

            if (isValid) {
                $("form").unbind('submit').submit();
            }
        });

        $('input[type="text"], input[type="email"], input[type="password"]').blur(function() {
            if ($(this).val() === '') {
                $(this).addClass('error');
            } else {
                $(this).removeClass('error');
            }
        });

        $('input[type="password"]').keyup(function() {
            if ($('input[name="password"]').val() === $('input[name="confirm_password"]').val()) {
                $('input[name="confirm_password"]').removeClass('error');
            } else {
                $('input[name="confirm_password"]').addClass('error');
            }
        });

    });
</script>
<body>
    <div class="wrapper">
        <a href="/"><img src="../assets/images/organic_shop_logo_large.svg" alt="Organic Shop"></a>
        <form action="validate/signup" method="post">
            <?php echo form_open(); ?>
            <h2>Signup to order.</h2>
            <a href="login">Already a member? Login here.</a>
            <ul>
                <li>
                    <input type="text" name="first_name">
                    <label>First Name</label>
                </li>
                <li>
                    <input type="text" name="last_name">
                    <label>Last Name</label>
                </li>
                <li>
                    <input type="email" name="email">
                    <label>Email</label>
                </li>
                <li>
                    <input type="password" name="password">
                    <label>Password</label>
                </li>
                <li>
                    <input type="password" name="confirm_password">
                    <label>Confirm Password</label>
                </li>
            </ul>
            <button class="signup_btn" type="submit">Signup</button>
            <?php echo form_close(); ?>
        </form>
<?php   if($this->session->flashdata("input_errors")){?>
        <div class="alert">
            <?= $this->session->flashdata("input_errors")?>
        </div>
<?php   }?>
    </div>
</body>
</html>