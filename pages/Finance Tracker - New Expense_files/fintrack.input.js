
$(document).ready(function() {
    $('input.focus').focus();
    $('a.confirmation').click(function(event) {
    	return confirm('Yes, I\'m sure I want to delete this record!');
    });
});
