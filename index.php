<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <?php session_start();
     include 'process/importLibrary.php';
     
     ?>
    
</head>
<body>
<div class="container">
    <div class="login-container">
        <div class="row">
            <div class="col-sm-4 col-lg-6 ">
                <div class="logo-column">
                    <img class="logo-image" src="images/testlogo.jpg" alt="logo">
                    <p class="logo-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do 
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                    </p>           
                </div>
            </div>
            <div class="col-sm-4 col-lg-6 ">
                <div class="login-column">
                    <form class="form-container" action="process/login-process.php" method="POST" >
                        <div class="form-group">
                        
                            <input name="username" type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                        
                            <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                    
                        <button class="full-width-button" type="submit" class="btn btn-primary">Submit</button>

                        <p class="forgot-password" data-toggle="modal" data-target="#forgot-password">Forgot Password</p>
                        <?php if(isset($_SESSION["wrong-password"])){ ?>
                            <p class="login-failed">INCORRECT USERNAME OR PASSWORD</p>  
                        <?php }
                        unset($_SESSION["wrong-password"]);
                        
                        ?>
                        <hr>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="forgot-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">      
        <p>Please enter your registered email to reset your password</p>   
             
        <input id="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        <p id="response-container"></p>                       
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="password-reset">Reset</button>
      </div>
    </div>
  </div>
</div>

</body>

<script>
    $(document).ready(function(){
        $(document).on('click', '.forgot-password', function(){
            
            $('#email').val('');
            $('#response-container').empty()
        });     
       $(document).on('click', '#password-reset', function(){
       
             var email =$("#email").val();
             $('#response-container').empty()
                $.ajax({
                     url:"process/resetPassword.php",
                     method:"POST",
                     data:{email:email},
                     dataType:"text",
                     success:function(response){
                        if(response == 'success'){
                            $('#response-container').empty()
                            $( "#response-container" ).append( "<p class='success-message'>Your password has been reset, Your new password is : pandacute</p>" );
                        }
                        else{
                            $('#response-container').empty()
                            $( "#response-container" ).append( "<p class='error-message'>Email is not found </strong>" );     
                        }
                     }
                });
      });

      function test(){
          alert('test')
      }


    })

</script>
</html>