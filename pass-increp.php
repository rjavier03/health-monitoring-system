
<?php



$password ='newpass';
$salt  = "RonaldJavier";
$password_encrypted = sha1($password.$salt);
echo $password_encrypted


?>