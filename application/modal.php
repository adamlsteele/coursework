<?php
    //Error reporting
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $id = $_GET['id'];

    //Create Connection to database
    $host = "localhost";
    $username = "root";
    $database = "test";
    $connection = new mysqli($host, $username, null, $database);

    $sql = "SELECT * FROM tbInformation WHERE ID = ".$id;
    $result = $connection->query($sql)->fetch_assoc();


?>



<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Editing <?php echo $result['First Name']?></h5>
    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
</div>

<div class="m-4 p-2">
        <form action="index.php" method="post">
            <input hidden name="ID" value="<?php echo $id ?>" />
            
            <div class="mb-4">
                <label class="form-label" for="firstName">First Name </label>
                <input mdbInput type="text" id="firstName" name="firstName" class="form-control" value="<?php echo $result['First Name'];?>" />
            </div>

            <div class="mb-4">
                <label class="form-label" for="lastName">Last Name </label>
                <input mdbInput type="text" id="lastName" name="lastName" class="form-control" value="<?php echo $result['Last Name'];?>" />
            </div>

            <div class="mb-4">
                <label class="form-label" for="address">Address </label>
                <input mdbInput type="text" id="address" name="address" class="form-control" value="<?php echo $result['Address'];?>" />
            </div>

            <button type="submit" class="btn btn-primary btn-block mb-4">Save Changes</button>
        </form>
    </div>