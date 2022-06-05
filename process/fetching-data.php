<?php 
      session_start();
      include ('connector.php');
      $idinput=$_POST['idinput'];
      $tempe=$_POST['tempe'];
      $oxygen=$_POST['oxygen'];
      $heart=$_POST['heart'];
      $status=$_POST['status'];
      $dateNow = date("Y-m-d");
      $slug = $_SESSION["company_slug"];
      $getInfo = "SELECT * FROM user_information WHERE RFID_ID = $idinput " ;
      $result = mysqli_query($con, $getInfo);
      $row = mysqli_fetch_array($result);
      if(isset($row['firstName'])){
        echo $row['firstName'];

        $insertInfo = "INSERT INTO customer_log(RFID_ID,temperature,heartRate,oxygenLevel,hStatus,entryDate,company_slug) 
                        VALUES($idinput,'$tempe','$heart','$oxygen','$status','$dateNow','$slug') " ;
        mysqli_query($con, $insertInfo);
        
      }
      else{
          echo "USER DOESN'T EXIST.";
      }
   
  





?>