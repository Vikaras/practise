<?php

include "db.php"

    $stmt = $conn->prepare("SELECT COLUMN_NAME FROM information_schema.columns
                        WHERE TABLE_SCHEMA = 'tool'
                        and TABLE_NAME = '" . strtolower($_GET['tblName']) . "' ");

    if ($stmt->execute(array())) {
        $cols = array();
        while ($row = $stmt->fetch()) {
            $cols[] = $row;
        }
        echo json_encode($cols);
    }


?>