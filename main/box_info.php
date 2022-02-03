<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<?php
	include_once '../connect.php';
	include_once '../head.php';
	include_once '../entree_box.php';
	$box_id = $_GET['id'];
	?>
</head>
<body>
	<div id="main">
		<?php	
		//request (GET, POST)
		$request= [$box_id];
		//DB struct
		$DBtable = ['id'];
		//select_name
		$select_name = [];
		$query = sql_query('boxs', $request, $DBtable, null);

		$result = $mysqli->query($query);
		while($base = $result->fetch_assoc()){ 
			$city = $base['city'];
			$size_b = $base['size_b'];
			$stage = $base['stage'];
			$box_number = $base['box_number'];
			$size_i = $base['size_i'];
			$length = $base['length'];
			$width = $base['width'];
			$height = $base['height'];
			$area = $base['area'];
			$volume = $base['volume'];
			$loading = $base['loading'];
			$location = $base['location'];
			$company_owner = $base['company_owner'];
		}
		?>
		<div id="box_info">
			<form action="box/box_update.php" method="post">
				<b>Город</b>
				<input type="text" name="city" value="<?= $city ?>">
				<b>Размеры (буквы)</b>
				<input type="text" name="size_b" value="<?= $size_b ?>">
				<b>Этаж</b>
				<input type="number" name="stage" value="<?= $stage ?>">
				<b>Номер бокса</b>
				<input type="number" name="box_number" value="<?= $box_number ?>">
				<b>Размеры (число)</b>
				<input type="number" name="size_i" value="<?= $size_i ?>">
				<b>Длина</b>
				<input type="number" name="length" value="<?= $length ?>">
				<b>Ширина</b>
				<input type="number" name="width" value="<?= $width ?>">
				<b>Высота</b>
				<input type="number" name="height" value="<?= $height ?>">
				<b>Площадь</b>
				<input type="number" name="area" value="<?= $area ?>">
				<b>Обьем</b>
				<input type="number" name="volume" value="<?= $volume ?>">
				<b>Нагрузка кг</b>
				<input type="number" name="loading" value="<?= $loading ?>">
				<b>Локация</b>
				<input type="text" name="location" value="<?= $location ?>">
				<b>Компания</b>
				<input type="text" name="company_owner" value="<?= $company_owner ?>">
				<b></b>
			</form>
		</div>

		<div id="arenda_info">
			<div id="arenda">
				
			</div>
			<div id="arenda_footer" onclick="get_arenda_data(<?= $box_id ?>)">
				Загрузить договора
			</div>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">

	//Unput name="company_owner" locked
	window.onload = function() {
		<?php
		if($ROOT < 3){
			if($ROOT == 2 and $COMPANY_OWNER == $company_owner){

			}else{ ?>
				document.querySelector('input[name="company_owner"]').readOnly = true;
			<? } ?>
			
		<?php } ?>
	}

	//Ajax box_arenda
	function get_arenda_data(id){
		var params = 'id='+id;
		var request = new XMLHttpRequest();
		request.open('POST', 'box/box_arenda_ajax.php');
		request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		request.send(params);
		request.onreadystatechange = function(){
			var info = JSON.parse(request.responseText);
			for(i=0; i<info.length; i++){
				
				if(i==0){
					var info_line = 
					"<div class='info_line'>"+

					new Date(info[i]['date_ot'] * 1000).toLocaleDateString("en-US")+
					" | "+
					new Date(info[i]['date_do'] * 1000).toLocaleDateString("en-US")+
					" | "+
					info[i]['type']+
					" | "+
					info[i]['fullname']+
					" | "+
					info[i]['telephone']+

					"</div>"
				}else{
					var info_line = 
					info_line + 
					"<div class='info_line'>"+

					new Date(info[i]['date_ot'] * 1000).toLocaleDateString("en-US")+
					" | "+
					new Date(info[i]['date_do'] * 1000).toLocaleDateString("en-US")+
					" | "+
					info[i]['type']+
					" | "+
					info[i]['fullname']+
					" | "+
					info[i]['telephone']+

					"</div>"
				}
				document.getElementById('arenda').innerHTML = info_line;
			}
		}
	}
</script>
<style type="text/css">
	#arenda{
		left: -1px;
		position: absolute;
		width: 94%;
		padding: 2%;
		height: 81%;
	}
	.info_line{
		margin: 0 0 2% 0;
		position: static;
		width: 100%;
		padding: 1%;
		border: 1px solid;
	}
	input{
		width: 99%;
		height: 1.8em;
		margin: 0 0 3% 0;
	}
	#arenda_footer:hover{
		background-color: #7EB46C;
	}
	#arenda_footer{
		cursor: pointer;
		text-align: center;
		padding: 3.3% 0 0 0;
		position: absolute;
		border: 1px solid;
		width: 100%;
		height: 6.6%;
		left: -1px;
		bottom: -1px;
	}
	#arenda_info{
		position: relative;
		width: 40%;
		float: right;
		padding: 1%;
		min-height: 100%;
		display: inline-block;
		border: 1px solid;
	}	

	#box_info{
		width: 40%;
		float: left;
		padding: 1%;
		min-height: 100%;
		display: inline-block;
		border: 1px solid;
	}	
</style>