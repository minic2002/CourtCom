<?php
session_start();
include "userdb.php";

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
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
        <li>
          <a href="logout">
          <i class='bx bx-log-out'></i>
            <span class="links_name">Logout</span>
          </a>
        </li>
        
        <li class="log_out">
          <a>
            <img src="<?php echo $_SESSION['user_pic']; ?>" class="rounded-circle me-3 kuwan" width="50" height="50" alt="<?php echo $_SESSION['fname'] . ' ' . $_SESSION['lname']; ?>">
            <span class="links_name"><?php echo $_SESSION['fname'] . ' ' . $_SESSION['lname']; ?></span>
          </a>
        </li>
      </ul>
    </div>
    <section class="home-section">
      	<header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                <h3>Bookings</h3>
					
                </div>
            </nav>
        </header>
        <div class="home-content">
      <?php
      $sql = "SELECT book_court.bcrt_id, users.fname, users.lname, book_court.Start_Time, book_court.End_Time, book_court.Booking_Date, pay_booked_court.payment_type, pay_booked_court.payment_amount, pay_booked_court.payment_status FROM book_court INNER JOIN pay_booked_court ON pay_booked_court.bcrt_id = book_court.bcrt_id INNER JOIN users ON book_court.user_id = users.user_id WHERE book_court.court_id = '$court_id' AND book_court.Booking_Status = 'Accept'";
      $result = mysqli_query($conn, $sql);
      ?>

    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Booking ID</th>
          <th scope="col">User Name</th>
          <th scope="col">Start Time</th>
          <th scope="col">End Time</th>
          <th scope="col">Booking Date</th>
          <th scope="col">Payment Type</th>
          <th scope="col">Payment Amount</th>
          <th scope="col">Payment Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $count = 1;
        while ($row = mysqli_fetch_assoc($result)) {
          $bcrt_id = $row['bcrt_id'];
          $fname = $row['fname'];
          $lname = $row['lname'];
          $start_time = $row['Start_Time'];
          $end_time = $row['End_Time'];
          $booking_date = $row['Booking_Date'];
          $payment_type = $row['payment_type'];
          $payment_amount = $row['payment_amount'];
          $payment_status = $row['payment_status'];
        ?>
        <tr>
          <th scope="row"><?php echo $count; ?></th>
          <td><?php echo $bcrt_id; ?></td>
          <td><?php echo $fname . " " . $lname; ?></td>
          <td><?php echo $start_time; ?></td>
          <td><?php echo $end_time; ?></td>
          <td><?php echo $booking_date; ?></td>
          <td><?php echo $payment_type; ?></td>
          <td><?php echo $payment_amount; ?></td>
          <td><?php echo $payment_status; ?>
          <button class="btn btn-success" title="Change Payment Status">
            <i class="fa fa-exchange"></i>
          </button>
          </td>
          <td>
            <button class="btn btn-danger" title="Delete Booking">
              <i class="fa fa-times"></i>
            </button>
          </td>
        </tr>
        <?php
          $count++;
        }
        ?>
      </tbody>
    </table>
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