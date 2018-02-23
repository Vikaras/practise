<?php

include "db.php";

    $stmt = $conn->prepare("SELECT COLUMN_NAME FROM information_schema.columns
                        WHERE TABLE_SCHEMA = 'tool'
                        and TABLE_NAME = '" . strtolower($_GET['tbl']) . "' ");

    if ($stmt->execute(array())) {
        $data = array();
        while ($row = $stmt->fetch()) {
            $data[] = $row;
        }
        echo json_encode($data);
    }


?>