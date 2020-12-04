<?php
    spl_autoload_register('my_autoloader');
    function my_autoloader($class) {
        require 'classes/' . $class . '.php';
    }
    $conn = new CRUD();
    $jsondata = json_decode($conn->getData(), true);
    $latestData = json_decode($conn->getLatestData(), true);
    $highestTemp = json_decode($conn->getHighestTemp(), true);
    $highestHumid = json_decode($conn->getHighestHumid(),true);
    $lowestTemp = json_decode($conn->getLowestTemp(), true);
    $lowestHumid = json_decode($conn->getLowestHumid(), true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="img/favicon.ico" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/28014f78a0.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/style.css">
    <title>Sensor</title>
</head>
<body>

<div class="container" style="margin-left:0;">
    <button type='button' class='btn btn-success' id='updateChart' style="margin-left:70%; margin-top:2%;" onclick="addData()">Last value</button> <br>
    <small style="margin-left:70%; margin-top:2%;">This will take the latest value from the sensor</small>
    <canvas id="myChart"></canvas>
</div>

<div class="container" style="margin-left:0;">
    <h3>Current temperature of the day: <?=$latestData[0]["temperature"]?>℃</h3>
    <h3>Current humidity of the day: <?=$latestData[0]["humidity"]?>%</h3>
    <hr>
    <h3>Highest temperature of the day:<?=$highestTemp[0]["temperature"]?>℃</h3>
    <h3>Highest humidity of the day:<?=$highestHumid[0]["humidity"]?>%</h3>
    <hr>
    <h3>Lowest temperature of the day:<?=$lowestTemp[0]["temperature"]?>℃</h3>
    <h3>Lowest humidity of the day:<?=$lowestHumid[0]["humidity"]?>%</h3>

</div>

<script>

var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['<?=$jsondata[0]['tdate']?>','<?=$jsondata[1]['tdate']?>','<?=$jsondata[2]['tdate']?>'],
        datasets: [{
            label: 'Temperature',
            data: [<?=$jsondata[0]['temperature']?>,<?=$jsondata[1]['temperature']?>,<?=$jsondata[2]['temperature']?>],
            backgroundColor: [
                'rgba(54, 162, 235, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
            ],
            borderWidth: 1
        },
        {
            label: 'Humidity',
            data: [<?=$jsondata[0]['humidity']?>,<?=$jsondata[1]['humidity']?>,<?=$jsondata[2]['humidity']?>],
            backgroundColor: [
                'rgba(189, 243, 164, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
            ],
            borderWidth: 1
        },],
        
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

function addData() {
    console.log(<?=$latestData[0]["humidity"]?> == myChart.data.datasets[0].data[0]);
    console.log(<?=$latestData[0]["humidity"]?>, myChart.data.datasets[0].data[0]);

    if(<?=$latestData[0]["humidity"]?> == myChart.data.datasets[0].data[0]) {
        console.log("Data is already up to date");
       
    }else{
        myChart.data.labels.shift()
        myChart.data.datasets[0].data.shift()
        myChart.data.datasets[1].data.shift()
        myChart.data.labels.push("<?=$latestData[0]["tdate"]?>");
        myChart.data.datasets[0].data.push(<?=$latestData[0]["temperature"]?>);
        myChart.data.datasets[1].data.push(<?=$latestData[0]["humidity"]?>);
        myChart.update()
    }

}


</script>

</body>
</html>
