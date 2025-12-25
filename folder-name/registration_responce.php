<?php 
    session_start();
    if (isset($_SESSION['email'])) {
        include("../Include PHP/database_connection.php");
    
        $firstName = $_POST['first-name'];
        $lastName = $_POST['last-name'];
        $gender = $_POST['gender'];
        $batch = $_POST['bth'];
        $dept = $_POST['department'];
        $email = $_POST['email'];
        $phoneNumber = $_POST['pno'];

        $booleanCheckForID = FALSE;

        $sql = "SELECT regno from student;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $regNo = $row['regno'];
            }
                $regNo += 1;
        } else {
                $regNo = 1;
        }

        $year = substr($batch, -2); // Last 2 digits of batch

        // Find the maximum sequence number for this department and year
        $sql = "SELECT MAX(CAST(SUBSTRING_INDEX(indexno, '/', -1) AS UNSIGNED)) as max_seq
                FROM student
                WHERE department='{$dept}' AND indexno LIKE '{$dept}/{$year}/%'";

        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $max_seq = $row['max_seq'] ? $row['max_seq'] : 0;
        $seq = $max_seq + 1;

        $indexno = $dept . '/' . $year . '/' . sprintf('%03d', $seq);

        // Generate unique barcode string for the student (using regno + indexno for security)
        $barcodeString = $regNo . $indexno;

        // Include barcode generation library
        include('barcode.php');

        // Generate barcode image and save to barcodes directory
        $barcodeFileName = "barcode_" . $regNo . "_" . time() . ".png";
        $barcodeFilePath = "barcodes/" . $barcodeFileName;

        // Generate barcode image using barcode.php (assuming it has a function generateBarcode)
        generateBarcode($barcodeString, $barcodeFilePath);

        // Save barcode string to database along with other student info

        
        $name = $_FILES['sppimage']['name'];
        $target_dir = "../profile/";
        $target_file = $target_dir . basename($_FILES["sppimage"]["name"]);
        
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $extensions_arr = array("jpg","jpeg","png","gif");
    
        if( in_array($imageFileType,$extensions_arr) ){
             if(move_uploaded_file($_FILES['sppimage']['tmp_name'], $target_file)){

                $sql = "INSERT INTO STUDENT
                (FIRSTNAME,LASTNAME,REGNO,INDEXNO,GENDER,BATCH,DEPARTMENT,EMAIL,PHONENUMBER,IMAGE,BARCODE)
                VALUES
                ('{$firstName}','{$lastName}','{$regNo}','{$indexno}','{$gender}','{$batch}','{$dept}','{$email}','{$phoneNumber}','{$name}','{$barcodeFilePath}')";
                
                $conn->query($sql); 
                
                $booleanCheckForID = TRUE;

             } else {
                    echo "Registration Failed";
             }
        } else {
            echo "Registration Failed";
        }       
    } else {
        header("Location: index.php?error=Please Login with Admin Account to Access");
        exit();
    }

    if ($booleanCheckForID) {
        header("Location: print_id_card.php?regno=$regNo");
        exit();
    } else {
        echo "Registration Failed";
    }
?>
