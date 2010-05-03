$(document).ready(function(){
	$('.tagArea').tagarea();
	$('a.comment_add').click(function(event){
		var $link = $(this);
		var $comments = $("#comments");
		jQuery.ajax({
			type: 'put',
			url: $link.attr('href'),
			success: function(data){
				$comments.append(data);
			},
			error: function(data){
				return true;
			}
		});
		return false;
	});
	
	$('ul#tag_cloud').tagcloud({type:"sphere", height:400});
});