<?php

include "db.php";


$stmt = $conn->prepare("SELECT * FROM reports
  LEFT JOIN tables ON reports.table_id = tables.table_id
  WHERE id = '" .$_GET['edit_id']. "' LIMIT 1");

$stmt->execute();

$reportData = $stmt->fetch();

$data = [
    'reportData' => [
        'lists' => $reportData['lists'],
        'table_id' => $reportData['table_id'],
        'table_name' => $reportData['table_name'],
        'comments' => $reportData['comments']
    ],
    'columns' => []
];

$columnsTable = strtolower($reportData['table_name']) . "_cols";

$columnsData = [];

$stmt = $conn->prepare("SELECT * FROM {$columnsTable}
  WHERE report_id = '" .$reportData['id']. "' LIMIT 1");

$stmt->execute();

$columns = $stmt->fetch(PDO::FETCH_ASSOC);

foreach($columns as $column_name => $column_value) {
    if(in_array($column_name, ['report_id', 'user_id', 'inventory_id'])) continue;

    $columnsData[$column_name] = $column_value;
}

$data['columns'] = $columnsData;

echo json_encode($data);


?>