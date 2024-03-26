<!doctype html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="\cs4116-project\src\app\styles.css" /> <!-- todo: find better way to use absolute links -->
    <link rel="stylesheet" href="\cs4116-project\src\app\navbar\navbar.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://kit.fontawesome.com/3af37769b5.js"
      crossorigin="anonymous"
    ></script>
    <title></title>
  </head>

  <body>
    <nav class="navbar navbar-expand-sm bg-body-tertiary fixed-top">
      <div class="container-fluid">
        <!-- LOGO -->
        <a class="logo-link" href="#"> <!-- todo: replace this href with link to homepage/dashboard based on if logged in (and all other links) -->
          <div class="logo">
            <img
              src="\cs4116-project\src\assets\ll-logo.png"
              height="594"
              width="703"
              alt="logo"
            />
            <span class="title">Love Languages</span>
          </div>
        </a>

        <!-- SIDEBAR -->
        <button
          class="navbar-toggler shadow-none border-0"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#offcanvasNavbar"
          aria-controls="offcanvasNavbar"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div
          class="sidebar offcanvas offcanvas-start"
          tabindex="-1"
          id="offcanvasNavbar"
          aria-labelledby="offcanvasNavbarLabel"
        >
          <div class="offcanvas-header text-white">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
              Love Languages
            </h5>
            <button
              type="button"
              class="btn-close btn-close-white"
              data-bs-dismiss="offcanvas"
              aria-label="Close"
            ></button>
          </div>

          <!-- LINKS -->
          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3 gap-4 row-gap-3">
            <?php
              session_start();
              if (isset($_SESSION['/logged_in'])) { //todo: need to properly implement this check
              echo '
                <li class="nav-item">
                  <a class="link nav-link" href="#">
                    <i class="fa-solid fa-magnifying-glass fa-2x"></i> <!--todo: investigate making this white when on that page -->
                    <span class="navbar-toggler text-white border-0">Search</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="link nav-link" href="#">
                    <i class="fa-solid fa-comment-dots fa-2x"></i>
                    <span class="navbar-toggler text-white border-0">Connections</span>
                  </a>
                </li>
              ';
              }
              ?>
              <li class="nav-item">
                <a class="link nav-link" href="#">
                  <i class="fa-solid fa-circle-info fa-2x"></i>
                  <span class="navbar-toggler text-white border-0">About Us</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="link nav-link" href="#">
                  <i class="fa-solid fa-user fa-2x"></i>
                  <span class="navbar-toggler text-white border-0">Profile</span>
                </a>
              </li>
            </ul>

          </div>
        </div>
      </div>
    </nav>
  </body>
</html>
