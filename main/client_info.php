<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<?php
	include_once '../connect.php';
	include_once '../head.php';
	include_once '../entree_client.php';
	?>
</head>
<body>
	<div id="main">
	<?php
	$root = root();
	if($root == True){ ?>
		
		<div id="client_info">
			
		</div>


	<?php }else{
		echo '<h1 style="color: red; font-size: 1200%;">root denied</h1>';
	} ?>
	</div>
</body>
</html>

<style type="text/css">
	#client_info{
		width: 40%;
		float: left;
		padding: 1%;
		min-height: 100%;
		display: inline-block;
		border: 1px solid;
	}
</style>