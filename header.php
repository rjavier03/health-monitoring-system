<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <?php session_start(); ?>
    <?php 
        if(!isset($_SESSION["company_name"])){
          header("Location: index.php");  
        }
        // include 'process/importLibrary.php';
        include 'process/connector.php';
    
    ?>
</head>
  <body>

    <input type="checkbox" id="check">
    <!--header area start-->
    <header>
      <label for="check">
        <i class="fas fa-bars" id="sidebar_btn"></i>
      </label>
      <div class="left_area">
        <h3>Company<span> Dashboard</span></h3>
      </div>
      <div class="right_area">
        <a href="http://localhost/MonitoringDevice/process/logout.php" class="logout_btn">Logout</a>
      </div>
    </header>
    <!--header area end-->
    <!--sidebar start-->
    <div class="sidebar">
      <center>
        <img src="images/usericon.png" class="profile_image" alt="">
        <h3><?=  $_SESSION["company_name"] .' - '. $_SESSION["company_id"];?></h3>
      </center>
      <a href="dashboard.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
      <a href="RFID-Scanner.php"><i class="fas fa-cogs"></i><span>Scanner</span></a>
      <a href="sample-vital.php"><i class="fas fa-table"></i><span>Sample Vital Signs</span></a>
      <a href="store-log.php"><i class="fas fa-th"></i><span>Store Log</span></a>
      <a href="user-info.php"><i class="fas fa-info-circle"></i><span>User Info</span></a>
      <a href="setting.php"><i class="fas fa-sliders-h"></i><span>Settings</span></a>
      <?php 
        if(isset($_SESSION["admin_id"])):
      ?>
      <button class="btn btn-secondary " id="back-to-admin" data-id="<?=$_SESSION["admin_id"]?>">BACK TO ADMIN</button>
      <?php
        endif;
      ?>
    </div>
    <!--sidebar end-->



  </body>
  <script>
       $(document).ready(function(){
        $(document).on('click', '#back-to-admin', function(){
          var ID =$(this).data("id");
          $.ajax({
                     url:"process/admin-back-redirection.php",
                     method:"POST",
                     data:{ID:ID},
                  
                     success:function(response){
                        // alert(response)
                        window.location = 'admin-dashboard.php';
                     }
                });
        });     
       })


  </script>
</html>
      