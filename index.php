<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>Title</title>
</head>
<body>
<div class="container">
    <!--TABLE WHICH HOLDS DATA FROM DB-->
    <div class="table-responsive">
        <h1 align="center">Reports generator</h1>
        <div align="right">
            <button type="button" data-toggle="modal" data-target="#add_data_modal" class="btn btn-warning">
                New report
            </button>
        </div>
        <div id="live_data"></div>
        <!--MODAL TO ADD NEW REPORT-->
        <div id="add_data_modal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">New report details</h4>
                    </div>
                    <!--FORM TO ADD NEW DATA TO DB-->
                    <div class="modal-body">
                        <p class="form-paragraph lead">*-Required fields</p>
                        <form action="" method="post" id="insert_form">
                            <div class="form-group">
                                <label for="repName">Enter name*:
                                    <input type="text" name="repName" id="repName" class="form-control form-input"
                                           required>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="selectTable">Select Table*:
                                    <select name="selectTable" id="selectTable" class="form-control form-input select-table">
                                        <option value=""></option>
                                    </select>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="reportComment">Report comment*:
                                    <textarea name="reportComment" id="reportComment" class="form-control form-input"
                                              cols="30"
                                              rows="10"
                                              style="resize: none" required>
                            </textarea>
                                </label>
                            </div>
                            <div class="modal-header">
                                <h4 class="modal-title">Registration</h4>
                            </div>
                            <div id="reg-wrap">

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/script.js"></script>
</body>
</html>