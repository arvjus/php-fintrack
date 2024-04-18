
$(document).ready(function() {

    // select menu item based on current url
    var path = $(location).attr('href');
    $('ul.nav li').each(function() {
        var $this = $(this);
        var frag = $this.attr('data-frag');
        if (frag !== undefined && path.indexOf(frag) > -1) {
            if (!$this.hasClass('active')) {
                $this.addClass('active');
            }
        }
    });
});