<?php 

error_reporting(E_ALL);

include 'general_functions.php'; 

class Stock{

   public $symbol;
   public $high_price;
   public $low_price;

 	/**
	 * Constructor - Simply store the stock ticker symbol.
	 * 
	 * @param string $symbol - The stock ticker symbol.
	 *
   	 * @return void
  	 */

   function __construct($symbol)
   {
       $this->symbol = $symbol; 
   }

 	/**
	 * This function will call a Yahoo Finance API that will grab Yahoo Finance News RSS feed data, 
	 * and return the three latest Yahoo Fninance news articles for the symboL.
  	 *
   	 * @return void
  	 */

   public function getRSSNewsFeed()
   {

    $rss = simplexml_load_file("http://feeds.finance.yahoo.com/rss/2.0/headline?s=" . $this->symbol . "&region=US&lang=en-US");
      $allNews = "<ul class='newsSide'>";
      $i = 0;
      foreach ($rss->channel->item as $feedItem) {
          $i++;
          $allNews .= "<li "; 

          if ($i % 2 == 1)
          {
            $allNews .=  "style='background-color: #FFFFFF; '"; 
          };
        
          $newsTitle = $feedItem->title; 

          $allNews .=  " ><a target='_blank' href='$feedItem->link' title='$feedItem->title'> " . $feedItem->pubDate . " " . $newsTitle . "</a></li>";

          if ($i == 3)
          {
            break;
          }
      }
      $allNews .=  "</ul>";

      return $allNews; 
    }


 	/**
	 * This function will call a Yahoo Finance API that will gather the last two weeks' pricing data 
	 * for a stock, go back 5 trading days, and calculate the highest and lowest trading price for 
	 * those days. 
  	 *
	 * @param int $num_days - The number of days you want to go back (i.e. '5')
	 *
   	 * @return void
  	 */

    public function setHighLow($num_days)
    {

      $yahoo_finance_API_URL = "http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20%20%20yahoo.finance.historicaldata%20where%20%20symbol%20%20%20%20=%20%22" . $this->symbol . "%22and%20%20%20%20startDate%20=%20%22" . getDateTwoWeeksAgo() . "%22%20and%20%20%20%20endDate%20%20%20=%20%22" . getTodaysDate() . "%22&format=json&diagnostics=true&env=store%3A%2F%2Fdatatables.org/alltableswithkeys&callback="; 
      $result = curlGetContents($yahoo_finance_API_URL);
      $result_json = json_decode($result);

      if (isset($result_json->query->results))
      {
        // initialize high and low values 

        $high = 0.0;  
        $low = 0.0; 

          $historicalDataArray = $result_json->query->results->quote;

          // initialize the high/low values to the high/low values of 
          // the first array element. 

          if (isset($historicalDataArray[0]->High))
          {
            $high = $historicalDataArray[0]->High;
          }

          if (isset($historicalDataArray[0]->Low))
          {
            $low = $historicalDataArray[0]->Low;
          }

          // now we loop through the rest of the days. 

          for ($i = 1; $i <= $num_days; $i++)
          {
              if (isset($historicalDataArray[$i]->High))
            {
              $current_high = $historicalDataArray[$i]->High;
              if ($current_high > $high)
              {
                $high = $current_high;
              }
            }
            if (isset($historicalDataArray[$i]->Low))
            {
              $current_low = $historicalDataArray[$i]->Low;

              if ($current_low < $low)
              {
                $low = $current_low;
              }
            }
          }

          $this->high_price = $high; 
          $this->low_price = $low;

      } // end of if (isset($result_json->query->results))

    } // end of function setHighLow5Days() 



 	/**
 	 * This function will retrieve the previously-calculated value for the highest trading price 
 	 * the stock has reached. 
  	 *
   	 * @return float
  	 */

    public function getHighPrice()
    {
      return $this->high_price; 
    }


 	/**
 	 * This function will retrieve the previously-calculated value for the lowest trading price 
 	 * the stock has reached. 
  	 *
   	 * @return float
  	 */
    public function getLowPrice()
    {
    	return $this->low_price; 
    }

}

 ?>