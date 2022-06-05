<?php

include ('connector.php');
session_start();

$id = $_SESSION["company_slug"];
$email = $_POST['email'];
$password = $_POST['password'];
$new_password = $_POST['new-password'];
$salt  = "RonaldJavier";
$password_encrypted = sha1($password.$salt);
$new_password_encrypted = sha1($new_password.$salt);
$query = "SELECT * FROM company_information WHERE company_email = '$email' and company_password= '$password_encrypted'" ;
$result = mysqli_query($con, $query	);
$row = mysqli_fetch_array($result);

if($row['company_id'])
{
    
$update = "UPDATE company_information SET company_password = '$new_password_encrypted' WHERE company_id = '$id'" ;
$updateresult = mysqli_query($con, $update	);
}

?>