$(function(){
	$(".teb-mod").click(function(){
		$(".teb-mod").removeClass("click");
		$(this).addClass("click");
		$(".J_click").hide();
		$("."+$(this).attr("_content")).show();
	});

	var n=0;
	$(".addpic").click(function(){
		n++;
		var filetext="<input id=img"+n+" name=img"+n+" type='file'/>";
		$("#addline").append(filetext);
		$("#n").val(n);
	});

	$(".reply-btn").click(function() {
		$(this).parent(".origin-content").next().toggleClass("reply-content-hidden");
	});

	//评论信息图片放大
    $(".comment-img").click(
        function(){
            $(".comment-img-big").hide();
            $(this).parent("div").nextAll("."+$(this).attr("_number")+"img").show();
        }
    )
	
})

function replyComment(i,commentId){
	var textareaContent = document.getElementById("textarea"+i).value;
	var formId = "form"+i;
	if(!textareaContent) {
		alert('请输入回复的内容！');
	}
	else {
		$.ajax({
			cache: true,
            type: "POST",
            url:"../deal/reply.php?commentId="+commentId+"&i="+i,
            data:$('#'+formId).serialize(),
            async: false,
            error: function(request) {
                alert("Connection error");
            },
            success: function(data) {
                document.getElementById("textarea"+i).value='';
                alert(data);
            }
		});
	}
}

function commentPass(commentId) {
	$.ajax({
		cache: true,
        type: "POST",
        url:"../deal/reply-pass.php?commentId="+commentId,
        async: false,
        error: function(request) {
            alert("Connection error");
        },
        success: function(data) {
            alert(data);
        }
	});
}