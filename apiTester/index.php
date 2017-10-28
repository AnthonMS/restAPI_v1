<html>
<head>
    <title>API Tester</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

<?php
$searchErr = $searchInput = "";
$searchEmpty = true;

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (empty($_POST["searchValue"]))
    {
        $searchErr = "You need to enter something to search";
    }
    else
    {
        // search not empty
        $searchEmpty = false;
        $searchInput = $_POST["searchValue"];
    }
}
?>

<center>

<h1><u>API Tester for world api</u></h1>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <table id="inputTable" border="0">
        <tr>
            <td class="tableCenter" colspan="2"><h3>Search</h3></td>
        </tr>
        <tr>
            <td class="tableCenter"><input id="searchInput" type="text" name="searchValue" placeholder="Search..."></td>
        </tr>
        <tr>
            <td class="error"><?php echo $searchErr ?></td>
        </tr>
        <tr>
            <td class="tableCenter" colspan="2"><input type="submit" id="searchBtn" name="searchBtn" value="Search"></td>
        </tr>
    </table>
</form>



<?php

function searchCountries($val)
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
}

if(!$searchEmpty)
{
    // not empty go ahead and use the API and show some data
    $searchResult = searchCountries($searchInput);
    $arrLength = count($searchResult['countries']);
    //print_r($searchResult);

    echo "<h2>Result(s) below for " . $searchInput . "</h2>";
//echo "<h3> Name: " . $testSearch[0] ."</h3>";

    for ($i = 0; $i < $arrLength; $i++)
    {
        //echo "<br>";
        //echo $testSearch['countries'][$i]['name'];
        echo "<h3>" . $searchResult['countries'][$i]['name'] . ", " .
            $searchResult['countries'][$i]['continent'] . ", " .
            $searchResult['countries'][$i]['region'] . "</h3>";
        echo "<p> Population: " . $searchResult['countries'][$i]['population'] . "</p>";

    }

}
?>
</center>
</body>
</html>




















