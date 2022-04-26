<?php
    //Error reporting
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();

    if(isset($_SESSION['auth']) == true) {
      header("Location: /".$_SESSION['type']."/");
    }
?>

<head>
    <title>Cloud Coding | Sign Up</title>
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"/>
    <link rel="stylesheet" href="css/mdb.min.css" />
    <link rel="stylesheet" href="../css/custom.css" />
</head>
<div id="particles-js"></div>
<body class="">
<section class="">
  <div class="container py-5">
    <div class="row d-flex justify-content-center align-items-center h-200">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5">
            <h3 class="text-center">Cloud Coding</h3>
            <h5 class="mb-5 text-center">Sign Up</h5>
            <?php if(isset($_GET['error'])) { echo '<p id="errorText" class="alert alert-danger">';}?><?php if(isset($_GET['error'])) {echo($_GET['error']);}?></p>
            <form id="form" action="/actions/signup.php" method="post">
              <div class="form-outline mb-4">
                <input  required type="text" name="name" id="typeNameX-2" class="form-control form-control-lg" maxlength=64/>
                <label class="form-label" for="typeNameX-2">Username</label>
              </div>

              <div class="form-outline mb-4">
                <input required type="email" name="email" id="typeEmailX-2" class="form-control form-control-lg" maxlength=64/>
                <label class="form-label" for="typeEmailX-2">Email</label>
              </div>
              <div class="form-outline mb-4">
                <input required type="password" name="password" id="password" class="form-control form-control-lg" maxlength=32/>
                <label class="form-label" for="password">Password</label>
              </div>

              <div class="form-outline mb-4">
                <input required type="password" name="confirmPassword" id="confirmPassword" class="form-control form-control-lg" maxlength=32/>
                <label class="form-label" for="confirmPassword">Confirm Passsword</label>
              </div>

              <p class="text-left">Select account type</p>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="accountType" id="accountType1" value="student" checked>
                <label class="form-check-label text-left" for="exampleRadios1">Student</label>
              </div>
              <div class="form-check">
               <input class="form-check-input" type="radio" name="accountType" id="accountType2" value="teacher">
                <label class="form-check-label text-left" for="exampleRadios2">Teacher</label>
              </div>
              </br>

              <button class="btn btn-primary btn-lg btn-block" type="submit">Sign Up</button>
            </form>
            <hr class="my-4">
            <p>Have an account? Access teacher/student login <a href="/">here</a>.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="../particles.js"></script>
<script src="../js/app.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $("form").submit(function(event) {
          password = $("password").val();
          confirmPassword = $("confirmPassword").val();
          if(password != confirmPassword) {
            $("errorText").innerText = "Two passwords do not match";
            alert("f");
            event.preventDefault();
          }
        });
    </script>
</body>
