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
    <div id="config_data"></div>
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
                        <div class="form-group input-wrap"></div>
                        <input type="submit" name="submit" value="Insert" class="btn btn-success">
                    </form>
                </div>
        </div>
    </div>
</div>
</body>
<script src="js/config.js"></script>
</html>
