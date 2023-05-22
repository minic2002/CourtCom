<?php
session_start();

include "userdb.php";

//Sign Up
if (isset($_POST["signup"])) {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $usertype = $_POST["usertype"];
    $email = $_POST["email"];
    $pnumber = $_POST["pnumber"];
    $password = $_POST["password"];

    // Specify the directory where the file should be uploaded
    $uploadDir = "static/images/profile_pictures/";

    // Get the filename and extension of the uploaded file
    $filename = basename($_FILES["profile_pic"]["name"]);
    $fileExt = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    // Generate a unique name for the uploaded file to prevent naming conflicts
    $uniqueName =  $fname . $lname . $pnumber . "." . $fileExt;
    $uploadFile = $uploadDir . $uniqueName;

    //upload the file
    move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $uploadFile);

    $double_check = "SELECT * FROM users WHERE email = ? OR pnumber = ?";
    $stmt = mysqli_prepare($conn, $double_check);
    mysqli_stmt_bind_param($stmt, "ss", $email, $pnumber);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if ($user["email"] === $email) {
            echo "<script>alert('Email already exists');</script>";
        }
        if ($user["pnumber"] === $pnumber) {
            echo "<script>alert('Phone Number already exists');</script>";
        }
    } else {
        // Insert the user information into the database
        $password = md5($password);
        $sql = "INSERT INTO users (fname, lname, user_pic, usertype, email, pnumber, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssss", $fname, $lname, $uploadFile, $usertype, $email, $pnumber, $password);
        mysqli_stmt_execute($stmt);
        
        $query = "SELECT * FROM users WHERE (email = ? OR pnumber = ?) AND password = ?";
        $kuan = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($kuan, "sss", $email, $pnumber, $password);
        mysqli_stmt_execute($kuan);
        $result = mysqli_stmt_get_result($kuan);
        $user = mysqli_fetch_assoc($result);
    
        // Check if the user exists and the password is correct
        if (mysqli_num_rows($result) == 1) {
            // Set the user attribute value in the session
            $_SESSION["usertype"] = $user["usertype"];
            $_SESSION["user_id"] = $user["user_id"];
            $_SESSION["fname"] = $user["fname"];
            $_SESSION["lname"] = $user["lname"];
            $_SESSION["user_pic"] = $user["user_pic"];
            $_SESSION["email"] = $user["email"];
            $_SESSION["pnumber"] = $user["pnumber"];
            
            // Redirect the user to the appropriate dashboard
            if ($user["usertype"] == "User") {
                header("Location: dashboard");
                exit();
            } elseif ($user["usertype"] == "Court Owner") {
                header("Location: court_info");
                exit();
            } else {
                header("Location: coach_info");
                exit();
            }
        }
        
    }
}

//Log in
if (isset($_POST["login"])) {
    // Get the form data
    $emailornumber = $_POST["emailornumber"];
    $password = $_POST["password"];

    // Retrieve the user information from the database
    $password = md5($password);
    $sql = "SELECT * FROM users WHERE (email = ? OR pnumber = ?) AND password = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $emailornumber, $emailornumber, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    // Check if the user exists and the password is correct
    if (mysqli_num_rows($result) == 1) {
        // Set the user attribute value in the session
        $_SESSION["usertype"] = $user["usertype"];
        $_SESSION["user_id"] = $user["user_id"];
        $_SESSION["fname"] = $user["fname"];
        $_SESSION["lname"] = $user["lname"];
        $_SESSION["user_pic"] = $user["user_pic"];
        $_SESSION["email"] = $user["email"];
        $_SESSION["pnumber"] = $user["pnumber"];
        
        // Redirect the user to the appropriate dashboard
        if ($user["usertype"] == "User") {
            header("Location: dashboard");
            exit();
        } elseif ($user["usertype"] == "Court Owner") {
            header("Location: dashboard_court");
            exit();
        } else {
            header("Location: dashboard_coach");
            exit();
        }
    } else {
        // User does not exist, show an error message
        echo "<script>alert('Invalid email/phone number or password.');</script>";
    }
}

//Register Court
if (isset($_POST["regcourt"])) {
    $user_id = $_SESSION["user_id"];
    $court_name = $_POST["court_name"];
    $court_address = $_POST["court_address"];
    $court_desc = $_POST["court_desc"];
    $court_type = $_POST["court_type"];
    $rph = $_POST["rph"];
    $availability = " ";

    // Specify the directory where the file should be uploaded
    $uploadDir = "static/images/court_images/";

    // Get the filename and extension of the uploaded file
    $filename = basename($_FILES["court_image"]["name"]);
    $fileExt = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    // Generate a unique name for the uploaded file to prevent naming conflicts
    $uniqueName =  $court_name . "-" . $user_id . "." . $fileExt;
    $uploadFile = $uploadDir . $uniqueName;

    //upload the file
    move_uploaded_file($_FILES["court_image"]["tmp_name"], $uploadFile);

    $sql = "INSERT INTO court (user_id, court_name, court_image, court_address, court_desc, court_type, rph, Availability) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssss", $user_id, $court_name, $uploadFile, $court_address, $court_desc, $court_type, $rph, $availability);
    mysqli_stmt_execute($stmt);

    //redirect to dashboard_court
    header("Location: dashboard_court");
    exit();
}

