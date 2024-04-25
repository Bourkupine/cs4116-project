<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require_once("../templates/header.php");
    ?>
    <title>Love Languages - About</title>
    <link rel="stylesheet" type="text/css" href="about.css"/>
</head>
<body>

<?php
require_once("../navbar/navbar.php");
?>

<div class="container">
    <div class="row first-row">
        <div class="col-12 col-xl mt-3 mb-3 me-4 pt-3 about-card" style="text-align: center;">
            <div>
                <img class="img-fluid" src="../../assets/cog.png" alt="cog">
            </div>
            <div class="title">
                <header>How does this work</header>
            </div>

            <div class="description">
                <p>
                    Love Languages is for the enthusiastic and single.
                    Want to practice a language with someone new? AND go on a date!
                    We are aspiring to re-focus the date to language.
                    By doing this we hope to take the hostility out of dating and
                    foster a learning environment rather than a tense nervous one.
                </p>
            </div>
        </div>
        <div class="col-12 col-xl mt-3 mb-3 ps-4">
            <div class="slogan slogan-text pt-3">
                <span>LOVE SPEAKS EVERY LANGUAGE</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-xl mt-3 mb-3 me-4 pt-3 about-card" style="text-align: center;">
            <div>
                <img class="img-fluid" src="../../assets/server.png" alt="cog">
            </div>
            <div class="title">
                <header>Our Job</header>
            </div>

            <div class="description">
                <p>
                    We only retain information needed, and
                    we never share your information with any third party.
                    We use our handcrafted algorithm to match you
                    with people whom are capable of speaking the
                    languages you are looking to practice.
                </p>
            </div>
        </div>

        <div class="col-12 col-xl mt-3 mb-3 pt-3 me-4 about-card" style="text-align: center;">
            <div>
                <img class="img-fluid" src="../../assets/mindset.png" alt="cog">
            </div>
            <div class="title">
                <header>Your job</header>
            </div>

            <div class="description">
                <p>
                    Be respectful, Please adhere to our terms and
                    conditions and most of all have fun! This is meant to
                    be an enjoyable experience for all involved.
                </p>
            </div>
        </div>
    </div>
</div>
<?php
require_once("../templates/footer.php");
?>
</body>
</html>