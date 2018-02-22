<?php

include "db.php";

$stmt = $conn->prepare("SELECT * FROM tables");

if ($stmt->execute(array())) {
    $table = array();
    while ($row = $stmt->fetch()) {
        $table[] = $row;
    }
    echo json_encode($table);
}


?>