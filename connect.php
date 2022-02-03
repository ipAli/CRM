<?php
$db_host='localhost'; // ваш хост
$db_name='test'; // ваша бд
$db_user='root'; // пользователь бд
$db_pass=''; // пароль к бд

$connect = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name); // коннект с сервером бд


//request (GET, POST)
$request= [];
//DB struct
$DBtable = [];
//select_name
$select_name = [];
function sql_query($DBname, $request, $DBtable, $select_name, $order = false, $order_name = 0){
	global $connect;
	global $ROOT;
	global $COMPANY_OWNER;
	global $CITY;
	global $NAME;
	global $ID;

	$query = "SELECT";
	if($select_name){
		$x = 0;
		foreach($select_name as $select_name){
			if($x == 0){
				$query = $query." ".$select_name." "; 
				$x = 1;
			}else{	
				$query = $query.", ".$select_name." ";
			}
		}
	}else{
		$query = $query." * ";
	}
	$query = $query."FROM `$DBname`";
	$x = false;
	$i = 0;
	foreach($request as $base){
		if($base){
			if($DBtable[$i] == 'company_owner' and $ROOT == 3){

			}else{
				if($x){
					$query = $query." AND "."`".$DBtable[$i]."`"." = "."'".$base."'";
				}else{
					$query = $query." WHERE "."`".$DBtable[$i]."`"." = "."'".$base."'";
					$x = true;
				}
			}
		}
		$i += 1;		
	}
	if($order){
		$query = $query."ORDER BY ".$order_name." DESC LIMIT 1";
	}
	return $query;

}
?>

