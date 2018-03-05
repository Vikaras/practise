// FILLING SELECT OPTIONS TO SELECT TABLE
$.getJSON("http://localhost/tool/php/table_select.php", function (data) {
    for ( var i = 0; i < data.length; i++) {
        $('.select-table').append(
            "<option value='" + data[i].table_id + "' data-table-name='" + data[i].table_name + "'>" +
            "" + data[i].table_name + "</option>"
        )
    }
});

// DISPLAYING COLUMNS OF CURRENT SELECTED TABLE
$('.select-table').on('change', function () {
    var tbl = $(".select-table option:selected").text() + "_cols";

    $('.settings').empty().append(
        "<div class='table-responsive'>" +
        "<table class='table table-bordered' id='set_table'>" +
        "<tr>" +
        "<th colspan='2'>Select columns*:</th>"
        + "</tr>"
        + "</table>"
        + "</div>"
    );
    $.getJSON("http://localhost/tool/php/cols.php?tbl=" + tbl, function (data) {
        for ( var i = 2; i < data.length; i++) {
            $('#set_table').append(
                "<tr>" +
                "<td>" + data[i].COLUMN_NAME + "</td>" +
                "<td>" + "<input class='check_cols' type='checkbox' name='checkboxes[" + data[i].COLUMN_NAME + "]' data-col-name='" + data[i].COLUMN_NAME + "' value='0'>" + "</td>"
                + "</tr>"
            );
            // ADDING VALUES TO CHECKBOXES
            $(document).on('click', '.check_cols', function () {
                $(this).prop("checked") ? $(this).val(1) : $(this).val(0);
            });
        }
    })
});

// INSERTING TABLE CONFIG TO DATABASE
$('#config_form').on('submit', function () {

// checking if one or more checkboxes is checked
    if ($("[type=checkbox]:checked").length > 0) {

// creating array to store checkbox values
        var checkboxes = [];
        $(".check_cols").each(function () {
            checkboxes.push({
                name: $(this).data('col-name'),
                value: $(this).val()
            });
        });

// calling ajax to store configs
        $.ajax({
            url: "php/tbl_config.php",
            method: "POST",
            data: {
                checkboxes: JSON.stringify(checkboxes),
                tbl: $("#selectTable").val(),
                repName: $("#repName").val(),
                repComments: $("#reportComment").val()
            },

            success: function (data) {
                alert("Configuration inserted successfully!");
                $('.config').html(data);
                $('#add_data_modal').modal("hide");
                location.reload();
                window.location.href = "index.php";
            }
        });

    } else {
        alert("Fill in required fields and select one or more checkboxes to continue!");
    }
    return false
});

// FETCHING TABLE CONFIGS AND FILLING TABLE
$.getJSON("http://localhost/tool/php/fetch.php?all", function (data) {
    for ( var i = 0; i < data.length; i++) {
        $('#fetch_table').append("<tr>" +
            "<td>" + data[i].id + "</td>" +
            "<td>" + data[i].lists + "</td>" +
            "<td>" + data[i].table_name + "</td>" +
            "<td>" + data[i].comments + "</td>" +
            "<td>" + "<input type='button' data-delete-id='" + data[i].id + "' value='Delete'  class='btn btn-danger btn-xs delete_config'>"
            + "<input type='button' data-view-id='" + data[i].id + "' value='View'  class='btn btn-info btn-xs view_config'>"
            + (data[i].edit == 1 ? "<input type='button' data-edit-id='" + data[i].id + "' value='Edit' " + "class='btn btn-warning btn-xs edit_config'>" : "")
            + "</td>" +
            "</tr>");
    }
});

// CALLING MODAL TO EDIT TABLE CONFIG
$(document).on('click', '.edit_config', function () {
    $('#edit_table_modal').modal("show");

    var edit_id = $(this).data('edit-id');

    // Creating table for edit data
    $('.edit-settings').html(
        "<table class='table table-bordered table-responsive' id='edit_table'>" +
        "<thead><tr>" +
        "<th colspan='2'>Edit columns*:</th>"
        + "</tr></thead><tbody></tbody>"
        + "</table>"
    );

    // Getting current data from database
    $.getJSON("http://localhost/tool/php/edit_table.php?edit_id=" + edit_id, function (data) {

        $("#editName").val(data.reportData.lists);
        $('#editComment').val(data.reportData.comments);
        $("#editSelectTable").empty().append("<option value='" + data.reportData.table_id + "'>" +
            data.reportData.table_name + "</option>");
        $("#editSelectTable").prop('disabled',true);
        $("#editSelectTable").append("<input type='hidden' id='selectedTableID'" +
            " name='editSelectTable' value='" + data.reportData.table_id + "'" +
            " data-table-name='" + data.reportData.table_name + "'>");

        $("#edit_form").prepend("<input type='hidden' id='editID'" +
            " name='editID' value='" + edit_id + "'>");

        // Generating columns and checkboxes
        $("#edit_table tbody").empty();

        for (var key in data.columns) {
            var row = $('<tr>' +
                '<td>' + key + '</td>' +
                '<td>' +
                '</td>' +
                '</tr>');
            $("#edit_table tbody").append(row);

            row.find('td:eq(1)').append($("<input/>").attr('class', 'edit_cols')
                .attr('name', 'checkboxes[' + key + ']')
                .data('col-name', key)
                .val(data.columns[key] == 1 ? 1 : 0)
                .attr('type', 'checkbox')
                .prop('checked', data.columns[key] == 1 ? true : false));
        }
    });

    // Changing values of the checkboxes
    $(document).on('click', '.edit_cols', function () {
        $(this).prop("checked") ? $(this).val(1) : $(this).val(0);
    });
});

// UPDATING CONFIGURATION TO DATABASE
$('#edit_form').on('submit', function () {

    // Checking if there are checked checkboxes
    if($("[type=checkbox]:checked").length > 0){

        // creating array to store all checkbox values
        var editCheckboxes = [];
        $(".edit_cols").each(function () {
            editCheckboxes.push({
                name: $(this).data('col-name'),
                value: $(this).val()
            });
        });

        $.ajax({
            url:"php/edit.php",
            method:"POST",
            data: {
                editCheckboxes:JSON.stringify(editCheckboxes),
                editID: $("#editID").val(),
                editTbl: $("#selectedTableID").val(),
                editTblName: $("#selectedTableID").data('table-name'),
                editName: $("#editName").val(),
                editComments: $("#editComment").val()
            },

            success: function (data) {
                alert("Configuration updated successfully!");
                $('.edit_config').html(data);
                $('#edit_table_config').modal("hide");
                location.reload();
                window.location.href = "index.php";
            }
        })
    } else {
        alert("Fill in required fields and select one or more checkboxes to continue!");
    }
    return false;
});

// DELETING TABLE CONFIGURATION
$(document).on('click', '.delete_config', function () {
    var delete_id = $(this).data('delete-id');

    if (confirm("Are you sure you want to delete this table configuration?")) {

        $.ajax({
            url: "php/delete.php",
            method: "POST",
            data: {delete_id: delete_id},
            success: function () {
                alert('Configuration deleted successfully!');
                location.reload();
                window.location.href = "index.php";
            }
        });
    }
    return false;
});

// CALLING VIEW PAGE
$(document).on('click', '.view_config', function () {
    var view_id = $(this).data('view-id');
    window.location.href = "config_index.php?view_id=" + view_id;
});


