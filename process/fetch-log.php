<?php 

    include ('connector.php');
    session_start();
    
    $slug = $_SESSION["company_slug"];
    $output = '';

    if(isset($_POST['search'])){
        $search =$_POST['search'];
        if($_POST['search'] != ''){
            if($search[0] == '0' && $search[1] == '0' && $search[2] == '0' )
            {
                $search = substr($search, 3);
            }    
        }
       
        $sql = "SELECT CL.RFID_ID, firstName,lastName,province,municipality,baranggay,temperature,heartRate,oxygenLevel,hStatus,entryDate 
        FROM customer_log as CL INNER JOIN user_information as UI ON CL.RFID_ID = UI.RFID_ID
        WHERE CONCAT(firstName , ' ' , lastName , CL.RFID_ID ) LIKE '%$search%' AND company_slug= '$slug'
        ";
        
    }

   else if(isset($_POST['province']) || isset($_POST['municipality']) 
        || isset($_POST['baranggay'])|| isset($_POST['status']) || isset($_POST['fromDate']) || isset($_POST['toDate']))
        {
            $province=$_POST['province'];
            $municipality=$_POST['municipality'];
            $baranggay=$_POST['baranggay'];
            $status=$_POST['status'];
            $fromDate=$_POST['fromDate'];
            $toDate=$_POST['toDate'];
            if($fromDate=='' || $toDate=='')
            {
                $fromDate = '1999-01-01';
                $toDate = date("Y-m-d");
            }
            $sql = "SELECT firstName,lastName,province,municipality,baranggay,temperature,heartRate,oxygenLevel,hStatus,entryDate 
            FROM customer_log as CL INNER JOIN user_information as UI ON CL.RFID_ID = UI.RFID_ID
            WHERE province LIKE '%$province%' AND
                  municipality LIKE '%$municipality%' AND
                  company_slug= '$slug' AND
                  baranggay LIKE '%$baranggay%' AND
                  hStatus LIKE '%$status%' AND
                  (entryDate BETWEEN '$fromDate' AND '$toDate')
                  
            ";
        }
    else{
    $sql = "SELECT firstName,lastName,province,municipality,baranggay,temperature,heartRate,oxygenLevel,hStatus,entryDate 
    FROM customer_log as CL INNER JOIN user_information as UI ON CL.RFID_ID = UI.RFID_ID WHERE company_slug= '$slug' ";
        }
    $result = mysqli_query($con, $sql);
    $output .= '
    <div>
    <div >

            <div class="table-wrapper-scroll-y my-custom-scrollbar">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr class="bg-dark text-white">
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Province</th>
                            <th>Municipality</th>
                            <th>Baranggay</th>
                            <th>Temperature</th>
                            <th>Heart Rate</th>
                            <th>Oxygen</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>';
                    if(mysqli_num_rows($result) > 0)
                    {
                        while ($row = mysqli_fetch_array($result))
                        {
                            if($row["firstName"] != null)
                            {
                            $output .= 
                            '<tr>
                                    <td class ="Grade"   >'.$row["firstName"].'</td>
                                    <td class ="Section"  >'.$row["lastName"].'</td>
                                    <td class ="Subject"  >'.$row["province"].'</td>
                                    <td class ="Grade"   >'.$row["municipality"].'</td>
                                    <td class ="Section"  >'.$row["baranggay"].'</td>
                                    <td class ="Subject"  >'.$row["temperature"].'</td>
                                    <td class ="Grade"   >'.$row["heartRate"].'</td>
                                    <td class ="Section" >'.$row["oxygenLevel"].'</td>
                                    <td class ="hstatus" id="hstatus" >'.$row["hStatus"].'</td>
                                    <td class ="Section" >'.$row["entryDate"].'</td>
                                </tr>	';
                            }
                            else
                            {
                    
                                //     $output .= '<tr>
                    
                    
                                //   <td class ="Name"   id="Grade">'.$row["Name"].'</td>
                                //                 <td class ="Grade"   id="Grade">'.$row["Grade"].'</td>
                                //   <td class ="Section"  id="Section">'.$row["Section"].'</td>
                                //   <td class ="Subject"  id="Subject">'.$row["Subject"].'</td>
                    
                    
                                //             </tr>	';
                            }
                        }
                    
                    }
                    $output .= '</table>';
                    echo $output;

?>