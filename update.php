<?php

//Thomas Holbrook - Tom@Jigsaw24.com
//PoC JAMF CCE March 2017

$jssUrl = "https://tjhjss01.local:8443";
?>

<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title>Tom</title>
</head>
<body>
<font size="5" color="red">
<br>
	<?php
		echo "Requesting update for device with JSS ID: " . $_POST['id'] . " Username " . $_POST['username'];
		echo "<br>";



$ch2 = curl_init();

$url2 = $jssUrl . '/JSSResource/mobiledevices/id/' . $_POST['id'] . '/subset/Location';


//set the url, number of POST vars, POST data
curl_setopt($ch2,CURLOPT_URL, $url2);
	curl_setopt($ch2, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/xml',
    'Accept: application/xml'
));
curl_setopt($ch2, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
//set your credentials here - I recommend making a specific user for this function
curl_setopt($ch2, CURLOPT_USERPWD, "tom:jamf1234");
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);

//execute post
$result2 = curl_exec($ch2);

echo "<br>";
echo "<br>";
$xml=simplexml_load_string($result2) or die("FAIL");
#print_r($xml);
echo "Device is currently assigned to " . $xml->location->username . "<br>";
echo "<br>";
echo "<br>";


//close connection
curl_close($ch2);

$setuser = "<mobile_device><location><username>" . $_POST['username'] . "</username></location></mobile_device>";

$url3 = $jssUrl . '/JSSResource/mobiledevices/id/' . $_POST['id'];

//open connection
$ch3 = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch3,CURLOPT_URL, $url3);
curl_setopt($ch3, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
//set your credentials here - I recommend making a specific user for this function
curl_setopt($ch3, CURLOPT_USERPWD, "tom:jamf1234");
curl_setopt($ch3,CURLOPT_POSTFIELDS, $setuser);
curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch3, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch3, CURLOPT_HTTPHEADER, array(
    'Content-Type: text/xml',
    'Accept: text/xml'
));

//execute post
$result3 = curl_exec($ch3);

print "Device " . $result3 . " has been updated to " . $_POST['username'];

echo "<br>";
echo "<br>";

//close connection
curl_close($ch3);


$addgroup = "<mobile_device_group><mobile_device_additions><mobile_device><id>" . $_POST['id'] . "</id></mobile_device></mobile_device_additions></mobile_device_group>";

$url4 = $jssUrl . '/JSSResource/mobiledevicegroups/id/4';

//open connection
$ch4 = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch4,CURLOPT_URL, $url4);
curl_setopt($ch4, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
//set your credentials here - I recommend making a specific user for this function
curl_setopt($ch4, CURLOPT_USERPWD, "tom:jamf1234");
curl_setopt($ch4,CURLOPT_POSTFIELDS, $addgroup);
curl_setopt($ch4, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch4, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch4, CURLOPT_HTTPHEADER, array(
    'Content-Type: text/xml',
    'Accept: text/xml'
));

//execute post
$result4 = curl_exec($ch4);


//close connection
curl_close($ch4);

$url = $jssUrl . '/JSSResource/mobiledevicecommands/command/UpdateInventory/id/' . $_POST['id'];


//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
//set your credentials here - I recommend making a specific user for this function
curl_setopt($ch, CURLOPT_USERPWD, "tom:jamf1234");
curl_setopt($ch,CURLOPT_POSTFIELDS, $null);

//execute post
$result = curl_exec($ch);

//close connection
curl_close($ch);


echo "<br>";
echo "<br>";


?>

<FORM><INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;"></FORM>

<br>
</form>
</font>
</body>
</html>