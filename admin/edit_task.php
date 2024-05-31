<?php
session_start();
include("../includes/connection.php");
if(isset($_SESSION['email'])){

if (isset($_POST['edit_task'])) {
    $id = $_POST['id'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Construct the SQL query
    $sql = "UPDATE `tasks` SET `uid` = $id, `description` = '$description', `start_date` = '$start_date', `end_date` = '$end_date' WHERE `tid` = $_GET[id]";

    // Execute the SQL query
    $result = mysqli_query($connection, $sql);

    // Check if the query executed successfully
    if ($result) {
        echo '<script> 
        
        window.location.href = "index.php";
        </script>';
    } else {
        // Display MySQL error if query fails
        echo 'Errro...Task is not edited successfully..!!';
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ETMS</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>



    <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script> -->

    <!-- <link rel="stylesheet" href="../css/style.css"> -->


    <style>
        body{
            background-color: #fff;
            color: black;
        }
        #header {
            background-color: #D4F6CC;
            height: 10vh;
            /* width: 100vw; */
            padding-top: 10px;
            padding-bottom: 5px;
            padding-left: 50px;
            color: black;
        }
    </style>
</head>

<body>
    <!-- header code start here -->

    

    <div class="row">
        <div class="col-md-4 m-auto" ><br>
            <h3 >Edit the Task</h3><br>
            <?php
            include("../includes/connection.php");

            $sql = "SELECT * FROM tasks where tid = $_GET[id];";
            $result = mysqli_query($connection, $sql);

            while ($row = mysqli_fetch_array($result)) {
            ?>
                <form method="post" action="">
                    <div class="form-group">
                        <input type="hidden" name="id" class="form-control" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="">Select User</label>
                        <select class="form-control" name="id" id="" required>
                            <option value="">-Select User-</option>
                            <?php
                            include("../includes/connection.php");
                            
                            $sql1 = "SELECT * FROM users";
                            $result1 = mysqli_query($connection, $sql1);
                            
                            if (mysqli_num_rows($result1)) {
                                while ($row1 = mysqli_fetch_assoc($result1)) {
                                    ?>
                                    <option value="<?php echo $row1['uid']; ?>">
                                        <?php echo $row1['name']; ?>
                                    </option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea class="form-control" name="description" id="" cols="50" rows="3" required><?php echo $row['description'] ?></textarea>

                    </div>
                    <div class="form-group">
                        <label>Start Date :</label>
                        <input type="date" class="form-control" name="start_date" value="<?php echo $row['start_date']; ?>" required />
                    </div>
                    <div class="form-group">
                        <label>End Date :</label>
                        <input type="date" class="form-control" name="end_date" value="<?php echo $row['end_date']; ?>" required />
                    </div>
                    <input type="submit" class="btn btn-warning" name="edit_task" value="Update" required>
                </form>
            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>
<?php 
}else{
  header('location:admin_login.php');
}
?>