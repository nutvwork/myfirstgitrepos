 <?php
/* Old WebHook--->nutvline.herokuapp.com/index.php*/



$access_token = 'N0IzKf3n/tuu23eKxvUEkAY6Afzj8nu+lQYp+FyOAZXSVofsrCArcwRBOJKEbssASNnN5S35vUE5yiQ3dPcvlRqu9G0IVPHVxUHUHW63dUUUdxfcWpbZUj7iu8ImPFKK8LnAdy5wGDxvMhUD1A1fugdB04t89/1O/w1cDnyilFU=';

$sValue= getInputMessage() ;
$MessageInput = $sValue[0];  
$replyToken =  $sValue[1];  
$ActionType= substr($MessageInput,0,1) ; 
$resp = "Bot Set From GIT -----Ok----" ;
echo $resp;
//return;

pushMessage($resp,$access_token,$replyToken) ;  

if ($ActionType == "C1" ) {

   $resp = getData($MessageInput) ;    
   pushMessage($resp,$access_token,$replyToken) ; 
   $ImageFileName = "http://images.all-free-download.com/images/graphicthumb/corporate_brochure_template_modern_checkered_blue_decoration_6828099.jpg" ;
   pushImage($ImageFileName,$access_token,$replyToken);
   return;
}

if ($ActionType == "P" || $ActionType == "p" ) {

   $resp = getData($MessageInput) ;    
   //pushMessage($resp,$access_token,$replyToken) ; 
   $ImageFileName = $resp  ;
   pushImage($ImageFileName,$access_token,$replyToken);
   return;
} 



//$resp = getData($MessageInput) ;

$text = "งง ???? " .$sValue[0]; 

$text .= " พิมพ์  P123456789 เพื่อดู ใบ Port งาน--->" . $resp; 
pushMessage($text,$access_token,$replyToken) ; 
//return;
//$ImageFileName = $resp  ;
//$ImageFileName ="https://www.talonplus.co.th/port/images/portimages/port_20524_609263650.png";
//pushImage($ImageFileName,$access_token,$replyToken);

return;



// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back

			$text = getData() ;

			$messages = [
				'type' => 'text',
				'text' => $text
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];

			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";



function getData($MessageInput) { 

 $field_string = $MessageInput ; 
 $url = 'https://www.talonplus.co.th/port/class/recivecurl.php?sval='. $field_string;
// echo $url. "<br/>";
 $curl = curl_init();
 curl_setopt_array($curl, array(
                        CURLOPT_RETURNTRANSFER => 1,
                        CURLOPT_URL => $url,
                        CURLOPT_USERAGENT => 'Thai Prosperous IT co.,Ltd.'
                   ));
 $resp = curl_exec($curl);
 curl_close($curl);
// echo $resp ;
 return $resp;
    
} // end func


function getInputMessage() { 


$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'] ;  
			$sValue[] = $text;
			$sValue[] = $replyToken ;  
			return $sValue;
			
		}
	}
}
    
} // end func 




function pushMessage($text,$access_token,$replyToken) {


	// Make a POST Request to Messaging API to reply to sender


	        $messages = [
				'type' => 'text',
				'text' => $text
			];

			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];

			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";




}



function pushImage($ImageFileName,$access_token,$replyToken) {


	// Make a POST Request to Messaging API to reply to sender


	       

			$messages = [
				'type' => "image",
				 "originalContentUrl"=>$ImageFileName,
                 "previewImageUrl"=> $ImageFileName
			];

			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];

			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";




}



  ?>
