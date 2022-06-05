<?php
include ('connector.php');
session_start();
$ID = $_POST['ID'];


$query = "SELECT * FROM company_information WHERE company_id = '$ID'" ;
$result = mysqli_query($con, $query	);
$row = mysqli_fetch_array($result);

$_SESSION["admin_id"]  = $_SESSION["company_id"];
$_SESSION["company_name"] = $row["company_name"];
$_SESSION["company_id"] = $row["company_id"];
$_SESSION["company_slug"] = $row["company_slug"];
header("Location: ../dashboard.php");


?>