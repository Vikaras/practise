// FILLING SELECT OPTIONS TO SELECT TABLE
$.getJSON("http://localhost/tool/php/table_select.php", function (table) {
    for (i = 0; i < table.length; i++) {
        $('#selectTable').append(
            "<option data-tbl-name='"+ table[i].table_name +"'>" + table[i].table_name + "</option>"
        )
  }
});
// DISPLAYING COLUMNS OF CURRENT SELECTED TABLE
$(document).on('change','.select-table', function () {
    var tblName = $(this).data('tbl-name');
    
});