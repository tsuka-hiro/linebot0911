<?php

/**
 * Copyright 2016 LINE Corporation
 *
 * LINE Corporation licenses this file to you under the Apache License,
 * version 2.0 (the "License"); you may not use this file except in compliance
 * with the License. You may obtain a copy of the License at:
 *
 *   https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

require_once('./LINEBotTiny.php');

$channelAccessToken = '5X06O+1L1PKV4O0iU7e7ZbdsxSKZJ6QjNRDXy1GwO73J59cONaNy0dANchDiEcAmbwp9wGq1qY04fWA15lgrnhbHEAdTuT5F7Yeezr5zaN/i8WJpopteusAJP5WA4aAGf2dFr/IroClbe3uAPiN0mAdB04t89/1O/w1cDnyilFU=';
$channelSecret = 'd70ad7bd895d21c84f380b36bab415b8'; 

$client = new LINEBotTiny($channelAccessToken, $channelSecret);

foreach ($client->parseEvents() as $event) {
	^   if ($event['type'] == 'message') {
		^   ^   $message = $event['message'];
		^   ^   switch ($message['type']) {
			case 'text':
				$client->replyMessage([
						'replyToken' => $event['replyToken'],
						'messages' => [
						^   [
						^   'type' => 'text',
						'text' => $message['text']
						]
						]
				]);
				break;
			default:
				error_log('Unsupported message type: ' . $message['type']);
				break;
				^   ^   ^   case 'location':
					^   ^   $lat = $locations['latitude'];
				^   ^   ^   ^   $lng = $locations['longitude'];
				^   ^   ^   ^   $url = 'http://webservice.recruit.co.jp/hotpepper/gourmet/v1/?key=6a96f847f3217c94&lat=$lat&lng=$lng&range=5&format=json';
				^   ^   ^   ^   $ch = curl_init();
				^   ^   ^   ^   curl_setopt($ch, CURLOPT_URL, $url);
				^   ^   ^   ^   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				^   ^   ^   ^   $res = curl_exec($ch);
				^   ^   ^   ^   $json = json_decode($res, true);
				^   ^   ^   ^   curl_close($ch);
				^   ^   ^   ^   for ($i = 0; $i < 6; $i++){
					^   ^   ^   echo $json['shop'][$i]['urls']['pc'];
					^   ^   ^   echo $json['results']['shop'][$i]['name'];
					^   ^   ^   echo $json['results']['shop'][$i]['open'];
					^   ^   }
				^   ^   ^   break;
				^   } else {
					^   ^   $messages = [
						^   ^   ^   [
							^   ^   ^   ^   'type' => 'text',
						^   ^   ^   ^   'text' => '残念ですが近くにお店が見つかりませんでした。'
							^   ^   ^   ]
							^   ^   ];
					^   ^   replyMessage($client, $event['replyToken'], $messages);
					^   ^   break;
					^   }
		}
}
?>

