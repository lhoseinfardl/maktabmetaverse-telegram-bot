<?php
/*
👋 Hi, I’m @lhoseinfardl
👀 I’m interested in ...
🌱 I’m currently learning ...
*/
ini_set('error_logs','off');
error_reporting(0);
//*****************************************************
define("API_KEY","token");   //token
function lhoseinfardl($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
function SendMessage($chat_id,$text,$mode,$reply = null,$keyboard = null){
	lhoseinfardl('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>$text,
	'parse_mode'=>$mode,
	'reply_to_message_id'=>$reply,
	'reply_markup'=>$keyboard
	]);
}

function EditMessageText($chatid,$messageid,$text,$parse_mode,$disable_web_page_preview,$keyboard){
   lhoseinfardl('editMessagetext',[
    'chat_id'=>$chatid,
  'message_id'=>$messageid,
    'text'=>$text,
    'parse_mode'=>$parse_mode,
  'disable_web_page_preview'=>$disable_web_page_preview,
    'reply_markup'=>$keyboard
  ]);
  }
function save($filename,$TXTdata)
	{
	$myfile = fopen($filename, "w") or die("Unable to open file!");
	fwrite($myfile, "$TXTdata");
	fclose($myfile);
	}
	function Forward($berekoja,$azchejaei,$kodompayam)
{
lhoseinfardl('ForwardMessage',[
'chat_id'=>$berekoja,
'from_chat_id'=>$azchejaei,
'message_id'=>$kodompayam
]);
}
function sendphoto($chat_id, $photo, $caption){
	bot('sendphoto',[
	'chat_id'=>$chat_id,
	'photo'=>$photo,
	'caption'=>$caption
	]);
	}
function DeleteFolder($path){
if($handle=opendir($path)){
while (false!==($file=readdir($handle))){
if($file<>"." AND $file<>".."){
if(is_file($path.'/'.$file)){ 
@unlink($path.'/'.$file);
} 
if(is_dir($path.'/'.$file)) { 
deletefolder($path.'/'.$file); 
@rmdir($path.'/'.$file); 
}
}
}
}
}
function getFile($file_id){
	return json_decode(file_get_contents('https://api.telegram.org/bot'.API_KEY.'/getFile?file_id='.$file_id));
}
//*****************************************************
$dev = array("1089674456","00000000","00000000"); //user id admin
$channel = "maktabmetaverse";//username channel - @
$token = API_KEY; // dont touch
$bot = maktabmetaverserobot;//username bot - @
$web = "https://lhoseinfardl.ir/maktab/";  // web addres
//*****************************************************
$update = json_decode(file_get_contents("php://input"));
$message = $update->message;
$text = $message->text;
$textt = $message->text;
$from_id = $message->from->id;
$fromid = $update->callback_query->from->id;
$chat_id = $message->chat->id;
$chatid = $update->callback_query->message->chat->id;
$message_id = $message->message_id;
$messageid = $update->callback_query->message->message_id;
$first_name = $message->from->first_name;
$last_name = $message->from->last_name;
$first = $update->callback_query->from->first_name;
$username = $message->from->username;
$tc = $update->message->chat->type;
$data = $update->callback_query->data;
$caption = $message->caption;
$photo = $update->message->photo;
$photo_id = $photo[count($photo)-1]->file_id;
$reply = $message->reply_to_message->forward_from->id;
$reply_id = $message->reply_to_message->from->id;
mkdir("data/$from_id");
$remove = json_encode(['KeyboardRemove'=>[],'remove_keyboard'=>true]);
//*****************************************************
@$user = json_decode(file_get_contents("data/$from_id/$from_id.json"),true);
@$user1 = json_decode(file_get_contents("data/$fromid/$fromid.json"),true);
@$lhoseinfardl = json_decode(file_get_contents("admin/settings.json"),true);
@$vipacc = $lhoseinfardl["vipacc"];
@$hoseinfd = $user["typedas"];
@$invite = $user["invite"];
@$step = $user['step'];
@$count = $user["syou"];
@$sbot = $user["sbot"];
@$account = $user["type"];
@$list = json_decode(file_get_contents("data/list.json"),true);
@$banlist = $list['ban'];
@$viplist = $list['vipp'];
@$admin = json_decode(file_get_contents("data/admins.json"),true);
$listadmin = $admin["dev"];
@$onof = file_get_contents("data/onof.txt");
$forchannel = lhoseinfardl ('getChatMember', ['chat_id' => "@$channel", 'user_id' => $from_id ]) ; 
$tch = $forchannel->result->status;
//*****************************************************
if(in_array($from_id, $list['ban'])){
SendMessage($chat_id,"شما قادر به استفاده از این ربات نیستید", null, $message_id, $remove);
exit();
}
if($onof == "off" && $from_id != $dev[0]){
SendMessage($chat_id,"اوه⚠️
ربات در حال حاضر توسط مدیر خاموش شدع!!!!!", null, $message_id, $remove);   
 return false;
}

elseif(strpos($text=="/start") !== false && $text !=="/start"){
$id=str_replace("/start ","",$text);
$amar=file_get_contents("data/members.txt");
$exp=explode("\n",$amar);
if(!in_array($from_id,$exp) && $from_id != $id){
$myfile2 = fopen("data/members.txt", "a") or die("Unable to open file!");
fwrite($myfile2, "$from_id\n");
fclose($myfile2);
$user["step"] = "free";
$user["invite"] = "0";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
$user1 = json_decode(file_get_contents("data/$id/$id.json"),true);
$invite = $user1["invite"];
settype($invite,"integer");
$newinvite = $invite + 1;
$user1["invite"] = $newinvite;
$outjson = json_encode($user1,true);
file_put_contents("data/$id/$id.json",$outjson);
lhoseinfardl('sendMessage',[
'chat_id'=>$id,
'text'=>"
[یک نفر از طریق لینک شما وارد ربات شد✅](tg://user?id=$from_id)
تعداد افرادی که تا حالا دعوت کردید : $invite 📰
",
'parse_mode'=>"markdown",
]);
lhoseinfardl('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"سلام $first_name 👥
متاورس کلوب هستم.

 به ربات چنل مکتب متاورس خوش اومدی

میتونم راجع به متاورس و ارز های دیجیتال کلی اطلاعات بهت بدم 🏠

کافیه هر قسمتی ک میخای رو دکمه مربوط بهش کلیک کنی

[کانال رسمی ما🏛](https://t.me/maktabmetaverse)",

'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"اصطلاحات و دانستنی 📋"],['text'=>"اطلاع رسانی 📬"]],
[['text'=>"آموزش صفر تا صد 🗂"]],
[['text'=>"متاورس چیست 📩"],['text'=>"ارز های متاورسی 💡"]],
]
])
 ]); 
 if($account == "") {
if($invite  >= $setadd && $tc == "private"){
$user["type"] = "vip";
$outjson = json_encode($user,true);
file_put_contents("data/$id/$id.json",$outjson);
lhoseinfardl('sendmessage',[
'chat_id'=>$id,
'text'=>"
تبریک دوست عزیز ✅
حساب شما ویژه شد🔰
تعداد دعوتی های  شما : $invite 〽️
",
]);
$lhoseinfardl["vipacc"] = "$vipacc" +1 ;
$sabts = json_encode($lhoseinfardl,true);
file_put_contents("admin/settings.json",$sabts);
}
}
}
}
if (!file_exists("data/$from_id/$from_id.json")) {
$myfile2 = fopen("data/members.txt", "a") or die("Unable to open file!");
fwrite($myfile2, "$from_id\n");
fclose($myfile2);
$user["step"] = "free";
$user["invite"] = "0";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
}

if($text == "/start"){
$user["step"] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
lhoseinfardl('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"سلام $first_name 👥
متاورس کلوب هستم.

 به ربات چنل مکتب متاورس خوش اومدی

میتونم راجع به متاورس و ارز های دیجیتال کلی اطلاعات بهت بدم 🏠

کافیه هر قسمتی ک میخای رو دکمه مربوط بهش کلیک کنی

[کانال رسمی ما🏛](https://t.me/maktabmetaverse)
",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"اصطلاحات و دانستنی 📋"],['text'=>"اطلاع رسانی 📬"]],
[['text'=>"آموزش صفر تا صد 🗂"]],
[['text'=>"متاورس چیست 📩"],['text'=>"ارز های متاورسی 💡"]],
]
])
 ]); 
}
if($tch != "member" && $tch != "creator" && $tch != "administrator" ){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"سلام کاربر عزیز🌟
لطفا برای حمایت و اطلاع از اپدیت های ربات در کانال ما عضو شوید🙏

@$channel l @$channel
@$channel l @$channel

لطفا بعد از عضویت در کانال ربات را دوباره استارت کنید❗️️

/start 🌟
", 
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'inline_keyboard'=>[
[
['text'=>"عضویت در کانال➰",'url'=>"http://t.me/$channel"]
],
]
])
]);
}
elseif($text == "خانه🏢"){
$user["step"] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
lhoseinfardl('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"به منوی اصلی برگشتید❗️",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"اصطلاحات و دانستنی 📋"],['text'=>"اطلاع رسانی 📬"]],
[['text'=>"آموزش صفر تا صد 🗂"]],
[['text'=>"متاورس چیست 📩"],['text'=>"ارز های متاورسی 💡"]],
]
])
 ]); 
}

elseif($text == "[MENO1]"){
$user["step"] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
lhoseinfardl('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"💵 قیمت ارز های کشور های مختلف:

🇪🇺 یورو : $yoro
------
🇺🇸 دلار : $dolar
------
🇦🇪درهم امارات  : <code>$emarat</code>
------
🇸🇪 کرون سوئد : <code>$swead</code>
------
🇳🇴 کرون نروژ : <code>$norway</code>
------
🇮🇶 دینار عراق : <code>$iraq</code>
------
🇨🇭فرانک سوئیس : <code>$swit</code>
------
🇦🇲 درام ارمنستان : <code>$armanestan</code>
------
🇬🇪لاری گرجستان : <code>$gorgea</code>
------
🇵🇰 روپیه پاکستان : <code>$pakestan</code>
------
🇷🇺 روبل روسیه : <code>$russia</code>
------
🇮🇳 روپیه هندوستان : <code>$india</code>
------
🇰🇼 دینار کویت : <code>$kwait</code>
------
🇦🇺 دلار استرلیا : <code>$astulia</code>
------
🇴🇲 ریال عمان : <code>$oman</code>
------
🇶🇦 ریال قطر : <code>$qatar</code>
------
🇨🇦 دلار کانادا : <code>$kanada</code>
------
🇹🇭بات تایلند : <code>$tailand</code>
------
🇹🇷 لیر ترکیه : <code>$turkye</code>
------
🇬🇧 پوند انگلیس : <code>$england</code>
------
🇭🇰 دلار هنگ کنگ : <code>$hong</code>
------
🇦🇿 منات اذربایجان : <code>$azarbayjan</code>
------
🇲🇾رینگیت مالزی : <code>$malezy</code>
------
🇩🇰 کرون دانمارک : <code>$danmark</code>
------
🇳🇿 دلار نیوزلند : <code>$newzland</code>
------
🇨🇳 یوان چین : <code>$china</code>
------
🇯🇵 ین ژآپن : <code>$japan</code>
------
🇧🇭 دینار بحرین : <code>$bahrin</code>
------
🇸🇾 لیر سوریه : <code>$souria</code>",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"خانه🏢"]],
]
])
 ]); 
}
///////////////////////////
//////////////////
///////////////////////////
elseif($text == "کاربر  🫀vip"&& $from_id == $dev[0]){
$user1['step'] = "vipda";
$outjson = json_encode($user1,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
lhoseinfardl('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"لطفا ایدی عدد  فرد را جهت ویژه کردن اکانت ارسال کنید ✔️",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[
['text'=>"پنل مدیریت💒"],
],
]
])
]);
}
elseif($step == "vipda" and is_numeric($text)){
$user['step'] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
$user['typedas'] = "vip";
$outjson = json_encode($user,true);
file_put_contents("data/$text/$text.json",$outjson);
 lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"حساب کاربر   [$text](tg://user?id=$text) ❗️
به ویژه ارتقا یافت 💢",
'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[
['text'=>"پنل مدیریت💒"],
],
]
])
]);
 lhoseinfardl('sendmessage',[
'chat_id'=>$text,
'text'=>"حساب شما توسط مدیر ربات در بخش #دستی ویژه شد🌙"
]);
$lhoseinfardl["vipacc"] = "$vipacc" + 1 ;
$sabts = json_encode($lhoseinfardl,true);
file_put_contents("admin/settings.json",$sabts);
}
/////////////////////////
elseif($text == "تحلیل ارز ها 🔐"){
$user['step'] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson); 
if($hoseinfd == "vip") {
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"در کلوب مکتب متاورس 📖
 در این قسمت تحلیل های تکنیکالی و فاندامنتالی vip  قرار میگیرد که صرفا اطلاعات و دیدگاه عالی به شما خواهد داد
———————-
ارز های ریسک گریز به ترتیب به ارزهای بزرگ تر و با نواسان کمتر میگویند
ارز هایی که تکان های کمتری را روزانه متحمل میشوند و مناسب سرمایه های بزرگ هستند 
———————-
ارز های ریسک پذیر به ارز هایی با نواسان بیشتر میگویند که تغییرات درصدی روزانه آنها بیشتر است 
",   
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"ارز های ریسک پذیر"]],
[['text'=>"ارزهای ریسک گریز"]],
]
])
]);
}else{
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"این بخش برای کاربران vip فعال می باشد 📭",   
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"خانه🏢"]],
[['text'=>"دریافت اشتراک 💡"]],
]
])
]);
}
}
//////////////////////

elseif($text == "آموزش صفر تا صد 🗂"){
$user["step"] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
lhoseinfardl('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"در حال به روز رسانی ...
(📚 هر آنچه برای تبدیل شدن به یک حرفه ای در این رشته نیاز دارید
در این قسمت خواهد بود ...)",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"خانه🏢"]],
]
])
 ]); 
}
elseif($text == "اطلاع رسانی 📬"){
$user["step"] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
lhoseinfardl('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"اطلاع رسانی های مهم و قابل توجه در این قسمت قرار میگیرند ...🔗",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"خانه🏢"]],
]
])
 ]); 
}
elseif($text == "ارز های متاورسی 💡"){
$user["step"] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
lhoseinfardl('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"در این قسمت 9 پروژه برتر رمز ارزهای متاورس Metaverse که باید بشناسید را بررسی خواهیم کرد. بازار همچنان به طور مداوم در حال حرکت است و منجر به پیدایش بسیاری از ارز های متاورسی جدید می‌شود. رمز ارزهای متاورس هم یکی از عناصری است که مانند NFT ها و میم کوین ها MEMES سرمایه گذاران را به بازار کریپتو جذب کرده است.💡📭

این قسمت صرفا جهت معرفی،پروژه‌های فعال در حوزه ارزهای دیجیتال می باشد.
و به هیچ وجه پیشنهاد سرمایه‌گذاری یا مورد تایید بودن پروژه توسط تیم مکتب متاورس نمی باشد. بدیهی است که مسئولیت سرمایه‌گذاری، خرید و فروش هر پروژه تماما برعهده شخص سرمایه گذار می باشد و تیم آموزشی مکتب متاورس تنها به‌عنوان مرجعی جهت نمایش اطلاعات قیمتی و اخبار پیرامون این پروژه‌‌ها عمل می‌کند.",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"Sandbox (SAND)  🔭"]],
[['text'=>"Axie Infinity (AXS) 🔭"],['text'=>"Decentraland (MANA) 🔭"]],
[['text'=>"Enjin Coin (ENJ) 🔭"],['text'=>"WAX (WAXP) 🔭"]],
[['text'=>"Star Atlas (ATLAS) 🔭"],['text'=>"Bloktopia (BLOCK) 🔭"]],
[['text'=>"Theta (THETA) 🔭"],['text'=>"Aavegotchi (GHST) 🔭"]],
[['text'=>"خانه🏢"]],
]
])
 ]); 
}
elseif($text == "Sandbox (SAND)  🔭"){
$user["step"] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
lhoseinfardl('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"سند باکس یک پلتفرم مجازی مبتنی بر اتریوم است که در سال 2012 ایجاد شد‌.🗂
 توکن بومی آن یعنی sand از جمله موفق ترین رمز ارزهای متاورس در عملکرد بوده است. سند باکس به عنوان یک پلتفرم بازی، فرصت‌هایی را برای گیمرها و سرمایه گذاران فراهم می‌کند تا در بازی و تجارت شرکت کنند. این پلتفرم در یک اکوسیستم طراحی شده است و به هر کسی اجازه می‌دهد کالاهای دیجیتالی را ایجاد کند، به اشتراک بگذارد و یا مبادله کند. بسیاری از این دارایی‌ها مجموعه بازی‌های آنلاین هستند. یک بازیکن می‌تواند از یک شخصیت در بسیاری از بازی‌ها استفاده کند. برای بازی فقط به دو آواتار و زمین نیاز دارید. محبوبیت آن از این واقعیت ناشی می‌شود که به بازیکنان اجازه می‌دهد از راه‌های مختلفی درآمد کسب کنند",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"آشنایی با اصطلاح سندباکس"],['text'=>"بنیان گذاران ارز دیجیتال sand چه کسانی هستند؟"]],
[['text'=>"دنیای ارز دیجیتال سندباکس چگونه است؟"],['text'=>"مزایای ارز دیجیتال سندباکس چیست؟"]],
[['text'=>"آشنایی با توکن‌های سندباکس"],['text'=>"نقش توکن سندباکس(TBS) در بلاک چین"]],
[['text'=>"کیف پول ارز سندباکس"],['text'=>"امنیت ارز سندباکس"]],
[['text'=>"خانه🏢"]],
]
])
 ]); 
}
elseif($text == "Axie Infinity (AXS) 🔭"){
$user["step"] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
lhoseinfardl('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"اگر جزو فعالان بازار ارزهای دیجیتال باشید، بدون شک رشد ارز دیجیتال AXS در طی یک سال گذشته توجه شما را به سمت خود جلب کرده است. اما بسیاری از افراد به‌خوبی با این ارز دیجیتال و البته نقاط ضعف و قوت آن آشنایی ندارند. همین مورد سبب می‌شود تا در زمان خرید دچار سردرگمی‌های مختلفی شوند.",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"معرفی ارز دیجیتال Axie Infinity"],['text'=>"معرفی بازی Axie Infinity"]],
[['text'=>"تاریخچه بازی Axie Infinity"],['text'=>"بنیان‌گذاران و تیم اکسی اینفینتی"]],
[['text'=>"نحوه عملکرد شبکه ارز دیجیتال اکسی اینفینیتی"],['text'=>"ویژگی‌های ارز دیجیتال AXS"]],
[['text'=>"توکن SLP"],['text'=>"توکن AXS"]],
[['text'=>"خرید ارز دیجیتال Axie Infinity"],['text'=>"کیف پول‌های ارز Axie Infinity"],['text'=>"آینده ارز دیجیتال AXS"]],
[['text'=>"سؤالات متداول"]],
[['text'=>"جمع‌بندی"]],
[['text'=>"خانه🏢"]],
]
])
 ]); 
}
/////////////////
elseif($text == "Decentraland (MANA) 🔭"){
$user["step"] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
lhoseinfardl('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"ارز دیجیتال Mana  یکی از جالبترین مفاهیم بلاکچین است که تا الان با آن روبرو شده‌ایم.

آنها در حال ایجاد یک دنیای واقعیت مجازی هستند، جایی که شما می‌توانید محتوای خود را در متون متنی آنها دنبال کنید؛ اما هنوز تعداد زیادی علامت سوال در مورد این پروژه وجود دارد؛ بنابراین در این بررسی سکه، مزایا، معایب و سوالات متداول برتر در مورد Decentraland را بررسی خواهیم کرد.",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"Decentraland چیست؟"],['text'=>"Decentraland چگونه عمل می‌کند؟"]],
[['text'=>"آیا Decentraland هنوز کارآیی دارد؟"],['text'=>"ecentraland چگونه با بازی‌های جهانی مجازی گره می‌خورد؟"]],
[['text'=>"موارد استفاده از Decentraland کدامند؟"],['text'=>"فرصت‌های کشف نشده"]],
[['text'=>"توکن SLP"],['text'=>"توکن AXS"]],
[['text'=>"هزینه زمین در Decentraland چقدر است؟"]],
[['text'=>"آیا مانا ارز دیجیتال خوبی برای سرمایه‌گذاری است؟"],['text'=>"آیا Decentraland کلاهبرداری است؟"]],
[['text'=>"جمع‌بندی"]],
[['text'=>"خانه🏢"]],
]
])
 ]); 
}
/////////////////
elseif($text == "Enjin Coin (ENJ) 🔭"){
$user["step"] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
lhoseinfardl('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"انجین کوین Enjin در کل دارای 1000،000،000،000 توکن ENJ است. اوج قیمت آن مربوط می‌شود به تاریخ 7 ژانویه 2018 که به 0.493384 دلار رسید. ENJ یک توکن ERC-20 بر روی بلاکچین Ethereum است و از قراردادهای هوشمند ERC-1155 نیز پشتیبانی می‌کند.

نمایشگاه بین المللی انجین کوین از جولای تا نوامبر 2017 برقرار بود و ارزش تقریبی 22 میلیون دلار ETH را به خود اختصاص داد که در این نمایشگاه تقریباً 80 درصد از کل توکن عرضه شده فروخته شده است و 20 درصد باقیمانده نیز بین تیم موسس، شرکت و سرمایه گذاران تقسیم شده است. هنگامی که این پروژه با فروش توکن خصوصی ترکیب شد، تقریباً 35 میلیون دلار سود به دست آورد.",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"معرفی تاریخچه پروژه انجین و ارز دیجیتال ENJ"],['text'=>"پلتفرم گیمینگ انجین چگونه کار می‌کند؟"]],
[['text'=>"اکوسیستم شبکه ارز دیجیتال انجین"],['text'=>"ارز دیجیتال انجین کوین (ENJ) چیست؟"]],
[['text'=>"الگوریتم اجماع و استخراج رمز ارز انجین کوین"],['text'=>"کاربردهای ارز دیجیتال ENJ"]],
[['text'=>"کیف پول های ارز دیجیتال انجین کوین"],['text'=>"همکاری‌های پلتفرم ارز دیجیتال انجین کوین"]],
[['text'=>"کدام بازی‌ها از ارز دیجیتال ENJ استفاده می‌کنند؟"]],
[['text'=>"اسپیس میسفیتس (Space Misfits)"],['text'=>"9 لایوز آرنا (9Lives Arena)"],['text'=>"6 اژدها (The 6 Dragons)"],['text'=>"جنگ کریپتا (War of Crypta)"],['text'=>"نستیبلز (Nestables)"]],
[['text'=>"همکاری‌های پلتفرم ارز دیجیتال انجین کوین"]],
[['text'=>"همکاری انجین با سامسونگ"],['text'=>"همکاری انجین با مایکروسافت"],['text'=>"وورد انجین به حوزه دیفای"],['text'=>"همکاری انجین با BMW"]],
[['text'=>"معرفی تاریخچه پروژه انجین و ارز دیجیتال ENJ"]],
[['text'=>"خانه🏢"]],
]
])
 ]); 
}
/////////////////
elseif($text == "WAX (WAXP) 🔭"){
$user["step"] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
lhoseinfardl('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"ارز دیجیتال وکس مخفف Worldwide Asset eXchange است که ارائه دهنده خدمات الکترونیکی پیشرو است. این ارز دیجیتال در نوامبر 2019، به وسیله مدیوس خریداری شد. 

مدیوس به سازمان‌ها کمک می‌کند که با ایجاد کارایی‌ بیشتر در فرصت‌ها صرفه جویی کرده و با صرفه‌جویی‌های بیشتر در هزینه و کنترل مالی بیشتر، تجارت خود را پیش ببرند.

فعالیت تیم مدیوس و دیجیتال وکس در واقع کاملا مکمل یکدیگر بوده و از نظر تاریخ، فرهنگ و شایستگی با یکدیگر مشابه هستند. تیم تشکیل دهنده این نوع شرکت متشکل از 350 کارمند در سراسر آمریکای شمالی، انگلیس، نوردیک، بنلوکس، لهستان و استرالیا است که سالانه بیش از 100 میلیارد دلار از طریق همین سیستم عامل پردازش می‌کنند. 

ترکیب مدیوس و واکس دیجیتال در سطوح مختلف بسیار مشهود بوده و جیسون بوش، مدیر عامل Azul Partners و Spend Matters، هر دو سازمان از نرخ رضایت مشتری بالایی برخوردار هستند؛ چرا که از استراتژی‌های سازگار بر روی فناوری مایکروسافت استفاده می‌کند.

در حال حاضر بیش از 3500 مشتری و 450000 کاربر منحصر به فرد در سراسر جهان، از راه حل‌های مدیریت هزینه مدیوس استفاده می‌کنند و از این طریق معاملات باارزش بیش از 150 میلیارد دلار  را سالانه مدیریت می‌کنند.

وکس یک بلاکچین و یک رمز پروتکل هدفمند بوده که برای ایجاد سریعتر، آسانتر و ایمن کردن معاملات تجارت الکترونیکی برای تمامی کاربران طراحی شده است. وکس بلاکچین از Delegated Proof of Stake، به عنوان سازو کار اجماع خود استفاده می‌کند؛ در واقع ارز دیجیتال برای بهینه‌سازی قابلیت استفاده بلاکچین در تجارت الکترونیکی اصناف طراحی شده است.

در حال حاضر وکس مجموعه‌ای از ابزراهای مبتنی بر بلاکچین طراحی کرده است که براساس آنها پلت فرم منبع باز، بازارها و توکن‌های غیر قابل شارژ بومی یا همان NFT  ساخته شده است. 

این ابزارها خدماتی برای پشتیبانی از تجارت الکترونیکی را شامل می‌شود  که از جمله آنها می‌توان به WAX ، SSO و OAUTH اشاره کرد.

گزارش‌هایی که از عملکرد این نوع ارز دیجیتال ارائه شده است، نشان دهنده سرعت بلاکچین با 500 بار بارگیری در میلی ثانیه است  که این میزان هزینه کمتری را برای مشتریان به همراه دارد. 

در معامله اولیه NFT در بلاکچین وکس، طی چند ساعت و در بعضی از موارد در چند دقیقه به فروش می‌رسد. حجم معاملات ثانویه WAX NFT نیز به اندازه فروش اولیه چشمگیر است؛ به گونه‌ای که حجم معاملات ثانویه NFT به طور میانگین 5 برابر بیشتر از حجم فروش اولیه به صورت سالانه است.",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"شرکای وکس چه کسانی هستند؟"],['text'=>"طراحی جدید توکنومیک وکس"]],
[['text'=>"برخی ویژگی های پلتفرم یا صرافی WAX "],['text'=>"جمع بندی WAX"]],
[['text'=>"۱. هدف پروژه وکس چیست؟"]],
[['text'=>"۲. ویژگی‌ های ارز وکس چیست؟"]],
[['text'=>"۳. بهترین کیف پول ارز وکس چیست؟"]],
[['text'=>"۴. کدام کیف پول برای نگهداری ارز وکس مناسب است؟"]],
[['text'=>"۵. بزرگ‌ ترین مزیت وکس چیست؟"]],
[['text'=>"۶. مشکل ارز وکس چیست؟"]],
[['text'=>"۷. آیا آینده وکس درخشان خواهد بود؟"]],
[['text'=>"خانه🏢"]],
]
])
 ]); 
}

