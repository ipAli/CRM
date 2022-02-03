<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<?php
	include_once '../connect.php';
	include_once '../head.php';
	?>
</head>
<body>
	<?php
	/*

	Проверка статуса боксов

	*/

	//request (GET, POST)

	$request= [$COMPANY_OWNER];
	//DB struct
	$DBtable = ['company_owner'];
	$select_name = ['id', 'arenda_info'];
	$query_post = sql_query('boxs', $request, $DBtable, $select_name);
	$result = $mysqli->query($query_post);

	while($base = $result->fetch_assoc()){

		// ЕСЛИ НЕ БРОНЬ И НЕ ЗАДОЛЖНОСТЬ
		if($base['arenda_info'] != 'бронь' and $base['arenda_info'] != 'задолжность'){

			//request (GET, POST)
			$request_1 = [$base['id']];
			$box_id = $base['id'];
			//DB struct
			$DBtable_1 = ['connect_box_id'];
			$select_name_1 = ['arenda_do', 'arenda_ot'];
			$query_post_1 = sql_query('user_arenda', $request_1, $DBtable_1, $select_name_1, True, 'arenda_do');
			$result_1 = $mysqli->query($query_post_1);
	
			while($base_1 = $result_1->fetch_assoc()){

				if($base_1['arenda_ot'] < time() and time() < $base_1['arenda_do']){
					$query_change_status = "UPDATE `boxs` SET `arenda_info`='занято' WHERE `id` = '$box_id'"; 
					mysqli_query($connect, $query_change_status);
				}else{
					$query_change_status = "UPDATE `boxs` SET `arenda_info`='свободно' WHERE `id` = '$box_id'"; 
					mysqli_query($connect, $query_change_status);
				}
			}
		}

	}
	
	?>
	<div id="main">
		<?php
		//request (GET, POST)
		$request= [$COMPANY_OWNER];
		//DB struct
		$DBtable = ['company_owner'];
		$select_name = ['city'];
		$query_post = sql_query('boxs', $request, $DBtable, $select_name);
		$posts = mysqli_query($connect, $query_post); 
		$posts = mysqli_fetch_all($posts);
		$city = array();
		foreach($posts as $post){
			array_unshift($city, $post[0]);
		}
		$city = array_unique($city);

		foreach($city as $city){
			?><div style="font-size: 1.3em; margin: 2% 0 0 0"><?= $city ?></div><?

			//request (GET, POST)
			$request= [$city];
			//DB struct
			$DBtable = ['city'];
			$select_name = ['location'];
			$query = sql_query('boxs', $request, $DBtable, $select_name);

			$base = mysqli_query($connect, $query); 
			$base = mysqli_fetch_all($base);
			
			$location = array();
			foreach($base as $base){
				array_unshift($location, $base[0]);
			}

			foreach($location as $location){
				?><div style="font-size: 0.8em; margin: 0 0 1% 0;"><?= $location ?></div><?

				//request (GET, POST)
				$request= [$city, $location];
				//DB struct
				$DBtable = ['city', 'location'];
				$select_name = ['stage'];
				$query = sql_query('boxs', $request, $DBtable, $select_name);
	
				$base = mysqli_query($connect, $query); 
				$base = mysqli_fetch_all($base);
				
				$stage = array();
				foreach($base as $base){
					array_unshift($stage, $base[0]);
				}

				foreach($stage as $stage){
					?><div style="color: #7FB36B; width: 100%; border-bottom: 1px solid;"><?= $stage.' этаж' ?></div><br><?

					//request (GET, POST)
					$request= [$city, $location];
					//DB struct
					$DBtable = ['city', 'location'];
					$query = sql_query('boxs', $request, $DBtable, null);

					$result = $mysqli->query($query);
					while($base = $result->fetch_assoc())
					{ ?>
					   <a href="box/box_info.php?id=<?= $base['id'] ?>"><div class="box <?= $base['arenda_info'] ?>" onmouseover="send(<?= $base['id'] ?>)">
					   		<?= $base['box_number'] ?> <?= $base['size_b'] ?>
					   </div></a>
					<? }
				}
			}
		}
		?>
	</div>

	<div id="box_info" onmouseover="info_box_visible()">
		<div id="timer"></div><br>

		id = <b id="box_id"></b>
	</div>
</body>
</html>
<script>
	box_info = document.querySelector('#box_info');
	box_info.style.display='none'


	function send(id){
		var params = 'id='+id;
		var request = new XMLHttpRequest();
		request.open('POST', 'box/box_info_ajax.php');
		request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		request.send(params);
		request.onreadystatechange = function(){
			var box = JSON.parse(request.responseText);
			//alert(request.responseText)
			info_box_visible()
			document.querySelector('#box_id').innerHTML = box['id'];
		}
	}
	var time = 1000
	var counter = 0
	function info_box_visible(){
		box_info.style.display='block'
		

		if(counter < 1){
			var box_function = setInterval(() => { 
				box_info.style.display='block'
				
				time -= 1;
				if(time <= 0){
					clearInterval(box_function);
					box_info.style.display='none'
					counter = 0
				}

				document.querySelector('#timer').style.width= time/10 + 7 + '%';
			}, 50);
			counter = 1
		}else{
			time = 1000
		}
	}
</script>
<style type="text/css">
	#timer{
		height:	1.5%;
		background-color: #7FB36B;
		margin: -1% 0 0 -7%;
	}
	#box_info{
		position: fixed;
		padding: 0% 0% 0% 1%;
		width: 15%;
		height: 40%;
		border: 1px solid;
		right: 1%;
		bottom: 0;
	}
	.box{
		width: 4%;
		height: 2.8%;
		border: 1px solid;
		border-radius: 5px;
		font-size: 0.8em;
		display: inline-block;
		padding: 0.4%;

	}
	.просрочено{
		background-color: #D24545;
	}
	.бронь{
		background-color: #E0E0E0;
	}
	.свободно{
		background-color: white;
	}
	.занято{
		background-color: #7FB36B;
	}
</style>

