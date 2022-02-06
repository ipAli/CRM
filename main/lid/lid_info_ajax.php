<?php
include_once '../../connect.php';

$id = $_POST['id'];
$query = "SELECT * FROM `user_info` WHERE `connect_id` = '$id'";
$result = $mysqli->query($query);

while($base = $result->fetch_assoc())
{
    $data = array(
    	'id'=>$base['id'],
    	'surname'=>$base['surname'],
    	'name'=>$base['name'],
    	'address'=>$base['address'],
    	'telephone'=>$base['telephone'],
    	'email'=>$base['email'],
    	'series'=>$base['series'],
    	'date'=>$base['date'],
    	'cod'=>$base['cod'],
    	'issued'=>$base['issued'],
    	'photo_1'=>base64_encode($base['photo_1']),
    	'photo_2'=>base64_encode($base['photo_2']),
    	'type'=>$base['type'],
    	'inn'=>$base['inn'],
    	'company_name'=>$base['company_name'],
    	'ur_adress'=>$base['ur_adress'],
    	'RS	'=>$base['RS'],
    	'director'=>$base['director'],
    	'KS'=>$base['KS'],
    	'fact_adress'=>$base['fact_adress'],
    	'bic'=>$base['bic']
    );
}
echo json_encode($data);
