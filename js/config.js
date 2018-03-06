//GETTING VIEW PAGE ID TO FILL INFO
$.urlParam = function (name) {
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results == null) {
        return null;
    }
    else {
        return decodeURI(results[1]) || 0;
    }
};

var view_id = $.urlParam('view_id');

$.getJSON("http://localhost/tool/php/config_name.php?view_id=" + view_id, function (data) {
    for (var i = 0; i < data.length; i++) {
        $(".config-name").append("<h1>" + data[i].lists + "</h1>");
        $(".add-btn").append("<button type='button' data-toggle='modal'" +
            " data-target='#fill_data_modal' class='btn btn-success new-fill' " +
            " data-fill-table='" + data[i].table_name + "'" +
            " data-fill-id='" + data[i].id + "'>" + "Add new" + "</button>");
    }
});

//GETTING INPUTS TO FILL IN
$(document).on('click', '.new-fill', function () {

    $('.input-wrap').empty();
    var fill_table = $(this).data('fill-table') + "_cols";
    var fill_id = $(this).data('fill-id');

    $.getJSON("http://localhost/tool/php/fill_config.php?fill_table=" + fill_table + "&fill_id=" + fill_id, function (data) {
        for (var i in data) {
            if (data[i] == 1 && ["report_id","user_id","inv_id","edit","filter","birth","comment"].indexOf(i) === -1 ) {
                $('.input-wrap').append("<div class='form-group'>" +"<label>" + i.charAt(0).toUpperCase() + i.substr(1) + ":"
                    + "</label>" + "<input type='text' class='form-control form-input' required>" + "</div>");
            } else if (data[i] == 1 && i == "birth") {
                $('.input-wrap').append("<div class='form-group'>" +"<label>" + i.charAt(0).toUpperCase() + i.substr(1) + ":"
                    + "</label>" + "<input type='date' class='form-control form-input' required>" + "</div>")
            } else if (data[i] == 1 && i == "comment") {
                $('.input-wrap').append("<div class='form-group'>" +"<label>" + i.charAt(0).toUpperCase() + i.substr(1) + ":"
                    + "</label>" + "<textarea class='form-control form-input' required></textarea>" + "</div>")
            }
        }
    });
});