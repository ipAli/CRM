<?php
include_once '../../connect.php';

$box_id = $_POST['id'];
//request (GET, POST)
$request= [$box_id];
//DB struct
$DBtable = ['connect_box_id'];
//select_name
$query = sql_query('user_arenda', $request, $DBtable, null);
$result = $mysqli->query($query);

$array = array();

while($base = $result->fetch_assoc())
{
    $date_do = $base['arenda_do'];
    $date_ot = $base['arenda_ot'];

    $request_client = [$base['connect_user_id']];
    $DBtable_client = ['id'];
    $query_client = sql_query('user_info', $request_client, $DBtable_client, null);

    $result_client = $mysqli->query($query_client);
    while($base_client = $result_client->fetch_assoc())
    {
        $type = $base_client['type'];
        if($base_client['type'] == 'Физ'){
            $fullname = $base_client['name'].' '.$base_client['surname'];
            $telephone = $base_client['telephone'];
            $email = $base_client['email'];
        }else{
            $fullname = $base_client['company_name'];
            $telephone = $base_client['telephone'];
            $email = $base_client['email'];
        }
    }
    $data = array(
        'date_do'=>$date_do,
        'date_ot'=>$date_ot,
        'type'=>$type,
        'fullname'=>$fullname,
        'telephone'=>$telephone,
        'email'=>$email
    );
    array_unshift($array, $data);
}
echo json_encode($array);

