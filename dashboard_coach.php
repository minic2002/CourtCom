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

	$sql = "SELECT COUNT(book_coach.coach_id) AS total_bookings FROM book_coach INNER JOIN USERS ON book_coach.user_id = users.user_id INNER JOIN COACH ON book_coach.coach_id = coach.coach_id WHERE book_coach.coach_id = '$coach_id'";
	$result = mysqli_query($conn, $sql);

	if ($result && mysqli_num_rows($result) > 0) {
		// Display the number of bookings on a particular court
		$book_count = mysqli_fetch_assoc($result);
	}

	$query1 = "SELECT COALESCE(ROUND(AVG(review_coach.rate), 1),'Unrated') AS total_rating FROM coach JOIN review_coach ON review_coach.coach_id = coach.coach_id WHERE coach.coach_id = '$coach_id'";
	$result1 = mysqli_query($conn, $query1);
	if ($result1 && mysqli_num_rows($result1) > 0) {
		$total_rating = mysqli_fetch_assoc($result1);
	}

	$query2 = "SELECT COUNT(review_coach.review_text) AS total_reviews FROM review_coach WHERE review_coach.coach_id = '$coach_id'";
	$result2 = mysqli_query($conn, $query2);
	if ($result2 && mysqli_num_rows($result2) > 0) {
		$total_reviews = mysqli_fetch_assoc($result2);
	}

	$query3 = "SELECT COUNT(Booking_Status) as Pending_Requests FROM book_coach WHERE Booking_Status = 'Pending' AND book_coach.coach_id = '$coach_id'";
	$result3 = mysqli_query($conn, $query3);
	if ($result3 && mysqli_num_rows($result3) > 0) {
		$Pending_Requests = mysqli_fetch_assoc($result3);
	}

	$query4 = "SELECT COUNT(Booking_Status) as Accepted_Requests FROM book_coach WHERE Booking_Status = 'Accept' AND book_coach.coach_id = '$coach_id'";
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
    <title>CourtCom | Coach Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" type="image/x-icon" href="static/images/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
          <a href="coach-bookings">
            <i class='bx bx-list-ul'></i>
            <span class="links_name">Bookings</span>
          </a>
        </li>
        <li>
          <a href="coach-booking-requests">
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
      <div class="container"><hr style="height: 2px;background-color: grey;"></div>
      <div class="container">
      <h3 style="text-align: center;">Ratings and Reviews</h3>
        <!--Display ratings and reviews-->
        <?php
            $query = "SELECT users.user_pic, users.fname, users.lname, review_coach.review_text, review_coach.rate, review_coach.review_date FROM review_coach JOIN users ON review_coach.user_id = users.user_id WHERE review_coach.coach_id = '$coach_id' ORDER BY review_coach.rate DESC";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="card mt-3">';
                    echo '<div class="card-body">';
                    echo '<div class="d-flex align-items-center">';
                    echo '<img src="'.$row['user_pic'].'" class="rounded-circle me-3" width="50" height="50" alt="User Picture">';
                    echo '<div>';
                    echo '<h5 class="card-title mb-0">'.$row['fname'].' '.$row['lname']. ' ' . '<span class="fa fa-star"></span> ' . $row['rate'] . '</h5>';
                    echo '<h6 class="text-muted">'.$row['review_date'].'</h6>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="mt-3">';
                    echo '<h4 class="card-text">'.$row['review_text'].'</h4>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<br><br><h5 class="text-center">No ratings and reviews available.</h5> <br><br>';
            }
        ?>
        <!--End of displaying-->
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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  </body>
</html>
