<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin</title>
    <?php 
        // session_start();
        include 'process/importLibrary.php';
        include 'admin-header.php';
        include 'process/connector.php';
        $todayDate =  date("Y-m-d") ;
        $all = "SELECT COUNT(*) FROM `customer_log`" ;
        $allcount = mysqli_fetch_array(mysqli_query($con, $all));

        $failed = "SELECT COUNT(*) FROM `customer_log` WHERE hstatus='FAILED'" ;
        $failedcount = mysqli_fetch_array(mysqli_query($con, $failed));

        $passed = "SELECT COUNT(*) FROM `customer_log` WHERE hstatus='PASSED'" ;
        $passedcount = mysqli_fetch_array(mysqli_query($con, $passed));

        
        $getCompany_slug ="SELECT company_slug FROM company_information";
        $companySlugs = mysqli_query($con, $getCompany_slug);
        $companySlugArray = array();
        if(mysqli_num_rows($companySlugs) > 0)
        {
            while ($row = mysqli_fetch_array($companySlugs))
            {
                $companySlugArray[] =$row['company_slug'];
            }
        }
        if (isset($_GET['company_slug'])) {
            $slug = $_GET['company_slug'] ;
        }
        else{
            $slug ='' ;
        }
        $slugAll = "SELECT COUNT(*) FROM `customer_log` WHERE company_slug LIKE '%$slug%'" ;
        $slugAllcount = mysqli_fetch_array(mysqli_query($con, $slugAll));

        $slugFailed = "SELECT COUNT(*) FROM `customer_log` WHERE hstatus='FAILED' AND company_slug LIKE '%$slug%'" ;
        $slugFailedcount = mysqli_fetch_array(mysqli_query($con, $slugFailed));

        $slugPassed = "SELECT COUNT(*) FROM `customer_log` WHERE hstatus='PASSED' AND company_slug LIKE '%$slug%'" ;
        $slugPassedcount = mysqli_fetch_array(mysqli_query($con, $slugPassed));
        
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
    <div class="row">
        <div class="col-lg-10">
            <div class="chart-graph">
                <div class="graph-chart">
                    <h1>Select Company : </h1>
                    <select id="company_slug" class="form-select" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <?php 
                            foreach($companySlugArray as $slug):
                        ?>
                             <option value=<?=$slug?>><?=$slug?></option>
                        <?php 
                            endforeach;
                        ?>
                   
                    </select>  
                </div>
            </div> 
        </div> 
    </div> 
    <div class="row">
        <div class="col-lg-3">
            <div class="white-container">
                <h1><?= $slugAllcount[0]?></h1>
                <p>Total No. of people Scanned</p>
                <p><?= date('F d Y', strtotime($todayDate)); ?></p>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="white-container">
                <h1 class="safe"><?= $slugPassedcount[0] ?></h1>
                <p>Total No. of people safe range</p>
                <p><?= date('F d Y', strtotime($todayDate)); ?></p>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="white-container">
                <h1 class="danger"><?= $slugFailedcount[0] ?></h1>
                <p>Total No. of people not safe range</p>
                <p><?= date('F d Y', strtotime($todayDate)); ?></p>
            </div>
        </div>
    </div>
</div>
</body>
<script>

    var company_slug = document.getElementById("company_slug");
    company_slug.addEventListener("change", viewCompany);
    const queryString = window.location.search;
 
    const urlParams = new URLSearchParams(queryString);
    const selectedSlug = urlParams.get('company_slug')
    company_slug.value = selectedSlug;
    function viewCompany(){
        baseUrl = window.location.href.split("?")[0];
        window.history.pushState('name', '', baseUrl);
        window.location.search += 'company_slug='+ company_slug.value;
    }

</script>
</html>