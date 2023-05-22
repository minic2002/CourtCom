<?php
  include "database.php";

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

  $user_id = $_SESSION["user_id"];
  $query = "SELECT court_id FROM court WHERE court.user_ID = '$user_id'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) == 1) {
      // Display the number of bookings on a particular court
      $court = mysqli_fetch_assoc($result);
      $court_id = $court["court_id"];

      $sql = "SELECT COUNT(book_court.court_id) AS total_bookings FROM book_court INNER JOIN USERS ON book_court.user_id = users.user_id INNER JOIN COURT ON book_court.court_id = court.court_ID WHERE book_court.court_id = '$court_id'";
      $result = mysqli_query($conn, $sql);

      if ($result && mysqli_num_rows($result) > 0) {
          // Display the number of bookings on a particular court
          $book_count = mysqli_fetch_assoc($result);
      }

      $query1 = "SELECT COALESCE(ROUND(AVG(review_court.rate), 1),'Unrated') AS total_rating FROM court JOIN review_court ON review_court.court_id = court.court_ID WHERE court.court_id = '$court_id'";
      $result1 = mysqli_query($conn, $query1);
      if ($result1 && mysqli_num_rows($result1) > 0) {
          $total_rating = mysqli_fetch_assoc($result1);
      }

      $query2 = "SELECT COUNT(review_court.review_text) AS total_reviews FROM review_court WHERE review_court.court_id = '$court_id'";
      $result2 = mysqli_query($conn, $query2);
      if ($result2 && mysqli_num_rows($result2) > 0) {
          $total_reviews = mysqli_fetch_assoc($result2);
      }

      $query3 = "SELECT COUNT(Booking_Status) as Pending_Requests FROM book_court WHERE Booking_Status = 'Pending' AND book_court.court_id = '$court_id'";
      $result3 = mysqli_query($conn, $query3);
      if ($result3 && mysqli_num_rows($result3) > 0) {
          $Pending_Requests = mysqli_fetch_assoc($result3);
      }

      $query4 = "SELECT COUNT(Booking_Status) as Accepted_Requests FROM book_court WHERE Booking_Status = 'Accept' AND book_court.court_id = '$court_id'";
      $result4 = mysqli_query($conn, $query4);
      if ($result4 && mysqli_num_rows($result4) > 0) {
          $Accepted_Requests = mysqli_fetch_assoc($result4);
      }
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
          <a href="#" class="active">
            <i class='bx bx-grid-alt'></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="court-bookings">
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
                <h3>Dashboard</h3>
              </div>
          </nav>
      </header>
        <div class="home-content">
          <div class="container mt-5">
              <div class="row row-centered">
                <div class="col-md-2">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Total Bookings</h5>
                      <p class="card-text"><?php echo $book_count['total_bookings']; ?></p>
                    </div>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Total Ratings</h5>
                      <p class="card-text"><?php echo $total_rating["total_rating"]; ?></p>
                    </div>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Total Reviews</h5>
                      <p class="card-text"><?php echo $total_reviews["total_reviews"]?></p>
                    </div>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Pending Requests</h5>
                      <p class="card-text"><?php echo $Pending_Requests["Pending_Requests"]; ?></p>
                    </div>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Accepted Requests</h5>
                      <p class="card-text"><?php echo $Accepted_Requests["Accepted_Requests"]?></p>
                    </div>
                  </div>
                </div>
            </div>
          </div>
      </div>
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
