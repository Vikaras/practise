<?php

include "db.php";

$stmt = $conn->prepare("SELECT * FROM reports 
LEFT JOIN tables ON reports.table_id = tables.table_id
LEFT JOIN inventory_cols ON reports.id = inventory_cols.report_id
LEFT JOIN users_cols ON reports.id = users_cols.report_id
WHERE id = '" .$_GET['edit_id']. "'");

if ($stmt->execute(array())) {
    $data = array();
    while ($row = $stmt->fetch()) {
        $data[] = $row;
    }
    echo json_encode($data);
}

?>