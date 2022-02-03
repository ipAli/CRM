<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<?php
	include_once '../../connect.php';
	include_once '../../head.php';
	include_once '../../entree_client.php';

	$client_id = $_GET['id'];

	//Find type	
	$request= [$client_id];
	$DBtable = ['id'];
	$select_name = [];
	$query = sql_query('user_info', $request, $DBtable, null);

	$result = $mysqli->query($query);
	while($base = $result->fetch_assoc()){
		$surname = $base['surname'];
		$name = $base['name'];
		$address = $base['address'];
		$telephone = $base['telephone'];
		$email = $base['email'];
		$series = $base['series'];
		$number = $base['number'];
		$date = $base['date'];
		$cod = $base['cod'];
		$issued = $base['issued'];
		$photo_1 = base64_encode($base['photo_1']);
		$photo_2 = base64_encode($base['photo_2']);
		$type = $base['type'];
		$inn = $base['inn'];
		$company_name = $base['company_name'];
		$ur_adress = $base['ur_adress'];
		$RS = $base['RS'];
		$director = $base['director'];
		$KS = $base['KS'];
		$fact_adress = $base['fact_adress'];
		$bic = $base['bic'];
		$checked = $base['checked'];
		$manager = $base['manager'];
		$company_owner =$base['company_owner'];
	}
	?>
</head>
<body>
	<div id="main">
	<?php
	$root = root();
	if($root){ ?>
		
		<div id="client_info">
			<form action="client_info_update.php">
				<?php
				if($type == 'Физ'){ ?>

					<b>Имя</b><br>
					<input type="text" name="name" value="<?= $name ?>"><br>
					<b>Фамилия</b><br>
					<input type="text" name="name" value="<?= $surname ?>"><br>
					<b>Адрес</b><br>
					<input type="text" name="name" value="<?= $address ?>"><br>
					<b>Телефон</b><br>
					<input type="text" name="name" value="<?= $telephone ?>"><br>
					<b>E-mail</b><br>
					<input type="text" name="name" value="<?= $email ?>"><br>
					<b>Серия п.</b><br>
					<input type="text" name="name" value="<?= $series ?>"><br>
					<b>Номер п.</b><br>
					<input type="text" name="name" value="<?= $number ?>"><br>
					<b>Дата выдачи</b><br>
					<input type="text" name="name" value="<?= $date ?>"><br>
					<b>Код</b><br>
					<input type="text" name="name" value="<?= $cod ?>"><br>
					<b>Выдан</b><br>
					<input type="text" name="name" value="<?= $issued ?>"><br>
					<img class="main_img" src="data:image/jpeg;base64, <?= $photo_1 ?>" alt="" width="" height="">
					<img class="main_img" src="data:image/jpeg;base64, <?= $photo_2 ?>" alt="" width="" height="">
					<label for="phone">Enter your phone number:</label>

				<?php }else{ ?>

					<b>Комапния</b><br>
					<input type="text" name="name" value="<?= $name ?>"><br>
					<b>ИНН</b><br>
					<input type="text" name="name" value="<?= $name ?>"><br>
					<b>Юр. адрес</b><br>
					<input type="text" name="name" value="<?= $name ?>"><br>
					<b>РС</b><br>
					<input type="text" name="name" value="<?= $name ?>"><br>
					<b>директор</b><br>
					<input type="text" name="name" value="<?= $name ?>"><br>
					<b>КС</b><br>
					<input type="text" name="name" value="<?= $name ?>"><br>
					<b>фактисческий адрес</b><br>
					<input type="text" name="name" value="<?= $name ?>"><br>
					<b>бик</b><br>
					<input type="text" name="name" value="<?= $name ?>"><br>


				<?php } ?>
			</form>
		</div>

		<div id="documents">
			<div class="document">
				
			</div>
		</div>


	<?php }else{
		echo '<h1 style="color: red; font-size: 1200%;">root denied</h1>';
	} ?>
	</div>
</body>
</html>

<style type="text/css">
	.document{
		width: 100%;
		height: 10%;
		border: 1px solid;
	}
	#documents{
		width: 40%;
		float: right;
		padding: 1%;
		min-height: 100%;
		display: inline-block;
		border: 1px solid;
	}
	.main_img{
		width: 48%;
		margin: 3% 0 0 0;
		height: 20em;
		display: inline-block;
	}
	#client_info{
		width: 40%;
		float: left;
		padding: 1%;
		min-height: 100%;
		display: inline-block;
		border: 1px solid;
	}
</style>