<?php
session_start();

include "userdb.php";

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

//IDs
$court_id = $_GET['court_id'];
$user_id = $_GET['user_id'];

if ($_SESSION['user_id'] != $user_id) {
    header('Location: view-court?id=$court_id');
    exit();
}

$stmt = mysqli_prepare($conn, "DELETE FROM review_court WHERE court_id = ? AND user_id = ?");
mysqli_stmt_bind_param($stmt, "ii", $court_id, $user_id);
mysqli_stmt_execute($stmt);

if (mysqli_affected_rows($conn) > 0) {
    header("Location: view-court?id=$court_id");
    exit();
} else {
    header("Location: view-court?id=$court_id");
    exit();
}

mysqli_close($conn);
?>