<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require("../require/connection.php");
    session_start();

    if(!isset($_SESSION['auth'])) {
        header("Location: /");
    }else{
        if($_SESSION['auth'] != true && $_SESSION['type'] != "student") {
            header("Location: /");
        }
    }
    
    $result = $connection->query("SELECT * FROM Student WHERE StudentID = ".$_SESSION['id']);
    $details = $result->fetch_assoc();

    if(isset($details['ClassID'])) {
        $classResult = $connection->query("SELECT * FROM Class WHERE ClassID = ".$details['ClassID']);
        $classDetails = $classResult->fetch_assoc();
    }
?>

<head>
    <title>Cloud Coding | Edit Profile</title>
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"/>
    <link rel="stylesheet" href="../css/mdb.min.css" />
    <link rel="stylesheet" href="../css/custom.css" />
</head>
<body>
    <?php require("../require/nav.php")?>
    <div class="container">
  <main>
    <div class="py-5 text-center">
      <h2>Edit Profile</h2>
      <p class="lead">Edit your user profile here.</p>
    </div>

    <div class="row g-5">
      <div class="col-md-5 col-lg-4 order-md-last">
        <?php if(isset($classDetails)) { echo '
        <h4 class="d-flex justify-content-between align-items-center mb-3">Your Class</h4>
        <div class="p-2">
          <h5 class="card-title">'.$classDetails['Class Name'].'</h5>
          <p class="card-body">'.
          $classDetails['Class Description'].'</br><strong class="badge badge-primary">Code: '.$classDetails['Class Code'].'</strong></p>
          <a href="../actions/leaveClass.php"class="btn btn-danger btn-block">Leave Class</a>
        </div>
        ';}?>
      </div>
      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Your Profile</h4>
        <form action="../actions/editProfile.php" method="POST">
          <div class="row g-3">
            <?php if(isset($_GET['success'])) { echo '<div class="alert alert-success">'.$_GET['success'].'</div>';} ?>
            <?php if(isset($_GET['error'])) { echo '<div class="alert alert-danger">'.$_GET['error'].'</div>';} ?>
            <div class="col-12">
              <label for="username" class="form-label">Username</label>
              <div class="input-group has-validation">
                <span class="input-group-text">@</span>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo $details['Username']; ?>" required>
              </div>
            </div>

            <div class="col-12">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" disabled value="<?php echo $details['Email']; ?>" placeholder="you@example.com">
            </div>

            <div class="col-12">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="col-12">
              <label for="confirmPassword" class="form-label">Confirm Password</label>
              <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" minlength="8">
            </div>

          <hr class="my-4">

          <button class="w-100 btn btn-primary btn-lg" type="submit">Save</button>

        </form>
      </div>
    </div>
  </main>


</body>