elseif($text == "Star Atlas (ATLAS) 🔭"){
$user["step"] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
lhoseinfardl('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"استار اطلس یک بازی ویدیویی مبتنی بر بلاک چین، کاوش در فضا و استراتژی محور است که روی بلاک چین سولانا (Solana) ساخته شده است. متاورس پنهاور چند نفره Star Atlas در آینده دور در سال 2,620 اتفاق می‌افتد. بازیکنان با استفاده از توکن ارز دیجیتال ATLAS قادر به خرید و فروش دارایی‌های درون بازی جهت استخراج منابع، خرید تجهیزات و مبارزه در سناریوهای مختلف در فضا هستند. ارز دیجیتال دیگری به نام POLIS توکن حاکمیتی بازی استار اطلس محسوب می‌شود و قابلیت کنترل هر دوی فعالیت‌های درون بازی و تغییرات در پارامترهای این متاورس رمز ارزی را به بازیکنان می‌دهد.

توکن‌های NFT قرار است تاثیر عظیمی بر صنعت گیمینگ و بازی بگذارند. این فناوری بدیع قادر به تحول پتانسیل اقتصادی صنعت بازی‌های ویدیویی آنلاین است. با ترکیب توکن‌های غیر قابل تعویض با صنعت بازی از طریق مفهوم متاورس، شاهد تکاملی حیرت‌آور در دنیا خواهیم بود.

استار اطلس یکی از این پروژه‌هاست که سرعت تحول نسل بعدی صنعت گیمینگ را تعیین می‌کند. بازی Star Atlas با اقتصاد توکن دوگانه خود، در حال ساخت یک تجربه بازی مجازی در آینده دور دست است. بازیکنان استار اطلس به دنبال جواهرات مبتنی بر NFT، قابلیت سفر در خلاء گسترده فضا را دارند. این بازی برای خلق تجربه متاورس، مکانیک بلاک چین را با آیتم‌های مبتنی بر توکن‌های غیرمثلی و یک فناوری گرافیکی منحصربه‌فرد ترکیب می‌کند.",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"بازی رمز ارزی استار اطلس چیست؟"],['text'=>"بازی ارز دیجیتال Star Atlas چگونه کار می‌کند؟"]],
[['text'=>"مکانیک‌های اصلی بازی"],['text'=>"مکانیک‌های بلاک چین و مودهای بازی استار اطلس"]],
[['text'=>"توکن های ارز دیجیتال بازی استار اطلس"]],
[['text'=>"ارز دیجیتال ATLAS چیست؟"]],
[['text'=>"توکن POLIS چیست؟"]],
[['text'=>"کیف پول های استار اطلس"],['text'=>"نابودی دارایی و مکانیک ضد تورمی ارز دیجیتال استار اطلس"]],
[['text'=>"خانه🏢"]],
]
])
 ]); 
}
elseif($text == "Bloktopia (BLOCK) 🔭"){
$user["step"] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
lhoseinfardl('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"بلاک توپیا Bloktopia یک پروژه متاورس و دارای ارز دیجیتال BLOK است که در این مطلب، کیف پول ها و صرافی های بازی بلاکتوپیا را بررسی می‌کنیم.


پلتفرم بلاک چینی الروند (Elrond) اخیرا همکاری خود با پروژه و بازی بلاک توپیا (Bloktopia) و ارز دیجیتال Blok را اعلام کرد و به جمع تازه‌ترین کسب و کارهای رمز ارزی در حوزه متاورس تبدیل شد. حتی شرکت فیسبوک هم با تغییر برند خود به متا (Meta)، با در آغوش گرفتن متاورس ادعا کرد که این فناوری جدید به برقراری بهتر ارتباط میان افراد و رشد کسب و کارها کمک می‌کند.

تا همین چند سال پیش، کافی بود یک کسب و کار خود را مبتنی بر بلاک چین اعلام کند تا نوآور و آینده‌گرا تلقی شود. امروزه، این صنعت مملو از پلتفرم‌هایی مقیاس پذیر، سریع، امن و توسعه‌دهنده پسند است. بنابراین کسب و کارها باید راهی جدید برای پیروزی در این رقابت پیدا کنند.

همکاری‌های میان‌رشته‌ای قادر به ایجاد تفاوت و ساخت موارد خلاقانه هستند. مثلا، زمانی که پروژه‌های بلاک چینی در گذشته نزدیک با اینترنت اشیاء (IoT) آشنا شدند، همیشه مورد استقبال سرمایه‌گذاران، کارآفرینان و کاربران بوده‌اند. به همین خاطر، ویژگی‌های جدید باید برای جوامع مفید باشند و بتوان آن‌ها را با ایده‌های بدیع برای رقابت و شکوفایی کسب و کارها پذیرفت یا آزمایش کرد.",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"متاورس رمز ارزی بلاک توپیا چیست؟"],['text'=>"همکاری الروند با متاورس ارز دیجیتال بلاک توپیا"]],
[['text'=>"چه کسانی از بلاکتوپیا بازدید خواهند کرد؟"]],
[['text'=>"یادگیری، کسب درآمد، بازی و خلق؛ چهار ستون متاورس رمز ارزی بلاک توپیا"]],
[['text'=>"از کجا و کدام صرافی ارز دیجیتال بلاک توپیا بخریم؟"]],
[['text'=>"خانه🏢"]],
]
])
 ]); 
}
elseif($text == "Theta (THETA) 🔭"){
$user["step"] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
lhoseinfardl('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"اغلب پروژه‌های بلاکچین روی ذخیره داده‌ها تمرکز کرده‌اند اما پلتفرم‌های پخش ویدئوی آنلاین مانند NetFlix و Hulu به چیزی بیشتر از فضای ذخیره‌سازی نیاز دارند. سرعت انتقال و پهنای باند برای این گونه خدمات حیاتی هستند؛ زیرا که 140 میلیون نفر به طور همزمان به هزاران فایل دسترسی داشته که می‌توانند سرور را تحت فشار قرار دهند. کیفیت فیلم 4K به سرعتی در حدود 48 مگابیت بر ثانیه نیاز داشته و فایل‌های VR با کیفیت 16K به سرعت 768 مگابیت بر ثانیه نیازمند هستند. 

ظهور پلتفرم‌های پخش مستقیم ویدئو تقریبا همزمان با توسعه فناوری بلاکچین همراه بود؛ از این رو علاقه‌مندان به حوزه ارزهای دیجیتال در بنیاد Theta تصمیم گرفتند که این دو فناوری را با هم ادغام نموده و از این رو پلتفرم جدیدی به نام theta خلق نمودند. با نظر به این موضوع توسعه دهندگان Theta، یک شبکه استریم ویدئو را بر اساس بلاکچین اختصاصی Theta توسعه دادند؛ در حالی که شبکه پخش ویدئو به استریم ویدیو‌های غیرمتمرکز اختصاص داده شده؛ اما بلاکچین Theta نیز محیطی برای استفاده از توکن THETA این پلتفرم فراهم کرده است. 

پلتفرم theta با استفاده از فناوری داده‌های توزیع شده، امکان ارائه محتوا بر روی پهنای باند بزرگ را فراهم می‌نماید. شبکه اصلی این پلتفرم، هم اکنون از منابعی مانند Silver TV، Samsung VR و MBN که بزرگترین رسانه خبری جمهوری کره است، پشتیبانی می‌کند. در واقع تیم بنیانگذار Theta عهده‌دار شبکه Silver TV نیز بوده و امیدوار است که صنعت استریم ویدئو را متحول نماید.",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"رسالت theta"],['text'=>"نقشه راه Theta"]],
[['text'=>"استخراج، معامله و سرمایه‌گذاری بر روی Theta"],['text'=>"آینده Theta و نظر کارشناسان"]],
[['text'=>"مزایای Theta"]],
[['text'=>"معایب Theta"]],
[['text'=>"خانه🏢"]],
]
])
 ]); 
}
elseif($text == "Aavegotchi (GHST) 🔭"){
$user["step"] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
lhoseinfardl('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"در این مطلب به معرفی ارز دیجیتال آوه گوچی (GHST) و بررسی آینده ارز دیجیتال آوه گوچی (GHST) می پردازیم. دایکو، به معنای فروش توکنی است که در پلتفرم دائو موجود است. این بدان معنی است که بودجه جمع آوری شده توسط اعضای خود جامعه، مدیریت شده و اعضا برای حاکمیت آن نظر سنجی می‌کنند. آوه گوچی یکی از انواع این پلتفرم‌ها است. این پلتفرم پروژه‌ای است که با استفاده از قابلیت دیفای، ارزهای دیجیتال را جمع آوری می‌کند و البته به کاربران امکان می‌دهد که ارزهای اختصاصی این پلتفرم را برای استفاده از تجربیات دیفای، جمع‌آوری و ترکیب کنند.

بودجه‌‌ی اولیه‌ی پروژه از طریق سود فروش اولیه تامین گردید. ابن بودجه بیشتر برای کلکسیون‌های ارز اختصاصی این پلتفرم قابل استفاده خواهد بود. ارز اختصاصی این پلتفرم پس از مدتی سوزانده می‌شود. این ارز درآمد بیشتر حاصل از فروش محصولات هنری است که از فروش بازی‌های کوچک جمع آوری می‌شود",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"ویژگی‌های ارز دیجیتال آوه گوچی (GHST) چیست؟"],['text'=>"ارز دیجیتال آوه گوچی (GHST) چگونه عمل می‌کند؟"]],
[['text'=>"آینده ارز دیجیتال آوه گوچی (GHST)"],['text'=>"کلام آخر گوچی"]],
[['text'=>"خانه🏢"]],
]
])
 ]); 
}
///////////////////////
elseif($text == "متاورس چیست 📩"){
$user["step"] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
lhoseinfardl('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"پس از انتشار اخبار تغییر نام فیس‌بوک به «مِتا» (Meta) و صحبت‌های مدیرعامل این شرکت مبنی بر تبدیل‌شدن اکوسیستم فیس‌بوک به یک دنیای مجازی یا همان متاورس (Metaverse)، حالا این سؤال، ذهن بسیاری از کاربران اینترنت را به خود مشغول کرده است که: متاورس چیست؟ کاربرد آن چیست؟ اصلاً این واژه از کجا سر در آورده و فناوری این‌بار چگونه می‌خواهد غافلگیرمان کند؟

اصطلاح متاورس، اولین بار در سال ۱۹۹۲ توسط نیل استفنسون (Neal Stephenson)، نویسنده رمان‌های علمی- تخیلی ابداع و در رمان «تصادف در برف» (Snow Crash)  به کار برده شد. متاورس تصویری از یک دنیای مجازی‌ است که در دل دنیای حقیقی وجود دارد. آنچه استفنسون ربع قرن پیش از تخیل خود آفرید، حالا عاشقان فناوری را به هیجان آورده است. او در بخشی از کتاب خود می‌نویسد:

هنگامی که ۱۰ سال پیش، هیرو نخستین بار این مکان را دید، نرم‌افزار مونوریل هنوز نوشته نشده بود. او و دوستانش برای این که بتوانند به جاهای مختلف بروند، مجبور بودند نرم‌‌افزار اتومبیل و موتورسیکلت بنویسند. آنها نرم‌‌افزارهای خود را بیرون می‌‌بردند و در بیابان سیاهی در شبِ الکترونیکی، با هم مسابقه می‌‌دادند.

حالا گویی دنیا به سمت‌و‌سویی می‌رود که تحقق متاورسِ موردنظر نیل استفنسون، برای اولین بار در تاریخ ممکن می‌شود. مردم بدون ترک‌کردن خانه‌هایشان می‌توانند به هرکجای جهان که می‌خواهند سفر کنند و از تجربه کاملاً بصری و حتی لمسی لذت ببرند. آن‎ها خواهند توانست از طریق تصاویر ارتباط برقرار کرده و در آن فضا دست به خریدوفروش بزنند. آن‎ها همچنین به بازی‌ها، فیلم‌ها، ورزش‌ها، رویدادهای جدید و گونه‌های جدیدی از روایت‌ها دست خواهند یافت؛ بر فراز کوه‌های آلپ از پاراگلایدر آویزان می‌شوند، به ماه پرواز می‌کنند و به‌سرعت به سوی زندگی در جهان دیجیتال حرکت می‌کنند.",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"متاورس چیست؟"],['text'=>"فیس‌بوک و متاورس"]],
[['text'=>"کاربردهای متاورس"],['text'=>"پروژه‌های مشهور متاورس"]],
[['text'=>"سؤالات متداول متاورس"],['text'=>"جمع‌بندی متاورس"]],
[['text'=>"خانه🏢"]],
]
])
 ]); 
}
elseif($text == "کاربردهای متاورس"){
$user["step"] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
lhoseinfardl('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"همان طور که گفتیم، متاورس دنیایی مجازی است که کاربران می‌توانند در آن هر کاری که می‌خواهند انجام دهند. تا حدی می‌توان گفت که توسعه یک متاورس کامل، کار ما را در بسیاری از حوزه‌ها راحت‌تر می‌کند و حتی می‌تواند خیلی از روزمرگی‌های ما را به جهانی مجازی منتقل کند.",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"ملاقات‌های مجازی و قرارهای کاری"],['text'=>"آموزش مجازی"]],
[['text'=>"کسب درآمد از بازی‌کردن"],['text'=>"خرید آنلاین"]],
[['text'=>"گردشگری و سفر"],['text'=>"کنسرت و جشن‌ها"]],
[['text'=>"مالکیت دیجیتال"],['text'=>"تفریح"]],
[['text'=>"اقتصاد"],['text'=>"عادت‌ها و هنجارهای زندگی"]],
[['text'=>"خانه🏢"]],
]
])
 ]); 
}
elseif($text == "پروژه‌های مشهور متاورس"){
$user["step"] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
lhoseinfardl('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"در ادامه برخی از پروژه‌های بلاک چینی و غیربلاک چینی حوزه متاورس و جهان‌های مجازی را بررسی می‌کنیم.",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"پراجکت کامبریا"],['text'=>"دیسنترالند"]],
[['text'=>"اکسی اینفینیتی"],['text'=>"سندباکس"]],
[['text'=>"خانه🏢"]],
]
])
 ]); 
}
//////////////////
elseif($text == "اصطلاحات و دانستنی 📋"){
$user["step"] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
lhoseinfardl('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📚 مقاله هایی برای داشتن علم و اطلاعات بیشتر در این رشته",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"کریپتوپانکس (CryptoPunks) چیست؟"],['text'=>"دیفای (DeFi) یا امور مالی غیرمتمرکز چیست؟"]],
[['text'=>"توکن چیست و چه تفاوتی با کوین دارد؟"]],
[['text'=>"خانه🏢"]],
]
])
 ]); 
}
//////////////////
elseif($text=="آشنایی با اصطلاح سندباکس"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"در کشورهای خارجی یک مکان شنی برای بازی بچه‌ها در نظر گرفته می‌شود که SANDBOX نام دارد. در دهه اخیر از این واژه در تکنولوژی و تجارت هم استفاده زیادی شده است. منظور از سندباکس محیطی بسته و امن است که پروژه‌های نرم‌افزاری تحت وب اجرا می‌شود بدون این که به سیستم برنامه‌نویس و یا توسعه دهنده آسیبی برساند؛ علاوه بر این، اجرای برنامه نوشته شده بر دیگر برنامه‌های در حال اجرا اثر نمی‌گذارد. در امنیت اطلاعات سندباکس جایی است که برنامه‌ها و یا کدهای مشکوک به بدافزار قبل از این که به صورت عمومی عرضه شوند، تست می‌شوند تا آسیبی به سیستم نرسانند. در حوزه مالی بررسی مدل‌های جدید کسب و کار انجام می‌گیرد؛ در واقع تست فروش محصولات و یا خدمات در مدل‌های تجاری قبل از بازار واقعی با کمک سندباکس انجام می‌شود تا در زمان و هزینه صرفه جویی شود.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text == 'کریپتوپانکس (CryptoPunks) چیست؟'){ 
 lhoseinfardl('sendphoto',[ 
 'chat_id'=>$chat_id, 
 'photo'=> "https://maktabmetaverse.vhbot.xyz/meta/photo/CryptoPunks.jpg",
 'caption'=>"
 کریپتوپانکس 🔭
",
   ]); 
lhoseinfardl('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"کریپتوپانکس را شاید بتوان یکی از معروف‌ترین پروژه‌های حوزه توکن‌های غیرمثلی یا همان NFTها دانست. در نگاه اول، این چهره‌های پیکسلی در مربع‌های کوچک چندان خاص به نظر نمی‌رسند؛ اما وقتی صحبت از توکن‌های غیرمثلی به میان می‌آید، ظاهر سادهٔ آنها می‌تواند فریبنده باشد. شما با داشتن تنها یکی از این توکن‌های به‌ظاهر خنده‌دار، ممکن است صاحب یک خانه کوچک یا یک عمارت بزرگ شوید.

شاید از خود بپرسید که چطور ممکن است یک کاراکتر پیکسلی مرا ثروتمند کند؟ باید بدانید که در حوزهٔ توکن‌های غیرمثلی هیچ چیز عجیبی وجود ندارد. در اوایل راه‌اندازی پروژه کریپتوپانکس، توکن‌های این پروژه به‌صورت رایگان توزیع شدند؛ اما اکنون با قیمتی بیش از ۲۰۰ هزار دلار به فروش می‌رسند.

کریپتوپانکس مجموعه‌ای از توکن‌های غیرمثلی است که هرکدام از آنها ویژگی‌ها و گونه‌های متفاوتی دارند. در مجموع ۱۰,۰۰۰ توکن کریپتوپانکس تولید شده است که هیچ‌یک از آنها یکسان نیستند. شما می‌توانید کریپتوپانکس را در وب‌سایت اصلی این پروژه مشاهده کنید.

در این مقاله توضیح می‌دهیم که کریپتوپانکس چیست، چگونه کار می‌کند و سازندگان این پروژه چه کسانی هستند. همچنین علت محبوبیت این پروژه را هم بررسی می‌کنیم و نحوه خرید توکن‌های کریپتوپانکس را آموزش می‌دهیم. سپس برخی از گران‌ترین و ارزان‌ترین توکن‌های این پروژه را معرفی و بررسی می‌کنیم که چه عواملی باعث ارزشمندشدن این توکن‌ها می‌شوند. با ما همراه باشید.",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"کریپتوپانکس چیست؟"],['text'=>"کریپتوپانکس چگونه کار می‌کند؟"]],
[['text'=>"سازندگان کریپتوپانکس"],['text'=>"چرا کریپتوپانکس تا این حد محبوب است؟"]],
[['text'=>"جمع‌بندی کریپتوپانکس"],['text'=>"سؤالات متداول کریپتوپانکس"]],
[['text'=>"خانه🏢"]],
]
])
 ]); 
}
///////////
elseif($text == 'دیفای (DeFi) یا امور مالی غیرمتمرکز چیست؟'){ 
lhoseinfardl('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"دیفای (DeFi) مخفف عبارت امور مالی غیرمتمرکز است که به طور کلی به قراردادهای هوشمند مالی و دارایی های دیجیتال، پروتکل ها و برنامه های غیرمتمرکز (DApps) ساخته شده در اتریوم مربوط می شود. به عبارت ساده تر، دیفای نرم افزار مالی است که بر روی بلاک چین ساخته شده و می تواند با هم ترکیب شود.

رایانه ها در طول سال های اخیر تقریباً تمام صنایع را دچار دگرگونی کرده اند. هر نوآوری بر پایه تغییر قبلی ایجاد شده و محصولات دیجیتال و خدمات پیشرفته تری ارائه می شود. از طریق فناوری، ما جهانی را متناسب با نیازهای خود برآورده می سازیم. اکنون برنامه ها بر بسیاری از جنبه های زندگی روزمره تأثیر می گذارند. پس چرا پول این طور نباشد؟",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"امور مالی غیرمتمرکز چیست ؟"],['text'=>"برنامه های دیفای چگونه اجرا می شوند؟"]],
[['text'=>"کاربردهای دیفای"],['text'=>"صرافی غیرمتمرکز"]],
[['text'=>"تفاوت برنامه های غیرمتمرکز دیفای با بانک های سنتی"],['text'=>"آینده دیفای چگونه است؟"]],
[['text'=>"خانه🏢"]],
]
])
 ]); 
}
elseif($text == 'توکن چیست و چه تفاوتی با کوین دارد؟'){ 
lhoseinfardl('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"توکن ارز دیجیتالی است که خودش بلاک چین مستقل ندارد. اگر این تعریف برای شما نامفهوم است، نگران نباشید و این مقاله را تا پایان دنبال کنید. در این مقاله ابتدا با بیانی کاملاً ساده توضیح می‌دهیم که تفاوت کوین و توکن در بازار ارزهای دیجیتال چیست و سپس مزیت‌های ایجاد یک توکن به‌جای بلاک چین اختصاصی را بررسی می‌کنیم. همچنین چگونگی ذخیره‌سازی توکن‌ها در کیف پول‌ها را توضیح داده و در پایان انواع دسته‌بندی توکن‌ها را نام می‌بریم.",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"توکن‌ها چگونه ساخته می‌شوند؟"],['text'=>"چرا توکن؟"]],
[['text'=>"کیف پول‌های توکن‌ها"],['text'=>"انواع توکن"]],
[['text'=>"توکن کاربردی"],['text'=>"توکن اوراق بهادار"]],
[['text'=>"توکن حاکمیتی (گاورننس)"],['text'=>"جمع‌بندی توکن"]],
[['text'=>"خانه🏢"]],
]
])
 ]); 
}
elseif($text == 'sssssss'){ 
lhoseinfardl('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"sssss",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"ssss"],['text'=>"ssss"]],
[['text'=>"ssss"],['text'=>"ssss"]],
[['text'=>"ssss"],['text'=>"ssss"]],
[['text'=>"خانه🏢"]],
]
])
 ]); 
}
elseif($text == 'sssssss'){ 
lhoseinfardl('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"sssss",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"ssss"],['text'=>"ssss"]],
[['text'=>"ssss"],['text'=>"ssss"]],
[['text'=>"ssss"],['text'=>"ssss"]],
[['text'=>"خانه🏢"]],
]
])
 ]); 
}
///////////
elseif($text=="بنیان گذاران ارز دیجیتال sand چه کسانی هستند؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"برای اولین بار ایده ایجاد پیوند بین بازارهای ارز دیجیتال و صنعت گیمینگ در سال 2011 ایجاد شد. دو فرد به نام آرتور مادرید و سباستین بروگت با همکاری یکدیگر، شرکت Pixowl را راه اندازی کردند. هر دو در رشته اقتصاد و سیستم های رایانه ای فارغ التحصیل شده و پس از راه اندازی شرکت، در پروژه های متعددی در صنعت گیمینگ با یکدیگر فعالیت کرده اند. پلتفرم سندباکس نیز حاصل همکاری این دو فرد است که به عنوان یکی از پروژه های زیرمجموعه Pixowl به شمار می آید.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="دنیای ارز دیجیتال سندباکس چگونه است؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"سندباکس یک دنیای مجازی است که بازیکنان در آن می‌توانند تجارب بازی خود را در بلاک چین اتریوم بسازند، مالک آن شوند و از آن کسب درآمد کنند. سندباکس سه قسمت اصلی دارد.

وجود یک نرم‌افزار هنری انیمیشن با نام ویرایشگر سه بعدی voxel برای ساخت دارایی‌های بازی (NFT)
بازاری برای خرید و فروش دارایی‌هایNFT 
ابزاری برای ساخت بازی و ایجاد تجربه‌های بازی در دنیای مجازی سندباکس",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="مزایای ارز دیجیتال سندباکس چیست؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"در حال حاضر صنعت گیمینگ یکی از بزرگترین صنعت های دنیا محسوب می شود که تاکنون حجم نقدینگی بالایی را دارد. در حال حاضر این صنعت محبوبیت بالایی بین مردم دنیا و گروه های سنی جوان دارد. این نکته در اصل چیزی است که در بازارهای ارز دیجیتال مورد نیاز است و آن هم حجم نقدینگی است. گره زدن بازار به محبوب ترین حوزه ها در بین مردم، کمک قابل توجهی به جایگاه بازارهای ارز دیجیتال در اقتصاد می کند. 

وجه تمایز پلتفرم سندباکس با دیگر پلتفرم های ارز دیجیتال، در تلفیق صنعت گیمینگ با ارزهای دیجیتال است. تولید کنندگان پلتفرم بر این باور هستند که با استفاده از این ایده می توانند تغییر بزرگی در صنعت ارز دیجیتال ایجاد کنند. این پلتفرم اجازه تولید محتوای صنعت گیمینگ را به تمام کاربران می دهد تا این قابلیت را داشته باشند که به سهم خود تاثیر بسزایی در تولید بازی داشته باشند. 

تولید ارز دیجیتال سند، نقش بسیار مهمی در تولید حاکمیت غیرمتمرکز در صنعت بازی های ارز دیجیتال دارد. البته توسعه دهندگان پلتفرم ارز دیجیتال سندباکس معتقدند که این ایده می تواند نقش بسیار مهمی در دنیای ارز دیجیتال داشته باشد. این پلتفرم اجازه تولید محتوای صنعت گیمینگ را به تمام کاربران خود می دهد و از این بابت نقش مهمی در شراکت جامعه خود در تولید بازی های گوناگون دارد.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="نقش توکن سندباکس(TBS) در بلاک چین"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"توکن سندباکس(TBS) در پلتفرم های بازی مبتنی بر بلاک چین است که همانند توکن های غیر قابل تفویض(NFT)، در فضای مجازی است. از جمله شرکت های معروفی که در صنعت بازی فعالیت می کنند می توان به پلتفرم های بازی همچون اسکوئر انکیس، مایند فول نس و ترو گلوبال ونچرز اشاره کرد.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="آشنایی با توکن‌های سندباکس"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"توکن‌های غیر قابل تعویض (NFT) توکن‌های مجازی است که برای نواقص دیجیتالی، امنیت و اعتبارسنجی در بلاک چین ضرب می‌شود. این توکن‌ها منحصر به فرد، غیر قابل تقسیم و غیر قابل تعویض هستند و به شما این امکان را می‌دهند که درون بازی، یک دارایی واقعی دیجیتال داشته باشید. به صورت کلی دو توکن ارز دیجیتال سندباکس وجود دارد که در ادامه مورد بررسی قرار می دهیم. 

توکن Sand، توکن اصلی سندباکس بوده که پایه و اساس این ارز دیجیتال ERC-20 است. امکانات اصلی این ارز دیجیتال به این شکل است که به سیستم بازی دسترسی داشته باشند و دارایی ها را خریداری کنند و یا اینکه بفروشند. با استفاده از این توکن می توان به راحتی در مشارکت شرکت داشت و یک درآمد منفعل را ایجاد کرد. 

توکن LAND، نوعی ارز دیجیتال است که مبتنی بر استاندارد ERC-1155 فعالیت می کند. بازیکنان Land، قابلیتی را برای کاربران خود فراهم می کند که بر طبق استاندارد ERC-721 است.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="کیف پول ارز سندباکس"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"یکی از دغدغه های اصلی کاربران ارز دیجیتال سندباکس، روش نگهداری و ذخیره ارز دیجیتال است. در حال حاضر روش های مختلفی برای ذخیره این ارز دیجیتال وجود دارد که از جمله این روش ها می توان به کیف پول سخت افزاری، آنلاین و کیف پول نرم افزاری اشاره کرد. از جمله کیف پول های قابل اعتمادی که می توان برای ذخیره ارز دیجیتال سندباکس استفاده کرد،کیف پول Trust wallet است.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="امنیت ارز سندباکس"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"از آنجایی که ارز دیجیتال سندباکس، همانند دیگر پروژه های ارز دیجیتال، بر روی اتریوم راه اندازی شده است. ارز دیجیتال اتریوم برای تایید تراکنش ها از اثبات سهام استفاده می کند. مکانیزم اثبات سهام و اثبات کار که توسط بلاک چین بیت کوین مورد استفاده قرار می گیرد، منتها چند تفاوت اساسی با یکدیگر دارند که در ادامه مورد بررسی قرار می دهیم.

تایید تراکنش ها در مکانیزم اثبات کار، توسط ماینرها انجام می شود و این در صورتی است که در مکانیزم اثبات سهام، تایید تراکنش ها توسط دارندگان بزرگ ارز دیجیتال انجام می شود. علاوه بر این در بلاک چین بیت کوین برای تایید تراکشن ها، نیاز به برق و توان محاسباتی بسیاری است اما این مساله در بلاک چین اتریوم وجود ندارد. 

همان طور که گفته شد ارز سندباکس، یک توکن استاندارد ERC-20 است که سرمایه گذاران با استفاده از این استاندارد می توانند مزایای بی شماری بدست بیاورند. بلاک چین اتریوم در وضعیت بسیار نامطلوبی قرار دارد و بدین دلیل به هیچ وجه جای نگرانی در ارتباط با امنیت ارز sand وجود ندارد و می توان به راحتی آن را معامله کرد.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
///..............///////
elseif($text=="معرفی ارز دیجیتال Axie Infinity"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"در واقع باید عنوان کنیم که ارز دیجیتال AXS به ارز ویژه بازی اکسی اینفینیتی گفته می‌شود. این ارز در حقیقت پاداش‌ موجود در این بازی است که افراد می‌توانند آن را در بخش‌های مختلف دریافت نمایند. از طرفی دیگر می‌توان به کمک آن فرایندهای مختلف داخل بازی را انجام داد. این قابلیت سبب شده است تا تقاضای زیادی برای این ارز دیجیتال ایجاد شود. 

خود ارز دیجیتال Axis Infinity یک نوع توکن بر روی شبکه اتریوم می‌باشد که از تکنولوژی ERC 20 بهره می‌جوید. این توکن بر روی شبکه اتریوم قرار دارد و لذا امنیت بی‌نظیر و البته کارایی بسیار بالای آن را در خود دارد. همین مورد هم سبب شده تا این ارز از لحاظ فنی بسیار ایده‌آل باشد.

اما باید عنوان کنیم که تا زمانی که به‌خوبی با این بازی آشنا نشوید، نمی‌توانید درک صحیحی از اهمیت این توکن پیدا کنید. از طرفی دیگر این موضوع می‌تواند به‌سادگی دلیل رشد نجومی قیمت آنلاین ارز دیجیتال را برای شما مشخص سازد. لذا ما در ادامه مروری دقیق‌تر بر روی این بازی دیجیتال خواهیم داشت.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="معرفی بازی Axie Infinity"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"بازی اکسی اینفینیتی را می‌توان به‌عنوان یکی از مطرح‌ترین بازی‌های موجود در دنیا قلمداد نمود که در شرایط فعلی رتبه اول بازی‌های بلاک‌چینی دنیا را به خود اختصاص داده است. این بازی نه‌تنها سرگرمی و هیجان را با خود به همراه دارد، بلکه یک درآمد تضمین شده را نیز به کاربرانش می‌دهد. همین مورد هم سبب شده تا بسیاری از مردم در پی این بازی بسیار جذاب و منحصربه‌فرد باشند. 

در واقع بازی اکسی اینفینیتی یک نوع بازی مبتنی بر توکن‌های غیر مثلی NFT می‌باشد. این بازی در بستر شبکه اتریوم توسعه داده شده و از قراردادهای هوشمند آن استفاده می‌کند. خود بازی اکسی اینفینیتی به نحوی الهام گرفته از بازی معروف پوکمون گو می‌باشد.

در این بازی کاربران ابتدا باید شخصیت‌های مختلفی را خریداری نمایند. این شخصیت‌ها توکن‌های غیر قابل معاوضه یا همان NFT هستند. هر یک از این توکن‌ها دارای ویژگی‌های مختص به خود هستند و می‌توانند بر اساس آن، قابلیت‌های ویژه‌ای در حین مبارزه داشته باشند. 

افراد باید حداقل سه شخصیت را خریداری نمایند که حداقل قیمت آنها 200 دلار می‌باشد. بعد از خریداری این شخصیت‌ها می‌بایست به‌وسیله آن‌ها در داخل بازی اکسی در مسابقات شرکت کرد. شما می‌توانید با کاربران مختلف مسابقه داده و در صورت برد مقداری توکن SLP را به‌عنوان جایزه دریافت کنید. این توکن هم از دیگر توکن‌های داخل بازی است که در ادامه به آن می‌پردازیم. افزون بر این موارد شما می‌توانید برای موفقیت در مرحله‌های پیش‌فرض بازی هم به این ارز دسترسی پیدا کنید. 

این مراحل تا حد زیادی ساده است و تمام افراد با هر سطحی می‌توانند روزانه دست‌کم 50 توکن SLP را به دست آورند. اما نکته قابل‌توجه امتیاز یا همان کاپ شما در بازی می‌باشد. به‌طورکلی این بازی دارای فصل یا سیزن های 2 ماهه است. در ابتدای هر فصل کاپ یا امتیاز بازیکنان بر روی رقم 1200 قرار می‌گیرد.
بعد از آن باید کاربران به‌وسیله تیم‌هایشان با یکدیگر مسابقه داده و کاپ خود را افزایش دهند. در پایان هر فصل به 1000 کاپ اول توکن AXS جایزه داده می‌شود
اما نکته اصلی این است که رسیدن به لیست 1000 کاپ اول کار بسیار سختی است و بایستی برای آن شخصیت‌های بسیار گران قیمتی را با قابلیت‌های منحصربه‌فرد خریداری نمود.

از طرفی دیگر باید توانایی شما در بازی‌کردن بسیار بالا باشد تا بتوانید به توکن AXS برسید. همین موضوع هم سبب شده تا این توکن بسیار نایاب شود. این نایاب بودن و البته سختی ماین کردن سبب شده تا قیمت AXS در طی چند سال گذشته روندی کاملاً صعودی به خود بگیرد. 

البته باید عنوان کنیم که فاکتورهای مختلف دیگری هم بوده‌اند که تقاضا برای این توکن را افزایش داده‌اند. برای مثال کاربران برای برید کردن نیاز به توکن AXS دارند. برید کردن به حالتی گفته می‌شود که شما دو تن از شخصیت‌هایتان را با همدیگر جفت می‌کنید تا شخصیت دیگر (همان توکن NFT) را به دنیا بیاورند.

این شخصیت جدید در حقیقت دارای ویژگی‌ها و کارت‌های والدین خود می‌باشد. لذا اگر نژاد والدین آن خالص و قوی باشد، می‌تواند بسیار قدرتمند و البته با ارزش باشد. افزون بر این موارد کاربران برای استیک کردن در داخل شبکه یا داشتن حق رأی، باید توکن AXS داشته باشند.

ترکیب کلی این دو مورد سبب شده تا تقاضای زیادی برای ارز دیجیتال Axie Infinity ایجاد شود. این موضوع در کنار سختی دستیابی به آن سبب شده تا قیمت آن در طی چند سال گذشته همواره صعودی باشد. باید عنوان کنیم که افزایش محبوبیت این بازی در طی چند سال گذشته هم از دیگر فاکتورهایی بوده که این تقاضا را بیشتر کرده است",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="تاریخچه بازی Axie Infinity"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"بازی اکسی اینفینیتی به‌عنوان نخستین بازی بلاک‌چینی دنیا تلقی می‌شود. ایده این بازی در سال 2017 توسط شخصی به نام تورنگ (مدیرعامل فعلی) ارائه شد. این شخص بیش از این تجربه زیادی در دنیای دیجیتال مارکتینگ داشت. اما با دیدن بازی پوکمون گو و البته رشد روزافزون ارزهای دیجیتال در دنیا، تصمیم گرفت تا یک بازی را خلق کند که علاوه بر جذابیت پوکمون گو، درآمدی را هم برای کاربران به دنبال داشته باشد.

به همین جهت بود که او استارتاپ‌های قبلی خود را رها کرد و در سال 2018 بازی اکسی اینفینیتی را به کمک تیم خود ساخت. این پروژه در ابتدا Sky Mavis نام داشت که در واقع اسم استودیوی بازی‌سازی آنان بود. آنها در سال 2020 ارز دیجیتال خود موسوم به AXS را روانه بازار نمودند. جذابیت بازی و البته مدل درآمدی آن توانست در مدت‌زمان اندکی این بازی را به محبوبیت برساند.

به‌گونه‌ای که اکنون بازی اکسی اینفینیتی به‌عنوان رکورددار بازی بلاک‌چینی در دنیا شناخته می‌شود. از طرفی دیگر این بازی طی ماه قبلی توانست به رکورد یک میلیون کاربر فعال روزانه برسد. این در نوع خود یکی از مهم‌ترین مزیت‌هایی بوده که این بازی را بسیار منحصربه‌فرد کرده است.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="بنیان‌گذاران و تیم اکسی اینفینتی"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"ارز دیجیتال Axie Infinity دارای تیم بسیار قدرتمندی است. اعضای این تیم نه‌تنها سابقه درخشانی دارند، بلکه در زمینه کاری خود مهارت‌های بالایی دارند. این در نوع خود به‌عنوان یکی از مهم‌ترین فاکتورهایی قلمداد می‌شود که توانسته این بازی را به موفقیت بالا برساند. ما در ادامه برخی از اعضای کلیدی این تیم را خدمت شما عزیزان بیان کرده‌ایم.

ترونگ تان نگوین TRUNG NGUYEN:

این شخص را می‌توان به‌عنوان بنیان‌گذار اصلی بازی اکسی اینفینیتی دانست. او زمانی که فقط 19 سال داشت استارتاپ lozi را راه‌اندازی نمود. بعداً برای این استارتاپ سرمایه لازم را جذب نمود و توانست آن را به موفقیت برساند.

او اکنون از آن استارتاپ کنار رفته و تمام انرژی خود را صرف بازی اکسی اینفینیتی کرده است. او شخصیت کلیدی و اصلی این بازی به‌حساب می‌آید و تمام تصمیمات و برنامه‌ریزی‌های اصلی توسط او انجام می‌شود.

تو دوان TU DOAN:

آقای تو دوان به‌عنوان شخص دوم در این بازی شناخته می‌شود. او به همراه ترونگ از جمله افرادی بود که شرکت lozi را افتتاح کرد. او در شرکت قبلی هم به‌عنوان یک طراح حرفه‌ای شناخته می‌شود.

از طرفی دیگر او تسلط بسیار بالایی در بازی پوکمون گو داشت و توانست در پرورش ایده این بازی کمک کند. او در حال حاضر وظیفه طراحی شخصیت‌های بازی اکسی اینفینیتی را برعهده داشته و به نحوی مدیر هنری این گروه می‌باشد.

کووی داوو QUY DAU:

این شخص هم از دیگر افراد حرفه‌ای موجود در تیم می‌باشد. او در سال 2016 به مقام اول در مسابقه برنامه‌نویسی کاتیون رسید و در سن 21 سالی هم شرکتی مختص خود را افتتاح کرده بود. او در زمینه برنامه‌نویسی تجربه بالایی دارد. وجود او برای تیم بسیار حیاتی بوده و به همین جهت سمت مهندس نرم‌افزار ارشد را دریافت کرده است.

DUY TRINH:

این شخص هم به‌عنوان یکی از انیماتورهای حرفه‌ای تیم شناخته می‌شود. او قبل از پیوستن به تیم اکسی اینفینیتی برای استودیوی های بازی‌سازی در کالیفرنیا کار می‌کرد و لذا تجربه بالایی در این زمینه دارد.

الکساندر لئونارد لارسن:
این شخص را می‌توان از دیگر اعضای کلیدی اکسی اینفینیتی دانست. او تجربه بسیار بالایی در دنیای بلاک‌چین دارد. از طرفی دیگر او یکی از اعضای اتحادیه بازی‌های بلاک‌چینی می‌باشد. او ارتباط خوبی با بسیاری از تیم‌های توسعه‌دهنده بازی‌های بلاک‌چینی در دنیا دارد. این در نوع خود سبب شده تا رشد این پروژه بسیار بیشتر شود.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="نحوه عملکرد شبکه ارز دیجیتال اکسی اینفینیتی"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"همان گونه که اشاره کردیم، ارز دیجیتال Axie Infinity در حقیقت یک نوع توکن در شبکه ERC20 است. این موضوع سبب شده تا ساختار و عملکرد این ارز تا حدود زیادی شبیه ارزهای موجود بر بستر اتریوم باشد.

البته باید عنوان کنیم که تیم توسعه‌دهنده‌ی ارز دیجیتال اکسی، یک ساید چین جداگانه را بر روی بستر اتریوم ایجاد کرده‌اند که نام آن رونین می‌باشد. این ساید چین برای امور داخلی بازی و البته نقل و انتقالات آن استفاده می‌شود. همین مورد هم سبب شده تا اکسی اینفینیتی به تنها بازی دیفای در دنیا بدل شود که شبکه بلاک‌چین مختص به خود را دارد.

نکته قابل توجه سیاست‌گذاری‌های ویژه این تیم است که تمام بازیکنان را به سمت این بلاک‌چین هدایت می‌کند. در واقع شما بایستی برای خرید شخصیت‌ها یا دریافت جوایز داخل بازی یک کیف پول رونین را ایجاد نمایید. این کیف در حقیقت پل ارتباطی بلاک‌چین اتریوم و بلاک‌چین رونین می‌باشد.

به همین جهت است که افراد می‌توانند از طریق آن یا سایر شبکه‌های دیگر، اتریوم را به آن انتقال داده و نسبت به خریدهای درون بازی اقدام نمایند. از طرفی دیگر این ساید چین در طی یک ماه گذشته از صرافی موجود بر بستر خود رونمایی کرده است.

این صرافی باعث شده تا نقل و انتقالات موجود در داخل شبکه بدون نیاز به کارمزدهای بالای شبکه اتریوم صورت گیرد. این در نوع خود یک مزیت بسیار منحصربه‌فرد برای جذب بازیکنان جدید به‌حساب می‌آید. 

وجود این ساید چین به همراه برنامه‌های غیرمتمرکز بستر آن نظیر صرافی و کیف پول رونین والت سبب شده تا عملکرد ارز دیجیتال AXS بسیار بهینه‌تر و عالی‌تر باشد. به‌گونه‌ای که افراد می‌توانند با سرعت بیشتر و البته هزینه‌های به‌مراتب کمتری نسبت به نقل و انتقالات درون آن اقدام نمایند. این در نوع خود یک مزیت بسیار منحصربه‌فرد می‌باشد.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="ویژگی‌های ارز دیجیتال AXS"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"ارز دیجیتال و پروژه اکسی اینفینیتی به واسطه ساختار خود، ویژگی‌های خاصی دارد که در موفقیت این ارز تأثیر بسزایی داشته است. این فاکتورها باعث شده‌اند تا نفوذ این ارز دیجیتال در بین جامعه بیشتر شود. ما در ادامه برخی از این ویژگی‌ها را خدمت شما عزیزان بیان کرده‌ایم. 

امنیت بالا 
ارز دیجیتال اکسی اینفینیتی بر روی شبکه بلاک‌چین اتریوم پیاده شده است. این ارز دیجیتال مانند اتریوم دارای پروتکل اثبات کار یا همان POW می‌باشد. این پروتکل به‌عنوان یکی از امن‌ترین راهکارها برای جلوگیری از تقلب و خرابکاری در داخل بلاک‌چین شناخته می‌شود.

از طرفی دیگر وجود تعداد بالایی از ماینرها در داخل شبکه باعث شده تا امنیت آن به حداکثر حالت خود برسد. افزون بر این موارد، خود تیم توسعه‌دهنده هم تمام فاکتورهای امنیتی را برای افزایش امنیت در داخل شبکه انجام داده‌اند.

کاربران بالا 
داشتن حجم بالایی از کاربران را می‌توان به‌عنوان یکی از مهم‌ترین مؤلفه‌ها برای رشد ارز دیجیتال Axie Infinity تلقی نمود. طبق آمار رسمی، این بازی طی ماه گذشته به طور متوسط روزانه یک میلیون کاربر فعال داشته است. اگرچه تمام این کاربران ارز دیجیتال AXS را ندارند اما بدون شک تمام آن‌ها در رقابت برای دستیابی به آن هستند.

افزون بر این موارد تمام آن‌ها برای انجام فرایندهایی چون برید کردن در داخل شبکه، به این توکن نیاز ندارند. همین مورد سبب شده تا تقاضای بسیار بالایی برای این توکن ایجاد شود. این تقاضا در کنار عرضه قطره چکانی آن باعث شده تا قیمت این ارز رشد بالایی داشته باشد.

سازگاری بالا
سازگاری بالا را می‌توان به‌عنوان یکی دیگر از مهم‌ترین مزیت‌های ارز دیجیتال Axie Infinity در نظر گرفت. این ارز دیجیتال در حقیقت بر بستر شبکه اتریوم ایجاد شده است. به همین جهت است که این ارز دیجیتال در تمام کیف پول‌ها و یا شبکه‌هایی از شبکه ERC 20 پشتیبانی کنند، ذخیره می‌شود. این در نوع خود به‌عنوان یکی از مهم‌ترین مزیت‌های این توکن شناخته می‌شود.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="توکن SLP"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"توکن SLP را می‌توان به‌عنوان دومین ارز موجود در بلاک‌چین اکسی اینفینیتی دانست. این ارز دیجیتال هم مانند AXS یک توکن بر بستر ERC 20 اتریوم می‌باشد. SLP در حقیقت مخفف عبارت Smooth Love Potion یا همان معجون عشق می‌باشد.

این توکن هم مانند ارز دیجیتال Axie Infinity به‌عنوان پاداش در طی بازی به کاربران پرداخت می‌شود. اما باید عنوان کنیم که این جایزه نسبت به خود ارز AXS بسیار عمومی‌تر است.
در واقع تمام بازیکنان با هر سطحی از توانایی می‌توانند این ارز دیجیتال را به عنوان جایزه دریافت کنند. این در حالی است که ارز AXS تنها به 1000 نفر اول و آن هم بعد از پایان فصل پرداخت می‌شود. همین موضوع سبب شده تا عمومیت ارز SLP بسیار بیشتر شود.

در حالت کلی افراد می‌توانند به سه روش مختلف ارز دیجیتال SLP را به‌عنوان جایزه در بازی اکسی اینفینیتی دریافت نمایند. روش اول مراحل از پیش تعیین شده می‌باشد که تحت عنوان ادونچر شناخته می‌شود.

افراد می‌توانند در این روش روزانه حداکثر 50 ارز SLp را به دست بیاورند. البته باید عنوان کنیم که این میزان در ابتدای کار حدود 150 توکن به‌صورت روزانه بود. اما بعدها برای جلوگیری از تورم و افت قیمت، این پاداش نصف شد.

دومین روش به‌دست‌آوردن SLP، مبارزه متقابل با سایر بازیکنان است که تحت عنوان Arena شناخته می‌شود. تمام تیم‌های سه نفره طی یک روز می‌توانند 20 مبارزه را با سایر کاربران انجام داده و در صورت برد، اس ال پی به‌عنوان جایزه دریافت نمایند. میزان جایزه متناسب با کاپ طرفین تعیین می‌شود.

البته باید عنوان کنیم که شما می‌توانید در طول روز بی‌نهایت بازی را در Arena انجام دهید. اما صرفاً برای بازی‌هایی پاداش دریافت می‌کنید که انرژی داشته باشید. هر تیم هم روزانه فقط 20 انرژی دارد.

سومین روشی که می‌توانید به‌وسیله آن ارز دیجیتال SLP را به دست بیاورید، انجام درخواست‌های روزانه می‌باشد. درخواست‌های روزانه عموماً بسیار ساده است. 5 برد در آرنا و 10 برد در ادونچر به شما 25 اس ال پی دیگر تحت عنوان درخواست روزانه جایزه می‌دهد.

البته باید عنوان کنیم که حجم این پاداش‌ها در زمان عرضه بازی بسیار بیشتر بود. این رقم از عرضه‌ها در ابتدا با توجه به تعداد اندک بازیکنان بسیار بهینه بود. به‌گونه‌ای که در طی یک سال گذشته قیمت هر SLP به مرز 45 سنت هم رسید.

اما با افزایش نجومی کاربران؛ میزان استخراج ارز دیجیتال SLP شدت گرفت. به‌گونه‌ای که عرضه از تقاضا پیشی گرفت. این در نوع خود سبب شد که قیمت تابه امروز هم روندی نزولی داشته باشد.

البته باید عنوان کنیم که تیم توسعه‌دهنده همواره تمهیداتی را برای افزایش قیمت این ارز دیجیتال انجام داده است. برای مثال برای برید کردن در داخل بازی، بایستی حتماً ارز دیجیتال SLP را استفاده نمایید. افزون بر این موارد در آینده هم برای خرید لند های بازی نیاز به ارز دیجیتال SLP خواهد بود.

این در نوع خود سبب شده تا تقاضا برای خرید ارز دیجیتال اس ال پی افزایش و این ارز هم قیمتی کنترل شده داشته باشد. اما در حالت کلی توکن اس ال پی به‌عنوان 452امین ارز بازار شناخته می‌شود.

حجم معاملات روزانه این ارز در محدوده 60 میلیون دلار قرار دارد اما حجم بازار آن به محدوده یک میلیارد دلار می‌رسد. البته باید عنوان کنیم که تیم توسعه‌دهنده در نظر دارد تا در آینده میزان تقاضا برای این ارز را افزایش داده و به نحوی قیمت آن را کنترل نماید.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="توکن AXS"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"توکن AXS در واقع به‌عنوان توکن اصلی پلتفرم اصلی بازی اکسی اینفینیتی شناخته می‌شود. این توکن دو سال بعد از انتشارِ خود بازی عرضه شد. اما مهندسی دقیق آن‌ها در انتشار و توزیع این ارز سبب شد تا به قیمت‌های بسیار نجومی برسد. به‌گونه‌ای که بعد از گذشت کمتر از دو سال توانست به رقم حدودی 160 دلار برسد که در نوع خود بسیار بی‌نظیر است. 
ارز دیجیتال AXS در واقع مخفف عبارت Axie Infinity Shard می‌باشد که یک توکن ERC20 است. این توکن بر روی شبکه اتریوم ایجاد شده و لذا دارای امنیت پیشرفته اتریوم می‌باشد.

نکته قابل‌توجه این است که ارز دیجیتال Axie Infinity محدود بوده و تنها 270 میلیون توکن از آن وجود دارد. از این میزان حدود 60 میلیون توکن در یک عرضه اولیه منتشر شد. مابقی آن برای مشاوران، اعضای تیم، پاداش بازی و موارد مشابه اختصاص‌یافته است. طبق روند فعلی بازی انتظار می‌رود که عرضه کل این توکن‌ها تا سال 2026 ادامه پیدا کند. 

البته باید عنوان کنیم که میزان عرضه این توکن نسبت به توکن SLP بسیار کمتر است. به‌گونه‌ای که در هر فصل تنها تعدادی از آن به‌عنوان پاداش به نفرات برتر داده می‌شود. این در حالی است که فرایند برید کردن بین اکسی‌های داخل بازی نیاز به این توکن دارد. همین مورد هم باعث می‌شود تا تقاضای زیادی برای آن شکل گیرد.
افزون بر این موارد افراد می‌توانند با استفاده از این توکن حق رأی را در داخل شبکه axs داشته باشند. همین موضوع هم سبب شده تا تقاضا برای خرید آن مجدداً روندی صعودی داشته باشد. این در نوع خود میزان تقاضا را هم‌افزایش داده است. بیشتر بودن میزان تقاضا نسبت به میزان عرضه سبب شده تا نمودار قیمت این ارز دیجیتال همچنان صعودی باشد.

نسبت عرضه به تقاضا این ارز دیجیتال سبب شده تا در مدت کمتر از دو سال به رتبه 25 بازار برسد و تسلط 0.25 درصدی بر کل مارکت داشته باشد. از طرفی دیگر میزان معاملات این ارز در طی یک روز به بیش از 190 میلیون دلار می‌رسد که با توجه به نوع محیط و البته عمر آن بسیار منحصربه‌فرد می‌باشد. 

لازم به ذکر است که این توکن به‌عنوان منبع درآمد اصلی شرکت اکسی اینفینیتی شناخته می‌شود. به عبارت ساده‌تر این شرکت بخش اعظم درآمد خود را از طریق عرضه این ارز به دست می‌آورد و همین منبع سرشاری از درآمد را برای برنامه‌ها و اهداف این پروژه ایجاد کرده است.

برای مثال طی یک ماه گذشته میزان درآمد این بازی از این طریق معادل 36 میلیون دلار بوده است. این رقم بالاترین میزان درآمد برای یک برنامه غیرمتمرکز یا همان DApp به‌حساب می‌آید.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="خرید ارز دیجیتال Axie Infinity"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"سهولت در خرید و فروش یک ارز دیجیتال را می‌توان به‌عنوان یکی از مهم‌ترین فاکتورهایی در نظر گرفت که افراد می‌بایست قبل از خرید یک ارز دیجیتال آن را لحاظ نمایند. این موضوع برای توکن‌هایی که از بازی را به دست می‌آید، اهمیت بسیار بیشتری به خود می‌گیرد.

در واقع این روزها بازی‌های بلاک‌چینی زیادی عرضه شده‌اند که ارزهای دیجیتال مختلفی را ارائه می‌دهند. اما باید عنوان کنیم که فرایند نقدکردن ارز دیجیتال آنها بسیار سخت و زمان‌گیر می‌باشد. به‌گونه‌ای که بسیاری از افراد نمی‌توانند پاداش‌های داخل بازی خود را نقد نمایند.

خوشبختانه ارز دیجیتال Axie Infinity و سایر توکن‌هایی که در داخل این بازار عرضه می‌شود، قدرت نقدشوندگی بالایی دارند. در حقیقت بایننس به‌عنوان بزرگ‌ترین صرافی ارز دیجیتال دنیا، بر روی این پروژه سرمایه‌گذاری کرده است.

به همین جهت هم بود که این صرافی در گام نخست نسبت به عرضه و انتشار این توکن‌ها اقدام نمود. به دنبال این هم تعدادی بسیاری از صرافی‌ها این ارز دیجیتال را لیست نمودند. برخی از این صرافی‌ها به شرح زیر هستند.

Binance
AvaTrade
Revolut
Coinbase
eToro
OKEx
FTX
Upbit
Huobi Global
Capital
Libertex
Plus500
CryptoRocket
Changelly
و….
این موارد را می‌توان تنها بخشی از صرافی‌های معتبر دنیا دانست که این ارز دیجیتال را ارائه می‌دهند. لازم به ذکر است که شما می‌توانید در این صرافی‌ها ارز AXS و SLP را در مقابل ارز فیات یا توکن‌های تتر، بیت‌کوین و اتریوم معامله نمایید. البته باید عنوان کنیم که این روزها امکان معامله این ارز دیجیتال در داخل خود سایدچین رونین و توسط صرافی آن ممکن شده است.

به دو گونه‌ای که افراد می‌توانند به شیوه‌ای مستقیم پاداش‌های خود را به استیبل کوین‌ها تبدیل نمایند. برای خرید اکسی‌های داخل بازی یا همان شخصیت‌های NFT می‌بایست از مارکت پلیسی که در داخل خود بازی قرار گرفته اقدام نمود.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="کیف پول‌های ارز Axie Infinity"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"نحوه نگهداری از یک ارز دیجیتال از دیگر مؤلفه‌هایی می‌باشد که سرمایه‌گذاران قبل از هرگونه اقدامی ابتدا آن را بررسی می‌کنند. بدیهی است که هراندازه یک ارز دیجیتال توسط کیف پول‌های بیشتری پشتیبانی شود، گزینه بهتری برای هولد کردن خواهد بود. ارز دیجیتال Axie Infinity و سایر توکن‌هایی که در داخل این بازی وجود دارند، از این نظر در سطح ایده‌آلی قرار دارند.

در حقیقت تمام توکن‌های این بازی بر مبنای ERC 20 یا ERC721 هستند. این دو پروتکل مربوط به شبکه اتریوم است. لذا هر کیف پولی که از اتریوم پشتیبانی نماید، می‌تواند از این ارزها نیز پشتیبانی کند. با این وجود ما در ادامه برخی از بهترین انتخاب‌ها را خدمت شما عزیزان ارائه داده‌ایم.

رونین والت:
رونین والت را می‌توان بهترین انتخاب ممکن برای این بازی و البته ارزهای دیجیتال آن دانست. این کیف پول در حقیقت به‌عنوان کیف پول رسمی بازی اکسی اینفینیتی شناخته می‌شود. این کیف پول بر بستر ساید چین رونین توسعه یافته که در اصل ساید چین اختصاصی بازی است.

در این کیف پول شما امکان ذخیره توکن‌های مختلف بازی را خواهید داشت. البته باید عنوان کنیم که جهت نصب و راه‌اندازی بازی هم این کیف پول الزامی است. اما مزیت‌های این کیف پول تنها برای راه‌اندازی بازی نیست بلکه باید عنوان کنیم که امنیت ایده‌آلی داشته و می‌توان از آن برای نگهداری توکن‌های این بازی هم استفاده نمایید.

البته این موضوع به شرطی است که نسخه اصلی آن را نصب کنید. به‌خاطر داشته باشید که این کیف پول در حال حاضر تنها به‌صورت افزونه برای مرورگرهای کروم و موزیلا منتشر شده و بهترین انتخاب برای نگهداری از توکن‌های NFT داخل بازی است. 

تراست والت 
تراست والت را می‌توان به‌عنوان معروف‌ترین کیف پول نرم‌افزاری جهان دانست. این کیف پول امنیت بسیار بالایی دارد. این کیف پول از تمام پروتکل‌های اتریوم پشتیبان می‌کند. به همین جهت می‌تواند ارزهای این بازی را هم در خود ذخیره سازد. 

کیف پول اتمیک 
اتیمک از دیگر کیف پول‌های نرم‌افزاری مطرح در دنیا می‌باشد که امنیت بسیار منحصربه‌فردی دارد. همین مورد هم سبب شده تا انتخاب بسیار ایده‌آلی برای نگهداری از ارز دیجیتال Axie Infinity باشد. 

ترزور وان 
کیف پول ترزور را می‌توان به‌عنوان معروف‌ترین کیف پول سخت‌افزاری دنیا تلقی نمود. این کیف پول با تکیه‌بر ساختار بسیار منحصربه‌فرد خود، می‌تواند یک انتخاب بی‌رقیب برای نگهداری از ارزهای دیجیتالی شما باشد.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="آینده ارز دیجیتال AXS"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"بررسی چشم‌انداز را می‌توان به‌عنوان یکی از مهم‌ترین و البته حیاتی‌ترین فاکتورهایی دانست که سرمایه‌گذاران قبل از خرید یک ارز دیجیتال به دنبال آن هستند. در واقع آن‌ها می‌خواهند بدانند که پیش‌بینی‌ها برای چند سال آینده یک ارز دیجیتال خاص به چه صورت می‌باشد.

این موضوع دررابطه‌با ارز دیجیتال Axie Infinity هم صدق می‌کند. در حقیقت نه‌تنها سرمایه‌گذاران، بلکه بازیکنان این بازی هم تمایل دارند تا روند این ارز دیجیتال را برای چند سال آینده بدانند. 
قبل از اینکه بخواهیم نظر برخی از کارشناسان را در این رابطه عنوان کنیم، بهتر است بدانید که در دنیای ارزهای دیجیتال هیچ مقوله‌ای قابل پیش‌بینی نیست. در حقیقت صعود یا نزول یک ارز می‌تواند از فاکتورهای بسیار زیادی تأثیر بگیرد.

عواملی همچون شرایط بازار، تیم توسعه‌دهنده، رقبا و… همه و همه بر روی این موضوع تأثیر می‌گذارند. با این وجود بسیاری از تحلیلگران نسبت به آینده‌این ارز دیجیتال و البته بازی آن امیدوار هستند. در حقیقت این بازی با استفاده از ایده جذاب خود نه‌تنها توانسته هیجان یک بازی را به بازیکنان هدیه دهد، بلکه برای آن‌ها یک منبع درآمدی بسیار ایده‌آل را هم خلق کرده است.

این منبع درآمدی در کشورهای آسیایی می‌تواند رقم بسیار منحصربه‌فردی داشته باشد. به‌گونه‌ای که می‌تواند بیشتر از درآمد یک روز کاری قشر متوسط باشد. 

افزون بر این موارد توکن‌های داخلی به شیوه‌ای مناسب توزیع شده و تیم بازی هم پیوسته در جهت کنترل و بهبود قیمت آنها تلاش می‌کند. برای مثال با کاهش قیمت توکن SLP، تیم توسعه‌دهنده میزان استفاده از این توکن برای برید ها را افزایش داد. این در نوع خود سبب شد تا توکن سوزی آن بیشتر شده و تقاضا برای آن رشد کند. 

افزون بر این موارد این بازی به‌صورت پیوسته آپدیت می‌شود. همین موضوع سبب شده تا مخاطبان بیشتری جذب آن شود. ترکیب کلی این موارد در کنار همدیگر سبب شده تا طیف زیادی از بازیکنان جدید جذب این بازی شوند. این در نوع خود همان فاکتوری است که می‌تواند قیمت را افزایش دهد.

محدود بودن خود توکن‌های اصلی هم عاملی بوده که آن را جذاب می‌کند. همین موارد سبب شده تا بسیاری از تحلیل گران آینده‌ای درخشان را برای این بازی و البته توکن آن پیش‌بینی نمایند.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="جمع‌بندی"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"بازی Axie Infinity را می‌توان به‌عنوان یکی از انقلاب‌های دنیای بلاک‌چین در نظر گرفت که فرایند کسب در آمد و بازی کردن را به همدیگر متصل نموده است. این بازی توکن‌های AXS و SLP را به‌عنوان جایزه ارائه می‌دهد. ارز اصلی این بازی AXS می‌باشد که به‌عنوان یکی از پرطر‌فدارترین توکن‌های بازار شناخته می‌شود.

این توکن بر بستر شبکه اتریوم عرضه شده و به همین جهت در کیف پول‌های بسیاری ذخیره می‌شود. از طرفی دیگر افراد می‌توانند این ارز دیجیتال را در بسیاری از صرافی‌های مطرح دنیا معامله کرده و پاداش‌های خود را نقد نمایند. 

خود بازی به‌گونه‌ای طراحی شده که علاوه بر جذب مخاطب، تقاضای زیادی را برای ارز دیجیتال اصلی آن ایجاد می‌کند. برای مثال این ارز برای بریدهای داخل بازی بسیار حیاتی می‌باشد. به همین جهت است که فرایند خرید آن روزبه‌روز بیشتر می‌شود، حال اینکه عرضه آن ثابت می‌ماند.

این موضوع در کنار جذابیت بازی باعث می‌شود تا قیمت این ارز دیجیتال در دنیا بیشتر شود. آپدیت‌های این بازی و البته مزایای منحصربه‌فردی که این ارز دارد، سبب شده تا بسیاری از تحلیلگران آینده درخشانی را برای این ارز دیجیتال پیش‌بینی نمایند.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="سؤالات متداول"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"آیا ارز دیجیتال Axie Infinity امن است؟
ارز دیجیتال Axie Infinity در حقیقت یک توکن بر بستر شبکه اتریوم می‌باشد. به همین جهت است که از هسته اتریوم و پروتکل POW برای تأمین امنیت خود استفاده می‌کند. به همین جهت می‌توان گفت که این ارز دیجیتال امنیت بسیار بالایی دارد. 

چگونه می‌توان ارز دیجیتال Axie Infinity را کسب نمود؟
برای به دست آوردن ارز دیجیتال Axie Infinity می‌توانید بازی اکسی اینفینیتی را انجام دهید. چنانچه به لیست 1000 نفر برتر در هر فصل برسید، می‌توانید تعدادی توکن AXS به‌عنوان جایزه دریافت کنید. از طرفی دیگر شما می‌توانید این ارز دیجیتال را به‌صورت مستقیم از صرافی‌ها خریداری نمایید. برخی از این صرافی‌ها به شرح زیر هستند:

Binance
AvaTrade
Revolut
Coinbase
eToro
OKEx
FTX
Upbit
Huobi Global
Capital
Libertex
Plus500
CryptoRocket
Changelly
و….
چگونه می‌توان ارز دیجیتال Axie Infinity را ذخیره نمود؟
از آنجایی که این ارز دیجیتال بر بستر شبکه اتریوم ساخته شده، لذا کیف پول‌های مختلفی از آن پشتیبانی می‌کنند. از جمله این کیف پول‌ها می‌توان به رونین والت، تراست والت، اتمیک والت و… اشاره نمود. 

آیا قیمت ارز دیجیتال Axie Infinity رشد می‌کند؟
در رابطه با قیمت ارزهای دیجیتال، هیچ‌گاه نمی‌توان پیش‌بینی دقیقی را انجام داد. اما با توجه به ساختار کلی بازی اکسی اینفینیتی و البته نحوه عرضه توکن‌های آن می‌توان این انتظار را داشت که این ارز دیجیتال تا چند سال آینده روندی صعودی به خود بگیرد.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
////.............//////
elseif($text=="Decentraland چیست؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"نرم‌افزاری است که در Ethereum اجرا می‌شود و به دنبال ایجاد انگیزه در شبکه جهانی کاربران برای کار با یک دنیای مجازی مشترک است.

کاربران Decentraland می‌توانند ضمن کاوش، تعامل و بازی در این دنیای مجازی، املاک و مستغلات دیجیتال را نیز خریداری کنند و یا بفروشند. با گذشت زمان این پلت فرم برای اجرای برنامه‌های تعاملی، پرداخت در جهان و ارتباطات نظیر به نظیر برای کاربران تکامل یافت.
دو نوع مختلف از توکن‌ها که عملیات را در Decentraland اداره می‌کنند، اینها هستند:

LAND
  یک رمز غیرقابل انعطاف 

 (NFT)  برای تعریف مالکیت زمین‌های نمایندگی املاک و مستغلات دیجیتال استفاده می‌شود.
MANA
  ارز رمزنگاری شده‌ای که خرید
 LAND 
و همچنین کالاها و خدمات مجازی مورد استفاده در Decentraland را آسان می‌کند.
تغییرات در نرم‌افزار Decentraland از طریق مجموعه تماس‌های هوشمند مبتنی بر بلاکچین اعمال می‌شود که به شرکت کنندگان صاحب MANA اجازه می‌دهد در مورد به روزرسانی‌های سیاست، برای پیشرفت‌های جدید رای دهند.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="aaaaa"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"Decentraland 
مانند یک بازی دنیای مجازی است؛ اما با کمک تمرکززدایی شما کنترل بیشتری بر محتوای خود خواهید داشت و حتی فرصت‌های شغلی نیز وجود دارد؛  این بدان معناست که هیچ کس نمی‌تواند شما را بیرون کند، سانسور کند یا کاری را که انجام می‌دهید محدود کند.

شما می‌توانید از طریق بازار آنلاین آنها در املاک و مستغلات Decentraland را خریداری کنید و با بفروشید.

آیا می‌توانید مطالب خود را در Decentraland تهیه کنید؟
تا به حال بازی Minecraft را بازی کرده‌اید؟
در این صورت ممکن است ساعت‌ها یا حتی روزها وقت خود را صرف خلق و ساختن منظره‌ای حماسی کرده باشید؛ اما جدا از سرگرمی فایده چندانی ندارد.
در Decentraland، در واقع می‌توانید محتوای ایجاد شده را تبدیل به پول کنید.

Decentraland از ویژگی‌ها و امکانات زیادی برخوردار است که می‌توان به فروش املاک و مستغلات  تا کسب درآمد در کازینو دیجیتال و موارد زیر اشاره کرد:

شما زمینی را در Decentraland خریداری می‌کنید
سپس در Decentraland یک کازینوی دیجیتال ایجاد می‌کنید
شما هر بار که یک کاربر در آنجا بازی می‌کند، با کازینوی خود نشانه‌های مانا کسب می‌کنید
سپس سکه مانای خود را به ارز دنیای واقعی فیات واریز کنید",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="آیا Decentraland هنوز کارآیی دارد؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"فناوری بلاکچین آنها کاربرد دارد و هم اکنون نیز ارز رمزنگاری شده Mana مورد معامله قرار می‌گیرد.

اما فقط یک مشکل بزرگ وجود دارد:

دنیای آنها هنوز با واقعیت مجازی سازگار نیست.

Decentraland 
سرانجام از طریق هدست واقعیت مجازی قابل کاوش خواهد بود؛ اما در حالی که هنوز در حالت بتا است. اکنون فقط یک نقشه سه بعدی به حساب می‌آید و گرافیک‌ها کاملاً قانع کننده به نظر نمی‌رسند!",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="ecentraland چگونه با بازی‌های جهانی مجازی گره می‌خورد؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"آیا تا به حال با Ready Player One برخورد کرده‌اید؟ شاید عجیب نباشد که بدانید بنیانگذاران Decentraland از آن الهام گرفته‌اند.

Decentraland
 شبیه بازی‌های دنیای مجازی همچون GTA یا Sims است که ممکن است با آن آشنا شده باشید؛ اما چند تفاوت اساسی وجود دارد که عبارتند از:

دنیای Decentraland می‌تواند بسیاری از بازی‌های مختلف را با هم ترکیب کند.
به عنوان مثال در حال حاضر بازیکنان PS4 نمی‌توانند به صورت آنلاین در مقابل گیمرهای XBOX بازی کنند.
این تفاوت با Decentraland  که همه چیز را در یک جهان بزرگ ترکیب می‌کند.
در بیشتر بازی‌های دنیای مجازی کاربران نمی‌توانند محتوای خود را ایجاد کنند اما در Decentraland می‌توانید.
بنابراین کاربران Decentraland می‌توانند دنیای خود را ایجاد کنند و با آنها ارتباط برقرار کنند.
شما برای ایجاد دارایی‌های دیجیتالی خود در Decentraland از آزادی و کنترل بیشتری برخوردار می‌شوید.
برخلاف اکثر شرکت‌های بازی سازی هیچ قانونی برای سانسور وجود ندارد.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="موارد استفاده از Decentraland کدامند؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"به نظر می‌رسد Decentraland مفهوم جالبی باشد؛ اما چرا آنها به ارز رمزنگاری شده Mana نیاز دارند؟ آنها در واقع در مورد برخی موارد استفاده خود در وایت پیپر صحبت کرده‌اند که در ادامه به چند مورد آن اشاره می‌کنیم:

برنامه‌ها
برنامه‌نویسان Decentraland می‌توانند برنامه‌های خود را در متن توسعه دهند. این می‌تواند شامل بازی‌های درون دنیا، قمار و صحنه‌های سه بعدی باشد.

تبلیغات
تا به حال بیلبوردهای نمادین در میدان تایمز را دیده‌اید؟ Decentraland نیز همان کار را ولی در قالب دیجیتال انجام‌ می‌دهد.

شرکت‌ها می‌توانند برای تبلیغات در بیلبوردهای دنیای مجازی به کاربران بپردازند.

آنها می‌توانند از این تبلیغات برای آگاهی از برند استفاده کنند یا حتی تجربیاتی ایجاد کنند که کاربران Decentraland بتوانند با محصولات برند در سیستم عامل تعامل داشته باشند.

دارایی‌های دیجیتال
گیمرها عاشق جمع‌آوری موارد کمیاب هستند؛  به عنوان مثال World Of Warcraft را در نظر بگیرید. حساب‌هایی که اقلام نادر در اختیار دارند اغلب می‌توانند صدها یا حتی هزاران دلار حراج کنند.

برنامه‌نویسان Decentraland می‌توانند موارد نادر خود را نسبت به معامله و جمع‌آوری درون بازی تولید کنند و ارزش و تازگی بیشتری  برای سیستم عامل ایجاد کنند.

انجمن
 

انسان موجودی اجتماعی است. ما عاشق اجتماعات و ملاقات با افراد جالب هستیم. یکی از بزرگترین دلایلی که مردم عاشق بازی‌های دنیای مجازی مانند Second Life هستند، عنصر اجتماعی است.

در Decentraland، دیدار انجمن‌های آنلاین و آفلاین انجام می‌شود",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="فرصت‌های کشف نشده"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"با قابلیت‌های برنامه‌نویسی و خلاقیت بلاکچین، فرصت‌های زیادی در Decentraland وجود دارد که حتی هنوز کشف نشده‌اند و می‌تواند شامل آموزش مجازی، جهانگردی واقعیت مجازی و حتی آموزش آنلاین باشد؛ اگر به عنوان مثال به کنسول‌های بازی مانند PS4 نگاه کنید این فناوری سال‌ها پیش منتشر شد؛ اما بازی‌های آنها هنوز در حال پیشرفت هستند.

با توجه به تازه بودن فناوری بلاکچین  فرصت‌های زیادی برای Decentraland وجود دارد که احتمالاً هنوز به آنها فکر نشده است",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="هزینه زمین در Decentraland چقدر است؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"قیمت رکوردی برای یک قطعه زمین در Decentraland در واقع 2000 مانا بود که در زمان فروش 170 هزار دلار قابل برگشت بود.

قیمت متفاوت است و این عمدتا به میزان عرضه در برابر تقاضا، مکان و اندازه قطعه زمین خریداری شده بستگی دارد.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="آیا مانا ارز دیجیتال خوبی برای سرمایه‌گذاری است؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"در واقع پتانسیل آینده مانا بیشتر به مدل تجاری به کار رفته و استفاده از آن بستگی دارد. عمدتا اگر دنیای VR آنها رهبر بازار شود، ارزش سکه آنها افزایش می‌یابد.

 بررسی مزایای مدل تجاری آنها:

سیستم عامل آنها در حال فعالیت است و درآمد کسب می‌کند
صنعت بازی با سرعتی چشمگیر در حال رشد است
انگیزه‌های زیادی برای رشد جامعه وجود دارد. مردم می‌توانند در دنیای Decentraland مشاغل سودآوری ایجاد کنند
انتظار می‌رود طی چند سال آینده واقعیت مجازی رشد چشمگیری داشته باشد
ایده آنها بسیار جالب است
سکه مورد استفاده در دنیای مجازی حول مبادلات رمز می‌چرخد",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="آیا Decentraland کلاهبرداری است؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"نمی‌توان گفت کلاهبرداری است اما لازم است به نکات زیر توجه داشته باشید:

Decentraland کامل نیست این یک فناوری جدید است که در حال ظهور است و هنوز کاملاً آماده نیست.

تیم توسعه دهنده آنها تجربه بازی زیادی ندارند

نقشه راه وب‌ سایت آنها ادعا می‌کند که این ایده در سال 2015 توسعه یافته است اما این موضوع فقط در سطح مفهومی بود، آنها در واقع تا اکتبر 2017 راه اندازی نشده اند.

در حالی که جهان توسعه یافته است هیچ دلیلی بر ادغام واقعیت مجازی وجود ندارد و در حال حاضر در VR نیست

فناوری آنها هنوز آماده نیست. مدت‌ها طول می‌کشد تا چیزی شبیه به دنیای سبک Ready Player One مشاهده کنیم

اگرچه  مفهوم Decentraland بسیار جالب توجه است، جنبه واقعیت مجازی فناوری آنها نیز باید توسعه یابد.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="معرفی تاریخچه پروژه انجین و ارز دیجیتال ENJ"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"انجین یک شرکت سنگاپوری است که توسط مدیرعامل و مدیر بخش خلاقیت آن به نام ماکسیم بلاگوف (Maxim Blogov) و مدیر فناوری ارشد آن به نام ویتک رادومسکی (Witek Radomski)، با راه‌اندازی پلتفرم گیمینگ خود به نام Enjin Network در سال 2009 تاسیس شد. در آن زمان، انجین نتورک امکان ساخت وبسایت، انجمن و برنامه را برای گیمرها فراهم کرده بود.

ایده ورود شرکت انجین به حوزه بلاک چین توسط رادومسکی و پس از علاقه وی به بیت کوین در سال 2012 شکل گرفت و توانست این شرکت را به پذیرش این ارز دیجیتال به عنوان یک روش پرداخت متقاعد کند.

در نهایت این شرکت در سال 2017 و با جمع‌آوری 18.9 میلیون دلار از طریق عرضه اولیه سکه (ICO)، وارد صنعت بلاک چین شد. انجین از زمان عرضه ارز دیجیتال ERC20 خود به نام ENJ، خدمات و ابزارهای بلاک چینی خود را توسعه داده است. در ژانویه 2018 (دی 96)، این شرکت بازی‌سازی نسخه اندروید کیف پول رمز ارزی خود به نام Enjin Wallet را عرضه کرد. چند ماه بعد، نسخه iOS این ولت نیز منتشر شد.

در تابستان سال 2018، این شرکت از راه‌اندازی رسمی پلتفرم انجین کوین در شبکه اصلی اتریوم و سازگاری آن با کوان تست‌نت (Kovan Testnet) خبر داد. پروژه انجین یک پلتفرم به عنوان خدمت است که امکان صدور دارایی‌های غیرقابل تعویض و تعویض‌پذیر به صورت توکن‌های اتریومی درون بازی را به توسعه‌دهندگان می‌دهد. در همان سال، این پلتفرم استاندارد توکن جدید خود به نام ERC-1155 را معرفی کرد که در سال 2019 تایید و در نرم‌افزار فعلی آن پیاده‌سازی شد. آقای رادومسکی نویسنده این استاندارد است و از آن برای صدور هر دوی توکن‌های مثلی و غیرمثلی استفاده می‌شود. به دنبال آغاز به کار استاندارد ERC1155، شرکت انجین بازارچه‌ای را برای خرید و فروش دارایی‌های مبتنی بر این استاندارد راه‌اندازی کرد.

بر اساس ادعای این شرکت، هم‌اکنون بیش از 18.7 میلیون کاربر و بیش از 250,000 جامعه گیمینگ در این پلتفرم مشغول بازی هستند.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="پلتفرم گیمینگ انجین چگونه کار می‌کند؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"پروژه انجین به ساخت، توزیع، ذخیره، معامله و ادغام دارایی‌های دیجیتال توکنیزه شده در صنایع مختلف خصوصا حوزه گیمینگ و بازی کمک می‌کند. شبکه انجین برای ساخت کوپن‌های دیجیتال، NFTها و موارد بسیار دیگر، از ارزهای دیجیتال با پشتوانه ENJ بهره می‌برد.

خدمات مدیریت جامعه (CMS) انجین اجازه ساخت وبسایت‌ها، فروشگاه‌ها، انجمن‌ها و ماژول‌هایی نظیر پلاگین‌های درون بازی را در کنار به حداقل رساندن تقلب، بهبود زمان‌های تسویه و حفظ هزینه پایین تراکنش‌ها به کاربران می‌دهد.

شبکه انجین همچنین به ابزارهای مدیریت جامعه خود شناخته می‌شود که به بیش از 20 میلیون کاربر بازی ماین‌کرفت برای اتصال کمک کرده و شبکه‌هایی قوی برای بازیکنان با طرز تفکر یکسان را تشکیل داده است. توکن‌های بلاک چین محور و NFTها را می‌توان به راحتی در چندین پلتفرم ادغام کرد که به همکاری‌های میان پلتفرمی بین توسعه‌دهندگان بازی‌ها و برندهای بازی‌سازی بزرگ مانند ماین‌کرفت منجر شده است.

شبکه انجین کوین برای پشتیبای از دارایی‌های دیجیتال صادرشده با استفاده از این پلتفرم، از ارز دیجیتال ENJ خود استفاده می‌کند. این یعنی امکان خرید، فروش و معامله آیتم‌های درون بازی با ارزشی در دنیای واقعی وجود دارد.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="اکوسیستم شبکه ارز دیجیتال انجین"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"پلتفرم انجین اکوسیستمی کامل را تشکیل داده است که امکان ساخت، ذخیره، معامله و استفاده از این آیتم‌ها در آن وجود دارد:

انجین والت (Enjin Wallet): یک کیف پول رمز ارزی برای ذخیره امن ارزهای دیجیتال، دارایی‌های بازی و تبادل ارزش.
انجین ایکس (EnjinX): اکسپلورر بلاک چین برای مشاهده تراکنش‌ها و دارایی‌ها
یونیتی پلاگین (Unity Plugin): به توسعه‌دهندگان بازی‌ها اجازه می‌دهد تا مستقیما آیتم‌ها را درون بازی‌های پلتفرم‌های مختلفی نظیر iOS، اندروید و کامپیوتر صادر و پیاده‌سازی کنند.
مارکت‌پلیس (Marketplace): برای خرید و فهرست کردن آیتم‌ها با امنیت قراردادهای هوشمندی که به صورت مستقل معاملات را تسهیل می‌کنند.
عملکردی به نام “Melting” در شبکه انجین به کاربران اجازه می‌دهد تا دارایی‌های بلاک چینی خود را در هر زمانی از بین برده و ارزش ارز دیجیتال ENJ درون آن‌ها را بازیابی کنند.

اکوسیستم بلاک چینی انجین ارائه محصولات نرم‌افزاری که باعث ساده‌سازی توسعه، ترید، کسب درآمد و کار با فناوری بلاک چین می‌شود را هدف قرار داده است. تمرکز این پلتفرم بر بازی‌های مجازی، محصولات مجازی و جلوگیری از تقلب و سرقت دارایی‌های دیجیتال است.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="ارز دیجیتال انجین کوین (ENJ) چیست؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"رمز ارز انجین کوین یک ذخیره ارزش دیجیتال و مبتنی بر استاندارد ERC20 اتریوم است که برای پشتیبانی از ارزش دارایی‌های بلاک چینی مانند توکن‌های غیرمثلی استفاده می‌شود. هر دارایی صادرشده در پلتفرم انجین، حاوی ارز دیجیتال ENJ است؛ یک منبع تولید که درون NFTها قفل و از گردش حذف می‌شود. تولید دارایی‌های بلاک چینی با توکن ENJ مزایای مختلفی برای سازندگان و کاربران دارد از جمله:

تزریق ذخیره ارزش به دارایی‌ها
حصول اطمینان از شفافیت و کمیابی
ارائه قدرت نقدینگی لحظه‌ای
کاربرد در بازی‌ها و برنامه‌ها
ضد تورم",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="الگوریتم اجماع و استخراج رمز ارز انجین کوین"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"شبکه انجین به ماینرها وابسته است. ارز انجین کوین روی یک الگوریتم اجماع اثبات کار (PoW) اجرا می‌شود و امکان ماین کردن آن وجود دارد. تجهیزات قابل استفاده برای استخراج ENJ مشابه بیت کوین و دیگر رمز ارزهایی است که غالبا از ریگ‌های ASIC یا GPU استفاده می‌کنند",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="کاربردهای ارز دیجیتال ENJ"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"انجین کوین اجازه مدیریت و ذخیره محصولات گیمینگ مجازی نظیر اکسسوری‌های مخصوص کاراکترها یا ارزهای درون بازی را به کاربران می‌دهد. کاربران نیز می‌توانند با فروش NFTهای خود، توکن ENJ کسب کنند. از انجین کوین به عنوان یک ارز برای خرید، فروش و معامله توکن‌های غیر مثلی استفاده می‌شود.

از این رمز ارز همچنین برای ساخت، مدیریت و تخریب آیتم‌های درون بازی استفاده می‌شود. توسعه‌دهندگان می‌توانند توکن‌های سفارشی، آیتم‌های منحصربه‌فرد یا توکن‌های امتیازی با پشتوانه انجین کوین را صادر کنند. در برخی از صرافی‌های خاص، امکان وایز ENJ و کسب درآمد از آن نیز وجود دارد.

از انجین در برنامه‌های پاداش وفاداری هم استفاده می‌شود. مثلا، در همکاری این پلتفرم با شرکت خودروسازی BMW، توکن‌های ان اف تی دارای امتیاز وفاداری هستند که از آن برای پرداخت هزینه سوخت، پارکینگ، عوارضی جاده‌ها یا حتی تبدیل آن به ENJ استفاده می‌شود.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="کیف پول های ارز دیجیتال انجین کوین"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"برای ذخیره و نگهداری ENJ به کیف پول پشتیبان آن نیاز دارید. از آنجایی که انجین کوین یک رمز ارز ERC20 روی شبکه اتریوم است، از تمامی والت‌های پشتیبان این شبکه مانند تراست والت، اتمیک ولت، متامسک، مای اتر والت و کیف پول های سخت‌افزاری مانند ترزور و لجر نانو اس و ایکس می‌توان استفاده کرد.

اما Enjin Wallet کیف پول رسمی پلتفرم انجین است که بازیکنان برای ذخیره و معامله آیتم‌ها از آن استفاده می‌کنند. این ولت امکان دسترسی به تمامی ویژگی‌های این پلتفرم را فراهم کرده است.
انجین والت همچنین به کاربران اجازه می‌دهد تا به موجودی خود دسترسی داشته و با بازی‌های مختلف ارتباط داشته باشند. امکان فروش مستقیم محصولات دیجیتال از داخل خود والت نیز وجود دارد.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="اسپیس میسفیتس (Space Misfits)"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"اسپیس میسفیتس یک بازی نقش‌آفرینی برخط چندنفره گسترده (MMO) سه بعدی در فضا است. در این بازی بازیکنان می‌توانند با استفاده از ارزهای دیجیتال به شکار، جمع‌آوری و ماین کردن آیتم‌ها و منابع بپردازند. این بازی دارای گرافیک قوی است و به بازیکنان اجازه می‌دهد تا در یکی از نقش‌های دزد فضایی، تریدر یا ماینر به بازی بپردازند. پلتفرم انجین با توکنیزه کردن دارایی‌های کلیدی به صورت NFT روی بلاک چین، کنترل بیشتری را به بازکنان می‌دهد و همچنین با استفاده از فناوری بلاک چین جامپ‌نت (JumpNet)، یک اقتصاد «بازی کن جایزه ببر» و ارز درون بازی مختص به خود به نام BITS را ساخته است.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="9 لایوز آرنا (9Lives Arena)"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"در بازی 9 لایز آرنا شما می‌توانید به وایکینگ، بربر، سامورایی، گلادیاتور یا آتلانتیایی باستان تبدیل شوید. هر بار که کاراکتری برنده نبرد شود، جوایزی مانند مواد و طرح‌های اولیه قدرتمند به بازیکنان اعطا می‌شوند که شانس ساخت سلاح‌های انحصاری از طریق آن‌ها را به بازیکنان می‌دهد",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="6 اژدها (The 6 Dragons)"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"6 اژدها یک بازی دارای 3 کلاس کاراکتر جنگجو، جادوگر و روحانی است. بازیکنان می‌توانند با ترکیب حداکثر 33 مهارت از هر 3 این کلاس‌ها، کاراکتر خود را بسازند. مثلا می‌توانند از بین 26 نوع از سخن کلاس جنگو، عصای کلاس جادوگر و گرز کلاس روحانی استفاده کنند.

با استفاده از پلتفرم ارز دیجیتال انجین کوین، کیف‌پول‌های دیجیتال گیمرها به موجودی‌های واقعی تبدیل می‌شوند که اجازه ساخت دارایی‌های جدید درون‌بازی را به بازکنان می‌دهند. سپس بازیکنان می‌توانند توکن‌های به‌جامانده از سوی دشمنان خود مانند شمشیر، زره و معجون را جمع کنند. این پلتفرم با کمک بلاک چین همچنین یک بازارچه درون بازی به نام “Blockchain Blacksmith Service” را ارائه کرده است که از طریق آن امکان ساخت دارایی‌های جدید درون‌بازی توکنیزه‌شده وجود دارد.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="جنگ کریپتا (War of Crypta)"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"جنگ کریپتا یک بازی چند نفره مبتنی بر وب بازیکن مقابل بازیکن (PvP) است. بازیکنان می‌توانند با افزایش سطح خود به جمع‌آوری، شخصی‌سازی و تقویت کاراکتر خود بپردازند و سپس بر اساس نیازهای نبرد، قهرمان‌هایی را برای تیم خود انتخاب کرده و آن‌ها را به مبارزه با قهرمان‌های دیگر تیم‌ها درآورند.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="نستیبلز (Nestables)"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"نستیبلز به گیمرها اجازه می‌دهد تا مکعب‌های سه‌بعدی را جمع‌آوری، معامله و بسازند. هر مکعب شخصیت منحصربه‌فرد و مجموعه‌ای از رفتارهای فیزیکی را دارد. کاربران نیز با طراحی، ساخت و تزئین «آشیانه» خود، قادر به تعامل با مکعب‌ها هستند. منابع مورد نیاز برای بهبود آشیانه قابل جمع‌آوری است.

این بازی به بازیکنان اجازه می‌دهد تا به جمع‌آوری و شخصی‌سازی مکعب‌هایی بپردازند که امکان ترید و معامله آن‌ها با دیگر بازیکنان وجود دارد. تمام این مکعب‌ها در بازی نستیبلز به صورت توکن ERC-1155 و دارای پشتوانه ارز دیجیتال ENJ هستند.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="همکاری انجین با سامسونگ"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"پروژه انجین با شرکت تولیدکننده تلفن‌های هوشمند سامسونگ الکترونیکس به‌عنوان یک ارائه‌دهنده فناوری، همکاری کرده است. بر این اساس، کیف پول انجین والت با فروشگاه Blockchain Keystore این شرکت تعامل دارد که یک فضای قابل اعتماد در دستگاه‌های جدید سامسونگ طراحی‌شده مختص ذخیره امن کلیدهای خصوصی رمزنگاری است.

شرکت سامسونگ همچنین از استاندارد توکن ERC1155 انجین پشتیبانی کرده و به دنبال افزایش پذیرش توکن‌های غیرمثلی مبتنی بر بلاک چین است.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="همکاری انجین با مایکروسافت"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"مایکروسافت نیز طی پیاده‌سازی Azure Heroes، برنامه‌ای که به طور مستقیم از توکن‌های غیرقابل تعویض ERC-1155 به عنوان پاداش استفاده می‌کند، با پلتفرم انجین همکاری کرده است. این پاداش مبتنی بر بلاک چین به شرکت‌کنندگانی که به تولید مواد برای پلتفرم مایکروسافت آزور کمک می‌کنند، اهدا خواهد شد. مثلا، به سازندگان شرکت‌کننده در انجمن توسعه یا قهرمان‌های محتوا، نشان‌های کمیاب اهدا می‌شود.
این نشان‌های کالکتیبل، در واقع اثباتی برای دریافت اچیومنت به عنوان یک قهرمان آزور برای کاربران هستند که قابلیت نمایش در حساب‌های صفحات اجتماعی را نیز دارند. از آنجایی که این نشان‌ها دارایی‌های توکنیزه‌شده هستند، امکان جعل آن‌ها وجود ندارد.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="وورد انجین به حوزه دیفای"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"ارز دیجیتال ENJ اکنون در پروتکل آوی (Aave) نیز پشتیبانی می‌شود. یعنی کاربران با واریز رمز ارز انجین کوین به پروتکل آوه و وام‌دهی آن به دیگران، قادر به کسب درآمد خواهند بود. پروتکل آوی با استفاده از قراردادهای هوشمند شفاف و تغییرناپذیر اتریوم، از سپرده‌های شما محافظت می‌کند.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="همکاری انجین با BMW"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"پس از گمانه‌زنی‌های فراوان، سرانجام انجین همکاری خود با شرکت خودروسازی BMW با هدف سواپ توکن‌های ENJ به داخل Vantage App این شرکت را تایید کرد. ونتیج اپ یک برنامه وفاداری مشتری کُره‌ای برای صاحبان خودروهاست. کاربران می‌توانند با استفاده از این اپلیکیشن هزینه خدمات و کالاها مانند بنزین، عوارضی‌های جاده‌ای و پارکینگ را پرداخت نمایند. همچنین پاداش‌های ریفرال برای صرف غذا و خرید وجود دارد.

خریدهای انجام‌شده توسط برنامه ونتیج اپ بی‌ام‌و با رمز ارز BMW Coin پاداش‌دهی خواهد شد که برای استفاده در بسیاری از فعالیت‌ها و حتی تبدیل آن به رمز ارز ENJ کاربرد دارد.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="جمع‌بندی ENJ"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"پروژه انجین توانایی ساخت و مدیریت محصولات مجازی روی بلاک چین اتریوم را برای توسعه‌دهندگان فراهم کرده است. هدف این پلتفرم مدیریت آیتم‌های درون بازی‌هاست. انجین این هدف را با کاهش کارمزد تراکنش‌ها، غلبه بر تکثیر و کپی محتوا و حذف تقلب انجام داده است. ماهانه میلیون‌ها تراکنش در بازارچه این پلتفرم انجام می‌شود و با ارائه مالکیت حقیقی محصولات مجازی به هولدرهای آن‌ها، تجربه‌ای یکپارچه از کار با ارز دیجیتال ENJ را برای کاربران به ارمغان آورده است.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="کدام بازی‌ها از ارز دیجیتال ENJ استفاده می‌کنند؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"پنج پلتفرم گیمینگ زیر از جمله استفاده‌کنندگان انجین کوین یا دارایی‌های دیجیتال مبتنی بر این رمز ارز هستند. بازی‌های زیادی در اینجا ایجاد شده‌اند، اما نام‌های زیر جزو شناخته شده‌ترین‌ها و برترین‌ها است",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="همکاری‌های پلتفرم ارز دیجیتال انجین کوین"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"با افزایش پذیرش بازی‌های بلاک چینی و رشد این اکوسیستم، شرکت انجین نیز همکاری‌های استراتژیکی داشته است که در این بخش به بررسی آن‌ها می‌پردازیم.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="شرکای وکس چه کسانی هستند؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"شرکای وکس NFT شخصیت‌های بزرگی مانند Atari, William Shatner, The Topps Company هستند؛ علاوه براین پروژه‌های مستقلی مانند بلاکچین، KOGS ، Bitcoin Origins، Heroes ، Alien Worlds و موارد دیگر میلیون‌ها دلار درآمد اولیه و بازار ثانویه در بلاکچین وکس کسب می‌کنند؛ همین دلیل موجب شده است که وکس به عنوان یک هدف اصلی برای توسعه دهندگان مستقل برای ایجاد مشاغل موفق بلاکچین باشد.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="طراحی جدید توکنومیک وکس"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"ویژگی اصلی سیستم جدید توکنومیکس وکس، طراحی میان زنجیره‌ای آن است. در اصل بلاکچین وکس برای معاملات NFT ساخته شده است و بهترین بلاکچین در فضای NFT است. اتریوم بهترین سیستم پولی  را در میان بلاکچین‌ها دارد. مدل توکنومی وکس جدید با ایجاد شرایط جدید توانسته است قابلیت‌های برترمالی را برای اتریوم ایجاد کند.

در واقع وکس امنترین و راحتترین روش برای ایجاد، خرید، فروش و تجارت NFT است. 

در حال حاضر وکس مجموعه کاملی را از ابزارهای مبتنی بر بلاکچین ایجاد کرده است که به هر فردی امکان تجارت فوری و ایمن NFT را با فرد دیگر و در هر مکانی می‌دهد؛ در واقع وکس مشابه با کیف پول ابری وکس با کاربرد آسان است که در آن حساب‌ها فقط با دو کلیک با استفاده از ورود به سیستم‌های اجتماعی قابل استفاده هستند.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="برخی ویژگی های پلتفرم یا صرافی WAX"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"محافظت در برابر نوسانات قیمت
تا به امروز، مسئله نوسانات قیمت رمزارزها اجتناب ناپذیر بوده است؛ در همین راستا، در اختیار داشتن قراردادهای ارز WAX که از طریق پلتفرم آن صادر می شوند، می توانند تا حدی از کاربران در برابر نوسانات قیمت محافظت کند.

امنیت شبکه
عدم نیاز به اعتماد یا همان Trustless بودن از دیگر ویژگی های این صرافی است. کاربران می دانند دارایی که در آن قرار گرفته، کلاهبرداری نیست و خرید و فروش آنها در بستری با امنیت بالا انجام می گیرد.

هزینه پایین
مقرون به صرفه بودن هم از جمله مواردی است که نمی توان به راحتی از آن گذشت. هزینه پایین معاملات باعث می شود که هر دو خریداران و فروشندگان، سود بیشتری را جمع آوری کنند.

نقدینگی زیاد
صرف نظر از این که دارایی های دیجیتال قابل معامله، از بازی های مختلفی سرچشمه می گیرند، اما می توان آنها را به کمک ارز WAX (وکس) یا قراردادهای آن معامله کرد.

استیکینگ

دارندگان ارز دیجیتال WAX می توانند به کمک کیف پول خود در یکی از بستر ها مانند Scatter یا Sqrl به انجام عملیات استیکینگ پرداخته و پاداش دریافت نمایند. همچنین کاربران می توانند در پروسه رای گیری های این شبکه شرکت کنند و تنها کافی است که کیف پول سازگار خود را به بلاک چین WAX وصل کنید.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="جمع بندی WAX"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"پس از قرار معلوم هدف پروژه WAX ارائه یک بستر امن و مطمئن آنلاین برای جامعه گیمر ها می باشد تا بتوانند دارایی ها و آیتم های که در بازی های مختلف بدست می آورند را با دیگر گیمر ها و کاربران از سراسر جهان مبادله کنند.  

برخورداری از حمایت opSkins که بازاری بی رقیب در این زمینه را بوجود آورده است، از جمله مواردی است که به جذابیت پلتفرم وکس می افزاید و خیال کاربران را از بابت امنیت آن راحت تر می کند.

این پلتفرم نیازی به ادغام رابط برنامه نویسی نرم افزار یا API با ناشر بازی ها ندارد و همین امر دسترسی به گیمر های بیشتری را از طریق بازار غیرمتمرکز فراهم می آورد.

قیمت گذاری آیتم ها در این پلتفرم براساس ارز WAX یا توکن WAXP می باشد که در ارتباط مستقیم با شبکه اتریوم می باشد.

سابقه درخشان تیم توسعه دهنده WAX پیش بینی های مثبتی نسبت به آینده آن ارائه می دهد و مواردی از جمله هزینه پایین معاملات، امنیت شبکه، سیستم پاداش دهی و سهولت نگهداری، به محبوبیت این توکن بیفزاید.

در پایان از شما می خواهیم هرگونه سوال یا تجربه کار با ارز WAX (وکس) را دارید، حتما در بخش دیدگاه ها مطرح کنید تا مورد استفاده و استقبال سایر علاقه مندان قرار گیرد.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="۱. هدف پروژه وکس چیست؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"این پلتفرم بستری غیرمتمرکز را برای خرید و فروش محصولات کاربران ارائه می‌دهد. استفاده از ظرفیت فعلی بازی‌های ویدیوئی یکی دیگر از اهداف این ارز به شمار می‌آید.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="۲. ویژگی‌ های ارز وکس چیست؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"امنیت شبکه، هزینه پایین، نقدینگی زیاد و محافظت در برابر نوسانات قیمت از ویژگی‌های این ارز است.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="۳. بهترین کیف پول ارز وکس چیست؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"کیف پول رسمی این پلتفرم یکی از بهترین کیف پول‌های این ارز است و شما می‌توانید به‌راحتی این ارز را داخل آن حفظ و نگهداری کنید.

۴. کدام کیف پول برای نگهداری ارز وکس مناسب است؟
همیشه باید به دنبال کیف پولی باشید که شرکت سازنده آن برنامه‌ای درباره مسدودسازی کاربران ایرانی نداشته باشد.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="۴. کدام کیف پول برای نگهداری ارز وکس مناسب است؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"همیشه باید به دنبال کیف پولی باشید که شرکت سازنده آن برنامه‌ای درباره مسدودسازی کاربران ایرانی نداشته باشد.
",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="۵. بزرگ‌ ترین مزیت وکس چیست؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"حمایت و پشتیبانی این ارز دیجیتال توسط OPSkins یکی از بزرگ‌ترین مزیت‌های آن است.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="۶. مشکل ارز وکس چیست؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"یکی از مشکلات این پلتفرم این است که تابع سازندگان بازی است. یکی دیگر از مشکلات آن این است که تنها امکان فروش ۳۵ درصد از این رمز ارز وجود دارد.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="۷. آیا آینده وکس درخشان خواهد بود؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"بی‌شک اگر این ارز به توسعه خود ادامه دهد، آینده درخشانی خواهد داشت. امیدواریم این مقاله برایتان مفید واقع شده باشد و به تمام پرسش‌های شما پاسخ داده باشیم. اگر تجربه یا سؤالی دارید لطفاً آن را با ما به اشتراک بگذارید.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="بازی رمز ارزی استار اطلس چیست؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"بازی Star Atlas که در سال 2,620 اتفاق می‌افتد، یک «متاورس گیمینگ مجازی» است که 3 فرقه برای کسب منابع با یکدیگر می‌جنگند و برای دستیابی به برتری سیاسی، دست به فتوحات سرزمینی می‌زنند. بازیکنان بازی استار اطلس به شهروند یکی از این 3 فرقه تبدیل خواهند شد. هر فرقه، نمایانگر یک ایدئولوژی ژئوپولتیک است که تاثیرگذاری یک بازیکن بر منازعات بین کهکشانی را تعیین می‌کند.

پلتفرم گیمینگ ارز دیجیتال Star Atlas با ترکیب گیم‌پلی سنتی با مکانیک و اقتصاد بلاک چین، تجربه‌ای شگرف به همراه جزئیات چشم‌نواز گرافیکی با استفاده از فناوری بازی Unreal Engine 5 به نام Nanite را ارائه کرده است. این فناوری، تصاویر سینمایی شبیه به برخی از مجبوب‌ترین بازی‌های فعلی را ایجاد می‌کند.
اکوسیستم رمز ارزی استار اطلس روی بلاک چین سولانا ساخته شده است. بلاک چین سولانا سریع‌ترین شبکه در دنیاست که تجربه گیمینگ امن بدون سرور را امکان‌پذیر می‌سازد. علاوه بر این، به لطف این شبکه، بازی استار اطلس از توکن‌های غیر مثلی به عنوان بخشی از اقتصاد درون بازی خود استفاده می‌کند. این اقتصاد درون بازی، مشابه اقتصادهای دنیای واقعی ساخته‌شده پیرامون مالکیت حقیقی دارایی‌های است.

بازی رمز ارزی Star Atlas همچنین از طرییق ماینینگ و استیکینگ، شباهت زیادی به مکانیک یک بلاک چین دارد. این بازی با استفاده از هر دوی عملیات استخراج و استیکینگ، به بازیکنان اجازه می‌دهد تا اعتبار دارایی‌های درون بازی را اثبات کرده و واقعا در داخل بازی از آن‌ها استفاده کنند. بازیکنان قادر به ماین کردن دارایی‌های داخل بازی هستند که قابلیت کشف آن‌ها از طریق کاوش در استار اطلس وجود دارد. ارزش این دارایی‌ها با بهبود خصیصه‌های بازیکنان یا توانایی آن‌ها در بازی، افزایش خواهد یافت. علاوه بر این‌ها، شبکه کریپتویی استار اطلس امکان راه‌اندازی نود استخراح و استیکینگ جهت تامین امنیت شبکه و کمک به کسب پاداش را فراهم می‌کند",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="بازی ارز دیجیتال Star Atlas چگونه کار می‌کند؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"بازیکنان در کنار مبارزه در تجارب علمی-تخیلی آینده‌گرا، به یکی از 3 فرقه در این بازی ملحق می‌شوند. بازیکنان با شرکت در این فرقه‌ها، قادر به کسب پاداش هستند که باعث بهبود تجربه گیم‌پلی آن‌ها می‌شود. این 3 فرقه:

قلمرو ماد (MUD Territory): اشغال شده و تحت کنترل بشر
منطقه اونی (ONI Region): اشغال شده توسط «کنسرسیومی از نژادهای بیگانه»
بخش اوستور (Ustur Sector): تحت کنترل «اندرویدهای حساس»",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="مکانیک‌های اصلی بازی"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"مکانیک‌های بازی رمز ارزی Star Atlas، عناصر بازی‌های دسته گرند استراتژی (GSG) و نقش‌آفرینی (RPG) را با کاوش فضایی و کنترل قلمرو ترکیب می‌کند. بازیکنان همچنین قادر به مدیریت وسایل نقلیه و ناوگان‌های سفینه‌های فضایی مختلف هستند. یکی دیگر از مفاهیم کلیدی این بازی، عملیات استخراج و ماینینگ است. این عملیت در هر دوی زمین و فضا قابل انجام است.

علاوه بر این‌ها، بازیکنان می‌توانند در ماموریت‌های محیطی علیه بازیکن (PVE)، مبارزات بازیکن عیله بازیکن (PVP) و تجارب گیمینگ واقعیت مجازی شرکت کنند. به علاوه اینکه بازیکنان قادر به استفاده از تجهیرات مخصوص و پیشرفته برای شرکت در یک «سیستم کریر پویا» هستند.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="مکانیک‌های بلاک چین و مودهای بازی استار اطلس"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"بازی ارز دیجیتال استار اطلس به طرق مختلف از فناوری بلاک چین استفاده می‌کند. این موارد شامل ارزهای درون بازی به نام ATLAS و POLIS و توکن‌های NFT هستند که مالکیت دارایی‌های داخل بازی را نشان می‌دهند. بازی استار اطلس برای اجرای سناریوهای بازی از قراردادهای هوشمند سولانا و برای ارائه ویژگی‌های امور مالی غیر متمرکز (دیفای) از سروم (Serum) استفاده می‌کند. علاوه بر این، بازیکنان می‌توانند از طریق بازارچه NFT استار اطلس دارایی‌های درون بازی را به صورت شفاف معامله کرده یا با ماین کردن منابعی که مختص قلمروهای کنترل‌شده هستند، به کسب درآمد منفعل بپردازند.

بازی استار اطلس همچنین دارای مود “Play-for-Keys” با ریسک بالا است. این مود به کاربران اجازه می‌دهد که به استیک کردن دارایی‌های دیجیتال و شرط‌بندی روی خروجی بازی بپردازند. علاوه بر این، نگهداری اکوسیستم ارز دیجیتال Star Atlas هم از طریق مدل حاکمیت درون زنجیره‌ای آن انجام می‌شود. این امر به بازیکنان اجازه می‌دهد که با رای‌دهی روی تغییرات پارامترهای بازی، کنترل بی‌سابقه‌ای روی تجربه گیمینگ خود داشته باشند.

استار اطلس برای ترکیب ژانرهای مختلف در یک محیط همه‌جانبه و منعطف، مودهای گیمینگ مختلفی دارد. این مودها شامل یک بازی نقش‌آفرینی، اکتشاف، شبیه‌سازی پرواز فضایی و گرند استراتژی هستند.

مود گرند استراتژی (Grand Strategy)
بازی گرند استراتژی افزوده باعث تشویق بازیکنان به جمع‌آوری آیتم، ساخت و توسعه فرمانروایی‌ها، پیاده‌سازی مسیرهای معاملاتی و مشارک در نبردهای تاکتیکی می‌شود که بازیکنان می‌توانند از طریق مناطق مختلف در نقشه بازی، به مشاهده آن‌ها بپردازند.

مود اکتشاف (Exploration)
بازی استار اطلس همچنین به بازیکنان اجازه می‌دهد که برای «پویش و کشف دارایی‌های آسمانی و زمینی» به کاوش در اعماق فضا بپردازند. به محض یافتن این دارایی‌ها، بازیکنان می‌توانند ادعای کشف دارایی‌ها را اعلام کرده و آن‌ها را ماین کنند. همچنین بازیکنان قادر به پالایش این دارایی‌ها و معامله آن‌ها از طریق Universal Marketplace هستند.

مود اکتشاف یک نمای بالا به پایین از فضا را ارائه می‌دهد که نشان‌دهنده نمای بیرونی سفینه فضایی یک بازیکن است. به علاوه، این حالت دارای یک “نمای اشعه ایکس” است که تصویری مقطعی از فضای داخلی سفینه فضایی را نشان می‌دهد. در اینجا، بازیکنان همچنین می‌توانند خدمه سفینه فضایی را مشاهده کرده و بر عملکرد وظایف نظارت داشته باشند. علاوه بر این، سفینه‌ها را می‌توان با استفاده از نمای کابین/پل، به صورت دستی به صورت اول شخص هدایت کرد. این نما همچنین قابلیت استفاده برای بازی‌های واقعیت مجازی (VR) را دارد.

مود بازی نقش‌آفرینی (RPG)
عنصر RPG این بازی از اصل پیشرانه اقتصاد Star Atlas ناشی می‌شود. با استخراج مواد خام و پالایش آن‌ها به اجزای مختلف و آیتم‌های درون بازی، بازیکنان قادر به ایجاد یک “کریر (Career)”برای خود هستند. مسیر کریری مورد انتخاب بازیکنان، تخصص‌های ایجادکننده جریان درآمدی برای آن‌ها را تعیین می‌کند.

مود شبیه‌سازی پرواز فضایی
مود شبیه‌سازی پرواز فضایی بازی ارز دیجیتال استار اطلس به همراه گرافیک‌های ریل تایم خیره‌کننده، یک تصویر اول شخص نشسته درون یک سفینه فضایی را در حین سفر به اعماق فضا نشان می‌دهد. سفینه‌ها قابلیت هدایت دستی دارند، یا بازیکنان می‌توانند کاپیتان سفینه‌های خود باشند، در نبردها شرکت کنند و از مکانیک‌های بازی بهترین بهره را ببرند. بازیکنان با استفاده از نمای کابین قادر به کنترل دستی دریچه گاز، اهرم پرواز و پنل‌های کنترل پیچیده هستند. به علاوه، بازیکنان می‌توانند با استفاده از هدست‌های واقعیت مجازی (VR) خود را در بازی غرق کنند.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="توکن های ارز دیجیتال بازی استار اطلس"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"اقتصاد درون بازی ارز دیجیتال Star Atlas به کاربران اجازه می‌هد تا از طریق به چالش کشیدن دیگر بازیکنان و تشکیل تیم جهت «سازمادهی، ساخت و مبارزه در قلمروهای ناشناخته»، فرمانروایی‌های بین کهکشانی خود را بسازند. در ابتدا، این امر شامل یک گروه نسبتا کوچک از کلونی‌های ماینینگ و سفینه‌های فضایی خواهد بود. با این حال، هدف این بازی تبدیل شدن این گروه‌ها به تمدن‌های پر رونقی است که در عین «تکرار مداوم فناوری‌های بیگانه و دیپلماسی بین کهکشانی»، به کاوش در جهان گسترده می‌پردازند.

علاوه بر این، اقتصادی بازی ارز دیجیتال استار اطلاس در عین همکاری با اعضای فرقه‌ها، «همسویی تولید محصولات با هر دوی پیشرفت بلند مدت و سرگرمی کوتاه مدت بازیکنان» را هدف قرار داده است.

اکثر بازی‌های MMO (سبک چند نفره آنلاین بزرگ) نیازمند به پایان رساندن وظایف تکراری و استفاده از روش‌های تشویقی کوچکی هستند که باعث خستگی و کمبود هیجان در بازیکنان می‌شود. اما استار اطلس با استفاده از یک سیستم درخت مهارت (Skill Tree)، خستگی بازیکنان را کاهش می‌دهد. بازیکنان نیز قادر به تخصیص زمان و منابع خود به فعالیت‌هایی هستند که با اهداف شخصی یا اهداف تعیین‌شده توسط فرقه یا کریر آن‌ها سازگاری دارد. علاوه بر این، پیشرفت درخت مهارت، امتیازها و پاداش‌های ویژه‌ای را برای بازیکنان فعال می‌سازد که امکان خرید آن‌ها با استفاده از توکن محلی ATLAS وجود دارد.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="ارز دیجیتال ATLAS چیست؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"توکن ATLAS ارز درون اکوسیستم کریپتویی استار اطلس است. این ارز دیجیتال که به عنوان «روان‌کننده این متاورس» فعالیت می‌کند، واحد تبادل برای خرید و فروش دارایی‌های داخل بازی است. این دارایی‌ها شامل وسایل نقلیه، خدمه، زمین، تجهیزات، مواد خام و محتویات هستند.

توکن ATLAS همچنین برای اجرای نیازمندی‌های عملیاتی در بازی استار اطلس لازم است. حالا این امر می‌تواند به صورت تراکنش‌های همتابه‌همتا باشد یا از طریق تجار شخصیت‌های غیر قابل بازی (NPC) صورت پذیرد. بازیکنان نیز باید با دقت هزینه‌های عملیاتی ماینینگ، سوخت، خدمه و تعمیرات وسایل نقلیه را متعادل کنند. برای این کار، بازیکنان باید برای پرداخت هزینه خریدهای درون بازی، مقداری توکن ATLAS داشته باشند. توکن اطلس همچنین ارز اصلی بازارچه NFT این بازی به شمار می‌رود.

80 درصد توکن‌های آتی ATLAS به بازیکنان با عملکرد خارق‌العاده در بازی پاداش داده خواهند شد. از مقدار اولیه این توکن، 20 درصد آن میان سهامداران توزیع می‌شود. 45 درصد هم به ایستگاه‌های ماینینگ تعلق می‌گیرد و 15 درصد دیگر هم برای جمع‌آوری منابع جهت توسعه این پلتفرم استفاده خواهد شد",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="توکن POLIS چیست؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"رمز ارز POLIS توکن حاکمیتی اکوسیستم Star Atlas محسوب می‌شود. پلیس به عنوان یک توکن کاربردی چند کاره، نشان‌دهنده سیاست اقتصادی استار اطلس هم در داخل بازی و هم در دنیای واقعی است. علاوه بر این، هولدرهای توکن POLIS می‌توانند برای مدیریت اقتصادهای خرد، به بخشی از یک شرکت مستقل غیرمتمرکز (DAC) تبدیل شوند. توکن POLIS به بازیکنان اجازه می‌دهد تا بر تمام افراد خارج از DAC که به دنبال ورود به قلمروهای مستقل آن‌ها هستند، هزینه، جریمه و مالیات اعمال کنند.

صرف نظر از اینکه کدام بازیکن مالک زمین یا تجهیزات درون آن قلمرو است، هولدرهای توکن پلیس قادر به کسب مالکیت قضایی قلمروها هستند. هولدرهای توکن POLIS همچنین می‌توانند فعالیت سایر بازیکنان در حوزه‌های قضایی خاص را محدود کرده و برای اجرای قوانین در یک منطقه قوانینی را وضع کنند. با این حال، برای تصویب این قوانین، به موافقت گروه بزرگی از بازیکنان نیاز است. هیچ دیکتاتوری به تنهایی و بدون همکاری دیگران قادر به وضع قوانین نیست.

علاوه بر این، هولدرهای توکن POLIS می‌توانند بر توسعه بازی Star Atlas تأثیر بگذارند. این امر شامل جنبه‌هایی از بازی مانند نرخ تورم، زمان‌بندی انتشار دارایی‌ها و جهت کلی بازی است. پس از توزیع اولیه 20 درصد از همه توکن‌های پلیس، تنها راه برای تولید این رمز ارزها، استیک کردن توکن ATLAS است. این استیکینگ درون خود بازی نیز اتفاق می‌افتد. با این حال، هر ارز دیجیتال ATLAS استیک‌شده، از استفاده درون بازی معاف خواهد بود.

توزیع این توکن طی دو مرحله انجام می‌گیرد. 20 درصد عرضه طی مرحله اول عرضه دارایی کهکشانی (Galactic Asset Offering) فروخته شد. مابقی نیز به عنوان پاداش میان استیکرها توزیع می‌شود.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="کیف پول های استار اطلس"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"از آنجایی که بازی Star Atlas روی شبکه سولانا ساخته شده، از تمام کیف پول‌های پشتیبان این بلاک چین می‌توان برای ذخیره این ارز دیجیتال استفاده کرد. محبوب‌ترین کیف پول سولانا Phantom نام دارد که برای ذخیره توکن اطلس نیز قابل استفاده است.

از جمله دیگر کیف پول های پشتیبان این شبکه می‌توان اتمیک والت، لجر نانو، اکسودوس و تراست ولت را نام برد.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="نابودی دارایی و مکانیک ضد تورمی ارز دیجیتال استار اطلس"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"بازیکنان با استفاده از «مناطق درگیری چند لایه»، قادر به انتخاب میزان ریسک در سناریوهای گیمینگ مختلف هستند. ریسک بالاتر، پاداش بیشتری را نیز به همراه دارد. بازیکنان همچنین می‌توانند در نبردهایی که سفینه فضایی‌شان را در معرض خطر نابودی قرار می‌دهد، شرکت کنند.

تخریب دارایی می‌تواند از طریق مکانیزم سوزاندن توکن، به نابودی دائمی دارایی‌ها منجر شود. برنده نبرد نیز می‌تواند توکن‌های غیرقابل تعویضی (NFT) که حریفش پشت سر گذاشته است را دریافت کند. برای حصول اطمینان از توزیع پاداش بدون نیاز به اعتماد به طرف دیگر، این فعالیت‌ها از طریق قراردادهای هوشمند اجرا می شوند. علاوه بر این، تیم توسعه مکانیسم‌های ضد تورمی را پیاده‌سازی کرده است که دسترسی به دارایی‌ها و منابع را در طول زمان کاهش می‌دهد.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="رسالت theta"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"Theta چیزی فراتر از یک تلاش ساده شرکت Silver TV در اجرای بلاکچین برای محصولات و خدمات فعلی خود بوده و پروژه مستقلی در نظر گرفته می‌شود. هدف اصلی این پروژه بازآفرینی سیستم استریم ویدئو برای ارائه محتوای کم هزینه فارغ از کیفیت و مکان است؛ اگرچه هنوز تلاش‌های زیادی برای راه‌سازی کامل پتانسیل سیستم استریم ویدئوی همتا به همتای مبتنی بر بلاکچین لازم است اما Theta شروع بسیار موفقیت‌آمیزی داشته است. 

استیو چن، یکی از هم بنیانگذاران یوتیوب که به صورت مشاور در پروژه Theta نیز مشارکت کرده است، به این پروژه امید زیادی داشته و معتقد است که همان گونه که یوتیوب صنعت سنی پخش ویدئو را در سال 2005 به چالش کشید، نوآوری‌های به کار رفته در Theta نیز صنعت مدرن استریم ویدئو را به چالش خواهند کشید. یکی از بزرگترین چالش‌های صنعت استریم ویدئوی مدرن، هزینه‌های بالای ارائه ویدئو به بخش‌های مختلف جهان بوده و این مشکل همگام با رشد فناوری های 4k، HD و ... بسیار آشکارتر شده است؛ علاوه بر این هزینه بالای ارائه ویدئو به بخش‌های مختلف جهان، باعث شده است که بیشتر درآمد حاصل شده از شبکه خرج ارائه خدمات شده و تولیدکنندگان محتوا سهم کوچکتری از درآمد محصولات خود داشته باشند که در نهایت باعث کاهش انگیزه و کاهش نوآوری می‌شود. 

از این رو Theta با استفاده از به اشتراک گذاری پهنای باند در ازای توکن، با ایجاد یک شبکه غیرمتمرکز همتا به همتا برای ارائه ویدئوهای با کیفیت بهتر و هزینه پایینتر، به این مشکل رسیدگی کرده است. در پلتفرم Theta بینندگان می‌توانند پهنای باند و منابع خود را به اشتراک گذاشته و در مقابل آن پاداش دریافت نمایند؛ در نتیجه با میزبانی شبکه ارائه محتوا یا CDN به وسیله یک سیستم همتا به همتا یا P2P، کیفیت استریم افزایش می‌یابد. از آنجایی که این مدل نیاز به توسعه یک زیرساخت گسترده برای شبکه را در عمل برطرف می‌نماید، به نوبه خود هزینه استریم ویدئو نیز کاهش یافته و در پی آن سهم تولیدکنندگان محتوا بالا رفته و به مشوقی برای نوآوری نیز تبدیل خواهد شد.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="نقشه راه Theta"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"در سال 2020، نسخه 2.0 شبکه اصلی منتشر شده و گره با کد نام Guardian آنلاین شد که باعث غیرمتمرکز ترن شدن و ایمنتر شدن کل شبکه شد. در انتهای همان سال، شمار گره‌های Guardian فعال در شبکه به 1240 مورد رسیده است. این گره‌ها سهام گذاری را آسان نموده که در پی آن در میان سال 2020 میزان کل سکه‌های THETA سهام گذاری شده در شبکه به 496 میلیون رسید. 

سایر تغییرات و بروز رسانی‌های اعمال شده در سال 2020، شامل معرفی سند باکس مخصوص قراردادهای هوشمند، انتشار اپلیکیشن Theta.tv  برای پلتفرم anroid TV، اضافه شدن امکان استریم ویدئوهای درخواستی یا VOD به اپلیکیشن THETA.tv، انتشار نسخه بتای مخزن داده  بلاکچین با استفاده از ETL/Google BigQuery و انتشار نسخه بتای سیستم مدیریت حقوق دیجیتال یا DRM برای استریم‌های نیازمند مجوز می‌شود. 

بنیاد Theta امیدوار است که سال 2021 دوره‌ای از رشد تصاعدی را به ارمغان داشته باشد و به همین دلیل برنامه‌های زیادی برای آن سال تدارک دیده است که شامل انتشار نسخه 3.0 از شبکه اصلی شامل گره‌های Elite Edge و سیستم‌های سهام‌گذاری و سوزاندن ارز TFUEL، اجرای اپلیکیشن توزیع یافته LINE و ادغام آن با Theta، توانایی کش کردن پچ‌های بازی، به روز رسانی‌های نرم‌افزاری و ... برای گره Edge و نسخه v2 از پلتفرم توسعه قراردادهای هوشمند هستند",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="استخراج، معامله و سرمایه‌گذاری بر روی Theta"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"توکن اصلی این شبکه THETA نام دارد که حداکثر شمار سکه‌های آن به 1 میلیارد محدود شده است. بیشترین قیمت این ارز دیجیتال در 20 ژانویه سال 2018 و برابر با 0.29 دلار ثبت شده است. 

یک رویداد خصوصی ICO یا توزیع سکه اولیه از 8 ژانویه سال 2018 تا 8 فوریه همان سال برگزار شده که تقریبا 300 میلیون سکه THETA به قیمت 20 میلیون دلار را به فروش رسانید. توزیع اولیه سکه‌های این ارز شامل 30 درصد برای سرمایه‌گذاران ICO اولیه، 22.5 درصد برای ذخیره شبکه  teta  و 15 درصد برای شرکای شبکه، 7.5 درصد برای مشاوران شبکه و  25 درصد نهایی برای استخراج‌کنندگان در نظر گرفته شده است. 

THETA در اوایل راه‌اندازی شبکه یک توکن بر پایه ERC-20 اتریوم بود و پس از اجرای شبکه اصلی theta در سال 2019، این توکن‌ها به صورت یک به یک به توکن بومی خود شبکه تعویض شدند. این ارز با استفاده از الگوریتم اثبات دارایی یا PoS قابل استخراج بوده؛ همچنین سهام‌گذاری آن در شبکه با استفاده از یک توکن دوم شبکه با نام TFUEL پاداش داده می‌شود. بیشترین قیمت TFUEL در سال 2019  برابر 0.0235 دلار بوده و حداکثر میزان آن به 5 میلیارد سکه محدود شده است. 

THETA در صرافی‌های متعددی از قبیل Bithumb، DigiFinex و ... قابل معامله بوده و ارزش معاملات روزانه آن به بیش از 10 میلیون دلار رسیده است",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="آینده Theta و نظر کارشناسان"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"وب‌سایت WalletIvestor نظر بسیار مثبتی به این ارز داشته و قیمت آن را در حدود 23.535 دلار برای سال 2025 پیش‌بینی کرده است.

وب‌سایت DigitalCoinPrice نیز نظر مثبتی نسبت به Theta داشته و معتقد است که بهای آن در سال 2025 به 9.51 دلار خواهد رسید.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="مزایای Theta"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"داشتن یک تیم توسعه با تجربه و گرفتن مشاوره و همکاری از توسعه‌دهندگان یوتیوب
امکان کسب درآمد از اشتراک‌گذاری منابع 
هزینه پایین خدمات",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="معایب Theta"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"عملکرد پیچیده سیستم به خصوص برای افراد ناآشنا به حوزه ارزهای دیجیتال و استریم ویدئو

عدم بهره‌گیری از سکه‌های با قیمت پایدار به منظور تضمین سرمایه کاربران",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="ویژگی‌های ارز دیجیتال آوه گوچی (GHST) چیست؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"ابن پلتفرم غیر متمرکز و دارای قراردادهای هوشمند است. منبع باز بودن این پلتفرم نیز یکی دیگر از مزایای آن محسوب می‌شود. در حال حاضر می‌توان گفت که این پلتفرم یکی از بهترین پلتفرم‌هایی است که می‌تواند پروژه‌های ان اف تی را ارسال کند. این پلتفرم اکنون تلاش می‌کند تا بتواند تجربه‌ی بازی را در میان کاربران ارتقا بخشد.

شاید این پلتفرم را بتوان با پلتفرم AxieInfinity مقایسه کرد که حرف اول را در بلاکچین اتریوم می‌زند. این دو شباهت‌هایی به یک دیگر دارند. در واقع می‌توان گفت هر پلتفرمی که با ان اف‌تی ها سروکار دارو و البته دیفای است، با دیگر پلتفرم‌ها شباهت‌هایی دارد. اما تفاوت این دو پلتفرم در این است که آوه گوچی بیشتر بستری برای ساخت بازی است، در حالی که اکسی اینفینیتی بیشتر به عنوان ابزاری برای بازی محسوب می‌شود. این مفاهیم متفاوت، هر چند در یک حیطه فعالیت می‌کنند، اما نتایجی کاملا متفاوت از یکدیگر دارند.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="ارز دیجیتال آوه گوچی (GHST) چگونه عمل می‌کند؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"مهم‌ترین کاری که این پلتفرم انجام می‌دهد ترکیب ان اف تی و دیفای است. این پلتفرم یک دیفای بسیار قوی است که از ان اف تی‌ها پشتیبانی می‌کند و به کاربران وام و موقعیت‌های سودآور اعطا می‌نماید. از آنجا که خود پلتفرم آوی یکی از بزرگترین پلتفرم‌ها برای اعطای وام در حوزه دیفای است، کاربران می‌توانند با کمک گرفتن از آن، وام دریافت کرده و در پلتفرم آوی گوچی ان اف تی‌ها را دریافت نمایند. به عبارت ساده با قراردادن سپرده در آوی، می‌توانید آوی گوچی دریافت کنید.
البته با ارز اختصاصی آوی گوچی نیز می‌توانید معامله نمایید. از این ارز می‌توانید برای خرید لوازم و تجهیزات مربوط به پلتفرم آوی استفاده نمایید. واین پلتفرم دارای سطح کمیابی است. هر چه ان اف تی گرانبهاتر باشد، حق بیمه بالاتر در بازار ثانویه به آن تعلق می‌گیرد.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="آینده ارز دیجیتال آوه گوچی (GHST)"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"از ارز اختصاصی این پلتفرم می‌توانید در امور حکمرانی استفاده کنید. اما هدف اصلی که قرار است این پلتفرم به آن برسد، این است که با استفاده از امکاناتی که در اختیار کاربران قرار می‌گیرد، انگیزه‌هایی برای کاربران پروژه ایجاد شود.

وقتی سرمایه‌گذاران از این ارز در آینده استفاده کنند می‌توانند میزان کل ارز اختصاصی این پلتفرم را که در گردش است افزایش دهند. وقتی خریدهای خالص افزایش یابد، تورم ایجاد شده و در نتیجه قیمت افزایش می‌یابد پورتال این پلتفرم به کاربران امکان شروع با ۱۰ آوا گوچی را می‌دهد که فقط یکی را می‌توانید انتخاب کنید. ارزها با استاندارد توکن‌های  ERC20 یا aTokens پشتیبانی شده و به این وسیله توسط Aave ، ارزش ذاتی خود را افزایش خواهند داد",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="کلام آخر گوچی"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"ارزهای دیجیتال می‌توانند هم با یکدیگر ترکیب شوند هم مسیر رسیدن به پلتفرم دیگری را هموار کنند‌. همانطور که پلتفرم اوی راه رسیدن به پلتفرم آوه گوچی را هموار می‌کند. همه‌ی آن‌ها در نهایت رسیدن به یک هدف یعنی عدم تمرکز، امنیت و مقیاس پذیری را در نظر دارند.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="متاورس رمز ارزی بلاک توپیا چیست؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"بلاکتوپیا یک آسمان‌خراش واقعیت مجازی دارای 21 طبقه، به افتخار 21 میلیون واحد بیت کوین و دارای یک رمز ارز محلی به نام BLOK است. این متاورس واقعیت مجازی است که هدف تبدیل شدن به مرکز آموزشی-سرگرمی برای تمام سطوح تجربه رمز ارزی را دنبال می‌کند.

این برج مجهز به تکنولوژی پیشرفته که از یک دنیای در حال زوال برمی‌خیزد، مبتنی بر یک اقتصاد NFT محور است که اجازه مالکیت زمین و توسعه آن به عنوان یک ملک واقعیت مجازی را به کارآفرینان می‌دهد و کاربران می‌توانند با تبلیغات و رویدادها، فرصت‌های کسب درآمد را داشته باشند
رمز ارزها، فناوری بلاک چین، واقعیت مجازی و واقعیت افزوده، همگی جهت ساخت یک مرکز غیرمتمرکز برای بازیکنان، سرمایه‌گذاران، توسعه‌دهندگان و کارآفرینان آینده ظهور کرده‌اند.

بلاکتوپیا برای پشتیبانی از 4 جنبه اصلی خود به نام‌های یادگیری (Learn)، کسب درآمد (Earn)، بازی (Play) و خلق (Create)، از بلاک چین رمز ارزی پالی گان (Polygon) استفاده می‌کند و روی یک موتور بازی چند پلتفرمی به نام Unity (محصول بنیان‌گذاران واقعیت مجازی سونی پلی استیشن) ساخته شده است. این متاورس به بازدیدکنندگان اجازه می‌دهد تا در یادگیری ابتدایی و پیشرفته شرکت کرده، با دوستان خود بازی کنند، شبکه‌ها را بسازند و کارهایی از این قبیل را انجام دهند.

شبکه رمز ارزی بلاکتوپیا شبیه به یک مرکز خرید بزرگ است که فروشگاه‌ها در کنار دیگر گونه‌های فعالیت‌ها و کسب و کارها حضور دارند و پروژه‌ها، صرافی‌ها، اینفلوئنسرها یا برندهای ارز دیجیتال، محتوا و پیام‌های کلیدی خود را به نمایش می‌گذارند.

بلاک توپین‌ها (Bloktopian) هولدرهای ارز دیجیتال BLOK و از اعضای متاورس بلاک توپیا هستند. در این دنیا، بازیکنان برای اولین بار به اطلاعات و محتوای گیرای رمز ارزها در یک مکان واحد دسترسی دارند. بلاکتوپین‌ها قادر به یادگیری، بازی و کسب درآمد از طریق مالکیت املاک و مستغلات، تبلیغات و موارد بسیار دیگر هستند. بلاکتوپیا که به پیشرفته‌ترین موتور بازی‌های ویدیویی ریل تایم در جهان به نام 3D Creation Engine مجهز است، از این فناوری برای خلق تجسم‌های خیره‌کننده و تجارب کاربری استفاده خواهد کرد.

متاورس بلاک توپیا دارای ویژگی‌هایی است که هولدرهای توکن BLOK قادر به خرید و مدیریت هستند.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="همکاری الروند با متاورس ارز دیجیتال بلاک توپیا"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"از آنجایی که بازیکنان به صورت پیش فرض در طبقه اول شبکه رمز ارزی بلاکتوپیا ظاهر خواهند شد، الروند نیز به عنوان یک «مستاجر اصلی»، دفتر مرکزی مجازی‌اش را در این طبقه قرار خواهد داد. Elrond مجاز به نمایش حداکثر یک سالن سفارشی است و محتواهایی نظیر عملکردهای اکوسیستم رمز ارزی یا مستندسازی در یک مکان مجازی ارائه می‌شود.

دنیل صرب (Daniel Serb)، رئیس توسعه کسب و کار الروند، اخیرا در پستی گفته است که:

ما به دنبال بررسی یکپارچگی‌های فنی عمیق‌تر با شبکه بلاک توپیا همچون تبدیل بخشی از عرضه ارز دیجیتال BLOK به رمز ارز ESDT (توکن محلی الروند) هستیم تا کاربران الروند دسترسی راحت‌تری به متاورس واقعیت مجازی Bloktopia داشته و NFTهای آن در بازارچه‌های بلاک چین Elrond قابل خرید باشند.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="چه کسانی از بلاکتوپیا بازدید خواهند کرد؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"به استناد یک تحقیق جدید، 90 درصد بازیدکنندگان متاورس رمز ارزی بلاک توپیا، مردان بین 18 تا 34 سال خواهند بود. این افراد علاقه بارزی به رمز ارزها و توکن‌های غیر قابل تعویض داشته و بین 20 تا 50 هزار درآمد دارند. این افراد از طریق اخبار درباره ارزهای دیجیتال شنیده و بر بازارهای ایالات متحده، آسیا و انگلستان متمرکزند",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="یادگیری، کسب درآمد، بازی و خلق؛ چهار ستون متاورس رمز ارزی بلاک توپیا"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"متاورس بلاکتوپیا از چهار ستون یادگیری، کسب درآمد، بازی و خلق ساخته شده است.

یادگیری
بلاک توپیا مرکز اصلی است که کاربران قادر به یادگیری درباره دنیای ارز دیجیتال هستند. کاوش در این دنیا حتی می‌تواند چالش‌برانگیز باشد.

کسب درآمد
بلاکتوپین‌ها فرصت‌های کسب درآمد زیادی از طریق خرید ملک و حتی سوداگری به وسیله آن به صورت فروش مجدد با قیمت بالاتر یا اجازه به یک مستاجر دارند. از دیگر فرصت‌های کسب درآمد در متاورس رمز ارزی بلاکتوپیا می‌توان به درآمد منفعل، استیکینگ و تبلیغات اشاره کرد.

بازی
کاربران می‌توانند از طریق تعامل اول شخص دنیای واقعیت مجازی به استراحت، خوش‌گذرانی، معاشرت و رقابت با دوستان خود در متاورس رمز ارزی بلاک توپیا بپردازند.

خلق
کاربران می‌توانند از طریق یک ابزار ساخت ساده، از خلاقیت خود برای تولید صحنه‌ها، اثر هنری و حتی شرکت در رویدادها برای بردن جوایز استفاده نمایند.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="از کجا و کدام صرافی ارز دیجیتال بلاک توپیا بخریم؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"در حال حاضر صرافی‌های کمی ارز دیجیتال BLOK را به لیست جفت‌های ارزی خود افزوده‌اند. صرافی‌هایی مانند اکی‌اکس، کوکوین، Gate.io، بیترو (Bitrue) و ZT از جمله این پلتفرم‌ها هستند. هنوز BLOK در بایننس خرید و فروش نمی‌شود. در صورت اضافه شدن ارز دیجیتال نام برده به بزرگترین صرافی رمز ارزی دنیا، قیمت آن رشد قابل توجهی خواهد داشت.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="متاورس چیست؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"برای درک بهتر مفهوم متاورس بیایید ابتدا نگاهی به معنای آن داشته باشیم. متاورس از دو بخش متا (Meta) و ورس (Verse) تشکیل شده است؛ متا یعنی «ماورا» و ورس هم یک اشتقاق معکوس از کلمه «Universe» است. در نتیجه متاورس یعنی دنیایی ماورایِ دنیای حقیقی ما.

متاورس یک مفهوم گسترده است؛ ولی عموماً به یک دنیای مجازی و ۳ بُعدی گفته می‌شود که افراد مختلف می‌توانند از طریق اینترنت به آن متصل شده و با یکدیگر تعامل داشته باشند.

متاورس را می‌توان به دنیاهایی که توسط واقعیت‌های مجازی و واقعیت‌های افزوده ساخته می‌شوند هم نسبت داد. در واقع متاورس هر دنیای مجازی‌ای است که کاربر می‌تواند در آن شخصیت خود را بسازد و فعالیت‌های مختلفی را انجام دهد.

ظهور و رشد صنعت بازی‌های رایانه‌ای باعث شد تا متاورس و جهان‌های مجازی که بازیکنان در آنها می‌توانند در یک دنیای ساختگی شخصیت خودشان را بسازند، به جاهای مختلف دنیای بازی سرک بکشند و با بازیکنان دیگر تعامل برقرار کنند، به مرحله‌ای تازه وارد شود.

با افزایش نفوذ بلاک چین در دنیای فناوری، پای متاورس به بازی‌های بلاک چینی هم باز شد. در این بازی‌ها، افراد می‌توانند آیتم‌های بازی را در قالب توکن معامله کنند. نوع عملکرد بازی‌های متاورس در بلاک چین، تفاوتی با بازی‌های غیر بلاک چینی ندارد و فقط دارایی‌های بازیکن در بازی به‌صورت توکن در آمده است.

مثلاً در یکی از این بازی‌ها، بازیکنان زمین‌های خود را می‌فروشند یا در بازی دیگر جنگجوها توکن‌هایی از شمشیرها و زره‌های خود دارند و می‌توانند آنها را در بازارهای آنلاین به دیگر بازیکنان بفروشند.

بسیاری از کارشناسان و متخصصان امر معتقدند توسعه بیشتر متاورس تأثیری در بحث مشاغل و زندگی روزمره انسان‌ها نخواهد داشت ولی تأثیر آن در فرهنگ و جامعه به‌عنوان یک کل، انکارناپذیر است. صد البته در ادامه خواهیم دید که در صورت برآورده‌شدن تمام آرمان‌های متاورس، زندگی ما دگرگون خواهد شد.

متاورس یک مفهوم است؛ نمی‌توان آن را یک نرم‌افزار یا یک محیط بازی در نظر گرفت. در واقع متاورس یک جهان مجازی است که کاربران می‌توانند شخصیت خود را در آن داشته باشند و هر کاری که در دنیای واقعی انجام می‌دهند را به‌صورت مجازی انجام دهند",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="فیس‌بوک و متاورس"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"شرکت فیس‌بوک،‌ غول حوزه فناوری، یکی از شرکت‌های پیشرو در حوزه متاورس است. این شرکت پیش‌تر بودجه‌ای ۵۰ میلیون دلاری برای توسعه پروژه متاورسی خود (XR Programs and Research Fund) کنار گذاشته بود.

فیس‌بوک به‌تازگی طی اطلاعیه‌ای اعلام کرد که تمام خدمات خود را زیر چتر نام «مِتا» (Meta) ارائه می‌کند. این تغییر نام،‌ یعنی شبکه‌های اجتماعی فیس‌بوک و اینستاگرام و پیام‌رسان واتس‌اپ از این پس زیرمجموعه‌های متا خواهند بود.

مارک زاکربرگ، مدیرعامل فیسبوک، در یک کنفرانس مجازی در این‌باره گفت:

امیدوارم در آینده به‌عنوان یک شرکت متاورس دیده شویم و قصد دارم کار و هویت خود را با آنچه در حال ساخت آن هستیم، تطبیق دهم. ما اکنون به‌عنوان دو بخش مختلف به کسب‌و‌کار خود نگاه می‌کنیم و گزارش می دهیم؛ یکی برای خانواده اپ‌هایمان و دیگری برای تلاشی که در پلتفرم‌های آینده انجام می‌شود. حالا به‌عنوان بخشی از پروژه، زمان آن فرا رسیده است که یک برند جدید اتخاذ کنیم تا همه کارهایی را که انجام می‌دهیم در بر گیرد؛ تا منعکس کنیم چه کسی هستیم و قصد ساخت چه چیزی را داریم.

با توجه به پتانسیل‌های بالای فیس‌بوک و همچنین منابع مالی گسترده این شرکت، به نظر می‌رسد که باید منتظر یک بازیگر قدرتمند در حوزه متاورس‌ها باشیم. از طرف دیگر، فیس‌بوک با شرکت‌های مختلفی برای توسعه متاورس خود همکاری می‌کند و همین مسئله می‌تواند ابعاد این پروژه را گسترده‌تر کند.

بسیاری هم پروژه دییم (Deim)، ارز دیجیتال فیس‌بوک را به متاورس مرتبط می‌دانند و می‌گویند این استیبل کوین می‌تواند تعاملات مالی افراد در متاورس را دگرگون کند.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="ملاقات‌های مجازی و قرارهای کاری"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"در زمان کرونا، ویدیوهایی از لباس‌های نامناسب افراد در هنگام مصاحبه‌های کاری و جلسات منتشر شد. این ویدیوها تا حدی باعث خجالت افراد می‌شد؛ ولی با توسعه متاورس، دیگر خبری از این مشکلات نیست.

شما می‌توانید در متاورس شخصیتی با لباس دلخواه ایجاد و در جلسات و ملاقات‌های مجازی شرکت کنید. فیس‌بوک پیش‌تر به این حوزه وارد شده و هورایزن ورک‌رومز (Horizon Workrooms) را توسعه داده است. هورایزن ورک‌رومز یک سرویس واقعیت مجازی (Virtual Reality) و واقعیت ترکیبی (Mixed Reality) است که جلسات را خارج از چهارچوب سنتی برگزار می‌کند.

هدف این سرویس، ایجاد یک محیط دیجیتالی است که کاربران بتوانند آواتاری از خود بسازند و در قالب این آواتار با یکدیگر تعامل داشته باشند. تعاملات آنها در محیط مجازی همانند دنیای واقعی خواهد بود؛ یعنی اگر هورایزن ورک‌رومز بتواند به هدف اصلی خود برسد، دیگر خبری از هزینه‌های هنگفت اجاره‌بها برای شرکت‌ها نخواهد بود؛ چراکه دیگر نیازی به حضور کارکنان در زیر یک سقف نیست و همه آنها می‌توانند در قالب شخصیت‌هایی مجازی با یکدیگر تعامل داشته باشند.

کار روی توسعه سرویس‌های مشابه، در دوران کرونا سرعت بیشتری گرفت؛ چراکه بسیاری از شرکت‌ها تصمیم گرفتند به‌صورت دورکاری به فعالیت خود ادامه دهند و همین موضوع نیاز به نرم‌افزارها و زیرساخت‌های ارتباط از راه دور را بیش از پیش پررنگ کرد.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="آموزش مجازی"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"همان طور که می‌دانیم، در دوران کرونا و قرنطینه تقریباً مدارس تمام دنیا تعطیل شد و بسیاری از کشورها از جمله ایران، به سراغ آموزش مجازی و آنلاین رفتند.
شرکت‌های بسیاری در راستای پاسخ به نیازهای آموزش مجازی و کلاس‌های آنلاین، نرم‌افزارها و خدمات مختلفی را ارائه کردند. نرم‌افزارهای ارتباطی، نرم‌افزارهای تعیین کارایی و کیفیت تحصیل و همچنین ابزارهایی برای تعامل بیشتر در محیط آموزش مجازی، از جمله مواردی بودند که در دوران قرنطینه با رشد همراه شدند.

درست مانند مجازی‌‌کردن روند کسب‌وکارها و تعاملات در محیط کار، محیط آموزشی هم نیاز به تغییراتی بنیادی دارد و متاورس می‌تواند تا حد زیادی به تحقق این رویاها کمک کند. از جمله کاربردهای متاورس در حوزه آموزش مجازی، می‌توان به بازی‌سازی از روند آموزش و آموزش از راه دور از طریق تماس‌های ویدیویی اشاره کرد.

بسیاری از کارشناسان حوزه آموزش و فناوری می‌گویند دانشگاه‌ها و مدارسی که از امکانات دیجیتالی بهتری برخودار باشند، می‌توانند خیلی زود رشد کرده و به رهبران این حوزه تبدیل شوند.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="کسب درآمد از بازی‌کردن"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"بازی‌های زیادی هستند که با فروش آیتم‌ها و به‌روزرسانی‌ها درآمد هنگفت دارند. در واقع آنها با عرضه چنین محصولاتی به بازیکنان انگیزه بازی‌کردن بیشتر می‌دهند. با ظهور بازی‌های موبایلی مثل پابجی (PUBG)، کندی کراش (Candy Crash) و کلن وارز (Clan Wars)، این حوزه با رشد گسترده‌ای همراه شد و حالا کمتری کسی را می‌توان پیدا کرد که تجربه بازی‌کردن آنها را نداشته باشد.
تقریباً در همه این بازی‌ها، سکه، الماس یا پولِ مخصوصِ داخل بازی به بازیکنان داده می‌شود. آنها فقط می‌توانند در داخل محیط بازی از این ارزها و امتیازها استفاده کنند. مفهوم کسب درآمد از بازی‌کردن (Play-to-Earn) قرار است این روند را تغییر دهد.

در حال حاضر بازیکنان بسیاری در آسیای جنوب شرقی از طریق بازی اکسی اینفینیتی (AxieInfinity) کسب درآمد می‌کنند.

پروژه‌های بلاک چینی دیگری مثل دیسنترالند (Decentraland) و سندباکس (Sandbox) هم دنیای مجازی ساخته‌اند که کاربران می‌توانند از طریق بازی‌کردن، درآمد کسب کنند. در این بازی‌ها عموماً آیتم‌های بازی، نظیر زمین، آثار هنری و آیتم‌ها، به‌شکل توکن غیرمثلی (NFT) در می‌آیند و کاربران می‌توانند آنها را در پلتفرم‌های معاملاتی، خریدوفروش کنند. از آنجا که بیشتر آنها روی بلاک چین اتریوم کار می‌کنند، نقدکردن درآمد هم بسیار آسان است.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="خرید آنلاین"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"همین حالا هم سایت‌های بزرگ و معتبری را می‌توان نام برد که خرید آنلاین از آنها بسیار ساده است؛ تنها کافی است کالای موردنظرتان را انتخاب کنید، آدرستان را وارد کرده و هزینه آنها را بپردازید؛ چند روز یا حتی چند ساعت بعد کالا به دستتان می‌رسد.

در این میان مشکلاتی هم وجود دارند که به‌عنوان نقاط ضعف خرید آنلاین شناخته می‌شوند؛ مثلاً انتخاب سایز مناسب برای لباس‌ها یا فرایند طولانی بازگرداندن پول به حساب مشتری آزاردهنده است. حتی گاهی کالای مورد نظر شبیه آن چیزی نیست که به شما نشان داده شده و پس‌فرستادن کالا خود طولانی و وقت‌گیر است.

متاورس می‌تواند این مشکل را هم حل کند! مثلاً یک شرکت هندی که در حوزه فروش عینک فعالیت می‌کند، امکانی را فراهم کرده است که کاربران می‌توانند از طریق دوربین، به‌صورت مجازی عینک موردنظرشان را روی صورتشان ببینند.

با پیشرفت متاورس، خرید آنلاین هم شکل و شمایلی تازه به خود می‌گیرد و اتاق شخصی شما می‌تواند به‌عنوان یک اتاق پرو عمل کند!",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="گردشگری و سفر"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"گردشگری شاید یکی از حوزه‌هایی بود که از کرونا آسیبی جدی دید. سال گذشته کشورهای شاخص گردشگری مثل یونان و مصر با تدارک تورهای واقعیت مجازی، تا حدی آسیب‌های کرونا را کم کردند.
اگر متاورس بتواند به ایده‌های خود جامه عمل بپوشاند، شما می‌توانید بدون این که خانه خود را ترک کنید، از جذاب‌ترین مقاصد گردشگری بازدید کنید و حتی به‌عنوان یک جنگجو، در جنگ‌های صلیبی شرکت کنید. در واقع نه تنها متاورس به شما امکان بازدید از موزه‌ها، سازه‌های قدیمی و عجایب جهان را می‌دهد، بلکه می‌توانید در زمان هم سفر کنید. از سوی دیگر، هزینه‌های سنگین سفر مثل رفت‌وآمد، سوخت و هتل هم صفر می‌شود.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="کنسرت و جشن‌ها"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"در دوران کرونا بسیاری از هنرمندان کنسرت‌های آنلاین برگزار کردند. شرکت‌های بزرگی مثل نتفلیکس هم با ارائه خدماتی نظیر نتلفلیکس پارتی (Netflix Party)، سعی کردند تا حدی در دوران کرونا کنسرت‌ها و جشن‌ها و دورهمی‌ها را بی‌خطر کنند.
پلتفرم سندباکس که پیش‌تر نام بردیم، پا را از این هم فراتر گذاشته و به کاربران اجازه می‌دهد فستیوال‌ها و رویدادهای مخصوص خودشان را ایجاد کنند. اسنوپ داگ، رپر مشهور، از جمله افرادی بود که در سندباکس خانه مجلل خود را ساخت و با فروش بلیت‌های VIP، کاربران را به شرکت در کنسرت مجازی دعوت کرد.

افزایش نیاز به تعاملات مجازی و گسترش مفهوم متاورس، باعث شد تا زمین‌ها در دنیاهای مجازی مثل متاورس و دیسنترالند با قیمت‌های میلیون دلاری خریدوفروش شوند.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="مالکیت دیجیتال"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"خریدوفروش آثار هنری در دنیای واقعی ما، امری عادی است و خیلی از افراد ثروتمند به‌دنبال خرید این دارایی‌ها هستند تا آنها را به کلکسیون‌های خود اضافه کنند. خیلی‌های دیگر هم املاک و مستغلات می‌خرند تا از شر تورم راحت شوند.

آثار هنری و زمین‌های مجازی در متاورس هم طرفداران زیادی پیدا کرده است و افراد زیادی را می‌توان پیدا کرد که در متاورس زمین و آثار هنری می‌خرند و می‌فروشند. مالکیت این دارایی‌ها به‌لطف توکن‌های غیرمثلی ممکن می‌شود؛ مثلاً در متاورس، هر قطعه زمین یک توکن غیرمثلی است و هر کسی که توکن را در کیف پول خود داشته باشد، مالک آن زمین است.

داستان آثار هنری هم به همین شکل است و هر کسی که توکن اثر را در اختیار داشته باشد، در واقع صاحب آن است.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="تفریح"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"متاورس و تلفیق آن با فناوری واقعیت مجازی و واقعیت افزوده، این امکان را به کاربران می‌دهد که بدون ترک صندلی‌شان، فعالیت‌هایی مثل قایق‌سواری، فوتبال و پرش از ارتفاع را تجربه کنند. حتی آنها می‌توانند غذاهای عجیب‌وغریب کشورهای دیگر را بچشند و تجربه‌هایی را داشته باشند که در دنیای واقعی نیازمند صرف هزینه و وقت زیادی است.

دنیاهای مجازی مثل ماین کرفت (Minecraft)، سکند لایف (Second Life) و ایو آنلاین (EVE Online)، تجربه‌هایی مشابه را در دنیایی کاملاً ساختگی برای کاربران فراهم می‌کنند.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="تعامل با رایانه"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"اختراع صفحات لمسی انقلابی در صنعت تلفن‌های همراه ایجاد کرد و حالا کمتر تلفن همراهی را پیدا می‌کنید که از این صفحات استفاده نکنند. با افزایش نفوذ سخت‌افزارهای واقعیت مجازی و متاورس، باید منتظر تغییرات بنیادین در تعامل کاربران و رایانه‌ها بود. مثلاً به جای آن که انگشت خود را روی صفحه تلفن همراه بکشید، می‌توانید با حرکت دست‌ها در هوا فرمان‌های موردنظرتان را به رایانه بفهمانید.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="اقتصاد"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"ظهور امور مالی غیرمتمرکز (DeFi) به‌گفته بسیاری، اتفاقی انقلابی بود. از طرف دیگر، بانکداری و امور مالی سنتی در متاورس جایی ندارد و همین مسئله به معنای ان است که دیفای و ارزهای دیجیتال می‌توانند در متاورس جایگاهی پراهمیت داشته باشند.

در واقع به‌لطف همین امور مالی غیرمتمرکز است که NFTها و دارایی‌های دیجیتال می‌توانند در تعاملات مالی دنیاهای مجازی مورد استفاده قرار گیرند.

اگر بانک‌ها و مؤسسات مالی همچنان رویکردی منفعل در این حوزه پیش بگیرند، احتمالاً از رقابت حذف می‌شوند؛ چراکه روزبه‌روز افراد بیشتری به‌سمت تعامل با متاورس پیش می‌روند و همین مسئله نیاز به راهکارهای نوین مالی را بیشتر می‌کند.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="عادت‌ها و هنجارهای زندگی"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"فرض کنید یک رایانه شخصی می‌خرید؛ رایانه بدون موس و صفحه کلید قابل استفاده نیست. با پذیرش بیشتر متاورس، نیاز به خرید سخت‌افزارها خاص و مناسب هم تغییر می‌کند.

شاید حالا بتوان با یک دوربین و وبکم معمولی هم در متاورس تعامل داشت ولی با پیشرفت بیشتر آن، نیاز به سخت‌افزارهای ویژه بیشتر می‌شود.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="پراجکت کامبریا"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"همان طور که پیش‌تر گفتیم، متا یا همان فیس‌بوک سابق، عزمش را جزم کرده تا حضوری پررنگ و قدرتمند در متاورس داشته باشد. پراجکت کامبریا (Project Cambria) هم یکی از تلاش‌های فیس‌بوک برای هدف قراردادن کاربران عادی است. این پروژه در واقع یک سخت‌افزار واقعیت مجازی است.

فیس‌بوک پیش‌تر هم عینک واقعی مجازی اکولوس ریفت (Oculus Rift) و اکولوس کوئست (Oculus Quest) را معرفی کرده بود؛ ولی به نظر می‌رسد پراجکت کامبریا راهی متمایز از این دو محصول را در پیش گرفته است. متا در این باره می‌گوید:

یک دستگاه با جدیدترین فناوری‌ها و قیمت بالاتر؛ قیمت بالاتر [دستگاه] به‌دلیل استفاده از جدیدترین فناوری‌ها در آن است.

متا ادعا می‌کند که این سخت‌افزار حضور اجتماعی افراد را بیشتر می‌کند و با توجه به این توصیف، باید انتظار یک محصول انقلابی را داشت که تعاملات اجتماعی ما را دگرگون خواهد کرد.

طبق شایعات، پراجکت کامبریا از یک فناوری به نام پَس‌ترو (Passthrough) استفاده می‌کند؛ یعنی کاربران با استفاده از هدست یا همان سخت‌افزاری که بالاتر آن را معرفی کردیم، می‌تواند وارد یک دنیای مجازی شوند و در آنجا با دیگر کاربران تعاملات اجتماعی داشته باشند.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="دیسنترالند"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"دیسنترالند (Decentraland) یک پلتفرم بازی‌های رایانه‌ای است که بر پایه فناوری توکن‌های غیرمثلی و قراردادهای کار می‌کند. این پلتفرم سال ۲۰۱۶ کار خود را آغاز کرد. در دیسنترالند کاربران می‌توانند یک شخصیت برای خود بسازند و در دنیای مجازی بازی گشت‌وگذار کنند و با دیگر کاربران تعامل داشته باشند.

تجربه بازی دیسنترالند شباهت زیادی با ماین کرفت و سکند لایف دارد. در این بازی کاربران می‌توانند آیتم‌هایی مثل قطعه زمین یا موارد دیگر را در بازارهای مختلف بفروشند. هر آیتم در بازی یک توکن غیرمثلی است و مالکیت آنها هم با استفاده از همین توکن‌ها تضمین می‌شود.

مانا (MANA) توکن بومی دیسنترالند است. مانا همچنین ارز بازی است و کاربران می‌توانند با استفاده از این توکن، آیتم‌های بازی را معامله کنند.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="اکسی اینفینیتی"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"اکسی اینفینیتی (AxieInfinity) یک متاورس و پلتفرم بازی‌های رایانه‌ای است. در این بازی کاربران می‌توانند جانوران مجازی خود را پرورش دهند و کسب درآمد کنند. در واقع هر جانور در داخل بازی یک توکن غیرمثلی با ویژگی‌های خاص است.

بازیکنان اکسی اینفینیتی را نباید با معامله‌گران آن اشتباه گرفت؛ آنها فقط بازی می‌کنند و به‌دنبال جانواران مختلف بازی می‌گردند. گزارش‌ها نشان می‌دهد تقریباً ۶۰ درصد فلیپینی‌ها این بازی را انجام می‌دهند و حتی به منبع درآمد اصلی آنها تبدیل شده است.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="سندباکس"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"سندباکس (Sandbox) یک پلتفرم مجازی بر بستر اتریوم است که کار خود را از سال ۲۰۱۲ آغاز کرده است. سندباکس امکان سرمایه‌گذاری و بازی‌کردن هم‌زمان کاربران را فراهم کرده است. معامله‌گران همچنین می‌توانند توکن‌های سندباکس را معامله و از نوسانات آن سود کسب کنند.

سندباکس در واقع یک اکوسیستم برای ساخت، به‌اشتراک‌گذاری و معامله دارایی‌های دیجیتال است. بیشتر این دارایی‌های در واقع آیتم‌های قابل‌معامله بازی‌های رایانه‌ای هستند. یک بازیکن در سندباکس می‌تواند با ساخت یک شخصیت، چندین بازی مختلف را انجام دهد.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="سؤالات متداول متاورس"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"چگونه می‌توان به متاورس دسترسی داشت؟
دسترسی به متاورس محدود به ساخت یک شخصیت است، ولی با پیشرفت آن احتمالاً داشتن عینک واقعیت مجازی یا سخت‌افزارهای ویژه ضروری خواهد بود.

آیا متاورس یک نرم‌افزار است؟
خیر؛ متاورس یک مفهوم است. وقتی می‌گوییم به متاورس وارد شویم، یعنی از یکی از جنبه‌های آن استفاده کنیم.

در متاورس چه کارهایی می‌توان انجام داد؟
متاورس یک جهان مجازی با پتانسیل‌های نامحدود است؛ یعنی اگر تمام مفاهیم متاورس عملیاتی شود، شما می‌توانید یک شخصیت مجازی با ابتکار عملی بی‌نهایت داشته باشید.

مشهورترین پلتفرم‌های متاورس چیست؟
در حال حاضر سندباکس، دیسنترالند و اکسی اینفینیتی بزرگترین پلتفرم‌هایی هستند که در بحث متاورس فعالیت می‌کنند.

آیا برای ورود به متاورس هزینه‌ای باید پرداخت شود؟
جواب این سؤال بسته به پلتفرمی است که از آن استفاده می‌کنید؛ مثلاً‌ برای ورود به اکسی اینفینیتی شما باید سه اکسی (جانور داخل بازی) که در حال حاضر قیمتی بالاتر از ۱۰۰ دلار دارد، بخرید.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="جمع‌بندی متاورس"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"متاورس یک جهان مجازی است که کاربران می‌توانند شخصیت موردعلاقه خود را در آن بسازند و درست مانند زندگی واقعی، در آنجا زندگی کنند.

با ورود نام‌های بزرگی مثل متا (فیس‌بوک) به این حوزه، باید منتظر نفوذ بیش از پیش متاورس در زندگی روزمره خود باشیم. با پیشرفت متاورس بسیاری از کارهای روزمره ما مثل شرکت در کلاس‌ها، خرید و سفر دگرگون می‌شود و جنبه‌هایی کاملاً‌ متفاوت با زندگی فعلی به آن اضافه خواهد شد.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
//////////////////////
////////////////////
elseif($text=="کریپتوپانکس چگونه کار می‌کند؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"در زمان راه‌اندازی پروژه کریپتوپانکس، استاندارد توکن ERC-721 که امروزه در بسیاری از توکن‌های غیرمثلی استفاده می‌شود وجود نداشت. به این منظور لاروا لبز، شرکت توسعه‌دهنده این پروژه، مجبور شد توکن‌های کریپتوپانکس را بر اساس استاندارد ERC-20 طراحی کند.

با نگاهی به وب‌سایت اتر اِسکن (Etherscan) مشاهده می‌کنیم که عرضه کل این توکن‌ها مقدار ۱۰,۰۰۰ واحد است. اگرچه کریپتوپانک‌ها به‌عنوان توکن‌هایی با استاندارد ERC-20 عرضه شدند، آنها توکن‌های یکسانی نیستند و هریک ماهیت منحصربه‌فردی دارند.
زمانی که پروژه کریپتوپانکس برای اولین بار منتشر شد، امکان ذخیره‌سازی تصاویر آنها در بلاک چین، به‌دلیل حجم بالایی که داشتند وجود نداشت؛ بنابراین شرکت لاروا لبز یک هش از تصویر ترکیبی تمام آنها ایجاد و در قرارداد هوشمند این پروژه مستقر کرد.

شما می‌توانید با مقایسه هشِ تصویر کریپتوپانک‌ها و هشِ ذخیره‌شده در قرارداد هوشمند این پروژه، از صحت اعتبار کریپتوپانک‌هایی که قرارداد هوشمند بلاک چین اتریوم آنها را مدیریت می‌کند اطمینان حاصل کنید.

هریک از کریپتوپانک‌ها شامل اطلاعاتی هستند که نشان‌دهنده موقعیت آنها در تصویر ترکیبی است. برای نمونه کریپتوپانک شماره ۷۸۰۴، در واقع ۷۸۰۴مین کریپتوپانک از تصویر ترکیبی است.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="سازندگان کریپتوپانکس"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"شرکت لاروا لبز پروژه کریپتوپانکس را در سال ۲۰۱۷ به‌عنوان یک پروژه آزمایشی منتشر کرد. این شرکت توسعه‌دهنده نرم‌افزارهای موبایل واقع در شهر نیویورک است. از محصولات برجسته لاروا لبز می‌توان به بازی رترو دیفنس (Retro Defense) و اپلیکیشن ویرایش عکس فوتو توییست (PhotoTwist) اشاره کرد.

کریپتوپانکس (Crypto Punks) چیست؟
دو توسعه‌دهنده نرم‌افزار کانادایی که خود را «فناوران خلاق» می‌نامند، در سال ۲۰۰۵ لاروا لبز را تأسیس کردند. این شرکت در ابتدای راه‌اندازی بیش از ۵۰ اپلیکیشن برای موبایل‌های مدل T-Mobile Sidekick منتشر کرده است. پس از آن، این شرکت به توسعه اپلیکیشن‌های سیستم‌عامل‌های iOS و اندروید روی آورد و موفق شد بیش از ۲۰ اپلیکیشن برای آنها عرضه کند. طی چند سال اخیر، شرکت لاروا لبز وارد حوزه بلاک چین شد و پروژه‌های مختلفی از جمله کریپتوپانکس را ایجاد کرد. این شرکت همچنین سابقه همکاری با شرکت‌های معتبری همچون گوگل و مایکروسافت را در کارنامه خود دارد.

کریپتوپانکس (Crypto Punks) چیست؟
جان واتکینسون (John Watkinson) به‌‌همراه مت هال (Matt Hall) شرکت لاروا لبز را در سال ۲۰۰۵ تأسیس کردند. جان متخصص علوم کامپیوتر، توسعه‌دهنده نرم‌افزار و هنرمند کانادایی است. او مدرک دکتری خود را از دانشگاه کلمبیا در رشته مهندسی برق اخذ کرده است.

مت هال در دانشگاه ترینیتی کالج (University of Trinity College) در رشته علوم کامپیوتر تحصیل کرده است. از سوابق کاری او می‌توان به فعالیت به‌عنوان مهندس ارشد نرم‌افزار در شرکت مُدوس (Modus)، فعالیت به‌عنوان مهندس ارشد نرم‌افزار در مرکز پزشکی دانشگاه کلمبیا و هم‌بنیان‌گذاری شرکت داکرسی (Docracy) اشاره کرد.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="چرا کریپتوپانکس تا این حد محبوب است؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"شاید درباره NFTهایی که به قیمت‌های بیش از میلیون‌ها دلار به فروش می‌رسند شنیده باشید. در مارس ۲۰۲۱ (اسفند ۱۴۰۰)، NFT ساخته‌شده توسط یک هنرمند دیجیتالی که به بیپِل (Beeple) شهرت دارد، به قیمت بیش از ۶۰ میلیون دلار فروخته شد و سایر NFTها هم با قیمت‌های مشابهی به فروش رفتند. این مقوله درباره توکن‌های کریپتوپانکس هم صدق می‌کند؛ اما چرا؟

همان‌ طور که می‌دانید، خرید آثار هنری در قالب NFT شما را به یک مالک منحصربه‌فرد تبدیل می‌کند که مستندات تمام مالکان قبلی آن اثر در بلاک چین ذخیره شده است. این ماهیت، توکن‌های کریپتوپانکس را به NFTهایی مناسب برای سرمایه‌گذارانی تبدیل می‌کند که به بازار توکن‌های غیرمثلی علاقه دارند.

به‌طور کلی، ارزش یک NFT تنها در صورت افزایش محبوبیت و درک عمومی آن رشد می‌کند. با درنظرگرفتن همین معیار، این امکان هم وجود دارد که ارزش یک NFT در هر زمان به‌شدت کاهش یابد؛ بنابراین این‌گونه سرمایه‌گذاری‌ها می‌توانند بسیار سودآور یا بسیار ضررده باشند.

در سال ۲۰۱۷، زمانی که کریپتوپانکس برای اولین بار منتشر شد، توکن‌های آن به‌صورت رایگان توزیع شدند. تنها هزینه‌ای که شما برای دریافت این توکن‌ها متحمل می‌شدید، پرداخت کارمزد شبکه اتریوم بود؛ اما اکنون یک کریپتوپانک می‌تواند میلیون‌ها دلار ارزش داشته باشد.

توسعه‌دهندگان اصلی پروژه کریپتوپانکس، قبل از آنکه کریپتوپانک‌ها را برای فروش منتشر کنند، تعداد هزار واحد از آنها را برای خود نگه داشتند. در واقع از ۱۰,۰۰۰ واحد توکن کریپتوپانکس، تعداد ۹,۰۰۰ واحد از آنها برای فروش منتشر شده و مابقی آنها در دست تیم کریپتوپانکس است که از ارزش بالایی برخوردار هستند و هر از چندگاهی با قیمت‌های گزاف در بازار فروخته می‌شوند. این امر باعث شده تا توسعه‌دهندگان این پروژه به میلیون‌ها دلار ثروت‌ دست پیدا کنند.

کریپتوپانک‌ها علاوه بر اینکه می‌توانند ارزش بالقوه‌ای برای سرمایه‌گذاری داشته باشند، آثار هنری جالبی برای به‌رخ‌کشیدن هستند. هرچه یک کریپتوپانک کمیاب‌تر باشد، مالک آن پرستیژ بیشتری دارد.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="جمع‌بندی کریپتوپانکس"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"در این مقاله سعی کردیم کریپتوپانکس را که یکی از مجموعه‌های NFT محبوب این روزهاست، به‌طور کامل بررسی کنیم و نحوه کار آن، سازندگان آن، نحوه خرید و دلایل افزایش محبوبیت آن را به زبانی ساده توضیح دهیم.

کریپتوپانکس بدون شک یکی از مهم‌ترین پروژه‌های موجود در حوزه توکن‌های غیرمثلی است که بخش زیادی از ارزش آن به تاریخچه‌ای که دارد، و همچنین به کمیاب‌بودن آن برمی‌گردد. کریپتوپانکس در حقیقت اولین مجموعه NFT است که پیش از آنکه حوزه NFTها تا به این حد شناخته شود کار خود را آغاز کرد و به همین دلیل از اهمیت بالایی برخوردار است.

هنوز هم می‌توانید محبوبیت گسترده آنها را با تعداد پروژه‌هایی که به‌طور مستقیم از کریپتوپانکس الهام گرفته‌اند مشاهده کنید؛ پروژه‌هایی مانند لِگو پانکس (Lego Punks)، جوراسیک پانکس (JurassicPunks)، کیوتی پانکس (Cutie Punks)، رَپ پانکس (Rap Punks)، انیمه پانکس (Anime Punks) و بسیاری از پروژه‌های دیگر.

هنوز به‌طور دقیق معلوم نیست که آینده کریپتوپانکس به چه شکلی خواهد بود. هیاهوی پیرامون کریپتوپانک‌ها ممکن است از بین برود یا افزایش یابد؛ اما چیزی که مسلم است این است که کریپتوپانک‌ها به‌عنوان NFTهای قابل‌توجه در حوزه ارزهای دیجیتال تاریخ‌ساز شده‌اند.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="سؤالات متداول کریپتوپانکس"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"آیا می‌توان توکن‌های کریپتوپانکس را فروخت؟
بله. قرارداد هوشمند پروژه کریپتوپانکس به‌گونه‌ای طراحی شده است که شما می‌توانید توکن‌های خود را به هرکسی در دنیا بفروشید. شما می‌توانید از طریق بازار کریپتوپانکس در وب‌سایت لاروا لبز و همچنین پلتفرم‌ اوپن سی، کریپتوپانک خود را به فروش برسانید.

کریپتوپانکس را کجا ذخیره کنیم؟
شما می‌توانید برای نگهداری NFTهای خود از کیف پول‌های نرم‌افزاری اتریوم مانند متامسک (Metamask) و کیف پول‌های سخت‌افزاری مانند لجر (Ledger) استفاده کنید.

چند توکن کریپتوپانکس در مجموع وجود دارد؟
در مجموع ۱۰,۰۰۰ واحد کریپتوپانک تولید شده که تعداد ۱,۰۰۰ واحد از آنها در دست تیم این پروژه قرار دارد و ۹,۰۰۰ واحد دیگر برای فروش منتشر شده است.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="کریپتوپانکس چیست؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"مجموعه کریپتوپانک (CryptoPunks) از اولین پروژه‌‌های حوزه NFT ارزهای دیجیتال و به نوعی گران ترین آن‌ها بوده که بر بستر اتریوم راه‌اندازی شده است.


توکن‌ غیرقابل تعویض (Non-Fungible-Tokens) یا به اختصار NFT، یکی از داغ‌ترین موضوعات حوزه کریپتوکارنسی بوده که با آغاز سال 2021 و میلیون‌ها معامله، تنور آن گرم‌تر از هر زمان دیگری شد. پروژه کریپتوپانک برای اولین بار در ژوئن  2017 (خرداد ۱۳۹۶) راه‌اندازی شد و توسط یک تیم دو نفره شامل مت هال (Matt Hall) و جان واتکینسون (John Watkinson) در استودیوی بازی‌سازی آمریکایی لاروا لبز (Larva Labs) توسعه یافت. توکن‌های CryptoPunk تصاویر 24 × 24 پیکسلی هستند که به صورت الگوریتمی تولید شده‌اند. کریپتوپانک قبل از کریپتوکیتیز (CryptoKitties) منتشر شد و این دو پروژه، اولین‌ها در فضای NFT بوده و یکی از الهامات استاندارد توکن ERC-721 در شبکه اتریوم هستند.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="امور مالی غیرمتمرکز چیست ؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"برای درک بهتر دیفای، ابتدا باید بدانیم که امور مالی سنتی چگونه بوجود آمد. در ابتدا انسان ها به مبادله کالاها و خدمات می پرداختند. اما همانطور که جوامع بشری شکل گرفت و توسعه یافت، اقتصاد ما نیز دچار دگرگونی شد. ما پول را اختراع کردیم تا مبادله دارایی های ارزشمند آسانتر شود. پس از آن، پول به تغییرات جدید و رشد اقتصادی کمک کرد. با این حال، پیشرفت بدون بها حاصل نمی شود.

از نظر تاریخی، مقامات مرکزی مانند دولت ها ارزهایی را صادر می کنند که زیربنای اقتصاد ما است. از بانک ها و موسسات مرکزی انتظار می رود که عرضه ارز در گردش را با دقت مدیریت و تنظیم کنند. با بزرگتر شدن اندازه و پیچیدگی اقتصاد، این مقامات مرکزی با افزایش اعتماد مردم به آنها، قدرت بیشتری کسب کردند.

شما به بانک خود اعتماد می کنید تا از پولتان به صورت امن نگهداری کند. همچنین هنگامی که نوبت به سرمایه گذاری می رسد، برای امنیت دارایی خود به یک مشاور مالی اعتماد می کنید. با واگذاری کنترل پول خود به دیگران، امیدوارید که سود کسب کنید. اما حقیقت غم انگیز در مورد سیستم مالی فعلی این است که قدرتی که بوسیله این اعتماد شکل می گیرد، همیشه ثمربخش نیست.

ما اغلب اطلاعات کمی در مورد نحوه بکار بردن سرمایه گذاری هایمان توسط شرکت ها داریم. در بیشتر موارد، سرمایه گذاران تنها بخش کوچکی از سودهای حاصل از این سرمایه گذاری ها را دریافت می کنند.

دیفای در تلاش است تا دنیایی متفاوت بسازد. امور مالی غیرمتمرکز در صدد ایجاد سیستم مالی است که در دسترس همگان باشد و نیاز به اعتماد به مراجع مرکزی را به حداقل برساند. فناوری هایی مانند اینترنت، ارزهای دیجیتال و بلاک چین به ما ابزارهایی برای ایجاد و کنترل سیستم مالی بدون نیاز به مراجع مرکزی را می دهند.

عبارتی معروف در فضای بلاک چین وجود دارد: «اعتماد نکنید، تأیید کنید.» از طریق شبکه بلاک چین، شما به عنوان یک فرد می توانید هر معامله ای را که در بلاک چین اتفاق می افتد، تأیید و بررسی کنید.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="برنامه های دیفای چگونه اجرا می شوند؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"هدف از ایجاد ارزهای رمزنگاری شده، قابلیت پرداخت پول در سطح جهانی است. جنبش امور مالی غیرمتمرکز به این هدف نزدیک شده است. برای هر خدمات مالی که از آن استفاده می کنید، یک گزینه جایگزین و جهانی تصور کنید. پس انداز، وام، معامله، بیمه و سایر موارد برای همه در جهان در بلاک چین های قرارداد هوشمند، مانند اتریوم امکان پذیر است.

قراردادهای هوشمند برنامه هایی هستند که در صورت تحقق شرایطی از پیش تعیین شده، می توانند به طور خودکار در بلاک چین اجرا شوند. قراردادهای هوشمند، توسعه دهندگان را قادر می سازد تا برنامه هایی بسیار پیشرفته تر از ارسال و دریافت ارزهای دیجیتال بسازند. این برنامه ها، به برنامه های غیر متمرکز یا dapp معروف هستند.

امور مالی غیرمتمرکز این موقعیت را دارد که سیستم مالی پایدارتر و شفاف تری را بوجود بیاورد. هرکسی که قابلیت اتصال به اینترنت داشته باشد، می تواند به قراردادهای هوشمند ساخته شده در بلاک چین اتریوم، دسترسی بیابد. اکثر قراردادهای هوشمند به گونه ای ساخته شده اند که متن باز و قابل تغییر باشند. بنابراین، کاربران می توانند کد قراردادهای هوشمند را تأیید کرده و انتخاب کنند که کدام سرویس ها برای آنها بهترین عملکرد را دارند.

شما می توانید به جای آن که توسط یک نهاد یا شرکت متمرکز کنترل شوید، از یک dapp استفاده کنید؛ چرا که بر اساس فناوری غیرمتمرکز ساخته شده است. (به این کلمه عادت کنید، dapp، از اینجا به بعد زیاد مشاهده خواهید کرد.)

در حالی که برخی از امکانات دیفای ممکن است مربوط به آینده باشند، بسیاری از برنامه های غیرمتمرکز آن تاکنون راه اندازی شده اند. dapp هایی در دیفای وجود دارند که می توانید از طریق آنها استیبل کوین (ارز دیجیتالی که ارزش آن به دلار آمریکا وابسته است) ایجاد کنید، پول خود را قرض دهید و سود دریافت کنید، وام بگیرید، یک دارایی را به دارایی دیگر تبدیل کنید، دارایی بخرید یا بفروشید و استراتژی های سرمایه گذاری خودکار و پیشرفته اعمال کنید.

تقریباً تمام برنامه های دیفای در بلاک چین اتریوم، محبوب ترین بلاک چین قابل برنامه نویسی در جهان، ساخته شده اند. به‌جز اتریوم، ایاس، تزوس، ترون، کاردانو، نئو، الگوراند و ده‌ها بلاک چین دیگر قادر هستند برنامه‌های حوزه امور مالی غیرمتمرکز را میزبانی کنند.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="کاربردهای دیفای"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"محصولات و خدمات بسیار متنوعی در دیفای وجود دارند. اکنون به معرفی سه نمونه از پرکاربردترین برنامه های دیفای می پردازیم.
وام گرفتن و وام دادن
پروتکل های وام دهی غیرمتمرکز یکی از محبوب ترین برنامه های اکوسیستم دیفای می باشند. دریافت وام و وام دهی به صورت آزاد و غیرمتمرکز مزایای بسیاری نسبت به سیستم اعتباری سنتی دارد. این مزایا شامل پرداخت فوری، قابلیت وثیقه گذاری دارایی های دیجیتال، عدم نیاز به چک های اعتباری است.

مشابه سیستم بانکداری، کاربران پول واریز می کنند و از وام گرفتن سایر کاربران، سود دریافت می کنند. با این حال، در این مورد دارایی ها، دیجیتالی هستند و قراردادهای هوشمند وام دهندگان را به وام گیرندگان متصل کرده، شرایط وام ها را اجرا و سود را توزیع می کنند. همه این ها بدون نیاز به اعتماد به یکدیگر یا بانک واسطه اتفاق می افتد.

از آنجا که این خدمات بر روی بلاک چین های عمومی ساخته شده است، نیاز به اعتماد به حداقل می رسد و از شفافیت بالایی برخوردار است. این سیستم وام دهی ریسک طرف قرارداد را کاهش می دهد و دریافت وام و وام دهی را ارزان تر، سریع تر و در دسترس افراد بیشتری قرار می دهد.

کامپاند (Compound)، آوه (Aave) و نکسو (Nexo) از معروف ترین پلتفرم های وام دهی دیفای هستند.

خدمات بانکی پولی
از آنجا که برنامه های دیفای، برنامه های مالی هستند، خدمات بانکی پولی یکی از کاربردهای بدیهی آن است. این خدمات می تواند شامل صدور استیبل کوین ها، رهن و بیمه باشد.
همزمان با رشد صنعت بلاک چین، توجه بیشتری بر ایجاد استیبل کوین ها بوجود آمده است. آنها نوعی دارایی دیجیتال هستند که معمولاً به یک دارایی دیگر وابسته هستند اما می توانند به راحتی به صورت دیجیتالی منتقل شوند. از آنجا که قیمت ارزهای رمزنگاری در برخی مواقع به سرعت نوسان می کند، می توان از استیبل کوین های غیرمتمرکز به عنوان پول دیجیتالی که توسط مقامات مرکزی صادر و کنترل نمی شود، استفاده کرد.

به عنوان مثال، دای (DAI) یک استیبل کوین وابسته به دلار است که توسط اتر (ETH) پشتیبانی می شود. برای به ازای هر دای، 1.50 دلار ETH در قرارداد هوشمند میکردائو (MakerDAO) به عنوان وثیقه قفل شده است.

در مورد خدمات اعتباری به دلیل وجود واسطه های فراوان، فرآیند دریافت وام مسکن گران و زمان بر است. با استفاده از قراردادهای هوشمند، هزینه های پذیره‌نویسی و حقوقی به میزان قابل توجهی کاهش می یابد.

صدور بیمه در بلاک چین نیاز به واسطه ها را حذف کرده و ریسک نقض بیمه نامه را کاهش می دهد. این امر می تواند منجر به مبلغ بیمه کمتر اما با همان کیفیت خدمات شود.

مهم ترین استیبل کوین های دیفای، دای، جمینی دلار (TrueUSD ،USD Coin ،(Gemini Dollar و  پاکسوس استاندارد (Paxos Standard) می باشند.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="صرافی غیرمتمرکز"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"یکی از مهم ترین برنامه های دیفای صرافی غیرمتمرکز یا به اختصار DEX می باشد. این پلتفرم به کاربران امکان معامله دارایی های دیجیتال بدون نیاز به واسطه (صرافی) را فراهم می کند. معاملات مستقیماً بین کیف پول های کاربر با کمک قراردادهای هوشمند انجام می شود.

دکس ها در واقع صرافی های ارز دیجیتال هستند که از قراردادهای هوشمند برای اجرای قوانین ترید، انجام معاملات و مدیریت ایمن سرمایه استفاده می کنند. در صرافی غیرمتمرکز هیچ اپراتوری وجود ندارد و نیاز به ثبت نام و تأیید هویت نیست.

از آنجا که صرافی های غیرمتمرکز نمی توانند کنترلی بر فرآیند صرافی داشته باشد، معمولاً کارمزد کمتری نسبت به صرافی های متمرکز دارند.

از فناوری بلاک چین می توان برای صدور و ارائه مالکیت تعداد زیادی از ابزارهای مالی استفاده کرد. این برنامه‌ها با ایجاد پلتفرمی غیرمتمرکز، نیاز به اعتماد به سازمان‌های امانت دار را از بین می برند.

به عنوان مثال می توان ابزار و منابعی را برای صادرکنندگان فراهم کرد تا بتوانند اوراق بهادار رمزگذاری شده ای را با پارامترهای قابل تنظیم در بلاک چین راه اندازی کنند.

اوراق مشتقه، دارایی های ترکیببی، بازارهای پیش بینی غیرمتمرکز و بسیاری موارد دیگر نیز می توانند در حوزه های دیفای جای بگیرند.

از جمله صرافی های غیرمتمرکز دیفای میتوان به AirSwap، Balancer، Bancor و IDEX اشاره نمود.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="تفاوت برنامه های غیرمتمرکز دیفای با بانک های سنتی"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"عملیات این کسب و کارها توسط یک موسسه و کارمندانش اداره نمی شود بلکه دارای قوانینی می باشد که به صورت کد (یا قرارداد هوشمند، همانطور که در بالا اشاره شد) نوشته شده است. هنگامی که از قرارداد هوشمند در بلاک چین استفاده می شود، برنامه های غیرمتمرکز دیفای می توانند با دخالت بسیار کم انسان به طور خودکار اجرا شوند (اگرچه در عمل معمولاً توسعه دهندگان با بروزرسانی یا رفع اشکال ها، از dapp حمایت می کنند).
کد در بلاک چین بسیار شفاف است و هر شخصی می تواند به بررسی آن بپردازد. این موضوع باعث ایجاد نوع دیگری از اعتماد در کاربران می شود، زیرا هر کس این موقعیت را دارد تا کارکرد قرارداد را بررسی کرده یا اشکالاتی را در آن پیدا کند. تاریخچه تمام تراکنش ها نیز برای همه قابل مشاهده است. این مورد ممکن است سؤالاتی را درباره حریم خصوصی برایتان ایجاد کند، اما باید گفت که تراکنش ها به صورت پیش فرض دارای نام مستعار هستند، یعنی مستقیماً با هویت واقعی شما مرتبط نیستند.
برنامه های غیرمتمرکز بدین منظور طراحی شدند که از همان روز اول در کل جهان قابل دسترس باشند. شما چه در تگزاس و چه در تانزانیا باشید، به شبکه و خدمات دیفای مشابهی دسترسی دارید. البته مقررات محلی ممکن است اعمال شوند، اما از نظر فنی اکثر برنامه های دیفای در دسترس افرادی است که قابلیت اتصال به اینترنت دارند.
عدم نیاز به مجوز جهت ایجاد و مشارکت: هر کسی می تواند برنامه های دیفای ایجاد کرده و یا از آنها استفاده کند. دیفای برخلاف امور مالی سنتی، به حساب کاربری یا پر کردن فرم های طولانی نیاز ندارد. کاربران از طریق کیف پول های دیجیتال خود به طور مستقیم با قراردادهای هوشمند در ارتباط هستند.
تجربه کاربری انعطاف پذیر: از رابط کاربری برخی از dapp ها خوشتان نمی آید؟ مشکلی نیست، می توانید رابط کاربری خود را تغییر دهید. قراردادهای هوشمند مانند API باز هستند و هر کسی می تواند برنامه مختص خود را ایجاد کند.
تعامل پذیری: برنامه های جدید دیفای می توانند با ترکیب سایر محصولات دیفای ساخته شوند. به عنوان مثال استیبل کوین ها، صرافی های غیرمتمرکز و بازارهای پیش بینی می توانند با هم ترکیب شوند تا محصولات کاملاً جدیدی را ارائه دهند.
در حال حاضر دیفای یکی از سریعترین بخش های در حال رشد در زمینه کریپتو می باشد. متخصصان دیفای برای محاسبه کشش بازار از یک معیار و اصطلاح جدید استفاده می کنند. این معیار «ارزش قفل شده در دیفای» نامیده می شود. در حال حاضر، کاربران بیش از 7 میلیارد دلار در این قراردادهای هوشمند سپرده گذاری کرده اند.

برای اتصال به این برنامه های غیرمتمرکز به یک کیف پول ارز دیجیتال با مرورگر داخلی dapp (مانند کیف پول کوین بیس) نیاز دارید.

هنوز در روزهای اولیه ظهور dapp ها به سر می بریم، بنابراین کاربران دیفای باید تحقیقات خود را در مورد محصولات و خدمات جدید انجام دهند. مانند هر کد رایانه ای، قراردادهای هوشمند می توانند در برابر خطاهای ناخواسته برنامه نویسی و هک های مخرب آسیب پذیر باشند.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="آینده دیفای چگونه است؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"پول و دارایی از زمان طلوع تمدن بشری به شکل های گوناگون در دسترس عموم بوده است. ارزهای دیجیتال جدیدترین نوع آن هستند. در سال های آینده، ممکن است تمام خدمات مالی که در سیستم فیات امروزی از آن استفاده می کنیم، در اکوسیستم ارزهای دیجیتال نیز استفاده شود. ما تاکنون شاهد صدور و مبادله دارایی، وام گرفتن، قرض دادن، حق حضانت و اوراق مشتقه در ارز های رمزنگاری بوده ایم. اقدام بعدی چیست؟
نسل اول برنامه های غیرمتمرکز دیفای به شدت به وثیقه جهت ایجاد امنیت نسبت به بازپرداخت وام متکی هستند. یعنی شما باید از قبل ارز دیجیتال داشته باشید و از آن به عنوان وثیقه استفاده کنید تا بتوانید ارز دیجیتال بیشتری وام بگیرید. اکثر وام های سنتی بدون وثیقه به یک سیستم هویتی نیاز دارند، به طوری که وام گیرندگان می توانند اعتبار ایجاد کنند و مقدار وام گیری خود را افزایش دهند، دقیقاً مانند امتیازات امروزی SSN و FICO. برخلاف سیستم های هویتی و اعتباری امروز، یک هویت غیرمتمرکز باید هم جهانی و هم دارای حریم خصوصی باشد.

ما همچنین شاهد نوآوری در فضای بیمه هستیم. بسیاری از وام های دیفای امروزه دارای وثیقه بیش از حد هستند (به این معنی که وام ها به دلیل ارزش بسیار بیشتر دارایی وثیقه، اساسا امن به نظر می رسند). اما قراردادهای هوشمند در دیفای آسیب پذیر نیز هستند. اگر هکری در کد متن باز برنامه های غیرمتمرکز اشکالی پیدا کرده و از آن سو استفاده کند، میلیون ها دلار می تواند در یک لحظه خالی شوند. تیم هایی مانند Nexus Mutual در حال ساخت بیمه غیرمتمرکزی هستند که در صورت هک شدن قرارداد هوشمند، دارایی کاربران را به صورت کامل به آنها بازگرداند.

روند دیگری که شاهد آن هستیم تجربه کاربری برتر است. نسل اول dapp ها توسط علاقه مندان به بلاک چین ساخته شده بود. این dapp ها در نمایش امکانات جدید و هیجان انگیز دیفای کار بزرگی انجام دادند. آخرین نسخه برنامه های دیفای بر طراحی و سهولت استفاده به منظور جلب مخاطبان بیشتر  اولویت گذاری شده است.

در آینده انتظار داریم که کیف پول های کریپتو درگاهی برای فعالیت تمام دارایی های دیجیتال باشند، درست مانند مرورگر اینترنت که امروز درگاهی برای اخبار و اطلاعات جهان محسوب می شود. داشبوردی را تصور کنید که نه تنها دارایی های شما بلکه مقدار ارزش قفل شده در پروتکل های مختلف مالی مانند وام ها، استخرها و قراردادهای بیمه را نشان می دهد.

در اکوسیستم دیفای، ما شاهد حرکت به سوی عدم تمرکز و قدرت تصمیم گیری هستیم. علیرغم کلمه غیرمتمرکز در دیفای، بسیاری از پروژه های امروزی دارای کلیدهای اصلی (master keys) هستند که توسعه دهندگان می توانند از طریق آن برنامه های غیرمتمرکز را خاموش یا غیرفعال کنند. این ویژگی به منظور امکان بروزرسانی آسان و قطع اضطراری شبکه در صورت وجود کد دارای اشکال فراهم شده است. جامعه دیفای در حال آزمایش روش هایی است که به سهام داران امکان رای دهی از طریق سازمان های خودمختار غیرمتمرکز مبتنی بر بلاکچین (DAO) را می دهد.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="توکن چیست و چه تفاوتی با کوین دارد؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"در بازار ارزهای دیجیتال، یک «توکن» (Token) ارز دیجیتالی است که بلاک چین مستقل خود را ندارد و روی شبکه‌های دیگر مانند اتریوم جابه‌جا می‌شود.

بنابراین در بازار ارزهای دیجیتال مهم‌ترین چیزی که یک توکن را با «کوین» (Coin) متمایز می‌کند،‌ داشتن یا نداشتن بلاک چین مستقل است. طبق این تعریف، یک کوین ارز دیجیتالی است که بلاک چین مستقل خود را دارد.

بیت کوین، اتریوم، ریپل، لایت کوین، بیت کوین کش، کاردانو و صدها ارز دیجیتال دیگر که بلاک چین‌های اختصاصی خود را دارند در دسته‌بندی کوین‌ها جای می‌گیرند.

از بزرگترین توکن‌های بازار هم می‌توان به تتر، چین لینک، دای (Dai)، آوی (Aave)، یرن فایننس (Yearn.Finance) و بت (BAT) اشاره کرد.

جالب است بدانید که ۲,۸۰۰ ارز دیجیتال از ۳,۹۰۰ ارز دیجیتالی که در زمان نگارش این مقاله در صرافی‌ها معامله می‌شوند، در حقیقت توکن‌ هستند و از بلاک چین‌هایی مانند اتریوم، بایننس چین (Binance Chain)، ایاس و تزوس استفاده می‌کنند. اولین مرجعی که کوین و توکن را از یکدیگر متمایز کرد، وب‌سایت کوین مارکت کپ (Coinmarketcap) بود.

برای اینکه متوجه شوید یک ارز دیجیتال کوین است یا توکن می‌توانید به صفحه اختصاصی آن در وب‌سایت ارزدیجیتال مراجعه کنید.

فراموش نکنید که توضیحات ارائه‌شده درباره تفاوت کوین و توکن، بر اساس ذهنیت موجود در بازار بود. از نگاه کلی‌تر و دقیق‌تر، هر واحد ارزی مستقل در یک شبکه می‌تواند توکن در نظر گرفته شود. با این تعریف، اتر، ارز دیجیتال بومی شبکه اتریوم هم یک توکن محسوب می‌شود، اما در بازار اتر را یک کوین در نظر می‌گیرند.

بیشتر توکن‌ها در دنیای ارزهای دیجیتال، «توکن‌های کاربردی» هستند. این توکن‌ها امکان دریافت کاربرد خاصی از یک پروژه را فراهم می‌کنند که تنها در اکوسیستم مربوط به آن قابل‌استفاده است.

برای مثال، اگر پروژه‌ای با این هدف کار خود را آغاز کند که بلیت اتوبوس‌های بین‌شهری را تنها با توکن‌های مخصوصی بتوان خریداری کرد، در این صورت کاربرد آن توکن تنها برای خرید بلیت‌ها خواهد بود و نمی‌توان به‌عنوان مثال از آن برای خرید غذا از رستوران استفاده کرد. در ادامه مقاله به‌طور مفصل درباره انواع توکن‌ها می‌خوانید.

ساخت توکن برای توسعه‌دهندگان بلاک چینی بسیار راحت‌تر از ایجاد یک بلاک چین و شبکه مستقل است و در بیشتر مواقع پروژه‌ها می‌توانند بدون نیاز به هزینه‌های نجومی برای طراحی یک بلاک چین، ارز دیجیتال خود را بسازند و به اهداف اولیه خود برسند.

پروژه‌هایی که قصد توسعه یک بلاک چین را دارند، معمولاً ابتدا از یک بلاک چین واسطه برای خود توکن ایجاد کرده و پیش‌فروش یا همان عرضه اولیه سکه (ICO) برگزار می‌کنند و در ازای پول ملی یا ارزهای دیجیتال دیگر توکن‌های خود را پیش از راه‌اندازی پروژه به فروش می‌رسانند. ارزش این توکن‌ها رابطه مستقیمی با وضعیت پروژه و حرکت آن در راستای اهدافش خواهد داشت.

همچنین، برخی توکن‌ها پس از اینکه به حد کافی توسعه پیدا کردند، به‌دنبال ایجاد بلاک چین اختصاصی خودشان می‌روند و به کوین تبدیل می‌شوند.

در حالی که کوین‌ها هر کدام می‌توانند کیف پول اختصاصی خود را داشته باشند، توکن‌ها روی کیف پول‌های بلاک چینِ میزبان ذخیره می‌شوند. به‌عنوان مثال، تمام توکن‌های مبتنی بر اتریوم، روی کیف پول‌ها و آدرس‌های اتریوم ذخیره می‌شوند، اما نمی‌توانید بیت کوین را روی آدرس اتریوم ذخیره کنید، چون یک کوین است. در ادامه درباره کیف پول‌‌های توکن‌ها بیشتر می‌خوانید.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="توکن‌ها چگونه ساخته می‌شوند؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"روی هر پلتفرم بلاک چینی که از قراردادهای هوشمند و زبان‌های برنامه‌نویسی سطح بالا استفاده کند، می‌توان توکن ایجاد کرد. اتریوم در حال حاضر میزبان بیش از ۸۰٪ توکن‌های بازار است و پس از آن بایننس چین (Binance chain)، ایاس، کازماس، تزوس و ترون قرار دارند.
به‌بیان ساده، توسعه‌دهندگان برای ایجاد یک توکن باید با استفاده از زبان‌های برنامه‌نویسی و استانداردهای ایجاد توکن که تیم یک بلاک چین آن را ارائه می‌کند، قرارداد هوشمند توکن خود را ایجاد کنند و با استفاده از ابزارهای موجود، آن در بلاک چین پیاده‌سازی کنند. برای مثال، زبان برنامه‌نویسی ساخت توکن (قرارداد هوشمند) در اتریوم سالیدیتی است و استاندارد اصلی اتریوم برای ایجاد توکن ERC-۲۰ نام دارد.

ساخت توکن به‌خودیِ خود در کمتر از یک ساعت و با هزینه بسیار کم (کارمزدهای شبکه) انجام می‌شود، اما فراموش نکنید صرفاً ایجاد یک توکن نمی‌تواند ارزشمندی آن را تضمین می‌کند.
اخت توکن به خودی خود بسیار آسان است، اما توکنی که هدف و کاربرد نداشته باشد، هیچ ارزشی هم ندارد.
متأسفانه آسان‌بودن ایجاد توکن‌های بی‌ارزش و بدون کاربرد، بستری برای کلاهبرداری هم فراهم کرده است و گاهی اوقات کلاهبرداران سعی می‌کنند توکن‌هایی که هیچ ارزشی ندارند را در قبال پول‌های واقعی مبادله کنند.

برای اینکه یک توکن بتواند ارزش جذب کند و مقبولیت به دست بیاورد، باید در یک پروژه کاربردی دخیل باشد و در صرافی‌های معتبر اضافه شود که به هیچ وجه کار ساده‌ای نیست.

بدون اغراق می‌توان گفت بیش از ۹۰٪ توکن‌های بازار هدف و کاربرد خاصی ندارند و صرفاً برای پرکردن جیب توسعه‌دهندگان عرضه شده‌اند.

در سال ۲۰۱۷ که به «جنون ICO‌ها» مشهور است، پروژه‌های کلاهبرداری زیادی با وعده‌های عجیب‌وغریب وارد میدان شدند و هر کدام با پیش‌فروش (ICO) توکن‌های خود به سرمایه‌گذاران ناآگاه چند میلیون دلار پول به جیب زدند. در سال ۲۰۱۸ با ترکیدن حباب بازار، تمام آن توکن‌ها به فراموشی سپرده شدند و هرگز نتوانستند حتی به قیمت اولیه خود برسند.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="چرا توکن؟"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"صرفه‌جویی در هزینه‌ها و زمان مهم‌ترین مزیت‌ ساخت توکن به‌جای یک بلاک چین جداگانه است. بیشتر پروژه‌هایی که می‌خواهند کار روی شبکه و بلاک چین خود را آغاز کند، در ابتدا بودجه و سرمایه کافی در اختیار ندارند و با توجه به گسترش سریع فضای ارزهای دیجیتال از نظر زمان‌بندی هم با مشکلات زیادی مواجه هستند. این پروژه‌ها می‌توانند در ابتدا خیلی سریع توکن خود را روی یک بلاک چین دیگر مانند اتریوم پیاده‌سازی کنند و با جذب سرمایه خصوصی یا عمومی و اضافه‌کردن آن به صرافی‌ها، به سرمایه و زمان‌بندی موردنظر خود دست پیدا کنند، شبکه اصلی خود را راه‌اندازی کنند و بعد توکن‌ها را به بلاک چین اختصاصی خودشان انتقال دهند. برای نمونه،‌ واحدهای ارزی ترون (TRX) در ابتدا به‌صورت توکن اتریومی عرضه شدند و بعد از توسعه بلاک چین ترون، به شبکه اصلی منتقل شدند.

تفاوت کوین و توکن
در خیلی از موارد هم اصلاً نیاز به ساخت بلاک چین جداگانه برای یک پروژه احساس نمی‌شود و پروژه می‌تواند از امنیت بالای بلاک چین میزبان نهایت استفاده را ببرد. به‌عنوان نمونه، پروژه چین لینک اکنون به‌خوبی کار می‌کند و با تیم‌های بزرگی قرارداد همکاری امضا کرده است، اما توکن بومی آن یعنی لینک (Link) که در زمان نگارش این مطلب از نظر ارزش بازار در رتبه ۵ بازار قرار دارد، روی اتریوم کار می‌کند. با توجه به حساسیت پروژه چین لینک، تعداد زیاد ماینرهای اتریوم و امنیت بالای این شبکه برای این پروژه اطمینان‌خاطر به همراه می‌آورد. پروژه بزرگ دیگری که از بلاک چین اتریوم بهره می‌برد، تتر است. این استیبل کوین که برای حفاظت از سرمایه‌گذاران در برابر نوسانات ساخته شده است و قیمت آن با توجه به داشتن پشتوانه دلاری، همیشه یک دلار است، توکن‌های خود (USDT) را روی چندین بلاک چین امن عرضه کرده است و نیازی به ایجاد بلاک چین اختصاصی نمی‌بیند.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="کیف پول‌های توکن‌ها"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"هر توکن می‌تواند روی تمام کیف پول‌ها و آدرس‌های بلاک چین میزبان ذخیره و منتقل شود. برای مثال، یک توکن اتریومی مانند چین لینک یا تتر را می‌توانید روی کیف پول و آدرس‌های اتریوم ذخیره کنید. به‌بیان ساده، با داشتن یک کیف پول و یک آدرس اتریوم می‌توانید تمام توکن‌های مبتنی بر آن را ذخیره کنید. تتر می‌خواهید؟ آدرس کیف پول اتریوم خود را بدهید. چین لینک می‌خواهید؟ بازهم آدرس کیف پول اتریوم خود را بدهید.
در مورد بلاک چین‌های دیگر مانند ترون، بایننس چین، ایاس و تزوس هم به همین صورت توکن‌ها روی کیف پول‌های هر کوین ذخیره می‌شوند. البته در بلاک چین‌های جدید مانند پولکادات و اولنچ این امکان وجود دارد که توکن‌ها روی کیف پول‌های اختصاصی با آدرس‌های متفاوت هم ذخیره شوند.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="انواع توکن"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"توکن‌ها را از نظر نوع می‌توان به چندین دسته متفاوت تقسیم کرد. طبقه‌بندی توکن‌ها مانند طبقه‌بندی هر چیز دیگری نسبی و وابسته به اشخاص است و هرکس می‌تواند آنها را از جنبه‌های مختلف تقسیم‌بندی کند. با این حال، در بین اغلب اعضای جامعه ارزهای دیجیتال توکن‌ها در ابتدا به‌ دو دسته کلی مثلی (Fungible) و غیرمثلی (Non-fungible) تقسیم می‌شوند و سپس در هر کدام از این دسته‌ها می‌توان دوباره طبقه‌بندی انجام داد.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="تفاوت توکن غیرمثلی و مثلی"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"قبل از اینکه توضیح بدهیم یک توکن غیرمثلی چیست، لازم است یک قدم عقب‌تر برویم و تفاوت مثلی‌بودن یا تعویض‌پذیر بودن با غیرمثلی بودن یا غیرقابل‌ تعویض بودن را بدانیم.

در اقتصاد، یک کالا (یا پول) در صورتی مثلی یا تعویض‌پذیر (Fungible) تلقی می‌شود که واحدهای آن با یکدیگر قابل‌تعویض باشند و نتوان هیچ‌کدام از آنها را کم‌ارزش‌تر یا با ارزش‌تر از دیگری دانست.

به‌عنوان مثال، بیت کوین، دلار، ریال و به‌طور کلی اسکناس‌ها در دسته دارایی‌های مثلی قرار دارند. یک اسکناس ۱۰,۰۰۰ تومانی نسبت به یک اسکناس ۱۰,۰۰۰ تومانی دیگر از نظر ارزش کاملاً برابر است و هر دو می‌توانند با یکدیگر تعویض شوند و مقدار کالای یکسانی را خریداری کنند. زمانی که یک اسکناس ۱۰,۰۰۰ تومانی به دوست خود قرض می‌دهید، انتظار ندارید که بعداً دقیقاً همان اسکناس را پس بگیرید.

در مقابلِ دارایی‌های مثلی‌،‌ چیزهای غیرمثلی (Non-fungible) قرار دارند که دورتادور ما را فرا گرفته‌اند. به‌طور کلی می‌توان گفت هر چیزی که ابزار مبادله نباشد، غیرمثلی است.

مثلاً لپ‌تاپ شما، تلفن همراه شما و خودروی شما اقلام غیرمثلی هستند. اگر خودروی خود را به دوستتان قرض بدهید تا به مسافرت برود، انتظار دارید دقیقاً همان خودرو را پس بگیرید نه یک خودروی دیگر. برای درک بهتر، بلیط بازی پرسپولیس و استقلال هم غیرمثلی است.

یک نمونه دیگر: تابلوی «مونالیزا»، شاهکار لئوناردو داوینچی، کاملاً غیرمثلی است. آیا کسی می‌تواند این اثر تاریخی را با یک تابلوی معمولی مبادله کند، با این فکر که هر دوی آنها تابلوی نقاشی هستند؟
حالا به سراغ تعریف توکن غیرمثلی برویم:

یک توکن غیرمثلی یا NFT، یک دارایی دیجیتال است که کمیاب و منحصربه‌فرد بوده و روی بلاک چین ذخیره و جابه‌جا می‌شود. آیتم‌‌های بازی‌های کامپیوتری، اقلام کلکسیونی، آثار هنری دیجیتال، بلیط رویدادهای مختلف، نام‌ دامنه‌ها، یک خانه که به‌صورت توکن درآمده و … در دسته توکن‌های غیرمثلی جای می‌گیرند.

در حال حاضر ۹۹٪ توکن‌های بازار مانند تتر و چین لینک مثلی هستند و همه واحدهای آنها از نظر ارزش مشابه و قابل‌تعویض هستند، اما حوزه NFT روزبه‌روز در حال گسترش است و احتمالاً در آینده توکن‌های غیرمثلی بخش بزرگتری از بازار را به خود اختصاص دهند.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="توکن کاربردی"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"توکن کاربردی (Utility Token) ارز دیجیتالی است که از آن برای پرداخت هزینه‌ها و خرید کالا و خدمات در یک یا چند پروژه خاص استفاده می‌شود. امروزه اغلب توکن‌های موجود در بازار توکن‌های کاربردی هستند. مثلاً توکن لینک (Link) یک توکن کاربردی است که افراد می‌توانند با آن هزینه خدمات پلتفرم چین لینک را پرداخت کنند.

ارزش این توکن‌ها فقط با عرضه و تقاضا مشخص می‌شود و هیچ پشتوانه‌ای برای آنها تعریف نشده است. همچنین ارزش این توکن‌ها به‌طور مستقیم هیچ ارتباطی با ارزش یا سرمایه‌های شرکت توسعه‌دهنده ندارد.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="توکن اوراق بهادار"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"وکن اوراق بهادار (Security Token) ارز دیجیتالی است که دارنده آن صاحب بخشی از یک دارایی، شرکت یا سود یک فعالیت خاص خواهد بود. به‌عنوان مثال، زمانی که یک خانه یا یک شرکت تبدیل به هزاران توکن شود و مانند سهام میان سرمایه‌گذاران توزیع شود، آن توکن یک توکن اوراق بهادار به شمار می‌رود.

اوراق بهادار به هر دارایی قابل‌‌معامله گفته می‌شود که در نهادهای قانونی ثبت شده باشد و یک سرمایه‌گذار بتواند با داشتن آن در یک فعالیت مالی مشارکت کند. سهام و اوراق قرضه، از مهم‌ترین اوراق بهادار به شمار می‌روند.

اصطلاح توکن اوراق بهادار در سال ۲۰۱۸ بین فعالان مطرح شد، زمانی که برخی از نهادهای قانون‌گذار در سراسر جهان – از جمله کمیسیون بورس آمریکا (SEC) – اعلام کردند برخی از ارزهای دیجیتال در حقیقت اوراق بهادار هستند و باید از نظر قانونی ثبت شوند. اینکه یک توکن اوراق بهادار است یا نه را نهاد قانون‌گذار کشور مشخص می‌کند. مثلاً در آمریکا، کمیسیون بورس آمریکا از طریق آزمایش هاوی مشخص می‌کند که یک دارایی اوراق بهادار است یا خیر. طبق تست هاوی، هر دارایی که شرایط زیر را داشته باشد، اوراق بهادار است:

یک سرمایه‌گذاری مالی باشد.
در آن انتظار سود تعریف شده باشد.
در یک شرکت ثبت شود.
این سود باید از فعالیت یک شخص ثالث به دست آید.
مزیت توکن‌های اوراق بهادار نسبت به اوراق بهادار سنتی این است که با استفاده از فناوری بلاک چین، سرمایه‌گذار می‌تواند به‌جای استفاده از کارگزاری‌ها، توکن خود را روی کیف پول شخصی ذخیره کند و در زمان معامله به‌راحتی آن را انتقال دهد. همچنین این نوع توکن در مراجع قانونی ثبت می‌شود و این موضوع ریسک کلاهبرداری را کاهش می‌دهد.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="توکن حاکمیتی (گاورننس)"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"توکن حاکمیتی یا گاورننس (Governance) ارز دیجیتالی است که دارنده آن می‌تواند با آن در تصمیم‌گیری‌ها و رأی‌گیری‌ها برای آینده یک سیستم یا شبکه نقش داشته باشد. به‌عنوان نمونه، توکن یونی سواپ (Uniswap) یک توکن حاکمیتی است که دارنده آن می‌تواند در تصمیم‌گیری‌های مهم این صرافی غیرمتمرکز حق رأی داشته باشد.

توکن‌های حاکمیتی اغلب اوقات در طبقه توکن‌های کاربردی جای می‌گیرند و این یعنی یک توکن حاکمیتی می‌تواند توکن کاربردی هم باشد.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="جمع‌بندی توکن"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"در این مقاله به هر آنچه که نیاز بود درباره توکن در حوزه ارزهای دیجیتال و تفاوت آن با کوین بدانید اشاره کردیم. تمام مطالب این مقاله را می‌توان در سه پاراگراف زیر خلاصه کرد:

در بازار ارزهای دیجیتال، توکن ارز دیجیتالی است که بلاک چین مستقل خود را ندارد و در بلاک چین و کیف پول‌های یک بلاک چین میزبان ذخیره می‌شود، اما به‌طور کلی می‌توان برای اشاره به هر واحد ارزی در یک شبکه بلاک چینی از عبارت توکن استفاده کرد.
توکن‌ها با استفاده از قراردادهای هوشمند و کدهای برنامه‌نویسی ایجاد می‌شوند و دو مزیت اصلی استفاده از آنها به‌جای ایجاد یک بلاک چین اختصاصی، صرفه‌جویی در وقت و هزینه است.
توکن‌ها از نظر نوع می‌توانند در ده‌ها دسته‌بندی جای بگیرند، اما در میان اغلب فعالان این حوزه، در حال حاضر آنها به سه نوع توکن‌های کاربردی، اوراق بهادار و حاکمیتی طبقه‌بندی می‌شوند.",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}
elseif($text=="ssss"){
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"ssss",
'parse_mode'=>"MARKDOWN",
'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"🔭اشتراک  (غیرفعال)",'switch_inline_query'=>""]]],
    ])
    ]);
}

/////////
/*lhoseinfardl('ForwardMessage',[
'chat_id'=>$koja,
'from_chat_id'=>$chat_id,
'message_id'=>$message_id]);
}
elseif($text=="dddd"){
lhoseinfardl('ForwardMessage',[
'chat_id'=>$chat_id,
'from_chat_id'=>"-1001521121338",
'message_id'=>"https://t.me/maktabmetaverse/42"]);
}

/*//*elseif($text == "xxx"){
$user["step"] = "poshtibani";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
lhoseinfardl('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"لطفا(پیام،انتقاد،پیشنهاد،شکایت) خود را ارسال کنید♥️",
'parse_mode'=>'Markdown',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[
['text'=>"بازگشت↩"]
],
]
])
]);
}elseif($step == "poshtibani"){     
$user["step"] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
Forward($dev[0],$chat_id,$message_id);
lhoseinfardl('sendmessage',[       
'chat_id'=>$dev[0],
'text'=>"پیام بالا از طرف 
[$chat_id](tg://user?id=$chat_id)
ارسال شده است
",
'parse_mode'=>'MarkDown',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'inline_keyboard'=>[
[
['text'=>"پاسخ",'callback_data'=>"pas-$chat_id"]
],
]
])
]);
lhoseinfardl('sendmessage',[       
'chat_id'=>$chat_id,
'text'=>"پیام شما به ادمین پشتیبان ارسال شد✔️
در اسراع وقت پاسخ ادمین برای شما ارسال میشود〽️",
]);
}
elseif($step == "ans"){
file_put_contents("admin/text.txt","$text");
$user["step"] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
$id = file_get_contents("admin/id.txt");
$txr = file_get_contents("admin/text.txt");
lhoseinfardl('sendmessage',[       
'chat_id'=>$id,
'text'=>"$txr",
]);  
 lhoseinfardl('sendSticker',[
'chat_id'=>$id,
'sticker'=>$update->message->sticker->file_id
]);
$photo = json_encode($update->message->photo);
$photo = json_decode($photo,true);
lhoseinfardl('sendPhoto',[
'chat_id'=>$id,
'photo'=>$photo[count($photo)-1]['file_id']
]);
lhoseinfardl('sendmessage',[       
'chat_id'=>$chat_id,
'text'=>"[ارسال شد](tg://user?id=$id)",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'inline_keyboard'=>[
[
['text'=>"پاسخ مجدد",'callback_data'=>"pas-$chat_id"]
],
]
])
]);
}


elseif($reply != "" && $chat_id == $dev[0]){
lhoseinfardl('sendmessage',[
'chat_id'=>$reply,
'text'=>"
پاسخ پشتیبان برای شما💢\n
<code>$text</code>",
'parse_mode'=>'HTML',
]);
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"پیام شما به کاربر ارسال شد❕",
'parse_mode'=>'MarkDown',
]);
}/*/////
//////////.....////////////


if($text == "/PANEL" or $text == "پنل" or $text == "/panel"){
if($from_id == $dev[0]){
$user['step'] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"Hi✋
welcome to panel🔥👅",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"آمار ربات📈"],['text'=>"پیام به کاربر📌"]],
[['text'=>"پیام همگانی✏"],['text'=>"فوروارد همگانی✒"]],
[['text'=>"بلاک کاربر💢"],['text'=>"انبلاک کاربر✅"]],
[['text'=>"روشن کردن ربات🔔"],['text'=>"خاموش کردن ربات🔕"]],
[['text'=>"کاربر  🫀vip"],['text'=>"حذف   💔 vip"]],
[['text'=>"بازگشت↩"]],
]
])
]);
}   

}

