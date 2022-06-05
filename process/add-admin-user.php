<?php
include ('connector.php');
session_start();

$role = $_POST['role'];
$name = $_POST['name'];
$email = $_POST['email'];
$slug = $_POST['slug'];
$username = $_POST['username'];



$query = "INSERT INTO `company_information` (`company_name`, `company_slug`, `company_email`, `company_username`, `company_password`, `role`)
            VALUES ('$name', '$slug', '$email',  '$username', '029a6d545a04254d99ba327c76ea7945aad861ac', '$role')";
$result = mysqli_query($con, $query	);
echo 'Data inserted';





?>