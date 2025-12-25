<?php
    session_start();
    session_unset();
    session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/additional_stylesheet.css">
    <link rel="stylesheet" href="css/home.css">
    
</head>
<body class="bgimg-reg">
    
    <div>
    <div class="">
        <div class="login-floating-box d-flex justify-content-center align-items-center vh-100 ">   
            <div class="col-xl-9 ">
            
                <div class="card rounded-3 text-black py-1 px-md-1 ">
                
            
                    <div class="row g-2 col col-xl-10">
                        <div class="login-input">
                            <div class="card-body p-md-5 mx-md-4">
                                <div class="text-center ">
                                    <img src="images/logo.png" 
                                        alt="logo">
                                </div>
                                <form method="POST" 
                                action="check_login.php" autocomplete="off">
                                <br>
                                <?php if (isset($_GET['error'])) { ?>
                                  <p class="error">
                                    <?php 
                                        echo "<b>".$_GET['error']."</b>"; 
                                    ?>
                                  </p>
                                <?php } else { ?> 
                                    <p class="please-login">
                                    <b>Admin Login</b></p>
                                <?php } 
                                    session_start();
                                    session_unset();
                                    session_destroy();
                                ?>
                                    <div class="form-outline mb-4 ">
                                    <label class="form-label" 
                                    for="username">Username</label>
                                    <input name="email" type="email" 
                                    id="username1" class="form-control"
                                    placeholder="email address"/>
                                    </div>
                                    <div class="form-outline mb-4">
                                    <label class="form-label" 
                                    for="password">Password</label>
                                    <input name="pass" type="password" 
                                    id="password" class="form-control"
                                    placeholder="password"/>
                                    </div>

                                    <div class="text-center pt-1 mb-5 pb-1">
                                    <p>
                                        <input class="btn btn-primary btn-block" 
                                        type="submit" value="Login">
                                    </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="slideshow-container-login fade-login">
                                <img id="slide-login"  
                                width="100%" 
                                    src="" 
                                alt="Slideshow Image">
                                <button id="prevButton-login">❮</button>
                                <button id="nextButton-login">❯</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="JS/script.js"></script>
</body>
</html>