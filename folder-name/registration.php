<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/additional_stylesheet.css">
</head>
<body class="bgimg-reg">
  <?php
  session_start();
  if (isset($_SESSION['email'])) {
  ?> 
    <div class="content-align-to-center">
    <div class="col-md-6 semi-whitebg">         
      <p class="text-center underlineforstd">
        <legend><b>STUDENT REGISTRATION</b></legend>
      </p>

      <form method="post" action="registration_responce.php" enctype="multipart/form-data">
        <legend><b>Student Information</b></legend>
        <u>Add your details to the relevant fields</u>
        <br>
        <div class="mb-3 form-group registration-form-margin">    
          <div class="input-group">
            <div class="row g-3">
              <div class="col">
                <div class="input-group">
                  <span class="input-group-text"><b>First Name</b></span>
                  <input type="text" aria-label="First name" 
                  class="form-control" placeholder="JOHN" name="first-name">
                </div>
              </div>
              <div class="col">
                <div class="input-group">
                <span class="input-group-text"><b>Last Name</b></span>
                <input type="text" aria-label="Last name" 
                class="form-control" placeholder="PETER" name="last-name">
              </div>
            </div>
          </div>
        </div>
        <div class="mb-3 form-group registration-form-margin">  
        </div>
        <div class="gender-batch-department">
          <div class="col mb-4 gx-6 form-group">
            <label for="gender" class="form-label">Gender:</label>
            <div class="form-check">
                  <input class="form-check-input" 
                  type="radio" name="gender" id="male" 
                  checked value="Male">
                  <label class="form-check-label" 
                  for="male">Male</label>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input class="form-check-input" type="radio" 
                  name="gender" id="female" value="Female">
                  <label class="form-check-label" for="Female">
                  Female
                  </label>
              </div>
          </div>
          <div class="col mb-4 gx-6 form-group">
            <label for="addbatch" class="form-label">Batch:</label>
            <input name="bth" type="text" class="form-control" 
            id="addbatch" >
          </div>
          <div class="col mb-4 gx-6 form-group"> 
              <label for="adddeptcode" class="form-label">
              Department:
              </label>
              <select name="department"
              class="form-select" id="adddept" required>
                  <option selected disabled value="">Choose</option>
                  <option value="ICT">ICT</option>
                  <option value="BST">BST</option>
                  <option value="EGT">EGT</option>
               </select>
          </div>
        </div>
        <div class="mb-3 form-group">
            <label for="addstudentEmail1" class="form-label">
              Email address:</label>
            <input name="email" type="email" 
            class="form-control" id="exampleInputEmail1" 
            placeholder="Ex:name@example.com">
        </div>
        <div class="mb-3 form-group">
            <label for="addphoneno" class="form-label">
              Phone Number:</label>
            <input name="pno" type="number" 
            class="form-control" id="addphoneno" 
            aria-describedby="emailHelp">
        </div>
        <div class="mb-3 form-group">
          <labele for ="stimage" class="form-label">
            Student profile pic</lable>
            <small class="form-text text-muted">
    Please upload a passport size photo (e.g., 3.5cm x 4.5cm)
  </small>
          <input name="sppimage" class="form-control"
          type="file" id="addstudentpic" accept="image/*">
        </div>
        <div class="button-submit-reset registration-form-margin">
          <input type="Submit" value="Submit and Generate ID Card"
          class="btn btn-primary">
          <input type="Reset" value="Reset"
          class="btn btn-danger margin-left-input">
        </div>
      </form>
    </div>
  </div>
  <?php
  } else {
      header("Location: index.php?error=Please Login with Admin Account to Access");
      exit();
  }
  ?>

</body>
</html>
