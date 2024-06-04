function addLoading() {
	if ($(".spinner-loading").length === 0) {
		console.log('nao existe loader e vou criar');
		var div = document.createElement('div');
		$(div).addClass('spinner-loading');
		$('body').append(div);
	} else {
		console.log('loader existe, executando...');
		$(".spinner-loading").css('display', 'block');
	}
}

function removeLoading() {
	$(".spinner-loading").css('display', 'none');	
}

// $(document).ajaxStart(function() {
//   addLoading();
// });

// $(document).ajaxStop(function() {
//   removeLoading();
// });