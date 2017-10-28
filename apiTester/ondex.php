<?php
/**
 * Created by PhpStorm.
 * User: Anthon
 * Date: 28-10-2017
 * Time: 00:46
 */

function searchCountries($val)
{
    // check if search is empty
    if (empty($val))
    {
        // print error
        return('Please enter valid search value');
    }
    else
    {
        $ch = curl_init();
        $url = "http://localhost/api_v2/country/search_country.php?s=" . $val;

        // setup cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, "my project");

        // parse url
        $result = curl_exec($ch);

        // close connection
        curl_close($ch);

        // return our decoded result
        return json_decode($result, 1);
        //return $result;
    }
}

// test the function
$testSearch = searchCountries("den");
print_r($testSearch);
echo "<br>";
$arrLength = count($testSearch['countries']);

//for ($i = 0; $i < $arrLength; $i++)
//{
    //echo "<br>";
    //print_r($testSearch['countries'][$i]);
    //echo "<br>";
    //echo $testSearch['countries'][$i]['name'];
//}

echo "<h2>Result(s) below for 'den'</h2>";
//echo "<h3> Name: " . $testSearch[0] ."</h3>";

for ($i = 0; $i < $arrLength; $i++)
{
    //echo "<br>";
    //echo $testSearch['countries'][$i]['name'];
    echo "<h3> Name: " . $testSearch['countries'][$i]['name'] . ", " .
        $testSearch['countries'][$i]['continent'] . ", " .
        $testSearch['countries'][$i]['region'] . "</h3>";
    echo "<p> Population: " . $testSearch['countries'][$i]['population'] . "</p>";

}




























?>