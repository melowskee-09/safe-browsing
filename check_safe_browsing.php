<?php



function safe_browsing_checker($urls,$type)
{
	$str_urls = "";
	switch($type){
		case 'single' :
			$str_urls = '{"url": "'.$urls.'"}';
		break;
		case 'multiple' :
			foreach($urls as $url){
				$str_urls .= '{"url": "'.$url.'"},';
			}
			$str_urls = substr($str_urls, 0, -1);
		break;
	}
	
	
    $data = '{
      "client": {
        "clientId": "check-url-178304",
        "clientVersion": "1.0"
      },
      "threatInfo": {
        "threatTypes":      ["MALWARE"],
        "platformTypes":    ["WINDOWS"],
        "threatEntryTypes": ["URL"],
        "threatEntries": [
          '.$str_urls.'
        ]
      }
    }';
	$key = "AIzaSyCp9kdT51WdQ_QZOW_MTN_RAiBzdnGOyUc";
	
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://safebrowsing.googleapis.com/v4/threatMatches:find?key=".$key);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", 'Content-Length: ' . strlen($data)));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $response = (array) json_decode(curl_exec($ch), true);
	$count=0;
	foreach($response as $values){
		
		foreach($values as $value){
			//echo $value['threat']['url'];
		    $url = $value['threat']['url'];
			send_mail($url);
		}
	}
	
    curl_close ($ch);
    //return ($response['matches'][0]['threatType']) ? true : false;
	return $response;
}

function send_mail($url){
	$content = "<span style='font-family:arial;font-size:12px;'>
				
					<p>The site <b><i>".$url."</i></b> contains harmful content, including pages that:</p>
					<ul>
					<li>Send visitors to harmful websites</li>
					<li>Try to trick visitors into sharing personal info or downloading software</li>
					</ul>

				</span>";
				
	$html_message = $content;
	$subject = "Safe Browsing Checker - This site is unsafe";
	$email = "crmljrgarcia@gmail.com";
	mail("$email", "$subject", "$html_message", "From: Safe Browsing Checker<crmljrgarcia@gmail.com> \r\n" .  "Content-Type: text/html; charset=iso-8859-1");
}

$type = $_POST['type'];

//echo count($urls );

switch($type){
	case 'single' :
		$url = $_POST['url'];
		if(safe_browsing_checker($url,$type)){
			//send_mail($url);
			echo "malware";
		}
		else{
			echo "clean";
		}
		//echo safe_browsing_checker($url,$type)?"malware":"clean";
	break;
	case 'multiple' :
		$urls = $_POST['urls'];
		$urls = preg_split('/;|,/', $urls);  
	
		echo(json_encode(safe_browsing_checker($urls,$type)));
	break;
}
?>