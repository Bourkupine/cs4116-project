<nav class="navbar navbar-expand-sm bg-body-tertiary fixed-top">
  <div class="container-fluid">
    <!-- LOGO -->
    <a class="logo-link" href="#">
      <!-- todo: replace this href with link to homepage/dashboard based on if logged in (and all other links) -->
      <div class="logo">
        <img
          src="../../assets/ll-logo.png"
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
          <!-- todo: check if user is logged in to determine what to display -->
          <li class="nav-item">
            <a class="link nav-link" href="#">
              <i class="fa-solid fa-magnifying-glass fa-2x"></i>
              <!--todo: investigate making this white when on that page -->
              <span class="navbar-toggler text-white border-0">Search</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="link nav-link" href="#">
              <i class="fa-solid fa-comment-dots fa-2x"></i>
              <span class="navbar-toggler text-white border-0">Connections</span>
            </a>
          </li>
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