if($text == "پنل مدیریت💒"&& $from_id == $dev[0]){
if($dev[0]){
$user['step'] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
 lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"برگشتید",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"آمار ربات📈"],['text'=>"پیام به کاربر📌"]],
[['text'=>"پیام همگانی✏"],['text'=>"فوروارد همگانی✒"]],
[['text'=>"بلاک کاربر💢"],['text'=>"انبلاک کاربر✅"]],
[['text'=>"روشن کردن ربات🔔"],['text'=>"خاموش کردن ربات🔕"]],
[['text'=>"کاربر  🫀vip"],['text'=>"حذف   💔 vip"]],
[['text'=>"بازگشت↩"]],
]
])
]);
}   
}

elseif($text == "آمار ربات📈"&& $from_id == $dev[0]){
$dex = file_get_contents("data/members.txt");
$dexx = explode("\n",$dex);
$mem = count($dexx)-1;
$robots = count(scandir("bots"))-1;
$robotv = count(scandir("botsv"))-1;
 lhoseinfardl('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
تعداد کل اعضا ربات : $mem  🎹
",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[
['text'=>"پنل مدیریت💒"],
],
]
])
]);
}
elseif($text == "بلاک کاربر💢"&& $from_id == $dev[0]){
$user['step'] = "banuser";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
 lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"ایدی عددی کاربر رو برای بلاک کردن بفرست🔰",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[
['text'=>"پنل مدیریت💒"],
],
]
])
]);
}elseif($step == "banuser" and is_numeric($text)){
$user['step'] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
if(!in_array($text, $list['ban'])){
$list['ban'][] = "$text";
$outjson = json_encode($list,true);
file_put_contents("data/list.json",$outjson);
 lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"کاربر [$text](tg://user?id=$text) ❗️
با موفقیت در لیست بلاک قرار گرفت〽️
",
 'parse_mode'=>"MarkDown",
 'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[
['text'=>"پنل مدیریت💒"],
],
]
])
]);
}
}
elseif($text == "ویژه"&& $from_id == $dev[0]){
$user['step'] = "vipuser";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
 lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"کیو ویژه کنم",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[
['text'=>"پنل مدیریت💒"],
],
]
])
]);
}elseif($step == "vipuser" and is_numeric($text)){
$user['step'] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
if(!in_array($text, $list['vipp'])){
$list['vipp'][] = "$text";
$outjson = json_encode($list,true);
file_put_contents("data/list.json",$outjson);
 lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"کاربر [$text](tg://user?id=$text) ❗️
ویژه شد
",
 'parse_mode'=>"MarkDown",
 'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[
['text'=>"پنل مدیریت💒"],
],
]
])
]);
}
}
elseif($text == "انبلاک کاربر✅"&& $from_id == $dev[0]){
$user['step'] = "unbanuser";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"ایدی عدد کاربر را جهت انبلاک کردن ارسال کن ♻️",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[
['text'=>"پنل مدیریت💒"],
],
]
])
]);
}
elseif($step == "unbanuser" and is_numeric($text)){
$user['step'] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
if(in_array($text, $list['ban'])){
$search = array_search($text, $list['ban']);
unset($list['ban'][$search]);
$list['ban'] = array_values($list['ban']);
$outjson = json_encode($list,true);
file_put_contents("data/list.json",$outjson);
 lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"کاربر [$text](tg://user?id=$text) ❗️
از الان میتواند از امکانات ربات استفاده کند✔️
",
'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[
['text'=>"پنل مدیریت💒"],
],
]
])
]);
lhoseinfardl('sendMessage',[
'chat_id'=>$text,
'text'=>"شما توسط ادمین از لیست بلاک خارج شدید ✔️
لطفا اشتباه خودتان را دوباره تکرار نکنید 🙏"]);
}
}

