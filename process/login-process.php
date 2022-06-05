<?php
    session_start();
    include ('connector.php');
    //getting the input from the form
    $username = $_POST["username"];
    $password = $_POST['password'];
    $salt  = "RonaldJavier";
    $password_encrypted = sha1($password.$salt);

	$query = "SELECT * FROM company_information WHERE company_username = '$username' and company_password= '$password_encrypted'" ;
	$result = mysqli_query($con, $query	);
	$row = mysqli_fetch_array($result);
    
    if(isset($row["company_id"])){

            
            $_SESSION["company_name"] = $row["company_name"];
            $_SESSION["company_id"] = $row["company_id"];
            $_SESSION["company_slug"] = $row["company_slug"];
            if($row["role"] == 'super-admin')
            {
                header("Location: ../admin-dashboard.php");      
            }
            else{
                header("Location: ../dashboard.php");
            }
           
			}
        
        else {
            header("Location: ../index.php");
            $_SESSION["wrong-password"] = 'true';
			}




















?>