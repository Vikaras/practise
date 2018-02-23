<?php

include "db.php";

$stmt = $conn->prepare("SELECT table_name FROM tables");

if ($stmt->execute(array())) {
    $table = array();
    while ($row = $stmt->fetch()) {
        $table[] = $row;
    }
    echo json_encode($table);
}


?>