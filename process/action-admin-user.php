<?php
include ('connector.php');
session_start();

$action = $_POST['action'];

if($action =='toUpdate')
{
    $update_id = $_POST['update_id'];
    $role = $_POST['update_role'];
    $name = $_POST['update_name'];
    $email = $_POST['update_email'];
    $slug = $_POST['update_slug'];
    $username = $_POST['update_username'];

    $query = "UPDATE company_information
                SET company_name = '$name',
                    company_slug = '$slug',
                    company_email ='$email',
                    company_username='$username',
                    `role`  = '$role' WHERE company_id = '$update_id'
    " ;
	$result = mysqli_query($con, $query	);
    echo 'UPDATED';
}






?>