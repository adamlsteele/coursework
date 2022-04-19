<?php
    require("../require/connection.php");
    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if(!isset($_SESSION['auth'])) {
        header("Location: /");
    }else{
        if($_SESSION['auth'] != true && $_SESSION['type'] != "student") {
            header("Location: /");
        }
    }
    $result = $connection->query("SELECT * FROM Student WHERE StudentID = ".$_SESSION['id']);
    $row = $result->fetch_assoc();
?>

<head>
    <title>Cloud Coding | Student dashboard</title>
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"/>
    <link rel="stylesheet" href="../css/mdb.min.css" />
    <link rel="stylesheet" href="../css/custom.css" />
</head>

<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarMobile" aria-controls="navbarMobile" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>

      <div class="collapse navbar-collapse" id="navbarMobile">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item active">
            <a class="nav-link" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Learn</a>
          </li>
          <li class="nav-item">
              <a class="nav-link bg-danger btn" href="../actions/logout.php">Sign out</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
<div id="particles-js"></div>
  <div class="p-5 align-items-start">
    <div class="col">
        <h1 class="mb-3">Hello, <?php echo $row['Username']; ?></h1>
        <h4 class="mb-3">Student Dashboard</h4>
        <a class="btn btn-primary" href="" role="button">Learn</a>
    </div>
  </div>

<script src="../particles.js"></script>
<script src="../js/app.js"></script>
</header>



<script type="text/javascript" src="../js/mdb.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>