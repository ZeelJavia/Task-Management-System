<?php
include('../includes/connection.php');
session_start();
if (isset($_SESSION['email'])) {
    $email = isset($_SESSION['email']) ? $_SESSION['email'] : "";
    $name = isset($_SESSION['name']) ? $_SESSION['name'] : "";
    $uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : "";

    if (isset($_POST['create_task'])) {
        $sql = "INSERT INTO `tasks` (`tid`, `uid`, `description`, `start_date`, `end_date`, `status`) VALUES (null, {$_POST['id']}, '{$_POST['description']}', '{$_POST['start_date']}', '{$_POST['end_date']}', 'Not started')";


        $result = mysqli_query($connection, $sql);
        // echo var_dump($result);
        if ($result) {
            echo "<script type='text/javascript' > 
                alert('Successfully created task');
                window.location.href = 'index.php';
            </script>";
        } else {
            echo '<script> 
                alert("Failed to create task"); 
                  window.location.href = "index.php";
              </script>';
        }
    }
?>
    <!doctype html>
    <html lang="en">

    <head>
        <title>Sidebar 03</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <div class="wrapper d-flex align-items-stretch">
            <nav id="sidebar" class="active">
                <div class="custom-menu">
                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
                        <i class="fa fa-bars"></i>
                        <span class="sr-only">Toggle Menu</span>
                    </button>
                </div>
                <div class="p-4">
                    <h1><a href="index.php" class="logo">TMS</a></h1>
                    <ul class="list-unstyled components mb-5">
                        <li class="active">
                            <a href="#" id="dashboard"><span class="fa fa-home mr-3"></span> Dashboard</a>
                        </li>
                        <li>
                            <a href="#" id="create_task"><span class="fa fa-user mr-3"></span> Create Task</a>
                        </li>
                        <li>
                            <a href="#" id="manage_task"><span class="fa fa-briefcase mr-3"></span> Manage Task</a>
                        </li>
                        <li>
                            <a href="#" id="view_leave"><span class="fa fa-sticky-note mr-3"></span> Leave Application</a>
                        </li>
                        <li>
                            <a href="#" id="logout"><span class="fa fa-paper-plane mr-3"></span> Log out</a>
                        </li>
                    </ul>
                </div>
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
                </h2>
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

                    if (targetId === "create_task") {
                        targetUrl = "create_task.php";
                    } else if (targetId === "manage_task") {
                        targetUrl = "manage_task.php";
                    } else if (targetId === "view_leave") {
                        targetUrl = "view_leave.php";
                    } else if (targetId === "dashboard") {
                        targetUrl = "dashboard.php";
                    } else if (targetId === "logout") {
                        $.get("../logout.php", function() {
                            window.location.href = "/project/home.php";
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
} else {
    header('location:admin_login.php');
}
?>