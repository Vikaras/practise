<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Configurations</title>
</head>
<body>
<div class="container">
    <!--TABLE WHICH HOLDS DATA FROM DB-->
    <div class="config-name"></div>
    <div class="pull-right add-btn"></div>
    <div id="config_data">
<!--DATA VIEW-->
        <?php

        include "php/db.php";

        $stmt = $conn->prepare("SELECT * FROM reports
          LEFT JOIN tables ON reports.table_id = tables.table_id
          LEFT JOIN inventory_cols ON inventory_cols.report_id = reports.id
          LEFT JOIN users_cols ON users_cols.report_id = reports.id
          WHERE reports.id = " . $_GET['view_id'] . " LIMIT 1");


        $stmt->execute();
        $reportData = $stmt->fetch();



        $table = $reportData['table_name'];
        $tableSingular = $table;

        if (substr($table, -1) == 's') {
            $tableSingular = substr($table, 0, -1); // bus pvz is users - user
        }

        $stmt = $conn->prepare("SELECT * FROM report_{$table}
          LEFT JOIN $table USING ({$tableSingular}_id)
          WHERE report_id = " . $_GET['view_id']);


        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $stmt1 = $conn->prepare("SELECT * FROM {$table}_cols WHERE report_id = " . $_GET['view_id'] . " LIMIT 1");
            $stmt1->execute();

            $columns = $stmt1->fetch(PDO::FETCH_ASSOC);


            echo '<table id="display_data" class="table table-bordered table-responsive"><thead><tr>';

            foreach ($columns as $column_name => $column_value) {
                if(!in_array($column_name, ['report_id']) && $column_value == 1) {
                    echo "<th>" . ucfirst($column_name) . "</th>";
                }
            }

            echo '</tr></thead><tbody>';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                foreach ($columns as $column_name => $column_value) {
                    if(!in_array($column_name, ['report_id']) && $column_value == 1) {
                        echo "<td>" . $row[$column_name] . "</td>";
                    }
                }
                echo '</tr>';
            }

            echo '</tbody></table>';
        } else {
            echo 'No data to display';
        }

        ?>
    </div>
</div>

<!--MODAL TO FILL IN CONFIG-->
<div id="fill_data_modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header fill-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Fill in the fields</h4>
            </div>
            <!--            FILL IN MODAL WITH DATA TO INSERT-->
            <div class="modal-body fill-details">
                <form action="" method="post" id="fill_form">
                    <div class="input-wrap"></div>

                    <input type="hidden" name="report_id" value="<?php echo $_GET['view_id']; ?>" id="report_id">
                </form>
            </div>
        </div>
    </div>
</div>
</body>
<script src="js/config.js"></script>
</html>
