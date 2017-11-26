<?php
require_once('../parser-func.php');

$json=array();

$split=preg_split("/(\n|\r|\r\n)/", $_POST['fit']);

$match=array();

preg_match("/\[(\w+)\s*,\s*.+\]/", array_shift($split), $match);//title
$json["ship_name"]=$match[1];


$json["slots"]=array();

foreach ($split as $value) {
	if(!empty($value)&&preg_match("/\[.+\]/",$value)===0){//if it is not empty line or pyfa [empty slot]
		preg_match("/([\w -]+),*[\w ]*/", $value, $match);//take module name without ammo
		array_push($json["slots"], $match[1]);
	}
}

// json_encode($json);
// var_dump($split);
var_dump($json);
?>