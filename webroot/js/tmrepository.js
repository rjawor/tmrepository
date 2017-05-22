function showTargetFile() {
	$('#target-file-div').css('display', 'inline');
}

function hideTargetFile() {
	$('#target-file-div').css('display', 'none');
}

function toggleDecision(unitId) {
	var decision = $('#decision-'+unitId);
	var image = $('#image-'+unitId);
	if (decision.val() == "1") {
		decision.val("0");
		image.attr('src', '/tmrepository/webroot/img/cross.png');
	} else {
		decision.val("1");
		image.attr('src', '/tmrepository/webroot/img/tick.png');
	}
}
