<?php
//if (isset($_POST["submit"])) {
//    session_start();
//    session_unset();
//}
?>

<head>
    <?php require_once "../templates/header.php"; ?>
    <?php
    if (!isset($_SESSION["logged-in"])) {
        header("Location: ../home");
    } ?>
  <link rel="stylesheet" href="profile.css">
  <title>Love Languages - Profile</title>
</head>

<body>
<?php require_once "../navbar/navbar.php"; ?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-4 p-3 d-flex d-md-block">
      <div class="col-6 col-md-12 d-flex flex-column align-items-center">
        <img class="img-fluid pfp" src="../../assets/ll-logo-gradient.png" alt="profile picture">
        <span class="name"><i>Firstname Lastname</i></span>
        <span class="info">Country, Region</span>
        <span class="info">Age, Sex</span>
      </div>
      <div class="col-6 col-md-12 mt-md-3">
        <div class="ms-5 text">
          <span><b>Interests:</b></span>
          <ul>
            <li>Running</li>
            <li>Fishing</li>
            <li>Cooking</li>
            <li>Photography</li>
          </ul>
        </div>
        <button class="edit-button text float-end pe-4">
          <i class="fa-regular fa-pen-to-square"></i>
          Edit Profile
        </button>
      </div>
    </div>

    <div class="col-md-8 pt-3">
      <div class="text-box text text-white p-3 mb-3">
        <span><b>Bio:</b></span>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam odio lorem, viverra eget diam a, interdum
          malesuada neque. Cras nisi ante, tincidunt ut efficitur sed, finibus vel erat. Nulla luctus, justo pharetra
          molestie porttitor, libero sapien venenatis mi, quis rutrum ex erat vel velit. Curabitur consequat elit lorem,
          ut iaculis est iaculis eu. Fusce congue quam a nisl viverra feugiat. Proin pretium rutrum mi. Morbi tellus
          est, accumsan ut enim ac, auctor dignissim felis. Morbi convallis nec nisl quis consequat. Aenean tempus
          consequat massa, nec maximus ante efficitur a. Nulla eget dictum mi. Cras quis sollicitudin diam.
        </p>
      </div>
      <div class="text-box text text-white p-3 mb-3">
        <span><b>Known Languages:</b></span>
        <ul>
          <li>English</li>
          <li>Spanish</li>
          <li>Portuguese</li>
          <li>Italian</li>
        </ul>
        <div class="d-flex justify-content-center">
          <button class="edit-button text-white text">
            <i class="fa-regular fa-pen-to-square"></i>
            Edit
          </button>
        </div>
      </div>
      <div class="text-box text text-white p-3 mb-3">
        <span><b>Learning Languages:</b></span>
        <ul>
          <li>Arabic</li>
          <li>French</li>
          <li>Vietnamese</li>
          <li>Urdu</li>
        </ul>
        <div class="d-flex justify-content-center">
          <button class="edit-button text-white text">
            <i class="fa-regular fa-pen-to-square"></i>
            Edit
          </button>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="d-flex justify-content-evenly justify-content-md-end mb-3">
      <button class="footer-btn text btn btn-danger me-3">
        Sign out
      </button>
      <button class="footer-btn text btn btn-outline-danger me-3">
        Delete Account
      </button>
    </div>
  </div>
</div>

<!--<form method="post" class="ms-5">-->
<!--  <button name="submit" type="submit" class="btn btn-danger">Log out</button>-->
<!--</form>-->

<?php require_once "../templates/footer.php"; ?>
</body>