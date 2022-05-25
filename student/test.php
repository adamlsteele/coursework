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

    $commonWords = array("and, if, a, so");

    //SQL query to gather information about the topic in question
    $sql = $connection->query("SELECT * FROM Topic WHERE TopicID = ".$_GET['id']);
    $topicDetails = $sql->fetch_assoc();

    //Post query that checks all of the answers
    if($_SERVER['REQUEST_METHOD'] === "POST") {
       $words = $_POST['words'];
       $correctWords = $_POST['correctWords'];

       $questions = count($words);
       $questionsCorrect = 0;

       //Compare the inputted answers with the correct answers
       for($i = 0; $i < count($words); $i++) {
           if(strtolower($words[$i]) == strtolower($correctWords[$i])) {
               ++$questionsCorrect;
           }
       }

       //Create a result for the user
       $query = "INSERT INTO Result(`TopicID`, `StudentID`, `Questions Answered`, `Questions Correct`) VALUES('"
       .$topicDetails['TopicID']."', '".$_SESSION['id']."', '".$questions."', '".$questionsCorrect."')";
       $connection->query($query);

       //Update user statistics
       $query = "
       UPDATE Student SET `Questions Answered` = `Questions Answered` + ".$questions."
       WHERE StudentID = ".$_SESSION['id'];
       $connection->query($query);

       $query = "
       UPDATE Student SET `Questions Correct` = `Questions Correct` + ".$questionsCorrect."
       WHERE StudentID = ".$_SESSION['id'];
       $connection->query($query);
    }

?>

<head>
    <title> Topic | <?php echo $topicDetails['Topic Name'];?></title>
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"/>
    <link rel="stylesheet" href="../css/mdb.min.css" />
    <link rel="stylesheet" href="../css/custom.css" />
</head>

<?php
if($_SERVER['REQUEST_METHOD'] === "POST") {
    echo ('


<div class="alert alert-success m-4 " role="alert">
<h4 class="alert-heading">Results</h4>
<p>You scored: '.$questionsCorrect.'/'.$questions.'</p>
<hr>
<p class="mb-0">You put (');

foreach($words as $word) {
    echo $word.' ';
}

echo ').</br>The correct answers were (';

foreach($correctWords as $correctWord) {
    echo $correctWord.' '; 
}

echo ').</p></br><a class="alert-link" href="/">Go back</a></div>'; }

?>
<body>
    <div class="container py-4">
    <header class="pb-3 mb-4 border-bottom">
      <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
        <span class="fs-4">Cloud Coding | Test</span>
        
      </a>
    </header>

    <div class="p-5 mb-4 bg-light rounded-3">
      <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold"><?php echo $topicDetails['Topic Name'];?></h1>
        <p class="col-md-8 fs-4"><?php echo $topicDetails['Topic Description'];?></p> 
      </div>
    </div>

    <div class="row align-items-md-stretch">
      <div class="col-md-6">
        <div class="h-100 p-5 text-white bg-dark rounded-3">
          <h2>Theory</h2>
          <form method="post" action="#"><p><?php
          
    //Splitting paragraphs at their break line point
    $correctWordsArray = [];
    $seperateTheoryParagraphs = explode("</br></br>", $topicDetails['Topic Content']);
    foreach($seperateTheoryParagraphs as $paragraph) {
        //Remove punctuation from the paragraph such as commas and hyphens
        $unpunctuatedParagraph = trim(preg_replace("/[^0-9a-z]+/i", " ", $paragraph));
        //Split the paragraph into an array of words
        $unpunctuatedParagraphWords = explode(" ", $unpunctuatedParagraph);
        foreach($unpunctuatedParagraphWords as $word) {
            //Randomly assign words to fill in
            $randomNumber = rand(1,6);
            echo ' ';

            if($randomNumber == 2) {
                echo('<input required type="text" class="" name="words[]" size="'.strlen($word).'"></input>');
                echo('<input type="hidden" name="correctWords[]" value="'.$word.'")</input>');
                array_push($correctWordsArray, $word);
            }else {
                //Print the word normally if it is not randomly selected
                echo $word;
            }
            //Print a space between words
        }
        //Print a line break in between paragraphs
        echo(". </br>");
    }
          
          
          ?></p><button class="btn btn-primary" type="submit">Check</button></form>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>