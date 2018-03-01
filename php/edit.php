<?php

include "db.php";

if(isset($_POST['editCheckboxes'])) {
    $arr = json_decode($_POST['editCheckboxes']);
    $editID = $_POST['editID'];
    $editName = $_POST['editName'];
    $editTbl = $_POST['editTbl'];
    $editComments = $_POST['editComments'];

    $stmt = $conn->prepare("SELECT * FROM tables WHERE table_id = " . $editTbl . " LIMIT 1");

    $stmt->execute();

    $sql = "UPDATE reports SET lists = '$editName', table_id = '$editTbl', comments = '$editComments' WHERE id = '$editID'";

    $stmt = $conn->prepare($sql);

    $stmt->execute();

    $report_id = $editID;

    $table = strtolower($editTbl) . '_cols';



    $sqlData = array();
   // foreach ($arr as $column_name => $column_value) {
      //  $sqlData[] = $column_name .  " = '" . $column_value . "'";
  //  }
    $counter = count($arr);
    for($i=0;$i<=$counter -1;$i++){
        $sqlData[] = array('name'=>$arr[$i]->name,'value'=>$arr[$i]->value);
    }
print_r($sqlData);


    $name = array();
    $value = array();
    foreach ($sqlData as $value)
    {
        $name[] = $value['name'];
        $value[] = $value['value'];
    }
    $sql2 = "UPDATE $table SET ";
    $sql2 .= implode(", ", $name ) ."=". implode(", ", $value );
    $sql2 .= "WHERE report_id = '$editID'";

    $stmt = $conn->prepare($sql2);
    $stmt->execute();
}

?>
