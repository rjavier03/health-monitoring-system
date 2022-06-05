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
        <h3>ADMIN<span> Dashboard</span></h3>
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
      <a href="admin-dashboard.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
      <a href="admin-user.php"><i class="fas fa-user"></i><span>Company List</span></a>
  
    </div>
    <!--sidebar end-->



  </body>
</html>
      