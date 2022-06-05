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
        include 'admin-header.php';
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
        <button id="close-update" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="update-company" type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- add new modal -->
<div class="modal fade" id="add-new-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <input type="text" class="form-control" name="" id="company-name" placeholder="Company Name"><br>
            <input type="text" class="form-control" name="" id="company-slug" placeholder="Company Slug"><br>
            <input type="email" class="form-control" name="" id="company-email" placeholder="Email"><br>
            <input type="text" class="form-control" name="" id="company-username" placeholder="Username"><br>
            <div class="role-div">
                <p>Role:</p>
                <select class="dropdown-menu" role="menu" name="" id="company-role">
                    <option class="dropdown-item" value="company-admin">Company Admin</option>
                    <option class="dropdown-item" value="super-admin">Super Admin</option>
                    <option class="dropdown-item" value="company-not-admin">Company Employee</option>
                </select>
            </div>
      </div>
      <div class="modal-footer">
  
        <button id="new-company" type="submit" class="btn btn-primary">Create New</button>
        </form>
        <button id="close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    $(document).on('click', '#update-company', function(){
        var update_id =  $("#update-id").val();
        var update_name =  $("#update-name").val();
        var update_slug =  $("#update-slug").val();
        var update_email =  $("#update-email").val();
        var update_username =  $("#update-username").val();
       
        var update_role =  $("#update-role").val();
        var action = 'toUpdate'
        $.ajax({
            url:"process/action-admin-user.php",
            method:"POST",
            data:{
                    action : action ,
                    update_id : update_id, 
                    update_name : update_name, 
                    update_slug : update_slug,
                    update_email : update_email,
                    update_role : update_role,
                    update_username:update_username
                },
            success:function(data){
                  load_store_log()
                   $("#close-update").click();
                    
                  alert(data)
                
                    }
        });
     
    })
    $(document).on('click', '#new-company', function(){
        var name =  $("#company-name").val();
        var email =  $("#company-email").val();
        var slug =  $("#company-slug").val();
        var role =  $("#company-role").val();
        var username =  $("#company-username").val();
       
        $.ajax({
            url:"process/add-admin-user.php",
            method:"POST",
            data:{
                    name : name, 
                    slug : slug,
                    email : email,
                    role : role,
                    username:username
                },
            success:function(data){
                  load_store_log()
                  alert(data)
                  $("#close").click();
                    }
        });
    
    })
    $(document).on('click', '#reset-password', function(){
        var ID =$(this).data("id");

        $.ajax({
            url:"process/resetPassword.php",
            method:"POST",
            data:{
                ID:ID
                },
            success:function(data){
                   alert(data)

                    
            }
        });
    })
    function load_store_log()
    {
        $.ajax({
            url:"process/fetch-admin-user-info.php",
            method:"POST",
            success:function(data){
                    $('#result').html(data);
                    }
        });
    }
    load_store_log()

    $(document).on('click', '#action-select', function(){
        var ID =$(this).data("id");

        $.ajax({
            url:"process/fetch-admin-user-data.php",
            method:"POST",
            data:{
                ID:ID
                },
            success:function(data){
                    $('#modal-user-info').html(data);

                    
            }
        });
    });
    
    $(document).on('click', '#action-view-as', function(){
        var ID =$(this).data("id");
      
        $.ajax({
            url:"process/admin-redirection.php",
            method:"POST",
            data:{
                ID:ID
                },
            success:function(data){
                window.location = 'dashboard.php';
                  //  alert(data)

                    
            }
        });
    });

    $('#search_text').keyup(function(){
      var search = $(this).val();
      $.ajax({
            url:"process/fetch-admin-user-info.php",
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