<?php
session_start(); 

if(isset($_SESSION['email'])){



$email = isset($_SESSION['email']) ? $_SESSION['email'] : "";
$name = isset($_SESSION['name']) ? $_SESSION['name'] : "";
$uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : "";

include('includes/connection.php');

if (isset($_POST['submit_leave'])) {
  // Escape input data to prevent SQL injection
  $subject = mysqli_real_escape_string($connection, $_POST['subject']);
  $message = mysqli_real_escape_string($connection, $_POST['message']);

  $sql = "INSERT INTO `leaves` (`lid`, `uid`, `subject`, `message`, `status`) VALUES (NULL, '$uid', '$subject', '$message', 'No Action');";
  $result = mysqli_query($connection, $sql);

  if ($result) {
    echo "<script>alert('Leave Request applied successfully...');
    window.location.href = 'user_dashboard.php';
    </script>";
  } else {
    echo "<script>alert('Error...please try again.');
    window.location.href = 'user_dashboard.php';
    </script>";
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- <title>Sidebar 03</title> -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css">

  <style>
    .list-unstyled.components li a {
      cursor: pointer;
    }
  </style>
</head>

<body>
  <div id="body">
    <div class="wrapper d-flex align-items-stretch">
      <nav id="sidebar" class="active">
        <div class="custom-menu">
          <button type="button" id="sidebarCollapse" class="btn btn-primary">
            <i class="fa fa-bars"></i>
            <span class="sr-only"></span>
          </button>
        </div>
        <div class="p-4">
          <h1><a href="index.html" class="logo">TMS</a></h1>
          <ul class="list-unstyled components mb-5">
            <li class="active">
              <a href="" id="dashboard"><span class="fa fa-home mr-3"></span> Dashboard</a>
            </li>
            <li>
              <a href="#" id="update_task"><span class="fa fa-user mr-3"></span> Update Task</a>
            </li>
            <li>
              <a id="apply_leave"><span class="fa fa-briefcase mr-3"></span> Apply Leave</a>
            </li>
            <li>
              <a id="leave_status"><span class="fa fa-sticky-note mr-3"></span> Leave Status</a>
            </li>
            <li>
              <a href="home.php" id="logout"><span class="fa fa-paper-plane mr-3"></span> Log out</a>
            </li>
          </ul>
      </nav>

      <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5" style="margin-left: 20px;" >
        <span style="font-size: larger; margin-right:20px">Email: <?php echo $email; ?></span>
        <span style="font-size: larger; margin-left:0px">Name: <?php echo $name; ?></span><br><br>
        <h4>Instructions for Employees</h4>
        <ul style="line-height: 3em; font-size: 1.2em; list-style-type: none;">
          <li>1. All the Employees should mark their attendance daily.</li>
          <li>2. Everyone must complete the task assigned to them.</li>
          <li>3. Kindly maintain decorum of the office.</li>
          <li>4. Keep office and your area neat and clean.</li>
        </ul>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $("#sidebar").on("click", "a", function(event) {
        event.preventDefault();
        var targetId = $(this).attr("id");
        var targetUrl = "";

        if (targetId === "update_task") {
          targetUrl = "task.php";
        } else if (targetId === "apply_leave") {
          targetUrl = "apply_leave.php";
        } else if (targetId === "leave_status") {
          targetUrl = "view_leave.php";
        } else if (targetId === "dashboard") {
          targetUrl = "dashboard.php";
        } else if (targetId === "logout") {
          $.get("logout.php", function() {
            window.location.href = "home.php";
          });
          return;
        }

        if (targetUrl !== "") {
          $.get(targetUrl, function(data) {
            $("#content").html(data);
          });
        }
      });
    });
  </script>
</body>

</html>
<?php 
}else{
  header('location:index2.php');
}
?>