<?php

include "db.php";

$stmt = $conn->prepare("SELECT * FROM reports
LEFT JOIN tables ON reports.table_id = tables.table_id");

if ($stmt->execute(array($_GET['all']))) {
    $data = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        if(strtolower($row['table_name']) == 'inventory') {
            $stmt1 = $conn->prepare("SELECT * FROM inventory_cols WHERE report_id = " . $row['id'] . " LIMIT 1");
        } else if(strtolower($row['table_name']) == 'users') {
            $stmt1 = $conn->prepare("SELECT * FROM users_cols WHERE report_id = " . $row['id'] . " LIMIT 1");
        }

        $stmt1->execute();
        $cols = $stmt1->fetch(PDO::FETCH_ASSOC);

        //var_dump($row, $cols);

        $data[] = array_merge($row, $cols);
    }
    echo json_encode($data);
}

?>