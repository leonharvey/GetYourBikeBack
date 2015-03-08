$('#show_spotted').click(function() {
    var body = $("html, body");
    body.animate({scrollTop:300}, '500', 'swing', function() { 
        var marker_id = $('#reported-selection').val().split('|');
        $.each(marker_id, function(i, e) {
            if (e) 
                marker[e].setIcon('');
        });
    });
});
