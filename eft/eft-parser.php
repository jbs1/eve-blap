<?php
require_once('parser-func.php');
header('Content-Type: application/json;charset=utf-8');

$json=array();

$eft_module_order=array("low","mid","high","rig","subsystem","drone","cargo");

$split=preg_split("/(\n|\r|\r\n)/", $_POST['eft']);

$match=array();

preg_match("/\[(\w+)\s*,\s*.+\]/", array_shift($split), $match);//title
$json["ship"]=array("name"=>$match[1],"id"=>get_typeid($match[1]));


foreach ($split as $value) {
	if(!empty($value)&&preg_match("/\[.+\]/",$value)===0){//if it is not empty line or pyfa [empty slot]
		preg_match("/(?:([\w -']+) x\d+|([\w -']+)),*[\w ]*/", $value, $match);//take module name without ammo & special case for stuff with amount (eg. Hobgoblin x5). selecting proper match group via empty($match[1])?$match[2]:$match[1])
		$current_match=empty($match[1])?$match[2]:$match[1];

		switch ($eft_module_order[0]) {//check what module type we are currently checking
			case 'low':
				if(is_low(get_typeid($current_match))){//check if current module fit current type beeing checked
					if(!isset($json['low'])){//make sure array for current type is initialized
						$json['low']=array();
					}
					array_push($json['low'],array("name"=>$current_match,"id"=>get_typeid($current_match),"meta"=>get_metalevel(get_typeid($current_match))));//add module to current types array
					break;
				} else {
					array_shift($eft_module_order);//if not the corret type move on to next one
				}

			case 'mid':
				if(is_mid(get_typeid($current_match))){
					if(!isset($json['mid'])){
						$json['mid']=array();
					}
					array_push($json['mid'],array("name"=>$current_match,"id"=>get_typeid($current_match),"meta"=>get_metalevel(get_typeid($current_match))));
					break;
				} else {
					array_shift($eft_module_order);
				}

			case 'high':
				if(is_high(get_typeid($current_match))){
					if(!isset($json['high'])){
						$json['high']=array();
					}
					array_push($json['high'],array("name"=>$current_match,"id"=>get_typeid($current_match),"meta"=>get_metalevel(get_typeid($current_match))));
					break;
				} else {
					array_shift($eft_module_order);
				}

			case 'rig':
				if(is_rig(get_typeid($current_match))){
					if(!isset($json['rig'])){
						$json['rig']=array();
					}
					array_push($json['rig'],array("name"=>$current_match,"id"=>get_typeid($current_match),"meta"=>get_metalevel(get_typeid($current_match))));
					break;
				} else {
					array_shift($eft_module_order);
				}

			case 'subsystem':
				if(is_subsystem(get_typeid($current_match))){
					if(!isset($json['subsystem'])){
						$json['subsystem']=array();
					}
					array_push($json['subsystem'],array("name"=>$current_match,"id"=>get_typeid($current_match),"meta"=>get_metalevel(get_typeid($current_match))));
					break;
				} else {
					array_shift($eft_module_order);
				}

			case 'drone':
				if(is_drone(get_typeid($current_match))){
					if(!isset($json['drone'])){
						$json['drone']=array();
					}
					array_push($json['drone'],array("name"=>$current_match,"id"=>get_typeid($current_match),"meta"=>get_metalevel(get_typeid($current_match))));
					break;
				} else {
					array_shift($eft_module_order);
				}

		}
	}
}
echo json_encode($json);
?>