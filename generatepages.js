$(document).ready(function(){
	$('#ps_check_all').click(function(){
		$(this).parent().parent().find('input[type="checkbox"]').attr('checked',true);
		return false;
	});

	$('#ps_check_none').click(function(){
		$(this).parent().parent().find('input[type="checkbox"]').attr('checked',false);
		return false;
	});
});