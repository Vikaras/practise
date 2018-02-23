<?php

include "db.php";

$stmt = $conn->prepare("SELECT * FROM tables");

if ($stmt->execute(array())) {
    $data = array();
    while ($row = $stmt->fetch()) {
        $data[] = $row;
    }
    echo json_encode($data);
}


?>