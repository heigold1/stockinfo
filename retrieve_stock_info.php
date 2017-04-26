<?php

error_reporting(E_ALL);

include './include/stock.php'; 

$symbol_list=$_GET['symbol_list'];  

$symbol_array = explode(',', $symbol_list);

$return_array = array();

foreach($symbol_array as $symbol)
{
	$my_stock = new Stock($symbol);
	$my_stock->setHighLow(5);
	
	$return_array[$symbol]['rss_feed'] = $my_stock->getRSSNewsFeed();
	$return_array[$symbol]['high_price'] = $my_stock->getHighPrice();
	$return_array[$symbol]['low_price'] = $my_stock->getLowPrice();

}

echo json_encode($return_array); 

?>