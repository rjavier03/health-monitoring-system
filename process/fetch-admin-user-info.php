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
       
        $sql = "SELECT * FROM company_information
        WHERE CONCAT(company_name , ' ' , company_slug  ) LIKE '%$search%'
        ";
        
    }


    else{
        $sql = "SELECT * FROM company_information";
        }
    $result = mysqli_query($con, $sql);
    $output .= '
    <div>
    <div >

            <div class="table-wrapper-scroll-y my-custom-scrollbar">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr class="bg-dark text-white">
                            <th>Company ID</th>
                            <th>Company Name</th>
                            <th>Company Slug</th>
                            <th>Email</th>
                           
                            <th>Username</th>
                            <th>Role</th>
                            <th>Action</th>
                         
                        </tr>
                    </thead>';
                    if(mysqli_num_rows($result) > 0)
                    {
                        while ($row = mysqli_fetch_array($result))
                        {
                            if($row["company_id"] != null)
                            {
                            $output .= 
                            '<tr>
                                    <td class =""   >'.$row["company_id"].'</td>
                                    <td class =""  >'.$row["company_name"].'</td>
                                    <td class =""  >'.$row["company_slug"].'</td>
                                    <td class =""  >'.$row["company_email"].'</td>
                                    <td class =""   >'.$row["company_username"].'</td>
                                    <td class =""  >'.$row["role"].'</td>
                              
                                    <td class="button-info">
                                     <button data-toggle="modal" data-target="#info-modal" class ="btn btn-primary" id="action-select" data-ID='.$row["company_id"].'>
                                        <i class="fa-solid fa-pen-to-square"></i>
                                     </button>
                                     <button class ="btn btn-danger" id="action-delete" data-ID='.$row["company_id"].'>
                                        <i class="fa-solid fa-trash-can"></i>
                                     </button>
                                     <button class ="btn btn-info" id="action-view-as" data-ID='.$row["company_id"].'>
                                        <i class="fa fa-eye"></i>
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