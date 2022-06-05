<?php 

    include ('connector.php');
    session_start();
    

    $output = '';

    if(isset($_POST['search'])){
        $search =$_POST['search'];
        if($_POST['search'] != ''){
            if($search[0] == '0' && $search[1] == '0' && $search[2] == '0' )
            {
                $search = substr($search, 3);
            }    
        }
       
        $sql = "SELECT * FROM user_information
        WHERE CONCAT(firstName , ' ' , lastName , RFID_ID ) LIKE '%$search%'
        ";
        
    }

   else if(isset($_POST['province']) || isset($_POST['municipality']) || isset($_POST['baranggay']))
        {
            $province=$_POST['province'];
            $municipality=$_POST['municipality'];
            $baranggay=$_POST['baranggay'];
        
            $sql = "SELECT * FROM user_information
                  WHERE province LIKE '%$province%' AND
                  municipality LIKE '%$municipality%' AND
                  baranggay LIKE '%$baranggay%'
                  
            ";
        }
    else{
        $sql = "SELECT * FROM user_information";
        }
    $result = mysqli_query($con, $sql);
    $output .= '
    <div>
    <div >

            <div class="table-wrapper-scroll-y my-custom-scrollbar">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr class="bg-dark text-white">
                            <th>RFID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Contact Number</th>
                            <th>Province</th>
                            <th>Municipality</th>
                            <th>Baranggay</th>
                            <th>Action</th>
                         
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
                                    <td class ="Grade"   >'.$row["RFID_ID"].'</td>
                                    <td class ="Section"  >'.$row["firstName"].'</td>
                                    <td class ="Subject"  >'.$row["email"].'</td>
                                    <td class ="Grade"   >'.$row["contactNumber"].'</td>
                                    <td class ="Subject"  >'.$row["province"].'</td>
                                    <td class ="Section"  >'.$row["municipality"].'</td>
                                    <td class ="Grade"   >'.$row["baranggay"].'</td>
                                    <td class ="Section" >'.$row["street"].'</td>
                                    <td class="button-info">
                                     <button data-toggle="modal" data-target="#info-modal" class ="btn btn-primary" id="action-select" data-RFID='.$row["RFID_ID"].'>
                                        <i class="fa-solid fa-pen-to-square"></i>
                                     </button>
                                     <button class ="btn btn-danger" id="action-delete" data-RFID='.$row["RFID_ID"].'>
                                        <i class="fa-solid fa-trash-can"></i>
                                     </button>
                                     
                                     </td>
                                
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