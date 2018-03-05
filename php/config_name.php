<?php

include "db.php";

$view_id = $_GET['view_id'];

$stmt = $conn->prepare("SELECT * FROM reports
 LEFT JOIN tables ON reports.table_id = tables.table_id
 WHERE id = '$view_id' LIMIT 1");

if ($stmt->execute(array())) {
    $data = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);
}

?>