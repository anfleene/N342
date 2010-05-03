$(document).ready(function(){
	$('a.comment_add').click(function(event){
		var $link = $(this);
		var $comments = $link.parents(".post").find(".comments");
		var html;
		jQuery.ajax({
			type: 'put',
			url: $link.attr('href'),
			success: function(data){
				// alert(data.replace(/^.<div id=\'body\'>/g, ""));
				$comments.append(data);
				html = $comments.children(":last").find("#body").html();
				$comments.children(":last").html(html);
			},
			error: function(data){
				alert("Failed To Add A Comment");
			}
		});
		return false
	});
	
	$('.tagArea').tagarea();
	
	$('ul#tag_cloud').tagcloud({type:"sphere", height:400});
});