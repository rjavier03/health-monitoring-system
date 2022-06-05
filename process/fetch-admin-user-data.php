<?php

include ('connector.php');
session_start();

$output = '';
$ID=$_POST['ID'];

$sql = "SELECT * FROM company_information WHERE company_id=$ID";

$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$output .= '
    <div class="form-group">
        <label for="">RFID ID</label>
        <input disabled type="RFID ID" class="form-control" id="update-id" placeholder="ID" value='.$ID.' >
    </div>
    <div class="row">
        <div class="form-group col">
            <label for="">Company Name</label>
            <input type="First Name" class="form-control" id="update-name" placeholder="Company Name" value='.$row["company_name"].'>
        </div>
        <div class="form-group col">
            <label for="">Company Slug</label>
            <input type="Company Slug" class="form-control" id="update-slug" placeholder="Company Slug" value='.$row["company_slug"].'>
        </div> 
    </div>   
    <div class="form-group">
        <label for="">Email</label>
        <input type="Email" class="form-control"  id="update-email" placeholder="Email" value='.$row["company_email"].'>
    </div> 
    <div class="form-group">
        <label for="">Username</label>
        <input type="Username" class="form-control"  id="update-username" placeholder="Username" value='.$row["company_username"].'>
    </div>
    <div class="row">  
        <div class="form-group col">
            <label for="">Role</label>
            <input type="Role" class="form-control"  id="update-role" placeholder="Role" value='.$row["role"].'>
        </div>  
  
    </div>
    <button data-id='.$ID.' id="reset-password" class="btn btn-danger">Reset Password</button> 
    ';

    echo $output;
    




?>