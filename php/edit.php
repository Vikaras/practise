<?php

include "db.php";

if(isset($_POST['editCheckboxes'])) {
    $arr = json_decode($_POST['editCheckboxes'], true);
    $editID = $_POST['editID'];
    $editName = $_POST['editName'];
    $editTbl = $_POST['editTbl'];
    $editTblName = $_POST['editTblName'];
    $editComments = $_POST['editComments'];

    $sql = "UPDATE reports SET lists = '$editName', table_id = '$editTbl', comments = '$editComments' WHERE id = '$editID'";

    $stmt = $conn->prepare($sql);

    $stmt->execute();

    $table = strtolower($editTblName) . '_cols';

    $sql2 = "UPDATE $table SET ";

    $sqlData = [];

    foreach ($arr as $col => $value) {
        $sqlData[] = $value['name'] . " = '" . $value['value'] ."'";
    }

    $sql2 .= implode(',', $sqlData);
    $sql2 .= " WHERE report_id = '$editID'";

    $stmt = $conn->prepare($sql2);
    $stmt->execute();
}

?>
