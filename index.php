<!DOCTYPE html>
<html>
<head>
<title>Retrieve Stock Information</title>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/main.js"></script>   
<link type="text/css" href="css/main.css" rel="stylesheet"/>
</head>

<body>

<h1>Stock Information Report</h1>

<p>This web application uses Yahoo Finance API's to gather news and price information on stock market ticker symbols</p>

<h2>Please enter a string of stock symbols (i.e. "MSFT,AAPL,HPX") and click the "Submit" button</h2>
<p>The following will be retrieved for each stock:<br><br>
- The stock's 3 latest Yahoo Finance Articles<br>
- The stock's highest price in the last 5 trading days<br>
- The stock's lowest price in the last 5 trading days<br> 
</p>

<input type="text" id="text_input" value="MSFT,AAPL,HPQ"><button type="button" id="main_button">Submit</button><br>

<div id="div_results">

</div>

</body>
</html>