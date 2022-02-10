<?php
include_once '../../connect.php';

$id = $_POST['id'];
$surname = $_POST['surname'];
$name = $_POST['name'];
$address = $_POST['address'];
$telephone = $_POST['telephone'];
$email = $_POST['email'];
$series = $_POST['series'];
$date = $_POST['date'];
$cod = $_POST['cod'];
$issued = $_POST['issued'];
$type = $_POST['type'];
$inn = $_POST['inn'];
$company_name = $_POST['company_name'];
$ur_adress = $_POST['ur_adress'];
$RS = $_POST['RS'];
$director = $_POST['director'];
$KS = $_POST['KS'];
$fact_adress = $_POST['fact_adress'];
$bic = $_POST['bic'];

echo $inn;
$query = "UPDATE `user_info` SET `inn` = '$inn' WHERE `id` = '3'";

//$query = "UPDATE `user_info` SET `id`='[value-1]',`connect_id`='[value-2]',`surname`='[value-3]',`name`='[value-4]',`address`='[value-5]',`telephone`='[value-6]',`email`='[value-7]',`series`='[value-8]',`number`='[value-9]',`date`='[value-10]',`cod`='[value-11]',`issued`='[value-12]',`photo_1`='[value-13]',`photo_2`='[value-14]',`type`='[value-15]',`inn`='[value-16]',`company_name`='[value-17]',`ur_adress`='[value-18]',`RS`='[value-19]',`director`='[value-20]',`KS`='[value-21]',`fact_adress`='[value-22]',`bic`='[value-23]',`checked`='[value-24]',`manager`='[value-25]',`company_owner`='[value-26]' WHERE `id` = '$id'";

mysqli_query($connect, $query);
$string = "Location: ../lids.php";
header($string);