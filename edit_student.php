<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: index.php?error=Please Login with Admin Account to Access");
    exit();
}
include("Include PHP/database_connection.php");

if (!isset($_GET['regno'])) {
    header("Location: home.php");
    exit();
}

$regno = intval($_GET['regno']);
$stmt = $conn->prepare("SELECT * FROM student WHERE REGNO = ?");
$stmt->bind_param("i", $regno);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    die("Student not found");
}
$student = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $gender = $_POST['gender'];
    $batch = $_POST['batch'];
    $department = $_POST['department'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phone'];

    $imageName = $student['IMAGE'];
    if (!empty($_FILES['profile_image']['name'])) {
        $target_dir = "profile/";
        $imageName = basename($_FILES['profile_image']['name']);
        $target_file = $target_dir . $imageName;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $valid_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($imageFileType, $valid_extensions)) {
            if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file)) {
                $oldImage = $target_dir . $student['IMAGE'];
                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            } else {
                die("Error uploading image");
            }
        } else {
            die("Invalid image file type");
        }
    }

    $changed = ($firstName != $student['FIRSTNAME'] ||
                $lastName != $student['LASTNAME'] ||
                $gender != $student['GENDER'] ||
                $batch != $student['BATCH'] ||
                $department != $student['DEPARTMENT'] ||
                $email != $student['EMAIL'] ||
                $phoneNumber != $student['PHONENUMBER'] ||
                $imageName != $student['IMAGE']);

    if ($changed) {
        $stmt = $conn->prepare("UPDATE student SET FIRSTNAME=?, LASTNAME=?, GENDER=?, BATCH=?, DEPARTMENT=?, EMAIL=?, PHONENUMBER=?, IMAGE=? WHERE REGNO=?");
        $stmt->bind_param("ssssssssi", $firstName, $lastName, $gender, $batch, $department, $email, $phoneNumber, $imageName, $regno);
        if ($stmt->execute()) {
            header("Location: home.php?message=Student updated successfully");
            exit();
        } else {
            echo "Error updating student: " . $conn->error;
        }
    } else {
        header("Location: home.php?message=No changes were made");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Student</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: #f7f9fc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            max-width: 700px;
            margin: 40px auto;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .card-header {
            background-color: #198754; 
            color: white;
            font-weight: 600;
            font-size: 1.5rem;
            border-radius: 12px 12px 0 0;
            text-align: center;
            padding: 1.25rem;
        }
        .form-label {
            font-weight: 600;
        }
        .form-control {
            border-radius: 8px;
        }
        .btn-success {
            border-radius: 8px;
            padding: 0.6rem 2rem;
            font-weight: 600;
        }
        .btn-danger {
            border-radius: 8px;
            padding: 0.6rem 2rem;
            font-weight: 600;
            margin-left: 15px;
        }
        .img-preview {
            max-width: 150px;
            max-height: 150px;
            display: block;
            margin-top: 10px;
            border-radius: 10px;
            object-fit: cover;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }
        @media (min-width: 768px) {
            .form-row {
                display: flex;
                align-items: center;
                margin-bottom: 15px;
            }
            .form-label {
                width: 140px;
                margin-bottom: 0;
            }
            .form-control, select.form-control {
                flex: 1;
            }
            .gender-options {
                display: flex;
                gap: 30px;
                padding-top: 5px;
            }
        }
    </style>
</head>
<body>

<div class="card">
    <div class="card-header">
        Edit Student Information
    </div>
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">
            
            <div class="form-row">
                <label class="form-label" for="first-name">First Name</label>
                <input type="text" id="first-name" name="first-name" class="form-control" 
                       value="<?php echo htmlspecialchars($student['FIRSTNAME']); ?>" required />
            </div>

            <div class="form-row">
                <label class="form-label" for="last-name">Last Name</label>
                <input type="text" id="last-name" name="last-name" class="form-control" 
                       value="<?php echo htmlspecialchars($student['LASTNAME']); ?>" required />
            </div>

            <div class="form-row">
                <label class="form-label">Gender</label>
                <div class="gender-options">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="male" value="MALE" <?php if($student['GENDER'] == 'MALE') echo 'checked'; ?>>
                        <label class="form-check-label" for="male">Male</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="female" value="FEMALE" <?php if($student['GENDER'] == 'FEMALE') echo 'checked'; ?>>
                        <label class="form-check-label" for="female">Female</label>
                    </div>
                </div>
            </div>

            <div class="alert alert-warning" role="alert">
                <strong>Note:</strong> Batch and Department cannot be updated here. If you need to change them, please register the student again.
            </div>

            <div class="form-row">
                <label class="form-label" for="batch">Batch</label>
                <input type="text" id="batch" name="batch" class="form-control"
                       value="<?php echo htmlspecialchars($student['BATCH']); ?>" readonly />
            </div>

            <div class="form-row">
                <label class="form-label" for="department">Department</label>
                <select id="department" name="department" class="form-control" disabled>
                    <option value="ICT" <?php if($student['DEPARTMENT'] == 'ICT') echo 'selected'; ?>>ICT</option>
                    <option value="BST" <?php if($student['DEPARTMENT'] == 'BST') echo 'selected'; ?>>BST</option>
                    <option value="EGT" <?php if($student['DEPARTMENT'] == 'EGT') echo 'selected'; ?>>EGT</option>
                </select>
            </div>

            <div class="form-row">
                <label class="form-label" for="email">Email Address</label>
                <input type="email" id="email" name="email" class="form-control" 
                       value="<?php echo htmlspecialchars($student['EMAIL']); ?>" required />
            </div>

            <div class="form-row">
                <label class="form-label" for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone" class="form-control" 
                       value="<?php echo htmlspecialchars($student['PHONENUMBER']); ?>" required />
            </div>

            <div class="form-row flex-column">
                <label class="form-label" for="profile_image">Profile Image</label>
                <input type="file" id="profile_image" name="profile_image" class="form-control-file" accept="image/*" />
                <img src="profile/<?php echo htmlspecialchars($student['IMAGE']); ?>" alt="Profile Image" class="img-preview" />
            </div>

            <div class="form-row mt-4 justify-content-end">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="home.php" class="btn btn-danger">Cancel</a>
            </div>

        </form>
    </div>
</div>

</body>
</html>
