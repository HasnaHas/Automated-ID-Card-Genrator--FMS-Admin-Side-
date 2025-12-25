<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    
    <!-- Google Fonts: Use a clean modern font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
    
    <title>FACULTY MANAGEMENT SYSTEM</title>
    
    <style>
        /* Use the font */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa; /* Light Bootstrap gray background */
            min-height: 100vh;
            padding-top: 40px;
            padding-bottom: 40px;
        }
        
        h2.page-heading {
            font-weight: 700;
            color: #343a40;
            margin-bottom: 2rem;
        }
        
        .container {
            max-width: 1400px;
        }
        
        /* Table styling */
        table {
            background: white;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        
        thead.thead-dark th {
            background-color: #343a40;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 600;
        }
        
        tbody tr:hover {
            background-color: #e9f5ff;
        }
        
        /* Profile images as small stamps */
        .profile-pic {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }
        .action-btns {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
        }
        /* Action buttons spacing */
        .action-btns a {
            margin-left: 0.3rem;
            transition: color 0.2s ease;
        }
        
        .action-btns a:hover {
            color: #0056b3 !important;
        }
        
        /* Responsive search & buttons */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 1.5rem;
            gap: 1rem;
        }

        /* Left controls container */
        .left-controls {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .search-input {
            max-width: 300px;
            width: 100%;
        }

        /* Date/time styling */
        #datetime {
            min-width: 180px;
            font-weight: 600;
            color: #6c757d; /* Bootstrap muted color */
            white-space: nowrap;
        }
        
        .top-bar .btn, 
        .top-bar form {
            margin-bottom: 0.5rem;
        }
        
        @media (max-width: 576px) {
            .top-bar {
                flex-direction: column;
                align-items: flex-start;
            }
            .left-controls {
                flex-direction: column;
                align-items: flex-start;
            }
            .search-input {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center page-heading">FACULTY MANAGEMENT SYSTEM</h2>
    <?php
session_start();
if (isset($_SESSION['email'])) {
    echo '<div class="top-bar d-flex justify-content-between align-items-center flex-wrap">';

    // Left side: Date/time
    echo '<div class="left-controls">';
    echo '<span id="datetime" class="text-muted font-weight-bold"></span>';
    echo '</div>';

    // Right side: Search + buttons
    echo '<div class="right-controls d-flex align-items-center flex-wrap gap-2" style="gap: 0.75rem;">';
    echo '<form class="form-inline mb-0 me-2" action="index.php" method="GET">';
    echo '<input id="search" name="search" class="form-control search-input" type="search" placeholder="Search students...">';
    echo '</form>';
    echo '<a href="Student_Registration/registration.php" class="btn btn-primary">Register Student</a>';
    echo '<a href="index.php" class="btn btn-danger">Logout</a>';
    echo '</div>';
}

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "FMS";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $search = isset($_GET['search']) ? $_GET['search'] : '';

    if (!empty($search)) {
        $stmt = $conn->prepare("SELECT * FROM student WHERE FIRSTNAME LIKE ? OR LASTNAME LIKE ? OR REGNO LIKE ? OR INDEXNO LIKE ? OR GENDER LIKE ? OR BATCH LIKE ? OR DEPARTMENT LIKE ? OR EMAIL LIKE ? OR PHONENUMBER LIKE ? OR BARCODE LIKE ?");
        $param = "%$search%";
        $stmt->bind_param("ssssssssss", $param, $param, $param, $param, $param, $param, $param, $param, $param, $param);
        $stmt->bind_param("ssssssssss", $param, $param, $param, $param, $param, $param, $param, $param, $param, $param);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        $result = $conn->query("SELECT * FROM student");
    }

    if ($result->num_rows > 0) {
        echo '<div class="table-responsive">';
        echo '<table class="table table-striped table-bordered">';
        echo '<thead class="thead-dark">';
        echo '<tr>';
        echo '<th>Profile</th>';
        echo '<th>First Name</th>';
        echo '<th>Last Name</th>';
        echo '<th>Reg No</th>';
        echo '<th>Index No</th>';
        echo '<th>Gender</th>';
        echo '<th>Batch</th>';
        echo '<th>Department</th>';
        echo '<th>Email</th>';
        echo '<th>Phone Number</th>';
        echo '<th>Actions</th>';
        echo '</tr>';
        echo '</thead><tbody>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td><img class="profile-pic" src="profile/' . htmlspecialchars($row['IMAGE']) . '" alt="Profile Pic"></td>';
            echo '<td>' . htmlspecialchars($row['FIRSTNAME']) . '</td>';
            echo '<td>' . htmlspecialchars($row['LASTNAME']) . '</td>';
            echo '<td>' . htmlspecialchars($row['REGNO']) . '</td>';
            echo '<td>' . htmlspecialchars($row['INDEXNO']) . '</td>';
            echo '<td>' . htmlspecialchars($row['GENDER']) . '</td>';
            echo '<td>' . htmlspecialchars($row['BATCH']) . '</td>';
            echo '<td>' . htmlspecialchars($row['DEPARTMENT']) . '</td>';
            echo '<td>' . htmlspecialchars($row['EMAIL']) . '</td>';
            echo '<td>' . htmlspecialchars($row['PHONENUMBER']) . '</td>';
            echo '<td class="action-btns">';
            echo '<a href="edit_student.php?regno=' . $row['REGNO'] . '" class="btn btn-success btn-sm" title="Update Student"><i class="fas fa-edit"></i></a> ';
            echo '<a href="Student_Registration/print_id_card.php?regno=' . $row['REGNO'] . '" target="_blank" class="btn btn-info btn-sm" title="Print ID Card"><i class="fas fa-print"></i></a> ';
            echo '<a href="delete_student.php?regno=' . $row['REGNO'] . '" onclick="return confirm(\'Are you sure you want to delete this student?\');" class="btn btn-danger btn-sm" title="Delete Student"><i class="fas fa-trash-alt"></i></a>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</tbody></table></div>';
    } else {
        echo '<p class="text-center text-muted">No students found.</p>';
    }

    $conn->close();
    ?>
</div>

<!-- Bootstrap JS & dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Date & time update script -->
<script>
function updateDateTime() {
    const dt = new Date();
    const options = { 
        weekday: 'short', year: 'numeric', month: 'short', day: 'numeric', 
        hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false 
    };
    document.getElementById('datetime').textContent = dt.toLocaleDateString('en-US', options);
}

document.addEventListener('DOMContentLoaded', () => {
    updateDateTime(); // initial call
    setInterval(updateDateTime, 1000); // update every second
});
</script>

<!-- Optional: client-side search filtering for instant feedback -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.getElementById("search");
        const tableRows = document.querySelectorAll("tbody tr");

        searchInput.addEventListener("input", function () {
            const searchTerm = searchInput.value.toLowerCase();
            tableRows.forEach(row => {
                const rowText = row.textContent.toLowerCase();
                row.style.display = rowText.includes(searchTerm) ? "table-row" : "none";
            });
        });
    });
</script>

</body>
</html>
