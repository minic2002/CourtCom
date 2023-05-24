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
    $bcch_id = $_GET['id'];
    $stmt = mysqli_prepare($conn, "UPDATE book_coach SET Booking_Status = 'Decline' WHERE bcch_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $bcch_id);
    mysqli_stmt_execute($stmt);

    if (mysqli_affected_rows($conn) > 0) {
        header("Location: coach-booking-requests");
        exit();
    } 
?>