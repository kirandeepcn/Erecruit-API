<?php

#Example of creating a candidate using erecruit 

## Returns an authorized curl resource that can be used with subsequent requests
function authenticate($serviceRoot, $username, $password, $entityID)
{
	$authenticate = $serviceRoot . "/Authenticate";
	
	$c = curl_init();
	
	
	curl_setopt($c, CURLOPT_URL, $authenticate);
	curl_setopt($c, CURLOPT_POST, true);
	curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($c, CURLOPT_HEADER, true);
	curl_setopt($c, CURLINFO_HEADER_OUT, true);
	curl_setopt($c, CURLOPT_COOKIEFILE, 'cookie.txt');
	curl_setopt($c, CURLOPT_COOKIEJAR, 'cookie.txt');
	
	#curl_setopt($c, CURLOPT_NOPROGRESS, false);
	
	$data = array('Username' => $username, 'Password' => $password, 'EntityID' => $entityID);
	curl_setopt($c, CURLOPT_POSTFIELDS, $data);
	
	
	$result = curl_exec($c);
	return array($c, $result);
}

function validate($c,$serviceRoot, $username, $password, $entityID)
{
	$authenticate = $serviceRoot . "/User/Validate";
	
	//$c = curl_init();
	
	
	curl_setopt($c, CURLOPT_URL, $authenticate);
	curl_setopt($c, CURLOPT_POST, true);
	curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($c, CURLOPT_HEADER, true);
	curl_setopt($c, CURLINFO_HEADER_OUT, true);
	curl_setopt($c, CURLOPT_COOKIEFILE, 'cookie.txt');
	curl_setopt($c, CURLOPT_COOKIEJAR, 'cookie.txt');
	
	#curl_setopt($c, CURLOPT_NOPROGRESS, false);
	
	$data = array('Username' => $username, 'Password' => $password, 'EntityID' => $entityID);
	curl_setopt($c, CURLOPT_POSTFIELDS, $data);
	
	
	$result = curl_exec($c);
	return array($c, $result);
}

function getCandidate($c, $serviceRoot, $candidateID, $entityID)
{
	$url = "$serviceRoot/Candidate/$entityID/$candidateID";
	
	curl_setopt($c, CURLOPT_URL, $url);
	curl_setopt($c, CURLOPT_HTTPGET, true);
	
	$result = curl_exec($c);
	
	var_dump(curl_getinfo($c, CURLINFO_HEADER_OUT));
	return $result;
}

function getUserDetails($c, $serviceRoot, $emailID, $entityID)
{
	$url = "$serviceRoot/User/$entityID/$emailID";
	
	curl_setopt($c, CURLOPT_URL, $url);
	curl_setopt($c, CURLOPT_HTTPGET, true);
	
	$result = curl_exec($c);
	
	var_dump(curl_getinfo($c, CURLINFO_HEADER_OUT));
	return $result;
}

function createCandidate($c, $serviceRoot, $candidateData)
{
	$url = "$serviceRoot/Candidate/Do/Create";
	
	curl_setopt($c, CURLOPT_URL, $url);
	curl_setopt($c, CURLOPT_POST, true);

	
	curl_setopt($c, CURLOPT_POSTFIELDS, $candidateData);
	
	$result = curl_exec($c);
	
	return $result;
}



$serviceRoot = "http://erecruittest.outsource.net/RestServices";
$entityID = "c3309135-5e23-4abf-8170-9520de61da62";
//$entityID = "00000000-0000-0000-0000-000000000e01";
$email = isset($_POST['email'])?$_POST['email']:"";
$password = isset($_POST['password'])?$_POST['password']:"";
$r = authenticate($serviceRoot, $email, $password, $entityID);
//var_dump($r[1]);

$r1 = validate($r[0],$serviceRoot, $email, $password, $entityID);
//echo "<pre>";
//print_r($r1[1]);
$validateData = substr($r[1],strpos($r[1],"<?xml"));
//print_r($validateData);
$xml=simplexml_load_string($validateData) or die("Error: Cannot create object");
//print_r($xml);
echo json_encode($xml);
//echo "</pre>";
//echo $r1[1];
//var_dump(getCandidate($r[0], $serviceRoot, 5145605, $entityID));
//print_r(getUserDetails($r[0], $serviceRoot, 'kevin@outsource.net', $entityID));
$candidateData = array(
"FirstName" => "Test",
"LastName" => "Candidate",
"Email" => "testcandidate@testcand.com",
"AdSource" => "Other",
"EntityID" => $entityID,
"FolderGroupID" => 1,
"CreatedByID" => "6E5AB85A-B786-42DE-B7A8-3DACD28957C2"
);

//print_r(createCandidate($r[0], $serviceRoot, $candidateData));
#var_dump(curl_error($r[0]));

curl_close($r[0]);
?>