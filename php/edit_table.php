<?php

include "db.php";

$stmt = $conn->prepare("SELECT * FROM reports WHERE id = '" .$_GET['edit_id']. "'");

if ($stmt->execute(array())) {
    $data = array();
    while ($row = $stmt->fetch()) {
        $data[] = $row;
    }
    echo json_encode($data);
}

?>