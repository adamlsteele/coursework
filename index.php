<?php
    //Error reporting
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();

    if(isset($_SESSION['auth']) == true) {
      header("Location: /".$_SESSION['type']."/index");
    }
?>  

<head>
    <title>Cloud Coding | Log in</title>
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
            <h5 class="mb-5 text-center">Log In</h5>
            <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
                <li class="nav-item text-center" role="presentation">
                    <button class="nav-link active" id="pills-teacher-tab" data-bs-toggle="pill" data-bs-target="#pills-teacher" type="button" role="tab" aria-controls="pills-teacher" aria-selected="true">Student</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-student-tab" data-bs-toggle="pill" data-bs-target="#pills-student" type="button" role="tab" aria-controls="pills-student" aria-selected="false">Teacher</button>
                </li>
            </ul>
            <?php if(isset($_GET['error'])) { echo '<p id="errorText" class="alert alert-danger">';}?><?php if(isset($_GET['error'])) {echo($_GET['error']);}?></p>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-teacher" role="tabpanel" aria-labelledby="pills-teacher-tab">
                    <form class="tab-pane fade show active " id="form" action="/actions/login.php?type=student" method="post"  id="pills-teacher" role="tab-panel">
                    <h5>Student Login</h5>
                    <input name="type" value="student" hidden/>
                    <div class="form-outline mb-4">
                        <input required type="email" name="email" id="typeEmailX-2" class="form-control form-control-lg" maxlength=64/>
                        <label class="form-label" for="typeEmailX-2">Email</label>
                    </div>
                    <div class="form-outline mb-4">
                        <input required type="password" name="password" id="password" class="form-control form-control-lg" maxlength=32/>
                        <label class="form-label" for="password">Password</label>
                    </div>
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                    </form>
                </div>
                <div class="tab-pane fade" id="pills-student" role="tabpanel" aria-labelledby="pills-student-tab">
                    <form class="" id="form" action="/actions/login.php?type=teacher" method="post" id="pills-student" role="tab-panel">
                    <h5>Teacher Login</h5>
                    <input name="type" value="teacher" hidden/>
                    <div class="form-outline mb-4">
                        <input type="email" name="email" id="typeEmailX-2" class="form-control form-control-lg" maxlength=64/>
                        <label class="form-label" for="typeEmailX-2">Email</label>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="password" name="password" id="password" class="form-control form-control-lg" maxlength=32/>
                        <label class="form-label" for="password">Password</label>
                    </div>
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                    </form>
                </div>
            </div>
            <hr class="my-4">
            <p>Need an account? Click <a href="/signup">here</a>.</p>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
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
