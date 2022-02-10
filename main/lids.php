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
			
			<div id="lid"></div>
		</div>

		<div id="right_block">
			<div id="text">
				
			</div>
		</div>

	</div>
</body>
</html>

<script type="text/javascript">
	window.onload = function() {
		var text = document.getElementById('lid')

		function view_lids(){
			var request = new XMLHttpRequest();
			params = 'id=' + 'wer'
			request.open('POST', 'lid/lid_views_ajax.php');
			request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			request.send(params);
			request.onreadystatechange = function(){
				lid_info = JSON.parse(request.responseText);
				for(i=0;i<lid_info.length;i++){
					text.innerHTML += 
					`
					<div class='lid' onmouseover='send(${lid_info[i].id})'>
						Емаил: ${lid_info[i].email}<br>
						Статус: ${lid_info[i].status}<br>
						Телефон: ${lid_info[i].telephone}<br>
						<br><br>
						Данные: ${lid_info[i].data_checked}
		
		
						<div class='side_bar'>
							<img class='icon' src='../images/accept.png' width='100%' height='20%'>
							<img class='icon' src='../images/comment.png' width='100%' height='20%'>
							<img class='icon' src='../images/accept.png' width='100%' height='20%'>
						</div>
					</div>
					<br>
					`
				}
			}
		}
		view_lids()
	}


	var text = document.getElementById('text')
		function send(id){
			var params = 'id='+ id;
			var request = new XMLHttpRequest();
			request.open('POST', 'lid/lid_info_ajax.php');
			request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			request.send(params);
			request.onreadystatechange = function(){
				lid_info = JSON.parse(request.responseText);
			if(lid_info){
				if(lid_info['type'] == 'Юр'){
					text.innerHTML = 
					`
					<form action="lid/update_lid_info.php" method="POST">

					<h3>Тип: Юр</h3><br>

					<div class='border'> Название компании: <div class='right_side_info'>
						<input class='rs_inp' type='text' value='${lid_info.company_name}'>
					</div></div><br><br>

					<div class='border'> ИНН: <div class='right_side_info'>
						<input name='inn' class='rs_inp' type='text' value='${lid_info.inn}'>
					</div></div><br><br>

					<div class='border'> Юр. адрес: <div class='right_side_info'>
						<input class='rs_inp' type='text' value='${lid_info.ur_adress}'>
					</div></div><br><br>

					<input class='sbm' type='submit'>
					</form>
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
	.sbm{
		width: 85%;
		height: 5%;
		position: absolute;
		bottom: 2%;
		left: 5;
	}
	.rs_inp{
		text-align: right;
		border: 1px solid;
		border-bottom: 0px solid;
		float: right;
	}
	.right_side_info{
		float: right;	
		display: inline-block;
	}
	.border{
		width: 100%;
		display: inline-block;
		border-bottom: 1px solid;
	}
</style>