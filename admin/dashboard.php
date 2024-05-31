<?php
session_start();
$email = $_SESSION['email'] ; 
$name = $_SESSION['name'];
?>
<h4>Instructions for Employees </h4>
<span style="font-size: larger; margin-right:20px">Email: <?php echo $email; ?></span>
<span style="font-size: larger; margin-left:0px">Name: <?php echo $name; ?></span><br><br>

<ul style="line-height: 3em; font-size: 1.2em; list-style-type: none; ">
    <li>1. All the Employees should mark their attendance daily.</li>
    <li>2. Everyone must complete the task assigned to them.</li>
    <li>3. kindly maintain decorum of the office.</li>
    <li>4. Keep office and your area neat and clean.</li>
</ul>