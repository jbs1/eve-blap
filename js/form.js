$(function(){
	var form=$('#fitting_form');
	form.submit(function(e) {
		e.preventDefault();
		$.ajax({
			url: 'ajax/eft-parser.php',
			type: 'POST',
			//dataType: 'json',
			data: {fit: $('textarea[name="fit"]').val()},
		})
		.done(function(data) {
			console.log("success:",data);
		})
		.fail(function(data) {
			console.log("fail:",data);
		})
	});

})
