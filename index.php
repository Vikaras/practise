<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Title</title>
</head>
<body>
<div class="container">
    <!--TABLE WHICH HOLDS DATA FROM DB-->
    <h1>Reports generator</h1>
    <div class="pull-right">
        <button type="button" data-toggle="modal" data-target="#add_data_modal" class="btn btn-success">
            New report
        </button>
    </div>
    <div id="live_data">
        <table id="fetch_table" class="table table-bordered table-responsive">
            <tr>
                <th>ID</th>
                <th>Lists</th>
                <th>Tables</th>
                <th>Comments</th>
                <th>Functions</th>
            </tr>
        </table>
    </div>
</div>

<!--MODAL TO ADD NEW CONFIG-->
<div id="add_data_modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">New report details</h4>
            </div>
            <!--CONFIGS INFO-->
            <div class="modal-body config">
                <p class="form-paragraph lead">*-Required fields</p>
                <form action="" method="post" id="config_form">
                    <div class="form-group">
                        <label for="repName">Enter list name*:
                            <input type="text" name="repName" id="repName" class="form-control form-input"
                                   required>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="selectTable">Select Table*:
                            <select name="selectTable" id="selectTable"
                                    class="form-control form-input select-table" required>
                                <option>--Select--</option>
                            </select>
                        </label>
                    </div>
                    <div class="form-group settings">
                    </div>
                    <div class="form-group">
                        <label for="reportComment">List comment:
                            <textarea name="reportComment" id="reportComment" class="form-control form-input"></textarea>
                        </label>
                    </div>
                    <input type="submit" name="submit" value="Insert" class="btn btn-success">
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--MODAL TO EDIT TABLE CONFIG-->
<div id="edit_table_modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit report details</h4>
            </div>
            <!--CONFIGS INFO-->
            <div class="modal-body edit_config_body">
                <p class="form-paragraph lead">*-Required fields</p>
                <form action="" method="post" id="edit_form">
                    <div class="form-group editName">
                        <label for="editName">Edit list name*:
                            <input type="text" name="editName" id="editName" class="form-control form-input"
                                   required>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="editSelectTable">Select Table:
                            <select name="editSelectTable_" id="editSelectTable"
                                    class="form-control form-input edit-select-table" required>
                            </select>
                        </label>
                    </div>
                    <div class="form-group edit-settings">
                    </div>
                    <div class="form-group">
                        <label for="editComment">Edit list comment:
                            <textarea name="editComment" id="editComment"
                                      class="form-control form-input"></textarea>
                        </label>
                    </div>
                    <input type="submit" name="update" value="Update" class="btn btn-success">
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
<script src="js/script.js"></script>
</html>