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
    console.log(tbl);
    $.getJSON("http://localhost/tool/php/cols.php?tbl="+ tbl, function (cols) {
        $("#reg-wrap").empty();
        for(i = 0; i < cols.length; i++) {
            $('#reg-wrap').append(
                "<div class='form-group'>" +
                "<label>"  + cols[i].COLUMN_NAME +
                "<input type='text' class='form-control form-input'>"
                + "</label>"
                + "</div>"
            )
        }
    })
});