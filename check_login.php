<?php
    session_start();
    include("Include PHP/database_connection.php");

    if (!$conn) {
        echo "Connection failed!";
        exit();
    }

    if (isset($_POST['email']) && isset($_POST['pass'])) {
        function validate($data){
           $data = trim($data);
           $data = stripslashes($data);
           $data = htmlspecialchars($data);
           return $data;
        }
        $email = validate($_POST['email']);
        $pass = validate($_POST['pass']);
        if (empty($email)) {
            header("Location: unified_login.php?error=Admin Login: User Name is required");
            exit();
        } else if(empty($pass)){
            header("Location: unified_login.php?error=Admin Login: Password is required");
            exit();
        } else {
            $simple_string = $pass."\n";
            // Storing the cipher method
            $ciphering = "AES-128-CTR";
            // Using OpenSSl Encryption method
            $iv_length = openssl_cipher_iv_length($ciphering);
            $options = 0;
            // Non-NULL Initialization Vector for encryption
            $encryption_iv = '1234567891011121';
            // Storing the encryption key
            $encryption_key = "W3docs";
            // Using openssl_encrypt() function to encrypt the data
            $pass_encrypted = openssl_encrypt($simple_string, $ciphering, $encryption_key, $options, $encryption_iv);

            $sql = "SELECT * FROM administration_users WHERE email=? AND password=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $email, $pass_encrypted);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                if ($row['email'] === $email && $row['password'] === $pass_encrypted) {
                    $_SESSION['email'] = $row['email'];
                    header("Location: home.php");
                    exit();
                } else {
                    header("Location: unified_login.php?error=Admin Login: Incorrect User name or password");
                    exit();
                }
            } else {
                header("Location: unified_login.php?error=Admin Login: Incorrect User name or password");
                exit();
            }
        }
    } else {
        header("Location: unified_login.php");
        exit();
    }
?>
