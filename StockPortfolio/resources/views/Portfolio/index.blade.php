@extends('layouts.app')

@section('content')

    <h1>Portfolio</h1>
    <h2>Free entry shares </h2>
    <form method="post" action="{{ route('Portfolio.store') }}">
          <div class="form-group">
              @csrf
              <label for="name">Share Name:</label>
              <input type="text" class="form-control" name="share_name"/>
          </div>
          <div class="form-group">
              <label for="price">Share Price :</label>
              <input type="text" class="form-control" name="share_price"/>
          </div>
          <div class="form-group">
              <label for="quantity">Share Quantity:</label>
              <input type="text" class="form-control" name="share_qty"/>
          </div>
          <button type="submit" class="btn btn-primary">Add</button>
      </form>

      <h2>Entry shares ticker </h2>

      <h4>The curent time is: </h4>
      <body onload="startTime()">
      <div id="txt"></div>
      <div id="txt2"></div>
      <div id="txt3"></div>

      <div id="piechart"></div>
      <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
      <div id="txt1"></div>
      <div id="txt2"></div>
      <div id="txt3"></div>
      <div id="txt4"></div>
      
      <script>

      // First try java script source: https://www.w3schools.com/js/tryit.asp?filename=tryjs_timing_clock
    function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
    }

    function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
    
    }
</script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
// source: https://www.w3schools.com/howto/howto_google_charts.asp
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
document.getElementById('txt2').innerHTML = 25;
// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Task', 'Hours per Day'],
  ['Work', 8],
  ['Eat', 2],
  ['TV', 4],
  ['Gym', 2],
  ['Sleep', 8]
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'My Portfolio', 'width':800, 'height':800};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>

      
      

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        //var test = {json_encode($waarde->toArray())};
        //var sites = {!! json_encode($waarde->toArray(), JSON_HEX_TAG) !!};
        //var test2 = @json($waarde->toArray());
        //var t = JSON.parse($waarde));
        
        //document.getElementById('txt3').innerHTML =t;
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',   2 ],
          ['Eat',    2],
          ['Commute',  2],
          ['Watch TV', 2],
          ['Sleep',    7]
        ]);
        //alert($waarde.value );
       
        var options = {
          title: 'My Daily Activities',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>

<script type="text/javascript">






// C# soup API in javascript.
var settings = {
  "url": "https://bitcionpricev220190827100215.azurewebsites.net/WebService1.asmx?wsdl",
  "method": "POST",
  "timeout": 0,
  "headers": {
    "Content-Type": "text/xml"
  },
  "data": "<soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:tem=\"http://tempuri.org/\">\r\n   <soapenv:Header/>\r\n   <soapenv:Body>\r\n      <tem:BTCPrice/>\r\n   </soapenv:Body>\r\n</soapenv:Envelope>",
};

$.ajax(settings).done(function (response) {
  console.log(response);
  document.getElementById('txt2').innerHTML =response;
});


// python API in javascript.
var settings = {
  "async": true,
  "crossDomain": true,
  "url": "http://pythonstock.westeurope.cloudapp.azure.com:5000/price_high/MSFT",
  "method": "GET",
  "headers": {
    "cache-control": "no-cache",
    "Postman-Token": "7e36ceff-0024-4191-8128-5539b3063c88"
  }
}

$.ajax(settings).done(function (response) {
  console.log(response);
  document.getElementById('txt3').innerHTML =response;
});


 // Erlang rest API in javascript jquery implimantation.
var settings = {
  "async": true,
  "crossDomain": true,
  "url": "http://pythonstock.westeurope.cloudapp.azure.com:8080/sun",
  "method": "GET",
  "headers": {
    "Authorization": "Basic TWljaGllbDpFcmxhbmc=",
    "cache-control": "no-cache",
    "Postman-Token": "0f995c9a-2d06-4cdd-961b-ac0dfc6079f1"
  }
}

$.ajax(settings).done(function (response) {
  console.log(response);
  document.getElementById('txt1').innerHTML =response;
});


 // Erlang rest API in javascript xhr implimantation.
var data = null;

var xhr = new XMLHttpRequest();
xhr.withCredentials = true;

xhr.addEventListener("readystatechange", function () {
  if (this.readyState === 4) {
    console.log(this.responseText);
    document.getElementById('txt4').innerHTML =response;
  }
});

xhr.open("GET", "http://pythonstock.westeurope.cloudapp.azure.com:8080/sun");
xhr.setRequestHeader("Authorization", "Basic TWljaGllbDpFcmxhbmc=");
xhr.setRequestHeader("cache-control", "no-cache");
xhr.setRequestHeader("Postman-Token", "1083939b-f952-49d7-9231-63dea7ff0bef");

xhr.send(data);



</script>








@endsection