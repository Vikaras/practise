<?php

include "db.php";

$fill_table = $_GET['fill_table'];
$fill_id = $_GET['fill_id'];

$stmt = $conn->prepare("SELECT * FROM $fill_table
WHERE report_id = '$fill_id' LIMIT 1");

$stmt->execute();

$columns = $stmt->fetch(PDO::FETCH_ASSOC);

$data = [];

foreach ($columns as $column_name => $column_value) {
    $data[$column_name] =  $column_value;
}

echo json_encode($data);

?>