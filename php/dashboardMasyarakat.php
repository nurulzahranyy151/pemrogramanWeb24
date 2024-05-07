<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RECITY</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,600;0,700;0,800;1,200;1,300;1,600;1,700;1,800&display=swap"
      rel="stylesheet" />
    <link rel="stylesheet" href="./css/dashboardstyle.css"/>
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>
  <header>
    <a href="#search" id="search"> <i data-feather="search"></i></a>


  </header>
  <!--START OF SIDEBAR-->
    <nav class="sidebar">
      <!--START OF HEADER-->
      <header>
        <div class="image-text">
          <span class="image">
            <img src="./img/logo.png" alt="logo">
          </span>
          <div class="text header-text">
            <span class="name">ReCity</span>
            <span class="namevol2">Resolve City</span>
          </div>
        </div>
        <i class="chevron-right" data-feather="chevron-right"></i>
      </header>
      <!--END OF HEADER-->
      <div class="menu-bar">
        <div class="menu">
          <ul class="nav-links">
            <li class="nav-link">
              <a href="#dashboard">
                <i class="sidebar-icon" data-feather="home"></i>
                <span class="text nav-text">Dashboard</span>
              </a>
              <li>
              <a href="#saved">
                <i class="sidebar-icon" data-feather="bookmark"></i>
                <span class="text nav-text">Saved</span>
              </a>
            </li>
            <li>
              <a href="#History">
                <i class="sidebar-icon" data-feather="clock"></i>
                <span class="text nav-text">History</span>
              </a>
            </li>
            <li>
              <a href="#Profile">
                <i class="sidebar-icon" data-feather="user"></i>
                <span class="text nav-text">Profile</span>
              </a>
            </li>
            <li>
              <a href="#Statistik">
                <i class="sidebar-icon" data-feather="bar-chart-2"></i>
                <span class="text nav-text">Statistic</span>
              </a>
            </li>
            <li>
              <a href="#sidebar-icon">
                <i class="sidebar-icon" data-feather="settings"></i>
                <span class="text nav-text">Settings</span>
              </a>
            </li>
            <li>
              <a href="#Logout">
                <i class="sidebar-icon" data-feather="log-out"></i>
                <span class="text nav-text">Logout</span>
              </a>
            </li>
          </ul>
        </div>
      </div>

        <div class="footer">
          <div class="footer-mode">
          <i class="footer-mode icon"></i>
          <i class="footer-mode icon" data-feather="sun"></i>
          </div> 
          <span class="mode-alt">Dark Mode</span>
          <div class="toggle-switch">
            <span class="switch"></span>
          </div>
        </div>
          
        </li>
      </div>
    </nav>
    <!--END OF SIDEBAR-->

    <script>
      feather.replace();
    </script>
</body>
</html>