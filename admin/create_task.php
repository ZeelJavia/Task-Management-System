<?php
include('../includes/connection.php');
session_start();
if(isset($_SESSION['email'])){
?> 
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
  <!-- <link rel="stylesheet" href="../css/style.css" /> -->
  <style>
    body{
      color: black;
      
    }
  </style>
</head>

<body>
  <h3 >Create a new Task</h3>

  <div class="row" >
    <div class="col-md-6">
      <form action="" method="post">
        <div class="form-group">
          <label for="">Select User</label>
          <select class="form-control" name="id" id="">
            <option value="">-Select User-</option>
            <?php
            include("../includes/connection.php");

            $sql = "SELECT uid,name FROM users";
            $result = mysqli_query($connection, $sql);

            if (mysqli_num_rows($result)) {
              while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <option value="<?php echo $row['uid']; ?>">
                  <?php echo $row['name']; ?>
                </option>
            <?php
              }
            }
            ?>
          </select>
        </div>

        <div class="form-group">
          <label>Description : </label>
          <textarea class="form-control" name="description" placeholder="Mention the task" id="" cols="50" rows="3"></textarea>
        </div>
        <div class="form-group">
          <label>Start Date :</label>
          <input type="date" class="form-control" name="start_date" />
        </div>
        <div class="form-group">
          <label>End Date :</label>
          <input type="date" class="form-control" name="end_date" />
        </div>
        <input type="submit" class="btn btn-warning" name="create_task" value="Create">
      </form>
    </div>
  </div>
</body>

</html> 
<?php 
}else{
  header('location:admin_login.php');
}
?>