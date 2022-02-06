<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<?php
	include_once '../head.php';
	?>
</head>
<body>
	<div id="main">
		<div id="left_block">
			<?php
			//request (GET, POST)
			$request= [];
			//DB struct
			$DBtable = [];
			//select_name
			$select_name = [];
			$query = sql_query('users', $request, $DBtable, $select_name);
	
			$result = $mysqli->query($query);
			while($base = $result->fetch_assoc()){ 
	
				$this_id = $base['id'];
				$query = "SELECT `id` FROM `user_info` WHERE `connect_id` = '$this_id'";
				$data = mysqli_query($connect, $query);
				if(mysqli_fetch_all($data)){
					$data_checked = "Заполнены";
				}else{
					$data_checked = "Отсутствую";
				}
				?>
	
				<div class="lid" onmouseover="send(<?= $base['id'] ?>)">
					Емаил: <?= $base['email'] ?><br>
					Статус: <?= $base['status'] ?><br>
					Телефон: <?= $base['telephone'] ?><br>
					<br><br>
					Данные: <?= $data_checked ?>


					<div class="side_bar">
						<img class="icon" src="../images/accept.png" width="100%" height="20%">
						<img class="icon" src="../images/comment.png" width="100%" height="20%">
						<img class="icon" src="../images/accept.png" width="100%" height="20%">
					</div>
				</div>
	
				<br>
	
			<?php } ?>
		</div>

		<div id="right_block">
			<div id="text">
				
			</div>
		</div>

	</div>
</body>
</html>

<style type="text/css">
	.icon{
		margin: 0 0 100% 0;
	}
	.side_bar{
		width: 7%;
		height: 134%;
		position: relative;
		display: none;
		left: 97.5%;
		bottom: 130%;
	}
	.lid:hover .side_bar{
		display: block;
	}
	.lid{
		display: inline-block;
		border: 1px solid;
		width: 18em;
		height: 6em;
		padding: 1em;
		margin: 0 2em 2em 0;
		vertical-align: top;
	}
	#left_block{
		display: inline-block;
		width: 50%;
	}
	#right_block{
		display: inline-block;
		position: fixed;
		right: 3%;
		float: right;
		width: 25%;
		border: 1px solid;
		height: 65%;
		padding: 2.5%;
		overflow: auto;
		
	}
	.right_side_info{
		float: right;
	}
	.border{
		border-bottom: 1px solid;
	}
</style>

<script type="text/javascript">
	var text = document.getElementById('text')
	function send(id){
		var params = 'id='+id;
		var request = new XMLHttpRequest();
		request.open('POST', 'lid/lid_info_ajax.php');
		request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		request.send(params);
		request.onreadystatechange = function(){
			lid_info = JSON.parse(request.responseText);
			//alert(lid_info['type'])
			if(lid_info){
				if(lid_info['type'] == 'Юр'){
					text.innerHTML= 
					`
					<h3>Тип: Юр</h3><br>
					<div class='border'> Название компании: <div class='right_side_info'>${lid_info.company_name}</div></div><br>
					<div class='border'> ИНН: <div class='right_side_info'>${lid_info.inn}</div></div><br>
					<div class='border'> Юр. адрес: <div class='right_side_info'>${lid_info.ur_adress}</div></div><br>
					`
				}else{
				text.innerHTML= 
					`
					<h3>Тип: Физ</h3><br>
					<div class='border'> Имя: <div class='right_side_info'>${lid_info.name}</div></div><br>
					`
				}
			}else{
				text.innerHTML= 
					`
					<h1 style="text-align: center;">Нет данных</h1>
					`
			}
			
		}
	}
	
</script>