$(document).ready(function(){
	$('#ps_check_all').click(function(){
		$(this).parent().parent().find('input[type="checkbox"]').prop('checked',true);
		return false;
	});

	$('#ps_check_none').click(function(){
		$(this).parent().parent().find('input[type="checkbox"]').prop('checked',false);
		return false;
	});
});
