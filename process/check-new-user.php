<?php

include ('connector.php');
session_start();


$RFID = $_POST['RFID'];

$query = "SELECT * FROM user_information WHERE RFID_ID = '$RFID'" ;
$result = mysqli_query($con, $query	);
$row = mysqli_fetch_array($result);
if(isset($row['RFID_ID']))
{
    echo 'ID is already Exist';
}
else{
    echo 'ID is available';
}



?>