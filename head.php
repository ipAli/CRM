<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

	<?php
	include_once 'connect.php';
	include_once 'cookie.php';
	include_once 'user_data.php';
	?>
</head>
<body>
	<header>
		
	</header>

	<div id="left_bar">
		<a href="clients.php">clients</a><br>
		<a href="main.php">main</a><br>
		<a href="lids.php">lids</a><br>
	</div>
</body>
</html>

<style type="text/css">
	a{
		text-decoration: none;
		color: black;
	}
	#main{
		padding: 3%;
		border: 1px solid;
		float: right;
		overflow-y: auto;
		width: 83.5%;
		height: 72.35%;
	}
	#left_bar{
		width: 10%;
		height: 84.5%;
		float: left;
		border: 1px solid;
	}
	header{
		width: 100%;
		height: 15%;
		border: 1px solid;
	}
	body, html{
		font-family: 'Roboto', sans-serif;
		margin: 0 0 0 0;
		height: 100%;
		width: 100%;
		overflow-x: hidden;
		overflow-y: hidden;
		color: #4A4A4A;
	}
</style>