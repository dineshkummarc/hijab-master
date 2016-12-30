$(document).ready(function(){
	$('.panel-dragable').sortable({
		axis: 'y',
		stop: function(event, ui){
			var data = $(this).sortable('serialize');
			$.ajax({
				type: 'POST',
				dataType: 'json',
				data : data,
				url : 'admin_system/menu_orders_edit',
				success: function(){

				}
			});
		}
	});
	$('.panel-dragable .list-group').sortable({
		axis: 'y',
		stop: function(event, ui){
			var data = $(this).sortable('serialize');
			$.ajax({
				type: 'POST',
				dataType: 'json',
				data : data,
				url : 'admin_system/menu_orders_edit',
				success: function(){

				}
			});
		}
	});
})