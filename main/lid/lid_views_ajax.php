<?php
	include_once '../../connect.php';
	//request (GET, POST)
	$request= [];
	//DB struct
	$DBtable = [];
	//select_name
	$select_name = [];
	$query = sql_query('users', $request, $DBtable, $select_name);
	
	$result = $mysqli->query($query);

	$data = array();

	while($base = $result->fetch_assoc()){ 
	
		$this_id = $base['id'];
		$query = "SELECT `id` FROM `user_info` WHERE `connect_id` = '$this_id'";
		$data_check = mysqli_query($connect, $query);
		if(mysqli_fetch_all($data_check)){
			$data_checked = "Заполнены";
		}else{
			$data_checked = "Отсутствуют";
		}

		$add = array(
			'id'=>$base['id'],
			'email'=>$base['email'],
			'status'=>$base['status'],
			'telephone'=>$base['telephone'],
			'data_checked'=>$data_checked
		);
		array_unshift($data, $add);
	}


	echo json_encode($data);


?>