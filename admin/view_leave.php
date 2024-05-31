<?php
include("../includes/connection.php");
session_start();
if (isset($_SESSION['email'])) {


?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <title>View Leaves</title>
        <style>
            table,
            td {
                padding: 10px;
            }

            .table {
                background-color: white;
                color: black;
            }

            .btn {
                margin: 5px;
            }
        </style>
    </head>

    <body>
        <center>
            <h3>All Leave Applications</h3>
        </center><br>

        <div class="container">
            <table class="table table-striped">
                <tr>
                    <th>S.NO</th>
                    <th>User</th>
                    <th>Subject</th>
                    <th style="width: 30%;">Message</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php
                $sql = "SELECT * FROM leaves";
                $result = mysqli_query($connection, $sql);
                $sno = 1; // Initialize serial number outside the loop
                while ($row = mysqli_fetch_assoc($result)) {
                    $uid = $row['uid'];
                    $sql1 = "SELECT * FROM users WHERE uid = $uid";
                    $result1 = mysqli_query($connection, $sql1);
                    $userFound = false;
                    if ($row1 = mysqli_fetch_assoc($result1)) {
                        $userFound = true;
                    }
                ?>
                    <tr>
                        <td><?php echo $sno; ?></td>
                        <td><?php echo $userFound ? $row1['name'] : 'User not found'; ?></td>
                        <td><?php echo $row['subject']; ?></td>
                        <td><?php echo $row['message']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td>
                            <a href="approve_leave.php?id=<?php echo $row['lid']; ?>" type="button" class="btn btn-success" style="margin: 0px;">Approve</a>
                            <a href="reject_leave.php?id=<?php echo $row['lid']; ?>" type="button" class="btn btn-danger" style="margin: 0px;">Reject</a>
                        </td>
                    </tr>
                <?php
                    $sno++; // Increment serial number for the next row
                }
                ?>
            </table>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaVxFw+8ROKU8FxkFYW7JoRpKdtB5LpuTr9" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>

    </html>
<?php
} else {
    header('location:admin_login.php');
}
?>