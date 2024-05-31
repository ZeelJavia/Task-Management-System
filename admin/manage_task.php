<?php
include('../includes/connection.php');
session_start();
if (isset($_SESSION['email'])) {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <title>Manage Tasks</title>
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
            <h3>All Assigned Tasks</h3>
        </center><br>

        <div class="container">
            <table class="table table-striped">
                <tr>
                    <th>S.No.</th>
                    <th>Task Id</th>
                    <th>Description</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php
                $sno = 1;
                $sql = "SELECT * FROM tasks";
                $result = mysqli_query($connection, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?php echo $sno;
                            $sno++; ?></td>
                        <td><?php echo $row['tid']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['start_date']; ?></td>
                        <td><?php echo $row['end_date']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td>
                            <a type="button" class="btn btn-success" href="edit_task.php?id=<?php echo $row['tid']; ?>">Edit</a><a type="button" class="btn btn-danger" href="delete_task.php?id=<?php echo $row['tid']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php
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