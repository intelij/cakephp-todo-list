$(document).ready(function(){

	var li_tpl = '<li class="priority {{Item.priority}}" id="item-{{Item.id}}"><label class="checkbox"><input type="checkbox" value="{{Item.id}}" />{{Item.content}}</label><span class="created">{{Item.created}}</span></li>';

	$("#ItemAddForm").submit(function(e) {
		e.preventDefault();

		if($('#ItemContent').val().length > 2) {
			$.post('/items/add', { Item: { content: $("#ItemContent").val() } }, function(data) {

				if ($('#prank').length > 0) {
					$('#prank').remove();
				}
				
				data = $.parseJSON(data);
				var output = Mustache.to_html(li_tpl, data);

				if($('#items  .priority.'+data.Item.priority).length > 0) {
					$("#items .priority."+data.Item.priority+":first").before(output);
				} else {
					$("#items").append(output);
				}

				$("#ItemContent").val('').focus();
			});
		}
	});
	
	$("#items :checkbox").click(function(){
		var id = $(this).val();

		$.post('/items/delete/'+id, function(data) {
			$("#item-"+id).remove();
			$.notifyBar({ html: 'Item deleted!', delay: 2000, animationSpeed: 500, close: true });

			if ($('#items li').length == 0) {
				$('#content').append('<img src="http://i.imgur.com/JF5a4.jpg" alt="All done?" style="margin: 0 auto;" id="prank" />');
			}
		});
	});

	$(".sort-controls a").click(function(e){
		e.preventDefault();

		$.get($(this).attr('href'), function(data){
			data = $.parseJSON(data);
			
			$("#items").html('');

			for(var item in data) {
				var output = Mustache.to_html(li_tpl, data[item]);
				$("#items").append(output);
			}
		});
	});

	$("#items").sortable({
        placeholder: 'ui-state-highlight',
        stop: function(i) {
            $.post('/items/reorder', $("#items").sortable("serialize"), function(data) {
            	$.notifyBar({ html: 'Reorder saved!', animationSpeed: 500, close: true });
            })
        }
    });
    $("#items").disableSelection();

});