<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
    <link rel="stylesheet" href="../styles.css"/>
    <link rel="stylesheet" href="login.css">
    <title>Love Languages - Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

</head>
<body>
<?php include '../navbar/navbar.php' ?>

<div class="container-fluid mt-2">
    <div class="row justify-content-md-between justify-content-center align-items-center">
        <div class="col-9 col-md-5 text-center">
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
    <form action="">
        <div class="row justify-content-center my-2">
            <div class="col-5">
                <div class="form-floating">
                    <input id="email" type="email" class="form-control" required placeholder="Email">
                    <label for="email">Email</label>
                </div>
            </div>
        </div>
        <div class="row justify-content-center my-2">
            <div class="col-5">
                <div class="form-floating">
                    <input id="password" type="password" class="form-control" required placeholder="Password">
                    <label for="password">Password</label>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-5 d-flex flex-md-row flex-column justify-content-md-between">
                <div class="col-2">
                    <div class="form-check">
                        <input id="remember-me" type="checkbox" class="form-check-input">
                        <label for="remember-me" class="form-check-label text-nowrap">Remember me</label>
                    </div>
                </div>
                <div class="col col-md-3 text-md-end text-center mt-md-0 mt-2">
                    <button id="login-button" class="btn ll-button px-md-3 px-5 fw-bold" type="submit">Login</button>
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
<div class="container-fluid my-5">
    <div class="row justify-content-center">
        <div class="col-5 text-center ">
            <span class="display-5 bold d-flex">Don't have an account?</span>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-5 text-center">
            <button id="sign-up-button" class="btn ll-button py-2 px-5" type="button">Sign Up</button>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/3af37769b5.js" crossorigin="anonymous"></script>
</body>
</html>