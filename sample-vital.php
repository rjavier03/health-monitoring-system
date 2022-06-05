<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample Vital Signs</title>
    <?php 
        // session_start();
        include 'process/importLibrary.php';
        include 'header.php';
    ?>
</head>
<body>
<div class="content">
    <div class="row">
        <div class="col-lg-3 col-md-4">
            <div class="white-container">
            <h3 class="vital-label">Real Time Temperature</h3>
            <p id="rt-temperature" class="vital-sign">test</p>
            <h3 class="vital-label">Average Temperature every 30seconds</h3>
            <p id="ave-temperature" class="vital-sign">test</p>
            </div>
        </div>
        <div class="col-lg-3 col-md-4">
            <div class="white-container">
            <h3 class="vital-label">Real Time Oxygen Level</h3>
            <p id="rt-oxygen" class="vital-sign">test</p>
            <h3 class="vital-label">Average Oxygen Level every 30seconds</h3>
            <p id="ave-oxygen" class="vital-sign">test</p>
            </div>
        </div>
        <div class="col-lg-3 col-md-4">
            <div class="white-container">
            <h3 class="vital-label">Real Time Heart Rate</h3>
            <p id="rt-heartRate" class="vital-sign">test</p>
            <h3 class="vital-label">Average Heart<br> Rate every 30seconds</h3>
            <p id="ave-heartRate" class="vital-sign">test</p>
            </div>
        </div>
    </div>
    <section id="graphs">
        <select name="" id="select-vital">
            <option value="temperature">Temperature</option>
            <option value="temperature">Oxygen Level</option>
            <option value="temperature">Heart Rate</option>
        </select>
        <div id="chart" style="height: 250px;"></div>
    </section>
</div>
   
</body>
<script>
    var tempe = document.getElementById('rt-temperature');
    var averageTempe = document.getElementById('ave-temperature');
    var oxy = document.getElementById('rt-oxygen');
    var averageOxyg = document.getElementById('ave-oxygen');
    var heart = document.getElementById('rt-heartRate');
    var averageHeartRate = document.getElementById('ave-heartRate');
    var i =0;
    var averageTemp = 0 ;
    var averageOxy = 0 ;
    var averageHeart = 0 ;
    var today = new Date();
    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var dateTime = date+' '+time;
    var localTemperature = parseFloat(localStorage.getItem('LiveTemp'));    
    var graphData = [
    {year : dateTime , temperature:localTemperature}

    ]
    function temperature(min = 31, max = 37) {
        let difference = max - min;
        let rand = Math.random();
        rand = Math.floor( rand * difference);
        rand = rand + min;
        rand = rand * 1.1;
        return rand.toFixed(1);
    }
    function Oxygen(min = 90, max = 100) {
        let difference = max - min;
        let rand = Math.random();
        rand = Math.floor( rand * difference);
        rand = rand + min;
        return rand.toFixed(1);
    }
    function HeartRate(min = 50, max = 110) {
        let difference = max - min;
        let rand = Math.random();
        rand = Math.floor( rand * difference);
        rand = rand + min;
        return rand.toFixed(1);
    }
    function classRemoval(){
        tempe.classList.remove("danger");
        tempe.classList.remove("safe");
        averageTempe.classList.remove("danger");
        averageTempe.classList.remove("safe");

        oxy.classList.remove("danger");
        oxy.classList.remove("safe");
        averageOxyg.classList.remove("danger");
        averageOxyg.classList.remove("safe");

        heart.classList.remove("danger");
        heart.classList.remove("safe");
        averageHeartRate.classList.remove("danger");
        averageHeartRate.classList.remove("safe");
    }
        setInterval(function(){ 
            i = i+1 ;
            classRemoval()
            var randomTemp = parseFloat(temperature());
            averageTemp = (averageTemp + randomTemp);
            var newTemp = averageTemp / i ;

            var randomOxy = parseFloat(Oxygen());
            averageOxy = (averageOxy + randomOxy);
            var newOxy = averageOxy / i ;

            var randomHeart = parseFloat(HeartRate());
            averageHeart = (averageHeart + randomHeart);
            var newHeart = averageHeart / i ;

            if(randomTemp > 37){
                tempe.classList.add("danger");
            }
            else{
                tempe.classList.add("safe");
            }
            if(newTemp > 37){
                averageTempe.classList.add("danger");
            }
            else{
                averageTempe.classList.add("safe");
            }
            //oxygen
            if(randomOxy < 95){
                oxy.classList.add("danger");
            }
            else{
                oxy.classList.add("safe");
            }
            if(newOxy < 95){
                averageOxyg.classList.add("danger");
            }
            else{
                averageOxyg.classList.add("safe");
            }
            //Heart Rate
            if(randomHeart <60 || randomHeart > 100){
                heart.classList.add("danger");
            }
            else{
                heart.classList.add("safe");
            }
            if(newHeart<60  ||newHeart > 100 ){
                averageHeartRate.classList.add("danger");
            }
            else{
                averageHeartRate.classList.add("safe");
            }
            tempe.innerHTML = randomTemp + '°c'
            averageTempe.innerHTML = newTemp.toFixed(1) + '°c' ;

            oxy.innerHTML = randomOxy + '%'
            averageOxyg.innerHTML = newOxy.toFixed(1) + '%' ;

            heart.innerHTML = randomHeart + 'b/m'
            averageHeartRate.innerHTML = newHeart.toFixed(1) + 'b/m' ;

            window.localStorage.setItem('AverageOxy', newOxy.toFixed(1));
            window.localStorage.setItem('LiveOxy', randomOxy);
            window.localStorage.setItem('AverageTemp', newTemp.toFixed(1));
            window.localStorage.setItem('LiveTemp', randomTemp);
            window.localStorage.setItem('AverageHeart', newHeart.toFixed(1));
            window.localStorage.setItem('LiveHeart', randomHeart);
        }, 3000);
        setInterval(function(){  // resetting the temp every 30secs
            i=0;
            averageTemp=0;
            averageOxy=0;
            averageHeart=0;
        }, 30000);
            ;
        displayGraph(graphData)
        setInterval(function(){     //Adding value to the graph
            document.getElementById('chart').innerHTML=''
            var today = new Date();
            var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
            var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            var dateTime = date+' '+time;
            var localTemperature = parseFloat(localStorage.getItem('LiveTemp'));  
            
            graphData.push({year: dateTime , temperature: localTemperature})
            displayGraph(graphData);
        }, 3000);
        setInterval(function(){   //resetting graph value
            graphData=[];
        }, 300000);
        function displayGraph(graphData){
            new Morris.Line({
            element: 'chart',
            data: graphData,
            xkey: 'year',
            ymax: 40,
            ymin: 34,
            ykeys: ['temperature'],
            labels: ['temperature']
            });
       }

</script>
</html>