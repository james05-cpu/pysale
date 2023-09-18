<?php
session_start();
include("conn.php");
$uid=$_SESSION['username'];
$comp="comp";
//define("IPN_LOG_FILE", "ipn.log");
$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$myPost = array();
foreach ($raw_post_array as $keyval) {
	$keyval = explode ('=', $keyval);
	if (count($keyval) == 2)
		$myPost[$keyval[0]] = urldecode($keyval[1]);
}

// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';
if(function_exists('get_magic_quotes_gpc')) {
	$get_magic_quotes_exists = true;
}


foreach ($myPost as $key => $value) {
	if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
		$value = urlencode(stripslashes($value));
	} else {
		$value = urlencode($value);
	}
	$req .= "&$key=$value";
}

// Post IPN data back to PayPal to validate the IPN data is genuine
// Without this step anyone can fake IPN data

$ch = curl_init("https://www.sandbox.paypal.com/cgi-bin/webscr");
if ($ch == FALSE) {
	return FALSE;
}
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLINFO_HEADER_OUT, 1);

// Set TCP timeout to 45 seconds
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 45);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

$res = curl_exec($ch);


if (curl_errno($ch) != 0) // cURL error
	{
	echo("Can't connect to PayPal to validate IPN message: ");
	curl_close($ch);
	exit;
}
// Inspect IPN validation result and act accordingly
// Split response headers and payload, a better way for strcmp
$payment_response = $res;

$tokens = explode("\r\n\r\n", trim($res));
$res = trim(end($tokens));
if (strcmp ($res, "VERIFIED") == 0) {
	// assign posted variables to local variables
	
	$item_name = $_POST['item_name'];
	$item_number = $_POST['item_number'];
	$payment_status = $_POST['payment_status'];
	$payment_amount = $_POST['mc_gross'];
	$payment_currency = $_POST['mc_currency'];
	$txn_id = $_POST['txn_id'];
	$receiver_email = $_POST['receiver_email'];
	$payer_email = $_POST['payer_email'];

	$stm=$conn->prepare("INSERT INTO PAYMENTS (status, txid,amt,payer,receiver) 
	VALUES(?,?,?,?,?)");
$stm->bindValue(1,$payment_status);
$stm->bindValue(2,$txn_id);
$stm->bindValue(3,$payment_amount);
$stm->bindValue(4,$payer_email);
$stm->bindValue(5,$receiver_email);

$stm->execute();
	// check whether the payment_status is Completed
	$isPaymentCompleted = false;
	if($payment_status == "Completed") {
		$isPaymentCompleted = true;

$aid=$_SESSION['rawid'];
$tm=time();
$id=rand(999,999999999);
$sign=$id+$tm;
$available=array();
$res=$conn->query("SELECT* FROM AD_BLACKLIST where aid='$aid'" );
while( $row=$res->fetchArray()){
array_push($available,$row['refid']);
}

$res=$conn->query("SELECT* FROM REFS where aid='$aid'" );
while( $row=$res->fetchArray()){
array_push($available,$row['refid']);
}

$chuck=array();
$stm=$conn->prepare("SELECT* FROM FOLLOWERS where `followed_id`=?");
$stm->bindValue(1,$uid);
$res=$stm->execute();
while( $row=$res->fetchArray()){
	if (!in_array($row['followed_id'],$available)) {
if (!in_array($row['followed_id'], $chuck)) {
	array_push($chuck, $row['followed_id']);
}
}
}
$stm=$conn->prepare("SELECT* FROM FOLLOWERS where `follower_id`=?");
$stm->bindValue(1,$uid);
$res=$stm->execute();
while( $row=$res->fetchArray()){
if (!in_array($row['followed_id'],$available)) {
if (!in_array($row['followed_id'], $chuck)) {
	array_push($chuck, $row['followed_id']);
}
}
}

foreach($chuck as $ref){
$stm=$conn->prepare("INSERT INTO REFS (referer, refid,aid,sign) 
	VALUES(?,?,?,?)");
$stm->bindValue(1,$comp);
$stm->bindValue(2,$ref);
$stm->bindValue(3,$aid);
$stm->bindValue(4,$sign);

$stm->execute();
}


	}
	
} else if (strcmp ($res, "INVALID") == 0) {
	echo "Error Occured";
}
?>