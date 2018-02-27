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

    $('.settings').empty();
    $('.settings').append(
        "<div class='table-responsive'>" +
        "<table class='table table-bordered' id='set_table'>" +
        "<tr>" +
        "<th colspan='2'>Select columns and settings</th>"
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
            "<td>" + (data[i].edit === "1" ? "<input type='button' value='Edit' " +
                "class='btn btn-warning btn-xs edit_config'>" : "") + " " +
            "<input type='button' value='Delete' class='btn btn-danger btn-xs delete_config'>" + "</td>" +
            "</tr>");

    }
});

// CALLING MODAL TO EDIT TABLE CONFIG
$(document).on('click', '.edit_config', function () {

    $('#edit_table_config').modal("show");

});
