<?php

include "db.php";


$stmt = $conn->prepare("DELETE FROM reports WHERE id = '".$_POST['delete_id']."'");
$stmt->execute();
?>
