<?php

include "db.php";

if(isset($_POST['checkboxes'])) {
    $arr = json_decode($_POST['checkboxes']);
    $tbl = $_POST['tbl'];
    $repName = $_POST['repName'];
    $repComments = $_POST['repComments'];

    $stmt = $conn->prepare("SELECT * FROM tables WHERE table_id = " . $tbl . " LIMIT 1");

    $stmt->execute();
    $row = $stmt->fetch();

    $columns_table = strtolower($row['table_name']) . '_cols';

    $colValues = [];
    foreach ($arr as $value) {
        $colValues[$value->name] = $value->value;
    }

    $sql = "INSERT INTO reports (lists, table_id, comments)
    VALUES('" . $repName . "', " . $tbl . ", '" . $repComments . "')";

    $stmt = $conn->prepare($sql);

    $stmt->execute();

    $report_id = $conn->lastInsertId();

    $sql2 = "INSERT INTO $columns_table (report_id, " . implode(", ", array_keys($colValues)). ")
    VALUES(" . $report_id . ", " . implode(", ", array_values($colValues)) . ")";

    $stmt = $conn->prepare($sql2);

        $stmt->execute();
}

?>

