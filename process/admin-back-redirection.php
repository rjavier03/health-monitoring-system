<?php
include ('connector.php');
session_start();
$ID = $_POST['ID'];
echo $ID;
$query = "SELECT * FROM company_information WHERE company_id = '$ID'" ;
$result = mysqli_query($con, $query	);
$row = mysqli_fetch_array($result);


$_SESSION["company_name"] = $row["company_name"];
$_SESSION["company_id"] = $row["company_id"];

header("Location: ../dashboard.php");



?>