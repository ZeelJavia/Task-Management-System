<?php
include("includes/connection.php");
session_start();
if(isset($_SESSION['email'])){

if (isset($_POST['update'])) {
    $status = $_POST['status'];
    $id = $_POST['id'];

    $sql = "UPDATE `tasks` SET status = '$status' WHERE `tid` = $id";

    $result = mysqli_query($connection, $sql);


    if ($result) {
        echo '<script> 
        alert("status updated successfully");
        window.location.href = "user_dashboard.php";
        </script>';
    } else {
        // Display MySQL error if query fails
        echo '<script> 
        alert("status not updated successfully");
        window.location.href = "user_dashboard.php";
        </script>';
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

    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <link rel="stylesheet" href="demo.css">

    
</head>

<body>
    

    <div class="row">
        <div class="col-md-4 m-auto" style="color:white"><br>
            <h3 style="color:black  ">Update the Task</h3><br>
            <?php
            include("includes/connection.php");

            $sql = "SELECT * FROM tasks where tid = $_GET[id];";
            $result = mysqli_query($connection, $sql);

            while ($row = mysqli_fetch_array($result)) {
            ?>
                <form method="post" action="">
                    <div class="form-group">
                        <input type="hidden" name="id" class="form-control" value="<?php echo $row['tid']; ?>" required> <!-- Populate the task ID -->
                    </div>
                    <div class="class-form">
                        <select name="status" id="" class="form-control ">
                            <option value="">-Select-</option>
                            <option value="In-progress">In-progress</option>
                            <option value="Complete">Complete</option>
                        </select>
                    </div>
                    <br>
                    <input type="submit" class="btn btn-warning" name="update" value="Update" required>
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
  header('location:index2.php');
}
?>