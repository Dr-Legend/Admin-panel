<?php
$API_KEY = 'AIzaSyDlkccWaB1G-6cxUqgbcZ4BQ2UHGzl30WE';
$ChannelID = 'UCYOgrka2vxuayv4bc7ESjGA';

$channelInfo = 'https://www.googleapis.com/youtube/v3/search?part=snippet&channelId='.$ChannelID.'&type=video&eventType=live&key='.$API_KEY;

$extractInfo = file_get_contents($channelInfo);
$extractInfo = str_replace('},]',"}]",$extractInfo);
$showInfo = json_decode($extractInfo, true);
print_r($showInfo);
if($showInfo['pageInfo']['totalResults'] === 0){

echo 'Users channel is Offline';

}else{

echo 'Users channel is LIVE!';

}

 ?>
 [22:50, 4/30/2019] Mlabs Ankit: If user channel is live then send the video id in response