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

    if($row['ClassID'] != "") {
      $classDetails = $connection->query("SELECT * FROM Class WHERE ClassID = ".$row['ClassID'])->fetch_assoc();
      $query = $connection->query("SELECT * FROM Teacher WHERE TeacherID = ".$classDetails['TeacherID']);
      $teacherDetails = $query->fetch_assoc();
    }

    $topics = $connection->query("SELECT * FROM Topic
    INNER JOIN Teacher
    ON Topic.AuthorID = Teacher.TeacherID");
    


?>

<head>
    <title>Cloud Coding | Student dashboard</title>
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"/>
    <link rel="stylesheet" href="../css/mdb.min.css" />
    <link rel="stylesheet" href="../css/custom.css" />
</head>
<?php require("../require/nav.php")?>
  <div id="particles-js" class="animation_background" ></div>
  <?php if(isset($_GET['error'])) { echo'<div class="alert alert-danger m-3"><p>'.$_GET['error'].'</p></div>';} ?>
  <div class="p-5 align-items-start" id="particles-jss">
    <div class="row">
      <div class="col p-3 m-3 mt-0">
        <div class="card p-3">
          <h1 class="mb-3">Hello, <?php echo $row['Username']; ?></h1>
          <h4 class="mb-3">Student Dashboard</h4>
          <p>Access assignments, view progress and start your own revision sessions here.</p>
        </div>
        <?php if($row['ClassID'] == "") { echo'
          <div class="card mt-3 p-3">
            <h4>Class</h4>
            <p class="alert alert-warning">You are not in a class. Join a class by clicking below.</p>
            <button type="button" class="btn btn-warning" data-mdb-toggle="modal" data-mdb-target="#addClassModal"#>Join Class</button>
          </div>
          ';
        }else { echo '
        <div class="card mt-3 p-3">
          <h4>Class Details</h4>
          <p><strong class="badge badge-primary">Class Name:</strong> '.$classDetails['Class Name'].'
          </br><strong class="badge badge-primary">Class Description:</strong> '.$classDetails['Class Description'].'
          </br><strong class="badge badge-primary">Teacher:</strong> '.$teacherDetails["Username"].'</p>
          <p>You have <span class="badge badge-success">0</span> upcoming assignments
          </br>You have <span class="badge badge-success">0</span> overdue assignments</p>
        </div>
        ';} ?>
        <div class="card mt-3 p-3">
          <h4>Learn</h4>
          <p>Learn topics outside of a class-set assignment.</p>
          <a class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#learnModal">Learn Topic</a>
        </div>
      </div>
      <div class="col mr-5 p-3">
          <div class="card p-3">
            <h4>Your progress</h4>
            <canvas id="doughnutChart"></canvas>
            <h4>Question accuracy: <span class="badge badge-primary"><?php if($row['Questions Answered'] != 0) {echo (($row['Questions Correct']/$row['Questions Answered'])*100)."%";}else{echo 0;} ?></span></h4>
            <h4>Questions answered: <span class="badge badge-primary"><?php echo $row['Questions Answered'];?></span></h4>
            <h4>Questions correct: <span class="badge badge-primary"><?php echo $row['Questions Correct'];?></span></h4>
          </div>
      </div>

  <div class="modal fade" id="addClassModal" tabindex="-1" aria-labelledby="addClassModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addClassModalLabel">Join Class</h5>
          <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="form" action="/actions/addClass.php" method="post">
            <div class="form-outline mb-4">
              <input  required type="text" name="code" id="typeCode-2" class="form-control form-control-lg" minlength=6 maxlength=6/>
              <label class="form-label" for="typeCode-2">Code</label>
            </div>
            <button class="btn btn-primary btn-block" type="submit">Join Class</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="learnModal" tabindex="-1" aria-labelledby="learnModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addClassModalLabel">Learn</h5>
          <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <input type="text" class="form-control" id="topicSearch" onkeyup="searchTopics()" placeholder="Search topic">
          <table class="table">
            <thead>
              <th>Topic Name</th>
              <th>Topic Description</th>
              <th>Author</th>
              <th>Learn</th>
            </thead>
            <tbody id="topicTable">
              <?php 
                foreach($topics as $topic) {
                  echo "<tr><td>".$topic["Topic Name"]."</td>";
                  echo "<td>".$topic["Topic Description"]."</td>";
                  if($topic["AuthorID"] == 1) {echo '<td>Cloud Coding</br> <span class="badge badge-success">Approved Author</span></td>';} else {echo '<td>'.$topic["Username"].'</td>';}
                  echo '<td><a class="btn btn-primary" href="/student/learn.php?id='.$topic["TopicID"].'" >Learn</a></td>';
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

<script src="../particles.js"></script>
<script src="../js/app.js"></script>
</header>

<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
<script src="https://unpkg.com/@adminkit/core@latest/dist/js/app.js"></script>
<script type="text/javascript" src="../js/mdb.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script>
    var ctxD = document.getElementById("doughnutChart").getContext('2d');
    var myLineChart = new Chart(ctxD, {
    type: 'doughnut',
    data: {
      labels: ["Questions Answered", "Questions Correct"],
      datasets: [{
        data: [<?php echo ($row["Questions Answered"] - $row["Questions Correct"]); ?>, <?php echo $row["Questions Correct"]; ?>],
        backgroundColor: ["f6f6f6", "#1266F1"],
        hoverBackgroundColor: ["#f5f5f5", "#1266F1"]
      }]
    },
    options: {
      responsive: true
    }
    });

    function searchTopics() {
      var td, i, textValue;
      var input = document.getElementById("topicSearch");
      var filter = input.value.toUpperCase();
      var table = document.getElementById("topicTable");
      var tr = table.getElementsByTagName("tr");

      for(i = 0; i <= tr.length-1; i++) {
        tr[i].style.display = "none";
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        } 
      }
    }
  </script>