<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php 
        // session_start();
        include 'process/importLibrary.php';
        include 'header.php';
        include 'process/connector.php';
        $todayDate =  date("Y-m-d") ;
        $slug = $_SESSION["company_slug"];
        echo $slug;
        $all = "SELECT COUNT(*) FROM `customer_log` WHERE company_slug= '$slug'" ;
        $allcount = mysqli_fetch_array(mysqli_query($con, $all));

        $failed = "SELECT COUNT(*) FROM `customer_log` WHERE hstatus='FAILED' AND company_slug= '$slug'" ;
        $failedcount = mysqli_fetch_array(mysqli_query($con, $failed));

        $passed = "SELECT COUNT(*) FROM `customer_log` WHERE hstatus='PASSED' AND company_slug ='$slug'" ;
        $passedcount = mysqli_fetch_array(mysqli_query($con, $passed));


        
        // $all = "SELECT COUNT(*) FROM `customer_log`" ;
        // $allcount = mysqli_fetch_array(mysqli_query($con, $all));

        // $failed = "SELECT COUNT(*) FROM `customer_log` WHERE hstatus='FAILED'" ;
        // $failedcount = mysqli_fetch_array(mysqli_query($con, $failed));

        // $passed = "SELECT COUNT(*) FROM `customer_log` WHERE hstatus='PASSED'" ;
        // $passedcount = mysqli_fetch_array(mysqli_query($con, $passed));
    ?>

</head>
<body>
<div class="content">
    <!-- <br><br><br><br><br> -->
    <div class="row">
        <div class="col-lg-3">
            <div class="white-container">
                <h1><?= $allcount[0]?></h1>
                <p>Total No. of people Scanned</p>
                <p><?= date('F d Y', strtotime($todayDate)); ?></p>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="white-container">
                <h1 class="safe"><?= $passedcount[0] ?></h1>
                <p>Total No. of people safe range</p>
                <p><?= date('F d Y', strtotime($todayDate)); ?></p>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="white-container">
                <h1 class="danger"><?= $failedcount[0] ?></h1>
                <p>Total No. of people not safe range</p>
                <p><?= date('F d Y', strtotime($todayDate)); ?></p> 
            </div>
        </div>
    </div>

</div>
</body>
<script>


</script>
</html>