<?php

header('Content-Type: text/html; charset=UTF-8');

$APPID="";
$APPSECRET="";

$TOKEN_URL="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$APPID."&secret=".$APPSECRET;

$json=file_get_contents($TOKEN_URL);
$result=json_decode($json);

$ACC_TOKEN=$result->access_token;

$data='{
   "button":[
   {
      "name":"我的数据",
      "sub_button":[
      {
         "type":"click",
         "name":"基本信息",
         "key":"wdjiaofei"
      },
      {
         "type":"click",
         "name":"会费缴纳状态",
         "key":"gongJiao"
      }]
   },
   {
      "name":"训练记录",
      "sub_button":[
      {
         "type":"click",
         "name":"1701期",
         "key":"hdjl1701"
      },
      {
         "type":"click",
         "name":"1702期",
         "key":"hdjl1701"
      },
      {
         "type":"click",
         "name":"1801期",
         "key":"hdjl1801"
      }]
   },
   {
      "name":"俱乐部财务",
      "sub_button":[
      {
         "type":"click",
         "name":"对账单",
         "key":"cwlsd"
      },
      {
         "type":"click",
         "name":"欠费名单",
         "key":"cwjfmd"
      }]
   }]
}';

$MENU_URL="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$ACC_TOKEN;

$ch = curl_init($MENU_URL);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data)));
$info = curl_exec($ch);
$menu = json_decode($info);
print_r($info);

if($menu->errcode == "0"){
	echo "Done";
}else{
	echo "Error";
}

/*$ch = curl_init(); 

curl_setopt($ch, CURLOPT_URL, $MENU_URL); 
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_AUTOREFERER, 1); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 

$info = curl_exec($ch);

if (curl_errno($ch)) {
	echo 'Errno'.curl_error($ch);
}

curl_close($ch);

var_dump($info);*/

?>
