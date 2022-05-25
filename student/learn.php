<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);    

    require("../require/connection.php");

    session_start();
    
    //Redirect the user back to the home page if a topic is not selected
    if(!isset($_GET['id'])) {
        header("Location: /");
    }

    //Determine if a user is completing an assignment
    if(!isset($_GET['AssignmentID'])) {
        $assignment = false;
    }

    //SQL query to gather information about the topic in question
    $sql = $connection->query("SELECT * FROM Topic WHERE TopicID = ".$_GET['id']);
    $topicDetails = $sql->fetch_assoc();
    
?>

<head>
    <title> Topic | <?php echo $topicDetails['Topic Name'];?></title>
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"/>
    <link rel="stylesheet" href="../css/mdb.min.css" />
    <link rel="stylesheet" href="../css/custom.css" />
</head>

<body>
    <div class="container py-4">
    <header class="pb-3 mb-4 border-bottom">
      <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
        <span class="fs-4">Cloud Coding | Learn</span>
        
      </a>
    </header>

    <div class="p-5 mb-4 bg-light rounded-3">
      <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold"><?php echo $topicDetails['Topic Name'];?></h1>
        <p class="col-md-8 fs-4"><?php echo $topicDetails['Topic Description'];?></p>
        <a class="btn btn-primary" href="test?id=<?php echo $_GET['id']; ?>">Test knowledge</a>
      </div>
    </div>

    <div class="row align-items-md-stretch">
      <div class="col-md-6">
        <div class="h-100 p-5 text-white bg-dark rounded-3">
          <h2>Theory</h2>
          <p><?php echo $topicDetails['Topic Content'];?></p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="h-100 p-5 bg-light border rounded-3">
          <h2>Example</h2>
          <p><h5>Pseudocode</h5><?php
            $examples = explode("§", $topicDetails['Topic Example']);
            echo $examples[0];

          ?></br><h5>C#</h5><?php echo $examples[1]; ?></p>
        </div>
      </div>
    </div>
  </div>
</body>