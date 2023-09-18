<?php

/**
 * Simple cURL request script
 *
 * Test if cURL is available, send request, print response
 *
 *   php curl.php
 */
$method=strip_tags($_POST['method']);
$doubt=strip_tags($_POST['url']);
if(!function_exists('curl_init')) {
    die('cURL not available!');
}

$curl = curl_init();
// or use https://httpbin.org/ for testing purposes
curl_setopt($curl, CURLOPT_URL, $doubt);
curl_setopt($curl, CURLOPT_FAILONERROR, true);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

//// Require fresh connection
//curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);

//// Send POST request instead of GET and transfer data
//$postData = array(
//    'name' => 'John Doe',
//    'submit' => '1'
//);

switch ($method) {
  case "GET":
    break;
  case "POST":
   curl_setopt($curl, CURLOPT_POST, true);
   if(strip_tags($_POST['data'])!=null){
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(trim(strip_tags($_POST['data']))));
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Accept:application/json'));
    echo( json_encode(trim(strip_tags($_POST['data']))));

   }
    break;
  case "DELETE":
  try {
  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');

   }
   catch(Exception $e) {
     curl_setopt($curl, CURLOPT_HTTPHEADER, array('X-HTTP-Method-Override: DELETE'));
  
    }

        break;

    case "PUT":

try {
  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');

   }
   catch(Exception $e) {
     curl_setopt($curl, CURLOPT_HTTPHEADER, array('X-HTTP-Method-Override: PUT'));
  
    }    break;
  default:
}
//curl_setopt($curl, CURLOPT_POST, true);
//curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postData));

//// Use a different request method
//curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
//// If the target does not accept custom HTTP methods
//// then use a regular POST request and a custom header variable
//curl_setopt($curl, CURLOPT_HTTPHEADER, array('X-HTTP-Method-Override: PUT'));
//// Note: PHP only converts data of GET queries and POST form requests into
//// convenient superglobals (»$_GET« & »$_POST«) - To read the incoming
//// cURL request data you need to access PHPs input stream instead
//// using »parse_str(file_get_contents('php://input'), $_INPUT);«

//// Send JSON body via POST request
//$postData = array(
//    'name' => 'John Doe',
//    'submit' => '1'
//);
//curl_setopt($curl, CURLOPT_POST, true);
//curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($postData));
//// Set headers to send JSON to target and expect JSON as answer
//curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Accept:application/json'));
//// As said above, the target script needs to read `php://input`, not `$_POST`!

//// Timeout in seconds
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, strip_tags($_POST['connect']));
curl_setopt($curl, CURLOPT_TIMEOUT, strip_tags($_POST['time']));

//// Dont verify SSL certificate (eg. self-signed cert in testsystem)
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, strip_tags($_POST['ssl']));
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, strip_tags($_POST['ssl']));

$output = curl_exec($curl);
if ($output === FALSE) {
    echo 'An error has occurred: ' . curl_error($curl) . PHP_EOL;

}
else {
    echo $output;

}