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
            <div class="col-sm-4 col-lg-6 col-md-12">
                <div class="logo-column">
                    <img class="logo-image" src="images/testlogo.jpg" alt="logo">
                      <input name="rfid-id"  class="form-control" id="idInput"  placeholder="Scan your RFID">
                     <button id="vital-scan">Scan</button>
                </div>
            </div>
            <div class="col-sm-4 col-lg-6 col-md-12 ">
                <div class="status-column">
                <div class="status">
                        <h1>Hi,<span id="name"></span></h1>
                      
                    </div>
                    <div class="status">
                        <h1>STATUS</h1>
                        <h1 id="status"></h1>
                    </div>
                    <div class="status">
                        <h1>TEMPERATURE</h1>
                        <h1 id="temperature"></h1>
                    </div>
                    <div class="status">
                        <h1>Oxygen</h1>
                        <h1 id="oxygen"></h1>
                    </div>
                    <div class="status">
                        <h1>Hearth Rate</h1>
                        <h1 id="heart"></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



</body>

<script>
  var scan_button = document.getElementById('vital-scan')
  scan_button.addEventListener('click' , getTempe);
  var input = document.getElementById("idInput");

    // Execute a function when the user presses a key on the keyboard
    input.addEventListener("keypress", function(event) {
    // If the user presses the "Enter" key on the keyboard
    if (event.key === "Enter") {
        // Cancel the default action, if needed
        event.preventDefault();
        // Trigger the button element with a click
        scan_button.click();
    }
    });
    input.focus()
  function getTempe(){
  
    var averageTemp = localStorage.getItem('AverageTemp');
    var AverageHeart = localStorage.getItem('AverageHeart');
    var AverageOxy = localStorage.getItem('AverageOxy');
    var status =true
    if(averageTemp >37)
    {
        document.getElementById('temperature').classList.remove('safe')
        document.getElementById('temperature').classList.add('danger')
        status= false;
    }
    else{
        document.getElementById('temperature').classList.remove('danger')
        document.getElementById('temperature').classList.add('safe')
    }
    if(AverageHeart <60 || AverageHeart > 100)
    {
        document.getElementById('heart').classList.remove('safe')
        document.getElementById('heart').classList.add('danger')
        status= false;
    }
    else{
        document.getElementById('heart').classList.remove('danger')
        document.getElementById('heart').classList.add('safe')
    }
    if(AverageOxy <95)
    {   document.getElementById('oxygen').classList.remove('safe')
        document.getElementById('oxygen').classList.add('danger')
        status= false;
    }else{
        document.getElementById('oxygen').classList.remove('danger')
        document.getElementById('oxygen').classList.add('safe')
    }
   if(status){
        document.getElementById('status').classList.remove('danger')
        document.getElementById('status').classList.add('safe')
        document.getElementById('status').innerHTML ='PASSED'
   }
   else{
    document.getElementById('status').classList.remove('safe')
        document.getElementById('status').classList.add('danger')
        document.getElementById('status').innerHTML ='FAILED'
   }
    document.getElementById('temperature').innerHTML = averageTemp  + '°c' ;
    document.getElementById('heart').innerHTML = AverageHeart+ 'b/m'
    document.getElementById('oxygen').innerHTML = AverageOxy + '%' ;
    
  }
  $(document).ready(function(){
           
       $(document).on('click', '#vital-scan', function(){
            var idinput = $("#idInput").val();
            var tempe = $("#temperature").text();
            var oxygen = $("#oxygen").text();
            var heart = $("#heart").text();
            var status = $("#status").text();
            $.ajax({
                     url:"process/fetching-data.php",
                     method:"POST",
                     data:{
                            idinput:idinput,
                            tempe:tempe,
                            oxygen:oxygen,
                            heart:heart,
                            status:status
                        },
                     dataType:"text",
                     success:function(response){
                        displayName(response);
                        input.value = '';
                     }
                });
              
      });

      function displayName(name){
        document.getElementById('name').innerHTML = name ;
      }


    })

</script>
</html>