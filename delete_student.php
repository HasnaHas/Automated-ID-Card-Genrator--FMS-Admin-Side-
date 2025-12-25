<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: index.php?error=Please Login with Admin Account to Access");
    exit();
}
include("Include PHP/database_connection.php");  // adjust path

if (isset($_GET['regno'])) {
    $regno = intval($_GET['regno']);

    // Get image filename to delete file
    $stmt = $conn->prepare("SELECT IMAGE FROM student WHERE REGNO = ?");
    $stmt->bind_param("i", $regno);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $imagePath = "profile/" . $row['IMAGE'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    // Delete student record
    $stmt = $conn->prepare("DELETE FROM student WHERE REGNO = ?");
    $stmt->bind_param("i", $regno);
    if ($stmt->execute()) {
        header("Location: home.php?message=Student deleted successfully");
        exit();
    } else {
        echo "Error deleting student: " . $conn->error;
    }
} else {
    header("Location: home.php");
    exit();
}
?>
