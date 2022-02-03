<?php
include_once 'user_data.php';
include_once 'connect.php';
function root(){
	$first_id = $_GET['id'];

	global $mysqli;
	global $ROOT;
	global $COMPANY_OWNER;
	global $CITY;
	global $NAME;
	global $ID;
	/*
	
	Находим клиента, менеджера клиента и компанию-владельца
	
	*/
	//request (GET, POST)
	$request= [$first_id];
	//DB struct
	$DBtable = ['id'];
	//select_name
	$select_name = ['manager', 'company_owner'];
	$query = sql_query('user_info', $request, $DBtable, $select_name);
	
	
	$result = $mysqli->query($query);
	while($base = $result->fetch_assoc()){
		$manager = $base['manager'];
		$company_owner = $base['company_owner'];
	}

	if($ROOT < 3){
		
		if($ROOT == 2 and $company_owner == $COMPANY_OWNER){
			return True;
		}
		if($company_owner == $COMPANY_OWNER and $manager == $ID){
			return True;
		}
	}else{
		return True;
	}
}

?>