<?php

include "db.php";

$fill_table = $_GET['fill_table'];
$fill_id = $_GET['fill_id'];

$stmt = $conn->prepare("SELECT * FROM $fill_table
WHERE report_id = '$fill_id' LIMIT 1");

$stmt->execute();

$columns = $stmt->fetch(PDO::FETCH_ASSOC);

var_dump($columns);
$data = [];

foreach ($columns as $column_name => $column_value) {
    $data[$column_name] =  $column_value;
}

var_dump($data);

echo json_encode($data);

//$stmt = $conn->prepare("SELECT * FROM $fill_table
//WHERE report_id = '$fill_id' LIMIT 1");
//
//if ($stmt->execute(array())) {
//    $data = array();
//    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//        $data[] = $row;
//    }
//    echo json_encode($data);
//}
//



?>