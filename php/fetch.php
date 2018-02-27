<?php

include "db.php";

$stmt = $conn->prepare("SELECT * FROM reports
LEFT JOIN tables ON reports.table_id = tables.table_id");

if ($stmt->execute(array($_GET['all']))) {
    $data = array();
    while ($row = $stmt->fetch()) {
        $data[] = $row;
    }
    echo json_encode($data);
}

?>