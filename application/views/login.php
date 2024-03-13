<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organic Shop: Let’s order fresh items for you.</title>

    <link rel="shortcut icon" href="../assets/images/organic_shop_favicon.ico" type="image/x-icon">

    <script src="../assets/js/vendor/jquery.min.js"></script>
    <script src="../assets/js/vendor/popper.min.js"></script>
    <script src="../assets/js/vendor/bootstrap.min.js"></script>
    <script src="../assets/js/vendor/bootstrap-select.min.js"></script>
    <link rel="stylesheet" href="../assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/vendor/bootstrap-select.min.css">
    <script src="../assets/js/global/dashboard.js"></script>
    <script src="../assets/js/global/global.js"></script>
    <link rel="stylesheet" href="../assets/css/custom/global.css">
    <link rel="stylesheet" href="../assets/css/custom/signup.css">
</head>
<script>
    $(document).ready(function() {
        $("input[name=email]").focus();
        $("form").submit(function(event) {
            event.preventDefault();

            var email = $("input[name=email]").val();
            var password = $("input[name=password]").val();

            if (email === "" || password === "") {
                alert("Please enter your email and password.");
                return false;
            }
            $("form").unbind('submit').submit();
        });
    });
</script>
<body>
    <div class="wrapper">
        <a href="/"><img src="../assets/images/organic_shop_logo_large.svg" alt="Organic Shop"></a>
        <form action="authenticate/login" method="post" class="login_form">
            <?php echo form_open(); ?>
            <h2>Login to order.</h2>
            <a href="/signup">New Member? Register here.</a>
            <ul>
                <li>
                    <input type="text" name="email">
                    <label>Email</label>
                </li>
                <li>
                    <input type="password" name="password">
                    <label>Password</label>
                </li>
            </ul>
            <button type="submit" class="login_btn">Login</button>
            <?php echo form_close(); ?>
        </form>
    </div>
<?php   if($this->session->flashdata("success")){?>
        <div class="alert">
            <p class="message_box success"><?= $this->session->flashdata("success")?></p>
        </div>
<?php   }?>
<?php   if($this->session->flashdata("input_errors")){?>
        <div class="alert">
            <?= $this->session->flashdata("input_errors")?>
        </div>
<?php   }?>
</body>
</html>