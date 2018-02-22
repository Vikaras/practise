// FILLING SELECT OPTIONS TO SELECT TABLE
$.getJSON("http://localhost/tool/php/table_select.php", function (table) {
    for (i = 0; i < table.length; i++) {
        $('#selectTable').append(
            "<option>" + table[i].table_name + "</option>"
        )
  }
});