<?php

include "db.php";

$stmt = $conn->prepare("SELECT lists FROM reports WHERE id = '".$_GET['view_id']."' LIMIT 1");

if ($stmt->execute(array())) {
    $data = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);
}

?>