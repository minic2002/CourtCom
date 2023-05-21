<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login");
    exit();
}

if ($_SESSION["usertype"] == "User" || $_SESSION["usertype"] == "Coach") {
    if ($_SESSION["usertype"] == "User") {
        header("Location: dashboard");
    } elseif ($_SESSION["usertype"] == "Coach") {
        header("Location: dashboard_coach");
    }
    exit();
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>CourtCom | Court Owner Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
	<link rel="icon" type="image/x-icon" href="static/images/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="static/css/dashboard_court.css">
  </head>
  
  <body>
  
    <!---Sidebar-->
    <div class="sidebar">
      <div class="d-flex flex-column align-items-center text-center mt-5 ">
        <img src="static/images/CourtCom_Logo_more_stroke.png" alt="CourtCom_Logo" width="150">
      </div>
      <ul class="nav-links">
        <li>
          <a href="dashboard_court">
            <i class='bx bx-grid-alt'></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="#" class="active">
            <i class='bx bx-list-ul'></i>
            <span class="links_name">Bookings</span>
          </a>
        </li>
        <li>
          <a href="court-booking-requests">
            <i class='bx bx-coin-stack'></i>
            <span class="links_name">Requests</span>
          </a>
        </li>
		<li>
          <a href="court-settings">
            <i class='bx bx-cog'></i>
            <span class="links_name">Settings</span>
          </a>
        </li>
        <li class="log_out">
          <a href="home.html">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Home</span>
          </a>
        </li>
      </ul>
    </div>
    <section class="home-section">
      	<header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis fugit ducimus voluptate voluptates suscipit totam excepturi id ad necessitatibus eum eaque animi adipisci, odit pariatur eius. Ratione autem aliquid quo.
					
                </div>
            </nav>

        </header>

 
    </section>
    <script>
      let sidebar = document.querySelector(".sidebar");
      let sidebarBtn = document.querySelector(".sidebarBtn");
      sidebarBtn.onclick = function() {
        sidebar.classList.toggle("active");
        if (sidebar.classList.contains("active")) {
          sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
      }
    </script>
  </body>
</html>