<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Log</title>
    <?php 
        // session_start();
        include 'process/importLibrary.php';
        include 'header.php';
    ?>
</head>
<body>
    <div class="content">
        <div class="row">
            <div class="col-lg-12 store-log">
                <div class="white-container  users">
                <div class="create-new">
                        <button data-toggle="modal" data-target="#add-new-modal" class ="btn btn-primary" id="create-new">Add New</button>
                    </div>
                <input type="text" name="search_text" id="search_text" placeholder="Student ID , Firstname, Lastname" class="form-control" />
                    <div class="filter">
                        <select name="province" id="province">
                            <option value="">Province</option>
                            <option value="Bulacan">Bulacan</option>     
                        </select>
                        <select name="municipality" id="municipality">
                            <option value="">Municipality</option>  
                            <option value="Bocaue">Bocaue</option>  
                            <option value="Balagtas">Balagtas</option>  
                        </select>
                        <select name="baranggay" id="baranggay">
                            <option value="">Baranggay</option>  
                            <option value="Taal">Taal</option>
                            <option value="Cruz">Cruz</option>    
                        </select>
                        <button id="filter"> Filter</button>
                    </div>
                   
                    <div id="result"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#info-modal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="info-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="modal-user-info"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- add new modal -->
<div class="modal fade" id="add-new-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create New</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <!-- <form action="process/add-new-user.php" method="POST"> -->
                <div class="form-group">
                 
                    <input name="RFID_ID" class="form-control" id="add-RFID" placeholder="RFID">
                    <p id="RFID-text"></p>
                </div>
                <div class="row">
                    <div class="form-group col">
                      
                        <input name="First_Name" class="form-control" id="add-first-name" placeholder="First Name">
                    </div>
                    <div class="form-group col">
                      
                        <input name="Last_Name" class="form-control" id="add-last-name" placeholder="Last Name">
                    </div> 
                </div>   
                <div class="form-group">
                 
                    <input name="Email" class="form-control" id="add-email" placeholder="Email" >
                </div> 
                <div class="form-group">
                 
                    <input name="Contact" class="form-control" id="add-contact" placeholder="Contact" >
                </div>
                <div class="row">  
                    <div class="form-group col">
                  
                        <input name="Province" class="form-control" id="add-province" placeholder="Province">
                    </div>  
                    <div class="form-group col ">
                     
                        <input name="Municipality" class="form-control" id="add-municipality" placeholder="Municipality">
                    </div>  
                </div>
                <div class="row">  
                    <div class="form-group col">
                      
                        <input name="Baranggay" class="form-control" id="add-baranggay" placeholder="Baranggay">
                    </div>  
                    <div class="form-group col ">
                        
                        <input name="Street" class="form-control" id="add-street" placeholder="Street" >
                    </div>  
                </div>
             
               
      </div>
      <div class="modal-footer">
  
        <button type="submit" id="add-new" class="btn btn-primary">Create New</button>
        <!-- </form> -->
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</body>
<script>
$(document).ready(function(){
    var status
    // $('form').submit(function(e){
    // e.preventDefault();
    // });
    function load_store_log()
    {
        $.ajax({
            url:"process/fetch-user-info.php",
            method:"POST",
            success:function(data){
                    $('#result').html(data);
                    }
        });
    }
    load_store_log()
    $(document).on('click', '#filter', function(){
        var province = $("#province").val();
        var municipality = $("#municipality").val();
        var baranggay = $("#baranggay").val();  
       
        $.ajax({
            url:"process/fetch-user-info.php",
            method:"POST",
            data:{
                    province:province,
                    municipality:municipality,
                    baranggay:baranggay 
                },
            success:function(data){
                    $('#result').html(data);

                    
            }
        });
    });
    $(document).on('click', '#action-select', function(){
        var RFID =$(this).data("rfid");
       
        $.ajax({
            url:"process/fetch-data-modal.php",
            method:"POST",
            data:{
                  RFID:RFID
                },
            success:function(data){
                    $('#modal-user-info').html(data);

                    
            }
        });
    });
    $(document).on('keyup', '#add-RFID', function(){
        var RFID = $("#add-RFID").val();
             $.ajax({
            url:"process/check-new-user.php",
            method:"POST",
            data:{
                  RFID:RFID
                },
            success:function(data){
                $("#RFID-text").text(data) 

                    
            }
        });
         });

    $(document).on('click', '#add-new', function(){
      
        var RFID = $("#add-RFID").val();
        var First_Name = $("#add-first-name").val();
        var Last_Name = $("#add-last-name").val();
        var Email = $("#add-email").val();
        var Contact = $("#add-contact").val();
        var Province = $("#add-province").val();
        var Municipality = $("#add-municipality").val();
        var Baranggay = $("#add-baranggay").val();
        var Street = $("#add-street").val();
        $.ajax({
            url:"process/add-new-user.php",
            method:"POST",
            data:{
                  RFID:RFID,
                  First_Name:First_Name,
                  Last_Name:Last_Name,
                  Contact:Contact,
                  Email:Email,
                  Province:Province,
                  Municipality:Municipality,
                  Baranggay:Baranggay,
                  Street:Street

                },
            success:function(data){
                alert(data)
                load_store_log()

                    
            }
        });
    });
    $('#search_text').keyup(function(){
      var search = $(this).val();
      $.ajax({
            url:"process/fetch-user-info.php",
            method:"POST",
            data:{
                   search:search
                },
            success:function(data){
                    $('#result').html(data);
                    addingColor()
            }
        });
    });
})



</script>
</html>