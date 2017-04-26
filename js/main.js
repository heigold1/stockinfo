
$(function() {


$("#main_button").click(function(){

	var all_symbols = $("#text_input").val();
	var test_results = /^[-\D\s]+(?:,[-\D\s]*)*$/.test(all_symbols); 

	if (test_results == true)
	{
		var spinner_div = $("<div class='loader' />")
	  	$("#div_results").html(spinner_div);

     	$.ajax({
          url: "retrieve_stock_info.php",
          data: {symbol_list: $("#text_input").val()},
          async: true, 
          dataType: 'json',
          success:  function (data) {
 			
 			$("#div_results").html('');

          	for (var key in data) {

	            var stock_symbol = $("<div class='stock_symbol' />");
	            $(stock_symbol).html("Stock Symbol: " + key)

	            var stock_rss_feed = $("<div class='stock_rss' />");
	            $(stock_rss_feed).html("Last 3 Yahoo Finance Articles: <br>" + data[key]['rss_feed']);

	            var stock_high_price = $("<div class='stock_high_price' />");
	            $(stock_high_price).html("5-Day High Price: $" + parseFloat(data[key]['high_price']).toFixed(2));

	            var stock_low_price = $("<div class='stock_low_price' />");
	            $(stock_low_price).html("5-Day Low Price: $" + parseFloat(data[key]['low_price']).toFixed(2));

 	            var stock_row =  $("<div class='stock_row' />");
 	            $(stock_row).append($(stock_symbol));
 	            $(stock_row).append($(stock_rss_feed));
 	            $(stock_row).append($(stock_high_price));
 	            $(stock_row).append($(stock_low_price));

 	            $("#div_results").append(stock_row);
  			}
          }
    	});  // end of AJAX call to retrieve_stock_info.php   
	}
	else 
	{
		alert("Your string didn't match the format and/or criteria for comma-separated list of character-only symbols.\n\nIt must be characters only (i.e. 'GOOG', 'MSFT')")
	}
});

});