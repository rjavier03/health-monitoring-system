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
                <div class="white-container  users " style="width:40%;">
                <h3>Update your password</h3>
                <form action="process/update-password.php" method="POST">
                    <div class="form-group">
                        <label for="">Email</label>
                        <input class="form-control"  type="email" name="email" id="user-email"><br>
                    </div>
                    <div class="form-group">
                        <label for="">Current Password</label>
                        <input class="form-control"  type="password" name="password" id="user-password">
                    </div>
                    <div class="form-group">
                        <label for="">NEW Password</label>
                        <input class="form-control"  type="new-password" name="new-password" id="user-password">
                    </div>
                    <input type="submit" class="btn btn-primary" value="submit">
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL -->

</body>
<script>
$(document).ready(function(){
    var status

   
})



</script>
</html>