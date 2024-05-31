<?php
session_start(); 

if(isset($_SESSION['email'])){



$email = isset($_SESSION['email']) ? $_SESSION['email'] : "";
$name = isset($_SESSION['name']) ? $_SESSION['name'] : "";
$uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : "";
?>

<span style="font-size: larger; margin-right:20px">Email: <?php echo $email; ?></span>
<span style="font-size: larger; margin-left:0px">Name: <?php echo $name; ?></span><br><br>
<h4>Instructions for Employees</h4>
<ul style="line-height: 3em; font-size: 1.2em; list-style-type: none;">
    <li>1. All the Employees should mark their attendance daily.</li>
    <li>2. Everyone must complete the task assigned to them.</li>
    <li>3. Kindly maintain decorum of the office.</li>
    <li>4. Keep office and your area neat and clean.</li>
</ul>
<?php 
}else{
  header('location:index2.php');
}
?>