elseif($text == "روشن کردن ربات🔔"&& $from_id == $dev[0]){
file_put_contents("data/onof.txt","on");
 lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"ربات هم اکنون در دسترس قرار گرفت ✅",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[
['text'=>"پنل مدیریت💒"],
],
]
])
]);
}
elseif($text == "خاموش کردن ربات🔕"){
file_put_contents("data/onof.txt","off");
 lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"رباتبا موفقیت از دسترس کاربران خارج شد🚫",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[
['text'=>"پنل مدیریت💒"],
],
]
])
]);
}


elseif($text == "پیام همگانی✏"&& $from_id == $dev[0]){
$user['step'] = "pmtoall";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"لطفا پیام خود را ارسال کنید ✔️",
'reply_to_message_id'=>$messageid,
'pars_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[
['text'=>"پنل مدیریت💒"],
],
]
])
]);
}

elseif($step == "pmtoall"){
$user['step'] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
lhoseinfardl('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"پیام شما با موفقیت به تمام اعضا ارسال شد❗️",
'pars_mode'=>'html',
]);
$memh = fopen("data/members.txt",'r');
while(!feof($memh)){
$memuser = fgets($memh);
lhoseinfardl('SendMessage',[
'chat_id'=>$memuser,
'text'=>$text
]);
}
}
elseif($text == "فوروارد همگانی✒"&& $from_id == $dev[0]){
$user['step'] = "fwdtoall";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"لطفا پیام خود را فروارد کنید💢",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[
['text'=>"پنل مدیریت💒"],
],
]
])
]);
}
elseif($step == "fwdtoall"){
$user['step'] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
$mem = file_get_contents("data/members.txt");
$memer = explode("\n",$mem); 
for ($i=0;$i<=count($memer)-1;$i++){ 
$koja = $memer["$i"];
lhoseinfardl('ForwardMessage',[
'chat_id'=>$koja,
'from_chat_id'=>$chat_id,
'message_id'=>$message_id]);
}
lhoseinfardl('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"پیام شما با موفقیت به تمام اعضا فروارد شد❗️",
]);
}


elseif($text == "پیام به کاربر📌"&& $from_id == $dev[0]){
$user['step'] = "pmmemd";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
lhoseinfardl('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"پیام خودتون رو ارسال کنید️",
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[
['text'=>"پنل مدیریت💒"],
],
]
])
]);
}
elseif($step == "pmmemd"){
$admin['pm'] = "$text";
$outjson = json_encode($admin,true);
file_put_contents("data/admins.json",$outjson);
lhoseinfardl('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"ایدی عددی کاربر",
'parse_mode'=>"MarkDown",
]);
$user['step'] = "pmmemdd";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
}
elseif($step == "pmmemdd"){
 $pmm = $admin["pm"];
lhoseinfardl('sendMessage',[
'chat_id'=>$text,
'text'=>"$pmm",
'parse_mode'=>"MarkDown",
]);
$user['step'] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id/$from_id.json",$outjson);
lhoseinfardl('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"ok",
'parse_mode'=>"MarkDown",
]);
}

//My ch: @lhoseinfardl
?>