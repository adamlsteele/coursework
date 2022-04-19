<?php
    //Error reporting
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //Create Connection to database
    $host = "localhost";
    $username = "root";
    $database = "test";
    $connection = new mysqli($host, $username, null, $database);

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $address = $_POST['address'];

        if(isset($_POST['ID'])) {
            $updateQuery = "UPDATE tbInformation
            SET `First Name` = '".$firstName."', `Last Name` = '".$lastName."', `Address` = '".$address."'
            WHERE ID = ".$_POST['ID'];
            $connection->query($updateQuery);
        }else{
            $postSQLQuery = "INSERT INTO tbInformation(`First Name`, `Last Name`, `Address`) VALUES ('".$firstName."', '".$lastName."', '".$address."')";
            $connection->query($postSQLQuery);
        }

    }else if(isset($_GET['method'])) {

        if($_GET['method'] == 'delete') {

            $id = $_GET['id'];
            $removeQuery = "DELETE FROM tbInformation WHERE id = ". $id;
            $connection->query($removeQuery);

        }else if($_GET['method'] == 'deleteAll') {
            $removeAllQuery = "DELETE FROM tbInformation";
            $connection->query($removeAllQuery);
        }
    }

    //Select all results
    $sqlQuery = "SELECT * FROM tbInformation";
    $sqlResult = $connection->query($sqlQuery);


?>

<head>
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"/>
    <link rel="stylesheet" href="css/mdb.min.css" />

    <script>
        function loadModal(str) {
            if (str.length == 0) { 
                document.getElementById("modalContent").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("modalContent").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "modal.php?id=" + str, true);
                xmlhttp.send();
            }
        }
    </script>
</head>

<body>
    <!-- List View of all users currently in the database -->
    <div class="m-4 p-2">
        <div class="alert alert-success" role="alert">
            <?php if(isset($postSQLQuery)) {echo $postSQLQuery.'</br>';} ?>
            <?php if(isset($removeQuery)) {echo $removeQuery.'</br>';} ?>
            <?php if(isset($removeAllQuery)) {echo $removeAllQuery.'</br>';} ?>
            <?php if(isset($updateQuery)) {echo $updateQuery.'</br>';} ?>
            <?php if(isset($sqlQuery)) {echo $sqlQuery.'</br>';} ?>
        </div>
        <h1>Database</h1>
        <h4>List of users</h4>
        <table class="table table-striped">
            <thead>
                <th scope="col">ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Address</th>
                <th scope="col">Actions</th>
            </thead>
            <tbody>
                <?php
                    if($sqlResult->num_rows > 0) {
                        while($row = $sqlResult->fetch_assoc()){
                            echo '<tr><th scope="row">'.$row['ID'].'</th><td>'.$row['First Name'].'</td><td>'.$row['Last Name'].'</td><td>'.$row['Address'].'</td><td><btn class="btn btn-warning" onclick="loadModal('.$row['ID'].')" data-mdb-toggle="modal" data-mdb-target="#edit">Edit</btn> <a href="?method=delete&id='.$row['ID'].'"class="btn btn-danger">Delete</a></td></tr>';
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>

    <div class="m-4 p-2">
        <h4>Add a new user</h4>
        <br>
        <form action="index.php" method="post">
            <div class="form-outline mb-4">
                <input max=20 type="text" id="firstName" name="firstName" class="form-control" />
                <label class="form-label" for="firstName">First Name </label>
            </div>

            <div class="form-outline mb-4">
                <input max=20 type="text" id="lastName" name="lastName" class="form-control" />
                <label class="form-label" for="lastName">Last Name </label>
            </div>

            <div class="form-outline mb-4">
                <input max=20 type="text" id="address" name="address" class="form-control" />
                <label class="form-label" for="address">Address </label>
            </div>

            <button on type="submit" class="btn btn-primary btn-block mb-4">Add User</button>
        </form>
    </div>

    <!-- Modal for editing data -->
    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="modalContent">
            </div>
        </div>
    </div>

    
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script type="text/javascript"></script>
</body>
