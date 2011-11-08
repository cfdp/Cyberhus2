<?php
//extract data from the post
extract($_POST);

var_dump($_POST);

//set POST variables
//$url = 'http://domain.com/get-post.php';
$url = 'http://chat.cybhus.dk/curl_script.php';
$fields = array(
			'lname'=>urlencode($guest_navn),
		);

//url-ify the data for the POST
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string,'&');

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POST,count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

//execute post
$result = curl_exec($ch);


//if(!curl_errno($ch)){
 $info = curl_getinfo($ch);

 echo 'Took ' . $info['total_time'] . ' seconds to send a request to ' . $info['url'];

//}
//close connection
curl_close($ch);
var_dump($result);
?>