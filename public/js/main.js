$(document).ready(function() {
	$('#email-search-btn').click(function() {
		var targetEmail = $('#email-search-input').val();
		$.ajax({
			url : '../report/search.php',
			type : 'GET',
			data : {
				'email' : targetEmail
			},
			dataType:'JSON',
		    success : function(request) {
		    	var res = request.res;              
		        $('#email-search-result').html(res);
		    },
		    error : function(request, error) {
		        $('#email-search-result').html("Request fail.");
		    }
		});
	});
});