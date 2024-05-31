<?php
session_start();
include('../includes/connection.php');
if(isset($_SESSION['email'])){

// delete query to delete data from table

$sql = "DELETE FROM `tasks` WHERE `tasks`.`tid` = $_GET[id];";

$result = mysqli_query($connection, $sql);

if ($result) {
    echo '<script> 
     alert("Successfully deleted");
     window.location.href = "index.php";
     </script>';
} else {
    // Display MySQL error if query fails
    echo '<script> 
     alert("Failed to delete"); 
         window.location.href = "index.php";
     </script>';
}

}else{
  header('location:admin_login.php');
}
