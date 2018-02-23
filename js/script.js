// FILLING SELECT OPTIONS TO SELECT TABLE
$.getJSON("http://localhost/tool/php/table_select.php", function (table) {
    for (i = 0; i < table.length; i++) {
        $('#selectTable').append(
            "<option data-table-name='"+ table[i].table_name +"'>" + table[i].table_name + "</option>"
        )
  }
});
// DISPLAYING COLUMNS OF CURRENT SELECTED TABLE
$(document).on('change', '.select-table', function () {
    var table = $(this).data('table-name');
    console.log(table);
    $.getJSON("http://localhost/tool/php/cols.php"+ table, function (cols) {
        for(i = 0; i < cols.length; i++) {
            $('#reg-wrap').append(
                "<div class='form-group'>" +
                "<label>" + " + cols[i].COLUMN_NAME + " 
                + "<input type='text' class='form-control form-input'>"
                + "</label>" 
                + "</div>"
            )
        }
    })
});