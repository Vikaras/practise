$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null){
        return null;
    }
    else{
        return decodeURI(results[1]) || 0;
    }
};

var view_id = $.urlParam('view_id');

$.getJSON("http://localhost/tool/php/config_name.php?view_id=" + view_id, function(data) {
    for (var i = 0; i < data.length; i++) {
        $(".config-name").append("<h1>" + data[i].lists +"</h1>");
    }
});



