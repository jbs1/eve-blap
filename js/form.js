$(function(){
	var form=$('#fitting_form');
	form.submit(function(e) {
		e.preventDefault();
		$.ajax({
			url: 'eft/eft-parser.php',
			type: 'POST',
			data: {eft: $('textarea[name="eft"]').val()},
			success: function(data) {
				console.log(data);
			},
			fail: function(data) {
				console.log(data);
			}
		})
	});

})
