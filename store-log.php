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
                <div class="white-container">
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
                        <select name="status" id="status">
                            <option value="">Status</option>
                            <option value="FAILED">Failed</option>
                            <option value="PASSED">Passed</option>
                        </select>
                        FROM : <input type="date" name="" id="from-date" placeholder="FROM">
                        TO : <input type="date" name="" id="to-date" placeholder="TO">
                        <button id="filter"> Filter</button>
                    </div>
                    <div id="result"></div>
                </div>
            </div>
        </div>

    </div>
</body>
<script>
$(document).ready(function(){
    var status
   function addingColor(){
    $( ".hstatus" ).each(function( index ) {
        if( $( this ).text()=='FAILED')
            {
                $( this ).addClass( "danger" );
            }
        else{
            $( this ).addClass( "safe" );
            }
        });
   }
    function load_store_log()
    {
        $.ajax({
            url:"process/fetch-log.php",
            method:"POST",
            success:function(data){
                    $('#result').html(data);
                    addingColor()



                    }
        });
    }
    load_store_log()
    $(document).on('click', '#filter', function(){
        var province = $("#province").val();
        var municipality = $("#municipality").val();
        var baranggay = $("#baranggay").val();
        var status = $("#status").val();
        var fromDate = $("#from-date").val();
        var toDate = $("#to-date").val();
        
        $.ajax({
            url:"process/fetch-log.php",
            method:"POST",
            data:{
                    province:province,
                    municipality:municipality,
                    baranggay:baranggay,
                    status:status,
                    fromDate:fromDate,
                    toDate:toDate
                },
            success:function(data){
                    $('#result').html(data);
                    addingColor()    
                    
            }
        });
    });
    $('#search_text').keyup(function(){
      var search = $(this).val();
      $.ajax({
            url:"process/fetch-log.php",
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