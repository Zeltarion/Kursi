<?php
//  error_reporting(E_ALL);
/* $DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
define("code_dir", $DOCUMENT_ROOT."/code/my_codegen/");
*/
//âûøå âàðèàíò, êîòîðûé íàäî èñïîëüçûâàòü ïðè ðàñïîëîæåíèè ñàéòà â èíòåðíåòå, à íå íà ÏÊ.

//íà ëîêàëå
$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
define("code_dir", "my_codegen/");



function generate_code() //ãåíåðèðóåì êîä
{
                
    $hours = date("H"); // ÷àñ       
    $minuts = substr(date("H"), 0 , 1);// ìèíóòà 
    $mouns = date("m");    // ìåñÿö             
    $year_day = date("z"); // äåíü â ãîäó

    $str = $hours . $minuts . $mouns . $year_day; //ñîçäàåì ñòðîêó
    $str = md5(md5($str)); //äâàæäû øèôðóåì â md5
	$str = strrev($str);// ðåâåðñ ñòðîêè
	$str = substr($str, 3, 6); // èçâëåêàåì 6 ñèìâîëîâ, íà÷èíàÿ ñ 3
	// Âàì êîíå÷íî æå ìîæíî ïîñòâàèòü äðóãèå çíà÷åíèÿ, òàê êàê, åñëè âçëîìùèêè óçíàþò, êàêèì èìåííî ñïîñîáîì ýòî âñå ãåíåðèðóåòñÿ, òî â çàùèòå íå áóäåò ñìûñëà.
	

    $array_mix = preg_split('//', $str, -1, PREG_SPLIT_NO_EMPTY);
    srand ((float)microtime()*1000000);
    shuffle ($array_mix);
	//Òùàòåëüíî ïåðåìåøèâàåì, ñîëü, ñàõàð ïî âêóñó!!!
    return implode("", $array_mix);
}

function img_code() //Áåðåì êàðàíäàøè è ðèñóåì êàðòèíêó :)
{

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");                   
header("Last-Modified: " . gmdate("D, d M Y H:i:s", 10000) . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");         
header("Cache-Control: post-check=0, pre-check=0", false);           
header("Pragma: no-cache");                                           
header("Content-Type:image/png");
//çàùèòà îò êýøèðîâàíèÿ...êñòàòè ñêàçàòü íå î÷åíü íàäåæíàÿ...

$linenum = 2; //ëèíèè
$img_arr = array(
                 "codegen.png",//ôîí èçîáðàæåíèÿ. Ìîæåòå ñàìè íàðèñîâàòü
                 "codegen0.png"//ôîí èçîáðàæåíèÿ. Ìîæåòå ñàìè íàðèñîâàòü
                );

$font_arr = array();
$font_arr[0]["fname"] = "verdana.ttf"; //ttf øðèôòû, ìîæíî çàìåíèòü íà ñâîè
$font_arr[0]["size"] = 16;//ðàçìåð
$font_arr[1]["fname"] = "times.ttf"; //ttf øðèôòû, ìîæíî çàìåíèòü íà ñâîè
$font_arr[1]["size"] = 16;//ðàçìåð

$n = rand(0,sizeof($font_arr)-1);
$img_fn = $img_arr[rand(0, sizeof($img_arr)-1)];
$im = imagecreatefrompng (code_dir . $img_fn); //ñîçäàåì èçîáðàæåíèå ñî ñëó÷àéíûì ôîíîì

for ($i=0; $i<$linenum; $i++)
{
//ðèñóåì ëèíèè
    $color = imagecolorallocate($im, rand(0, 150), rand(0, 100), rand(0, 150));
    imageline($im, rand(0, 20), rand(1, 50), rand(150, 180), rand(1, 50), $color);
}

$color = imagecolorallocate($im, rand(0, 200), 0, rand(0, 200));
imagettftext ($im, $font_arr[$n]["size"], rand(-4, 4), rand(10, 45), rand(20, 35), $color, code_dir.$font_arr[$n]["fname"], generate_code());//íàêëàäûâàåì êîä

for ($i=0; $i<$linenum; $i++)//åùå ðàç ëèíèè! Óæå ñâåðõó.
{
    $color = imagecolorallocate($im, rand(0, 255), rand(0, 200), rand(0, 255));
    imageline($im, rand(0, 20), rand(1, 50), rand(150, 180), rand(1, 50), $color);
}

ImagePNG ($im);
ImageDestroy ($im);//íó âîò è ñîçäàíî èçîáðàæåíèå!
}

img_code();
?>
