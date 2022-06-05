<?php
    session_start();
    include ('connector.php');
    if(isset($_POST['email']))
    {
        $email=$_POST['email'];
        $query = "SELECT * FROM company_information WHERE company_email = '$email'" ;      
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_array($result);
        if(isset($row["company_email"])){
            $resetPassword = "UPDATE company_information SET company_password= '029a6d545a04254d99ba327c76ea7945aad861ac' WHERE company_email='$email' " ;
            $result_Reset = mysqli_query($con, $resetPassword);
            echo 'success';
        }
        else{
            echo 'failed';
        }

    }
 
    if(isset($_POST['ID']))
    {

        $id=$_POST['ID'];
        $query = "SELECT * FROM company_information WHERE company_id = '$id'" ;
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_array($result);
        if(isset($row["company_email"])){
            $resetPassword = "UPDATE company_information SET company_password= '029a6d545a04254d99ba327c76ea7945aad861ac' WHERE company_id='$id' " ;
            $result_Reset = mysqli_query($con, $resetPassword);
            echo 'success';
        }
        else{
            echo 'failed';
        }
    }
   
 









?>