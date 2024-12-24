<?php

session_start();



define("APPURL", "http://localhost/jobboard");

?>
<!doctype html>
<html lang="en">

<head>
  <title>JobBoard &mdash; Website Template by Colorlib</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <meta name="author" content="Free-Template.co" />
  <link rel="shortcut icon" href="ftco-32x32.png">

  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.14/css/bootstrap-select.min.css">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.14/js/bootstrap-select.min.js"></script>

  <link rel="stylesheet" href="<?php echo APPURL; ?>/css/custom-bs.css">
  <link rel="stylesheet" href="<?php echo APPURL; ?>/css/jquery.fancybox.min.css">
  <link rel="stylesheet" href="<?php echo APPURL; ?>/css/bootstrap-select.min.css">
  <link rel="stylesheet" href="<?php echo APPURL; ?>/fonts/icomoon/style.css">
  <link rel="stylesheet" href="<?php echo APPURL; ?>/fonts/line-icons/style.css">
  <link rel="stylesheet" href="<?php echo APPURL; ?>/css/owl.carousel.min.css">
  <link rel="stylesheet" href="<?php echo APPURL; ?>/css/animate.min.css">
  <link rel="stylesheet" href="<?php echo APPURL; ?>/css/quill.snow.css">

  <!-- MAIN CSS -->
  <link rel="stylesheet" href="<?php echo APPURL; ?>/css/style.css">
</head>

<body id="top">

  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->


    <!-- NAVBAR -->
    <header class="site-navbar mt-3">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="site-logo col-6"><a href="<?php echo APPURL; ?>">JobBoard</a></div>

          <nav class="mx-auto site-navigation">
            <ul style="margin-right: -500px" class="site-menu js-clone-nav d-inline d-xl-block ml-0 pl-0">
              <li><a href="<?php echo APPURL; ?>" class="nav-link active">Home</a></li>
              <li><a href="<?php echo APPURL; ?>/about.php">About</a></li>
              <li><a href="<?php echo APPURL; ?>/contact.php">Contact</a></li>

              <?php if (isset($_SESSION['username'])): ?>


                <li><a href="<?php echo APPURL; ?>/gerneral/workers.php">Workers</a></li>
                <li><a href="<?php echo APPURL; ?>/gerneral/companies.php">Companies</a></li>
                <?php if (isset($_SESSION['type']) and $_SESSION['type'] == "Company"): ?>
                  <li class="d-lg-inline">
                    <a href="<?php echo APPURL; ?>/jobs/post-job.php"><span class="mr-2">+</span> Post a
                      Job</a>
                  </li>
                <?php endif; ?>

                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <?php echo $_SESSION['username']; ?>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"
                      href="<?php echo APPURL; ?>/users/public-profile.php?id=<?php echo $_SESSION['id']; ?>">Public
                      profile</a>
                    <a class="dropdown-item"
                      href="<?php echo APPURL; ?>/users/update-profile.php?upd_id=<?php echo $_SESSION['id']; ?>">Update
                      profile</a>
                    <?php if (isset($_SESSION['type']) and $_SESSION['type'] == "Worker"): ?>
                      <a class="dropdown-item"
                        href="<?php echo APPURL; ?>/users/update-cv.php?upd_cv_id=<?php echo $_SESSION['id']; ?>">Update
                        CV</a>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['type']) and $_SESSION['type'] == "Worker"): ?>
                      <a class="dropdown-item"
                        href="<?php echo APPURL; ?>/users/saved_jobs.php?id=<?php echo $_SESSION['id']; ?>">Saved Jobs</a>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['type']) and $_SESSION['type'] == "Company"): ?>
                      <a class="dropdown-item"
                        href="<?php echo APPURL; ?>/users/show-applicants.php?id=<?php echo $_SESSION['id']; ?>">Show
                        Applicants</a>
                    <?php endif; ?>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo APPURL; ?>/auth/logout.php">Logout</a>
                  </div>
                </li>
              <?php else: ?>
                <a href="<?php echo APPURL; ?>/auth/register.php"
                  class="btn btn-primary border-width-2 d-none d-lg-inline-block"><span
                    class="mr-2 icon-lock_outline"></span>Register</a>
                <a href="<?php echo APPURL; ?>/auth/login.php"
                  class="btn btn-primary border-width-2 d-none d-lg-inline-block"><span
                    class="mr-2 icon-lock_outline"></span>Log In</a>
              <?php endif; ?>
            </ul>
          </nav>
        </div>
      </div>
    </header>