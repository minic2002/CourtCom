<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login");
    exit();
}

// Check if user is a Court Owner or Coach
if ($_SESSION["usertype"] == "Court Owner" || $_SESSION["usertype"] == "Coach") {
    // Redirect user to the appropriate dashboard
    if ($_SESSION["usertype"] == "Court Owner") {
        header("Location: dashboard_court");
    } else {
        header("Location: dashboard_coach");
    }
    exit();
}

include "userdb.php";

$bcrt_id = $_GET['id'];

$stmt = mysqli_prepare($conn, "DELETE FROM book_court WHERE bcrt_id = ?");
mysqli_stmt_bind_param($stmt, "i", $bcrt_id);
mysqli_stmt_execute($stmt);

if (mysqli_affected_rows($conn) > 0) {
    header("Location: bookings");
    exit();
} else {
    echo "Error deleting booking.";
}

mysqli_close($conn);
?>