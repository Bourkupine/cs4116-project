<style>
    body {
        padding-top: 66px;
    }

    .navbar {
        background: rgb(0, 74, 173);
        background: linear-gradient(
                90deg,
                rgba(0, 74, 173, 1) 0%,
                rgba(203, 108, 230, 1) 100%
        );
    }

    .nav-logo-link {
        text-decoration: none !important;
    }

    .nav-logo {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        margin-left: 1%;
        color: #99a1ff;

        img {
            margin-right: 10px;
            object-fit: contain;
            max-width: 56px;
            height: auto;
        }
    }

    @media (max-width: 575px) {
        .sidebar {
            background: linear-gradient(
                    180deg,
                    rgba(0, 74, 173, 1) 0%,
                    rgba(203, 108, 230, 1) 100%
            ) !important;
        }
    }

    .nav-logo:hover {
        color: #c6c7ff;
    }

    .nav-title {
        display: flex;
        font-family: Bungee, sans-serif;
        font-size: 24px;
        line-height: 24px;
    }

    .nav-link:hover {
        color: gainsboro !important;
    }

    @media (max-width: 575px) {
        .nav-link {
            color: white !important;
            border-bottom: 1px white !important;
        }

        .nav-link:hover {
            color: #bebebe !important;

            span {
                color: #bebebe !important;
            }
        }
    }
</style>

<nav class="navbar navbar-expand-sm bg-body-tertiary fixed-top">
  <div class="container-fluid">
    <!-- LOGO -->
    <a class="nav-logo-link" href="
    <?php
    if (isset($_SESSION["logged-in"])) {
      echo "../dashboard";
    } else {
      echo "../home";
    }
    ?>">
      <div class="nav-logo">
        <img
          src="../../assets/ll-logo.png"
          height="594"
          width="703"
          alt="logo"
        />
        <span class="nav-title">Love Languages</span>
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
            if (isset($_SESSION["logged-in"])) {
              echo "
          <li class=\"nav-item\">
            <a class=\"nav-link nav-link\" href=\"../search\">
              <i class=\"fa-solid fa-magnifying-glass fa-2x\"></i>
              <span class=\"navbar-toggler text-white border-0\">Search</span>
            </a>
          </li>
          <li class=\"nav-item\">
            <a class=\"nav-link nav-link\" href=\"../connections\">
              <i class=\"fa-solid fa-comment-dots fa-2x\"></i>
              <span class=\"navbar-toggler text-white border-0\">Connections</span>
            </a>
          </li>";
            }
            ?>
          <li class="nav-item">
            <a class="nav-link nav-link" href="../about">
              <i class="fa-solid fa-circle-info fa-2x"></i>
              <span class="navbar-toggler text-white border-0">About Us</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link" href="
            <?php
            if (isset($_SESSION["logged-in"])) {
                echo "../profile";
            } else {
                echo "../login";
            }
            ?>">
              <i class="fa-solid fa-user fa-2x"></i>
              <span class="navbar-toggler text-white border-0">Profile</span>
            </a>
          </li>
        </ul>

      </div>
    </div>
  </div>
</nav>