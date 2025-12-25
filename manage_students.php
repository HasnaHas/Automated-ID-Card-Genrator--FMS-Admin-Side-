<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

include("Include PHP/database_connection.php");

if (isset($_GET['action']) && isset($_GET['regno'])) {
    $action = $_GET['action'];
    $regno = $_GET['regno'];
    $status = $action == 'approve' ? 'approved' : 'rejected';
    $sql = "UPDATE student SET STATUS = ? WHERE REGNO = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $regno);
    $stmt->execute();
    header("Location: manage_students.php");
    exit();
}

// Get pending students
$sql = "SELECT * FROM student WHERE STATUS = 'pending'";
$pending_students = $conn->query($sql);
if (!$pending_students) {
    die("Database query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Students</title>
    <link rel="stylesheet" href="CSS/bootstrap.css">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/additional_stylesheet.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">FMS Admin</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="home.php">Home</a>
                <a class="nav-link" href="manage_students.php">Manage Students</a>
                <a class="nav-link" href="check_login.php?logout=true">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Manage Students</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Reg No</th>
                    <th>Name</th>
                    <th>Index No</th>
                    <th>Department</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($student = $pending_students->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $student['REGNO']; ?></td>
                        <td><?php echo $student['FIRSTNAME'] . ' ' . $student['LASTNAME']; ?></td>
                        <td><?php echo $student['INDEXNO']; ?></td>
                        <td><?php echo $student['DEPARTMENT']; ?></td>
                        <td><?php echo $student['STATUS']; ?></td>
                        <td>
                            <a href="manage_students.php?action=approve&regno=<?php echo $student['REGNO']; ?>" class="btn btn-success btn-sm">Approve</a>
                            <a href="manage_students.php?action=reject&regno=<?php echo $student['REGNO']; ?>" class="btn btn-danger btn-sm">Reject</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