//Register Coach
if (isset($_POST["regcoach"])) {
    $user_id = $_SESSION["user_id"];
    $coachdesc = $_POST["coachdesc"];
    $sport_type = $_POST["sport_type"];
    $rph = $_POST["rph"];
    $availability = " ";

    $sql = "INSERT INTO coach (user_id, sport_type, rph, coach_desc, availability) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $user_id, $sport_type, $rph, $coachdesc, $availability);
    mysqli_stmt_execute($stmt);

    //redirect to dashboard_coach
    header("Location: dashboard_coach");
    exit();
}

//Book Court
if (isset($_POST["bo_court"])) {
    $user_id = $_SESSION["user_id"];
    $court_id = $_POST['court_id'];
    $st_time = $_POST["s_time"];
    $en_time = $_POST["e_time"];
    $bo_date = $_POST["bodate"];
    $booking_status = "Pending";

    //convert the format of time and date that is compatible with the MySQL database
    $start_time = date('H:i:s', strtotime($st_time));
    $end_time = date('H:i:s', strtotime($en_time));
    $book_date = date('Y-m-d', strtotime($bo_date));

    $sql = "INSERT INTO book_court (user_id, court_id, Start_Time, End_Time, Booking_Date, Booking_Status) VALUES (?, ?, ?, ?, ?, ?) ";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssss", $user_id, $court_id, $start_time, $end_time, $book_date, $booking_status);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Retrieve the booked court ID
        $query = "SELECT book_court.bcrt_id FROM book_court INNER JOIN users ON book_court.user_id = users.user_id INNER JOIN court ON book_court.court_id = court.court_id WHERE book_court.court_id = '$court_id' AND book_court.user_id = '$user_id'";
        $resulta = mysqli_query($conn, $query);

        if ($resulta && mysqli_num_rows($resulta) > 0) {
                $book_court = mysqli_fetch_assoc($resulta);
                $bcrt_id = $book_court['bcrt_id'];
            // redirect to pay booked court
            header("Location: pay-booked-court?id=$bcrt_id");
            exit();
        }

    } else {
        echo "<script>alert('Booking Failed. Please try again.');</script>";
    } 
}


//Book Coach
if (isset($_POST["bo_coach"])) {
    $user_id = $_SESSION["user_id"];
    $coach_id = $_POST['coach_id'];
    $st_time = $_POST["s_time"];
    $en_time = $_POST["e_time"];
    $bo_date = $_POST["bodate"];
    $booking_status = "Pending";

    //convert the format of time and date that is compatible to mysql database
    $start_time = date('H:i:s', strtotime($st_time));
    $end_time = date('H:i:s', strtotime($en_time));
    $book_date = date('Y-m-d', strtotime($bo_date));

    $sql = "INSERT INTO book_coach (user_id, coach_id, Start_Time, End_Time, Booking_Date, Booking_Status) VALUES (?, ?, ?, ?, ?, ?) ";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssss", $user_id, $coach_id, $start_time, $end_time, $book_date, $booking_status);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Retrieve the booked coach ID
        $query = "SELECT book_coach.bcch_id FROM book_coach INNER JOIN users ON book_coach.user_id = users.user_id INNER JOIN coach ON book_coach.coach_id = coach.coach_id WHERE book_coach.coach_id = '$coach_id' AND book_coach.user_id = '$user_id'";
        $resulta = mysqli_query($conn, $query);

        $book_coach = mysqli_fetch_assoc($resulta);
        $bcch_id = $book_coach['bcch_id'];

        // redirect to pay booked coach
        header("Location: pay-booked-coach?id=$bcch_id");
        exit();
    } else {
        echo "<script>alert('Booking Failed. Please try again.');</script>";
    }
    
}

//Review Court
if (isset($_POST["rr_court"])) {
    $user_id = $_SESSION["user_id"];
    $court_id = $_POST["court_id"];
    $court_review = $_POST["review_court"];
    $court_rate = $_POST["rate_court"];

    $sql = "INSERT INTO review_court (user_id, court_id, review_text, rate) VALUES (?, ?, ?, ?) ";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $user_id, $court_id, $court_review, $court_rate);
    mysqli_stmt_execute($stmt);
}


//Review Coach
if (isset($_POST["rr_coach"])) {
    $user_id = $_SESSION["user_id"];
    $coach_id = $_POST["coach_id"];
    $coach_review = $_POST["review_coach"];
    $coach_rate = $_POST["rate_coach"];

    $sql = "INSERT INTO review_coach (user_id, coach_id, review_text, rate) VALUES (?, ?, ?, ?) ";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $user_id, $coach_id, $coach_review, $coach_rate);
    mysqli_stmt_execute($stmt);
}

//Pay Booked Court
if (isset($_POST["pabo_court"])) {
    $bcrt_id = $_POST["bcrt_id"];
    $paytype = $_POST["paytype"];
    $amount = $_POST["amount"];
    $paystatus = $paytype;

    $sql = "INSERT INTO pay_booked_court (bcrt_id, payment_type, payment_amount, payment_status) VALUES (?, ?, ?, ?) ";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $bcrt_id, $paytype, $amount, $paystatus);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        header("Location: bookings");
        exit();
    }
}

//Pay Booked Coach
if (isset($_POST["pabo_coach"])) {
    $bcch_id = $_POST["bcch_id"];
    $paytype = $_POST["paytype"];
    $amount = $_POST["amount"];
    $paystatus = $paytype;

    $sql = "INSERT INTO pay_booked_coach (bcch_id, payment_type, payment_amount, payment_status) VALUES (?, ?, ?, ?) ";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $bcch_id, $paytype, $amount, $paystatus);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        header("Location: bookings");
        exit();
    }
}

?>