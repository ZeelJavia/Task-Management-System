<?php
include('../includes/connection.php');
$sql = "UPDATE leaves set status = 'Rejected' where lid = $_GET[id]";
$result  = mysqli_query($connection, $sql);
if ($result) {
    echo '<script> 
            alert("leave status updated successfully...");
            window.location.href = "index.php";
        </script>';
} else {
    echo '<script> 
        alert("Error...Please try again later...");
        window.location.href = "index.php";
    </script>';
}
