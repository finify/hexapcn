<?php
$username = $_SESSION['fx_adminemail'];
?>
<body>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand sidenav-toggler" data-action="sidenav-pin" data-target="#sidenav-main" href="javascript:void(0)">
          <img src="<?= $sitelogo ?>" class="navbar-brand-img" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="index.php">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="viewusers.php">
                <i class="ni ni-credit-card text-orange"></i>
                <span class="nav-link-text">View user</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="coin.php">
                <i class="ni ni-spaceship text-primary"></i>
                <span class="nav-link-text">Coins</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="deposit.php">
                <i class="ni ni-spaceship text-primary"></i>
                <span class="nav-link-text">Deposit</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="invest.php">
                <i class="ni ni-money-coins text-primary"></i>
                <span class="nav-link-text">Investments</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="planscategory.php">
                <i class="ni ni-money-coins text-primary"></i>
                <span class="nav-link-text">Plan category</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="investmentplans.php">
                <i class="ni ni-money-coins text-primary"></i>
                <span class="nav-link-text">Investments Plans</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="earnings.php">
                <i class="ni ni-money-coins text-primary"></i>
                <span class="nav-link-text">Earnings</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="withdraw.php">
                <i class="ni ni-credit-card text-yellow"></i>
                <span class="nav-link-text">Withdrawal Requests</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="kyc.php">
                <i class="ni ni-support-16 text-red"></i>
                <span class="nav-link-text">kyc</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.php">
                <i class="ni ni-support-16 text-red"></i>
                <span class="nav-link-text">contacts page</span>
              </a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='settings.php'>
                <i class='ni ni-settings text-green'></i>
                <span class='nav-link-text'>Settings</span>
              </a>
            </li>
            
          </ul>
          <!-- Divider -->
          <hr class="my-3">
          <!-- Navigation -->
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item">
              <a class="nav-link" href="../includes/logout.php">
                <i class="ni ni-key-25"></i>
                <span class="nav-link-text">Logout</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-dark  border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>
          </ul>
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                    <i class="ni ni-single-02"></i>
                  </span>
                  <div class="media-body  ml-2  d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold"><?php echo $username;?></span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu  dropdown-menu-right ">
                <div class="dropdown-header noti-title">
                  <h6 class="text-overflow m-0">Welcome!</h6>
                </div>
                <div class="dropdown-divider"></div>
                <a href="../includes/logout.php" class="dropdown-item">
                  <i class="ni ni-user-run"></i>
                  <span>Logout</span>
                </a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>