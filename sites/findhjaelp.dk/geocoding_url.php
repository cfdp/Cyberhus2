<?php
//Set up our variables
$longitude = "";
$latitude = "";
$precision = "";

//Three parts to the querystring: q is address, output is the format (
$key = "ABQIAAAAbma0EtBcKlwKZK-W54o2ixRDo8J9-qNMHSYdk0qFyHPGqQcYjBT8IAILDK3y3nDs6h0C2nNN-XkezQ";
$address = urlencode("sønder allé 33 århus denmark");
$url = "http://maps.google.com/maps/geo?q=".$address."&output=csv&key=".$key;

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER,0);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER[‘HTTP_USER_AGENT’]);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$data = curl_exec($ch);
curl_close($ch);

echo "Data: ". $data." ";
if (strstr($data,"200"))
{
$data = explode(",",$data);

$precision = $data[1];
$latitude = $data[2];
$longitude = $data[3];

echo "Latutide: ".$latitude." ";

echo "Longitude: ".$longitude." ";

} else {
echo "Error in geocoding!";
}

?>

