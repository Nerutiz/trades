<?php
require_once("./JSON.php");

// FIXME: doesn't look like we really need Pear at all
// which decreases the testing burden.
// Commenting out.the require and the new File() call.

// NOTE: File.php is installed via Pear using:
//	%> sudo pear install File
// Your server will also need the Pear library directory included in PHP's
// include_path configuration directive
// require_once('File.php');

// ensure that we don't try to send "html" down to the client
header("Content-Type: application/json");

$json = new Services_JSON;
//$fp = new File();

$results = array();
$results['error'] = null;

$jsonRequest = file_get_contents('php://input');
//$jsonRequest = '{"params":["Blah"],"method":"myecho","id":86}';

$req = $json->decode($jsonRequest);

$method = $req->method;
$params = $req->params;

switch($method) {
	case "postJsonRpc12Echo":
	case "postJsonRpc12EchoNamed":
		if (is_array($params)){
			$results['result']=$params;
		}else{
			$results['result']=$params->message;
		}
		break;
	default:
		$results['result']="";
		$results['error']=array();
		$results['error']['code']=-32601;
		$results['error']["message"]="The requested remote-procedure does not exist / is not available.";
		header('HTTP/1.1 500 Server Error');
		break;
}

$results['id'] = $req->id;

$encoded = $json->encode($results);

print $encoded;
?>
