<?php

error_reporting(E_ALL);


/**
 * This function will cURL a URL and return it's HTML contents. 
 *
 * @param string $url - The URL who'se html will be scraped.
 *
 * @return string $data - The html contents of the page. 
 */
function curlGetContents($url)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

/**
 * This function will calculate the date in PHP format, for two weeks ago. 
 *
  * @return date 
 */
function getDateTwoWeeksAgo()
{
  	$date_two_weeks_ago = date('Y-m-d', strtotime("-14 days"));
  	return $date_two_weeks_ago;
}

/**
 * This function will calculate the date in PHP format, for today.
 *
  * @return date 
 */
function getTodaysDate()
{
  	$todays_date = date('Y-m-d');
  	return $todays_date;
}

?>