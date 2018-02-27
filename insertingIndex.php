<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>2page</title>
</head>
<body>
<div class="container">
    <!--TABLE WHICH HOLDS DATA FROM DB-->
    <div class="table-responsive">
        <h1 align="center">ADD</h1>
        <div align="right">
            <button type="button" data-toggle="modal" data-target="#add_data_modal" class="btn btn-success">
                +Add
            </button>
        </div>
        <div id="live_data">
            <table id="add_table" class="table table-bordered">

            </table>
        </div>
        </div>
    </div>
</div>
</body>
<script src="js/script.js"></script>
</html>
