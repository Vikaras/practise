// FILLING SELECT OPTIONS TO SELECT TABLE
$.getJSON("http://localhost/tool/php/table_select.php", function (data) {
    for (i = 0; i < data.length; i++) {
        $('.select-table').append(
            "<option value='"+ data[i].table_id +"' data-table-name='"+ data[i].table_name +"'>" +
            "" + data[i].table_name + "</option>"
        )
    }
});
// DISPLAYING COLUMNS OF CURRENT SELECTED TABLE
$('.select-table').on('change', function () {
    var tbl = $(".select-table option:selected").text();
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
    $.getJSON("http://localhost/tool/php/cols.php?tbl=" + tbl + "_cols", function (data) {
        for (i = 1; i < data.length; i++) {
            $('#set_table').append(
                "<tr>" +
                "<td>" + data[i].COLUMN_NAME + "</td>" +
                "<td>" + "<input type='checkbox'>" + "</td>"
                + "</tr>"
            )
        }
    })
});