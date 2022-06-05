<?php

include ('connector.php');
session_start();

$output = '';
$RFID=$_POST['RFID'];

$sql = "SELECT * FROM user_information WHERE RFID_ID=$RFID";

$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$output .= '
    <div class="form-group">
        <label for="">RFID ID</label>
        <input type="RFID ID" class="form-control" id="modal-form" placeholder="RFID" value='.$RFID.'>
    </div>
    <div class="row">
        <div class="form-group col">
            <label for="">First Name</label>
            <input type="First Name" class="form-control" id="modal-form" placeholder="First Name" value='.$row["firstName"].'>
        </div>
        <div class="form-group col">
            <label for="">Last Name</label>
            <input type="Last Name" class="form-control" id="modal-form" placeholder="First Name" value='.$row["lastName"].'>
        </div> 
    </div>   
    <div class="form-group">
        <label for="">Email</label>
        <input type="Email" class="form-control" id="modal-form" placeholder="First Name" value='.$row["email"].'>
    </div> 
    <div class="form-group">
        <label for="">Contact</label>
        <input type="Contact" class="form-control" id="modal-form" placeholder="First Name" value='.$row["contactNumber"].'>
    </div>
    <div class="row">  
        <div class="form-group col">
            <label for="">Province</label>
            <input type="Contact" class="form-control" id="modal-form" placeholder="First Name" value='.$row["province"].'>
        </div>  
        <div class="form-group col ">
            <label for="">Municipality</label>
            <input type="Contact" class="form-control" id="modal-form" placeholder="First Name" value='.$row["municipality"].'>
        </div>  
    </div>
    <div class="row">  
        <div class="form-group col">
            <label for="">Baranggay</label>
            <input type="Contact" class="form-control" id="modal-form" placeholder="First Name" value='.$row["baranggay"].'>
        </div>  
        <div class="form-group col ">
            <label for="">Street</label>
            <input type="Contact" class="form-control" id="modal-form" placeholder="First Name" value='.$row["street"].'>
        </div>  
    </div>
    
    ';

    echo $output;
    




?>