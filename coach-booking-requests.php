<?php
include "database.php";

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login");
    exit();
}

if ($_SESSION["usertype"] == "Court Owner" || $_SESSION["usertype"] == "User") {
    if ($_SESSION["usertype"] == "Court Owner") {
        header("Location: dashboard_court");
    } elseif ($_SESSION["usertype"] == "User") {
        header("Location: dashboard");
    }
    exit();
}

$user_id = $_SESSION["user_id"];
$query = "SELECT coach_id FROM coach WHERE coach.user_ID = '$user_id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
	// Display the number of bookings on a particular coach
	$coach = mysqli_fetch_assoc($result);
	$coach_id = $coach["coach_id"];

}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>CourtCom | Coach Dashboard</title>
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
          <a href="dashboard_coach">
            <i class='bx bx-grid-alt'></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="coach-bookings">
            <i class='bx bx-list-ul'></i>
            <span class="links_name">Bookings</span>
          </a>
        </li>
        <li>
          <a href="#" class="active">
            <i class='bx bx-coin-stack'></i>
            <span class="links_name">Requests</span>
          </a>
        </li>
        <li>
          <a href="coach-settings">
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
      $sql = "SELECT book_coach.bcch_id, users.fname, users.lname, book_coach.Start_Time, book_coach.End_Time, book_coach.Booking_Date, pay_booked_coach.payment_type, pay_booked_coach.payment_amount FROM book_coach INNER JOIN pay_booked_coach ON pay_booked_coach.bcch_id = book_coach.bcch_id INNER JOIN users ON book_coach.user_id = users.user_id WHERE book_coach.coach_id = '$coach_id' AND book_coach.Booking_Status = 'Pending'";
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
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $count = 1;
        while ($row = mysqli_fetch_assoc($result)) {
          $bcch_id = $row['bcch_id'];
          $fname = $row['fname'];
          $lname = $row['lname'];
          $start_time = $row['Start_Time'];
          $end_time = $row['End_Time'];
          $booking_date = $row['Booking_Date'];
          $payment_type = $row['payment_type'];
          $payment_amount = $row['payment_amount'];
        ?>
        <tr>
          <th scope="row"><?php echo $count; ?></th>
          <td><?php echo $bcch_id; ?></td>
          <td><?php echo $fname . " " . $lname; ?></td>
          <td><?php echo $start_time; ?></td>
          <td><?php echo $end_time; ?></td>
          <td><?php echo $booking_date; ?></td>
          <td><?php echo $payment_type; ?></td>
          <td><?php echo $payment_amount; ?></td>
          <td>
          <button class="btn btn-success" title="Accept" onclick="coach_accept_book('<?php echo $bcch_id; ?>')">
              <i class="fa fa-check"></i>
            </button>
            <button class="btn btn-danger" title="Decline" onclick="coach_decline_book('<?php echo $bcch_id; ?>')">
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
      function coach_accept_book(bcch_id){
        location.href="coach-accept-book?id="+bcch_id;
      }

      function coach_decline_book(bcch_id){
        location.href="coach-decline-book?id="+bcch_id;
      }

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