<?php

function db_select_array($query)
{
	$db = new SQLite3($_SERVER['DOCUMENT_ROOT']."/sde/sqlite-latest.sqlite");
	$result=$db->query($query);

	$return=array();

	while($row=$result->fetchArray(SQLITE3_ASSOC)){
		array_push($return,$row);
	}

	return $return;
}

function get_typeid($name)
{
	return db_select_array("SELECT typeID FROM invTypes WHERE typeName='$name'")[0]["typeID"];
}

function is_low($typeid)
{
	$result=db_select_array("SELECT * FROM dgmTypeEffects WHERE typeID='$typeid' AND effectID=11");
	if(empty($result)){
		return false;
	} else {
		return true;
	}
}

function is_mid($typeid)
{
	$result=db_select_array("SELECT * FROM dgmTypeEffects WHERE typeID='$typeid' AND effectID=13");
	if(empty($result)){
		return false;
	} else {
		return true;
	}
}

function is_high($typeid)
{
	$result=db_select_array("SELECT * FROM dgmTypeEffects WHERE typeID='$typeid' AND effectID=12");
	if(empty($result)){
		return false;
	} else {
		return true;
	}
}

function is_rig($typeid)
{
	$result=db_select_array("SELECT * FROM dgmTypeAttributes WHERE typeID='$typeid' AND attributeID=1153");//calibration cost
	if(empty($result)){
		return false;
	} else {
		return true;
	}
}

function is_subsystem($typeid)
{
	$result=db_select_array("SELECT * FROM dgmTypeAttributes WHERE typeID='$typeid' AND attributeID=1366");//subSystemSlot
	if(empty($result)){
		return false;
	} else {
		return true;
	}
}

function is_drone($typeid)
{
	$groupid=db_select_array("SELECT groupID FROM invTypes WHERE typeID='$typeid'")[0]['groupID'];
	$catid=db_select_array("SELECT categoryID FROM invGroups WHERE groupID='$groupid'")[0]['categoryID'];

	if($catid==18){
		return true;
	} else {
		return false;
	}
}

function get_metalevel($typeid){
	$result=db_select_array("SELECT valueInt,valueFloat FROM dgmTypeAttributes WHERE typeID='$typeid' AND attributeID=633");

	if(empty($result)){
		return 0;
	} else {
		return isset($result[0]["valueInt"])?$result[0]["valueInt"]:$result[0]["valueFloat"];
	}
}


?>