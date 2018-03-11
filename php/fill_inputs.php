<?php

include "db.php";

if(isset($_POST['inputData'])) {
    $arr = json_decode($_POST['inputData']);
    $table = $_POST['table'];

    $colValues = [];
    foreach ($arr as $value){
        $colValues[$value->name] = $value->value;
    }

    $sql = "INSERT INTO $table";

    $sql .= "(`".implode("`, `",array_keys($colValues))."`)";

    $sql .= " VALUES ('".implode("', '",array_values($colValues))."')";

    $stmt = $conn->prepare($sql);

    $stmt->execute();

    $itemID = $conn->lastInsertId();
    $reportID = $_POST['report_id'];

    $tableSingular = $table;

    if (substr($table, -1) == 's') {
        $tableSingular = substr($table, 0, -1);
    }

    $stmt = $conn->prepare("INSERT INTO report_" . $table . " (report_id, {$tableSingular}_id)
        VALUES($reportID, $itemID)");

    $stmt->execute();


}

?>