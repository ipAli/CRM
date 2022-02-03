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
	<div id="main">
		 <table width="80%">
   			<tr>
    			<th class="names">ФИО/Компания</th>	
    			<th class="telephone">Телефон</th>
    			<th class="email">Email</th>
    			<th class="type">Тип</th>
    			<th class="manager">Менеджер</th>
   			</tr>
   				<?php
   					//request (GET, POST)
					$request= [$COMPANY_OWNER];
					//DB struct
					$DBtable = ['company_owner'];
					//select_name
					$select_name = ['id', 'name', 'surname','type', 'company_name', 'telephone', 'manager'];
					$query = sql_query('user_info', $request, $DBtable, $select_name);

					$result = $mysqli->query($query);
					while($base = $result->fetch_assoc()){ 
						if($base['manager']){
							//request (GET, POST)
							$request_man= [$base['manager']];
							//DB struct
							$DBtable_man = ['id'];
							//select_name
							$select_name_man = ['name'];
							$query_man = sql_query('managers', $request_man, $DBtable_man, $select_name_man);
	
							$result_man = $mysqli->query($query_man);
							while($base_man = $result_man->fetch_assoc()){
								$manager_name = $base_man['name'];
							}
						}else{
							$manager_name = null;
						}
						?>
						<tr>
							<?
							if($base['type'] == 'Физ'){ ?>
								<td onclick="window.location.href='client/client_info.php?id=<?=$base['id'] ?>'; return false" class="names"><?= $base['name'] ?></td>
								<td onclick="window.location.href='client/client_info.php?id=<?=$base['id'] ?>'; return false" class="telephone"><?= $base['telephone'] ?></td>
								<td onclick="window.location.href='client/client_info.php?id=<?=$base['id'] ?>'; return false" class="email"><?= $base['email'] ?></td>
								<td onclick="window.location.href='client/client_info.php?id=<?=$base['id'] ?>'; return false" class="type"><?= $base['type'] ?></td>
								<td onclick="window.location.href='client/client_info.php?id=<?=$base['id'] ?>'; return false" class="manager"><?= $manager_name ?></td>
							<? }else{ ?>
								<td onclick="window.location.href='client/client_info.php?id=<?=$base['id'] ?>'; return false" class="names"><?= $base['company_name'] ?></td>
								<td onclick="window.location.href='client/client_info.php?id=<?=$base['id'] ?>'; return false" class="telephone"><?= $base['telephone'] ?></td>
								<td onclick="window.location.href='client/client_info.php?id=<?=$base['id'] ?>'; return false" class="email"><?= $base['email'] ?></td>
								<td onclick="window.location.href='client/client_info.php?id=<?=$base['id'] ?>'; return false" class="type"><?= $base['type'] ?></td>
								<td onclick="window.location.href='client/client_info.php?id=<?=$base['id'] ?>'; return false" class="manager"><?= $manager_name ?></td>
							<? } ?>
								<td class="dop">icon</td>
    							<td class="dop">icon</td>
						</tr>
					<? }
				?>
   		</table>
   		<div id="setting">
   			<input type="checkbox" name="names">Фио<br>
   			<input type="checkbox" name="telephone">Телефон<br>
   			<input type="checkbox" name="email">Еmail<br>
   			<input type="checkbox" name="type">Тип<br>
   			<input type="checkbox" name="manager">Менеджер<br>
   		</div>
	</div>
</body>
</html>
<script type="text/javascript">
	var inp_names = document.querySelector('input[name="names"]');
	var inp_telephone = document.querySelector('input[name="telephone"]');
	var inp_email = document.querySelector('input[name="email"]');
	var inp_type = document.querySelector('input[name="type"]');
	var inp_manager = document.querySelector('input[name="manager"]');
	inp_manager.checked = false
	
	window.oninput = () =>{
		arr =  new Array(inp_names, inp_telephone, inp_email, inp_type, inp_manager)

		for(var j=0; j<arr.length; j++){
			var cookie_name = arr[j].name

			if(arr[j].checked == true){
				document.cookie = "client_view_" + cookie_name + "=1";
				var x = document.getElementsByClassName(cookie_name)
				for(i=0;i<x.length;i++){
					x[i].classList.remove('hidden')
				}
			}else{
				document.cookie = "client_view_" + cookie_name + "=0";
				var x = document.getElementsByClassName(cookie_name)
				for(i=0;i<x.length;i++){
					x[i].classList.add('hidden')
				}
			}
		}
	}

	var names = document.getElementsByClassName('names');
	var telephone = document.getElementsByClassName('telephone');
	var email = document.getElementsByClassName('email');
	var type = document.getElementsByClassName('type');
	var manager = document.getElementsByClassName('manager');

	array =  new Array()
	<?php

	if($_COOKIE['client_view_names'] == '0'){?> 
		array.push(names); 
		document.querySelector('input[name="names"]').checked = false;
	<?}else{ ?>
		document.querySelector('input[name="names"]').checked = true;
	<? } 
	if($_COOKIE['client_view_telephone'] == '0'){?> 
		array.push(telephone); 
		document.querySelector('input[name="telephone"]').checked = false;
	<?}else{ ?>
		document.querySelector('input[name="telephone"]').checked = true;
	<? } 
	if($_COOKIE['client_view_email'] == '0'){?> 
		array.push(email); 
		document.querySelector('input[name="email"]').checked = false;
	<?}else{ ?>
		document.querySelector('input[name="email"]').checked = true;
	<? } 
	if($_COOKIE['client_view_type'] == '0'){?> 
		array.push(type); 
		document.querySelector('input[name="type"]').checked = false;
	<?}else{ ?>
		document.querySelector('input[name="type"]').checked = true;
	<? } 
	if($_COOKIE['client_view_manager'] == '0'){?> 
		array.push(manager); 
		document.querySelector('input[name="manager"]').checked = false;
	<?}else{ ?>
		document.querySelector('input[name="manager"]').checked = true;
	<? } 

	?>

	for(var j=0; j<array.length; j++){
		for(var i=0; i < array[j].length; i++){
			array[j][i].classList.add("hidden");
		} 
	}
</script>
<style type="text/css">
	#setting{
		position: fixed;
		width: 20%;
		height: 20%;
		right: 1%;
		bottom: 1%;
		border: 1px solid;
	}
	.visible{
		display: block;
	}
	.hidden{
		display: none;
	}
	.dop{
		width: 5%;
		padding: 0%;
	}



	







	table {
		border-spacing: 0px 5px;
		font-weight: bold;
	}
	th {
		height: 40px;
		border: 1px solid;
		width: 20%;
		padding: 10px 20px;
		background: #80B26A;
		text-align: center;
	}
	tr{
		cursor: pointer
	}
	td {
		padding: 1%;
		margin: -1%;
		border: 1px solid;
		text-align: center;
		vertical-align: middle;
		padding: 10px;
		text-align: center;
		border-top: 2px solid #56433D;
		border-bottom: 2px solid #56433D;
		border-right: 2px solid #56433D;
	}
	tr:nth-child(odd){
		background-color: #ECFCE6;
	}
</style>
