<?php

include ('connector.php');
session_start();

$RFID = $_POST['RFID'];
$First_Name = $_POST['First_Name'];
$Last_Name = $_POST['Last_Name'];
$Email = $_POST['Email'];
$Contact = $_POST['Contact'];
$Province = $_POST['Province'];
$Municipality = $_POST['Municipality'];
$Baranggay = $_POST['Baranggay'];
$Street = $_POST['Street'];


echo $RFID . $First_Name .$Last_Name .$Email .$Contact .$Province .$Municipality .$Baranggay . $Province .$Street;
$query = "INSERT INTO `user_information` (`RFID_ID`, `firstName`, `lastName`, `email`, `contactNumber`, `municipality`, `province`, `baranggay`, `street`) 
            VALUES ('$RFID', '$First_Name', '$Last_Name', '$Email', '$Contact', '$Municipality', '$Province', '$Baranggay', '$Street')";
$result = mysqli_query($con, $query	);



?>
