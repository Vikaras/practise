// FILLING SELECT OPTIONS TO SELECT TABLE
$.getJSON("http://localhost/tool/php/table_select.php", function (table) {
    for (i = 0; i < table.length; i++) {
        $('.select-table').append(
            "<option>" + table[i].table_name + "</option>"
        )
    }
});
// DISPLAYING COLUMNS OF CURRENT SELECTED TABLE
$('.select-table').on('change', function () {
    var tbl = document.querySelector('.select-table').value;
    $('.settings').empty();
    $('.settings').append(
        "<div class='table-responsive'>" +
        "<table class='table table-bordered' id='set_table'>" +
        "<tr>" +
        "<th colspan='2'>Choose columns</th>"
        + "</tr>"
        + "</table>"
        + "</div>"
    );
    $.getJSON("http://localhost/tool/php/cols.php?tbl=" + tbl, function (cols) {
        for (i = 0; i < cols.length; i++) {
            $('#set_table').append(
                "<tr>" +
                "<td>" + cols[i].COLUMN_NAME + "</td>" +
                "<td>" + "<input type='checkbox'>" + "</td>"
                + "</tr>"
            )
        }
    })
});