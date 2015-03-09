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

$('#show_snaps').click(function() {
    var snaps = $('#reported-selection').find(':selected').attr('data-snaps').split('|');
    $.each(snaps, function(i, v) {
        var snap = v.split('-');
        console.log(v);
        if (v) $('.modal .inner').append('<a href="' + '/snaps/' + snap[0] + '.jpg" target="_blank">View snap - ' + snap[1] + '</a><br>');
    });
    $('.modal').fadeIn('fast');
})
$('.close-btn').click(function() {
    $('.modal').fadeOut('fast');
})