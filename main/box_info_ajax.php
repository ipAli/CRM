<?php
include_once '../connect.php';

$id = $_POST['id'];
$query = "SELECT * FROM `boxs` WHERE `id` = '$id'";
$result = $mysqli->query($query);
while($base = $result->fetch_assoc())
{
    $data = array(
    	'id'=>$base['id'],
    	'box_number'=>$base['box_number']
    );
}
echo json_encode($data);

