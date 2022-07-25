<?php 
include "config.php";

$tofile = '';
foreach($_POST AS $key => $value) {
    ${$key} = trim(filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS)); 
	$tofile .= $key.':'.$value.'
';
} // end FOREACH

if($file = fopen("response.txt", "w+")){
		fputs($file, $tofile);
		fclose($file);
} // end frite to file

include "global.php";
$link = mysqli_connect($hostName, $userName, $password, $databaseName) or die ("Error connect to database");

$data = $_POST;
ksort($data);
$str = http_build_query($data);
$sign2 = md5($str . $roskassa_secretkey);

$tofile = "
===========
".$str."
sign from roskassa: ".$sign."
sign from script: ".$sign2;
if($file = fopen("response.txt", "a+")){
		fputs($file, $tofile);
		fclose($file);
} // end frite to file

// check for pending order
$chattid = explode("|", $order_id);
$nfttype = $chattid[1];
$chat_id = $chattid[0];

// LANGUAGE
$str3select = "SELECT `lang` FROM `users` WHERE `chatid`='$chat_id'";
$result3 = mysqli_query($link, $str3select);
$row3 = @mysqli_fetch_object($result3);
if($row3->lang != ''){
	$langcode = $row3->lang;
}else{
	$langcode = 0;	
}
require "lang.php";
for ($i = 0; $i < count($text); $i++) {
	for ($k = 0; $k < count($text[$i]); $k++) {
		$text[$i][$k] = str_replace("&#13;&#10;", "
", $text[$i][$k]);
		$text[$i][$k] = str_replace("&#9;", "", $text[$i][$k]);
		$text[$i][$k] = str_replace("&#60;", "<", $text[$i][$k]);
		$text[$i][$k] = str_replace("&#62;", ">", $text[$i][$k]);
		$text[$i][$k] = str_replace("&#39;", "'", $text[$i][$k]);
		$text[$i][$k] = str_replace("", "", $text[$i][$k]);						
	} // end FOR
} // end FOR	
// LANGUAGE

$str2select = "SELECT * FROM `temp_sess` WHERE `chatid`='$chat_id' ORDER BY `rowid` DESC LIMIT 1";
$result = mysqli_query($link, $str2select);
if(mysqli_num_rows($result) != 0){
	$row = @mysqli_fetch_object($result);	
		
		if($nfttype == "blogger") {$rate = $BloggerNFT;}
		elseif($nfttype == "custom") {$rate = $Blogger3D;}
		elseif($nfttype == "nude") {$rate = $NFTNude;}
		
		$ssum = $amount/$rate;
		$gotNFT = number_format($ssum, 2, '.', ''); 		
		
		$str16select = "SELECT * FROM `nft` WHERE `chatid`='$chat_id'";
		$result16 = mysqli_query($link, $str16select);
		if(mysqli_num_rows($result16) == 0){
			$str2ins = "INSERT INTO `nft` (`chatid`,`".$nfttype."`) VALUES ('$chat_id','$gotNFT')";
			mysqli_query($link, $str2ins);
		}else{
			$row16 = @mysqli_fetch_object($result16);
			if($nfttype == "blogger"){
				$oldsum = $row16->blogger;
			}elseif($nfttype == "custom"){
				$oldsum = $row16->custom;
			}elseif($nfttype == "nude"){
				$oldsum = $row16->nude;					
			}
			$newsum = $oldsum + $gotNFT;					
			$str11upd = "UPDATE `nft` SET `".$nfttype."`='".$newsum."' WHERE `chatid`='$chat_id'";
			mysqli_query($link, $str11upd);
							
		}		
		
		######## SAVE TRANSACTION ###########
		if($nfttype == "blogger"){
			$cat = $gotNFT;
			$dog = 0;
			$nude = 0;
		}elseif($nfttype == "custom"){
			$cat = 0;
			$dog = $gotNFT;					
			$nude = 0;
		}elseif($nfttype == "nude"){
			$cat = 0;
			$dog = 0;					
			$nude = $gotNFT;						
		}
		$date_time = date("j-m-Y G:i");
		$str2ins = "INSERT INTO `transactions` (`chatid`,`sender`,`date_time`,`blogger`,`custom`,`nude`) VALUES ('$chat_id','tegromoney','$date_time','$cat','$dog','$nude')";
		mysqli_query($link, $str2ins);
		######## SAVE TRANSACTION ###########
		
		
		$str2del = "DELETE FROM `temp_sess` WHERE `rowid` = '$row->rowid'";
		mysqli_query($link, $str2del);		
}
// check for pending order
		
		$tomessage = str_replace("%sum%", $gotNFT, $text[$langcode][33]);
		$tomessage = str_replace("%coin%", $nfttype, $tomessage);
		$response = array(
			'chat_id' => $order_id,
			'text' => $tomessage);
		sendit($response, 'sendMessage');	

function sendit($response, $restype){
	$ch = curl_init('https://api.telegram.org/bot' . TOKEN . '/'.$restype);  
	curl_setopt($ch, CURLOPT_POST, 1);  
	curl_setopt($ch, CURLOPT_POSTFIELDS, $response);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_exec($ch);
	curl_close($ch);	
}

function send($id, $message, $keyboard) {   
		
		//Удаление клавы
		if($keyboard == "DEL"){		
			$keyboard = array(
				'remove_keyboard' => true
			);
		}
		if($keyboard){
			//Отправка клавиатуры
			$encodedMarkup = json_encode($keyboard);
			
			$data = array(
				'chat_id'      => $id,
				'text'     => $message,
				'reply_markup' => $encodedMarkup
			);
		}else{
			//Отправка сообщения
			$data = array(
				'chat_id'      => $id,
				'text'     => $message
			);
		}
       
        $out = sendit($data, 'sendMessage');       
        return $out;
}   
?>