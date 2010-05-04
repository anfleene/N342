$(document).ready(function(){
	//ajax method on posts to add comments
	$('a.comment_add').click(function(event){
		var $link = $(this);
		//find the current comment container
		var $comments = $link.parents(".post").find(".comments");
		var html;
		jQuery.ajax({
			type: 'put',
			url: $link.attr('href'),
			success: function(data){
				//insert the respond into the dom
				$comments.append(data);
				//get the import bits form the response
				html = $comments.children(":last").find("#body").html();
				//replace the original response data with the important bits
				$comments.children(":last").html(html);
			},
			error: function(data){
				alert("Failed To Add A Comment");
			}
		});
		return false
	});
	//make this a special tag adding textarea
	$('.tagArea').tagarea();
	
	//make the tagcloud ul into an actual tagcloud
	$('ul#tag_cloud').tagcloud({type:"sphere", height:400});
});