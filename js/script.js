// FILLING SELECT OPTIONS TO SELECT TABLE
$.getJSON("http://localhost/tool/php/table_select.php", function (data) {
    for (i = 0; i < data.length; i++) {
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
        "<th colspan='2'>Select columns and settings*:</th>"
        + "</tr>"
        + "</table>"
        + "</div>"
    );
    $.getJSON("http://localhost/tool/php/cols.php?tbl=" + tbl, function (data) {
        for (i = 2; i < data.length; i++) {
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
                alert("Data inserted successfully!");
                $('.config').html(data);
                $('#add_data_modal').modal("hide");
                location.reload();
                window.location.href = "index.php";
            }
        });
    } else {
        alert("Select one or more checkboxes to continue!");
    }
    return false
});

// FETCHING TABLE CONFIGS AND FILLING TABLE
$.getJSON("http://localhost/tool/php/fetch.php?all", function (data) {
    for (i = 0; i < data.length; i++) {
        $('#fetch_table').append("<tr>" +
            "<td>" + data[i].id + "</td>" +
            "<td>" + data[i].lists + "</td>" +
            "<td>" + data[i].table_name + "</td>" +
            "<td>" + data[i].comments + "</td>" +
            "<td>" + (data[i].edit === "1" ? "<input type='button' data-edit-id='" + data[i].id + "' value='Edit' " +
                "class='btn btn-warning btn-xs edit_config'>" : "") + " " +
            "<input type='button' data-delete-id='" + data[i].id +"' value='Delete'  class='btn btn-danger btn-xs delete_config'>"
            + " <input type='button' data-view-id='\" + data[i].id +\"' value='View'  class='btn btn-info btn-xs view_config'> "+"</td>" +
            "</tr>");

    }
});

// CALLING MODAL TO EDIT TABLE CONFIG
$(document).on('click', '.edit_config', function () {
    $('#edit_table_config').modal("show");

    var edit_id = $(this).data('edit-id');

    $.getJSON("http://localhost/tool/php/edit_table.php?edit_id=" + edit_id, function (data) {

        $('.edit-settings').empty().append("<div class='table-responsive'>" +
            "<table class='table table-bordered' id='edit_table'>" +
            "<tr>" +
            "<th colspan='2'>Edit columns and settings*:</th>"
            + "</tr>"
            + "</table>"
            + "</div>");

        for(i = 0; i < data.length; i++) {
            $("#editName").val(data[i].lists);
            $('#editComment').val(data[i].comments);
            $("#editSelectTable").append("<option value='"+ data[i].table_id +"'>" +
                data[i].table_name + "</option>");
        }
    });

});

// DELETING TABLE CONFIGURATION
$(document).on('click', '.delete_config', function () {
    var delete_id = $(this).data('delete-id');

    if (confirm("Are you sure you want to delete this table configuration?")) {

        $.ajax({
            url:"php/delete.php",
            method: "POST",
            data:{delete_id:delete_id},
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
$(document).on('click', '.view_config',function (){
    window.location.href = "/tool/insertingIndex.php";
});


