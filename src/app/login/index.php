<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require_once("../templates/header.php");
    ?>
    <?php
    if (isset($_SESSION["logged-in"])) {
        header("Location: ../dashboard");
    } ?>
    <title>Love Languages - Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
<?php
require_once("../navbar/navbar.php");
?>

<div class="container-fluid mt-2">
    <div class="row justify-content-md-between justify-content-center align-items-center">
        <div class="offset-md-1 col-9 col-md-5 text-center">
            <span class="slogan-text d-flex">Love speaks every language</span>
        </div>
        <div class="col-md-4 d-none d-md-block">
            <img src="../../assets/ll-logo-gradient-login.png" alt="logo" class="img-fluid">
        </div>
    </div>
</div>
<div class="container-fluid mt-3">
    <div class="row justify-content-center">
        <div class="col-5">
            <span id="welcome-text" class="display-4 text-center justify-content-center d-flex">Welcome Back!</span>
        </div>
    </div>
    <?php if (isset($_SESSION["login-failure"])): ?>

        <div class="row justify-content-center">
            <div class="col-5 text-nowrap">
                <span class="fs-6 text-danger">Invalid Email or Password</span>
            </div>
        </div>

    <?php endif;
    unset($_SESSION["login-failure"]); ?>

    <form method="post" action="login_submit.php">
        <div class="row justify-content-center my-2">
            <div class="col-5">
                <div class="form-floating">
                    <input id="email" type="email" name="email" class="form-control" required placeholder="Email">
                    <label for="email">Email</label>
                </div>
            </div>
        </div>
        <div class="row justify-content-center my-2">
            <div class="col-5">
                <div class="form-floating">
                    <input id="password" type="password" name="password" class="form-control" required
                           placeholder="Password">
                    <label for="password">Password</label>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-5 d-flex flex-md-row flex-column justify-content-md-between">
                <div class="col-2">
                    <div class="form-check">
                        <input id="remember-me" name="remember-me" type="checkbox" class="form-check-input">
                        <label for="remember-me" class="form-check-label text-nowrap">Remember me</label>
                    </div>
                </div>
                <div class="col col-md-3 text-md-end text-center mt-md-0 mt-2">
                    <button id="login-button" class="btn ll-button px-md-3 px-5 fw-bold " type="submit">Login</button>
                </div>
            </div>
        </div>
    </form>
    <div class="row justify-content-center mt-2">
        <div class="col-5">
            <a href="">Forgot password</a>
        </div>
    </div>
</div>
<div class="container-fluid mt-5">
    <div class="row justify-content-center">
        <div class="col-5 text-center">
            <span class="display-5 bold">Don't have an account?</span>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-5 text-center">
            <a href="../register/index.php" id="sign-up-button" class="btn ll-button px-5 fw-bold text-nowrap "
               type="button">Sign Up</a>
        </div>
    </div>
</div>
<?php
require_once("../templates/footer.php");
?>
</body>
</html>