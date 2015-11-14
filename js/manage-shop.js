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

function commentPass(event,commentId) {
	$.ajax({
		cache: true,
        type: "POST",
        url:"../deal/reply-pass.php?commentId="+commentId,
        async: false,
        error: function(request) {
            alert("Connection error");
        },
        success: function(data) {
            $(event).addClass("pass-btn-click");
            $(event).text("已通过");
            alert(data);
        }
	});
}

function modifyMsgCheck() {
	if($("#shopName").val() == '') {
		$("#error01").text("请输入商店名称！");
		return false;
	}
	else if($("#telno").val() == '') {
		$("#error01").text("请输入联系方式！");
		return false;
	}
	else if($("#type").val() == '') {
		$("#error01").text("请选择分类！");
		return false;
	}
	else if($("#shop_state").val() == '') {
		$("#error01").text("请选择营业状态！");
		return false;
	}
	else{
		return true;
	}
}

function publishPreferentialCheck() {
	if($("#preferential-msg").val() == '') {
		$("#error02").text("请输入优惠信息！");
		return false;
	}
	else if($("#start-time").val() == '') {
		$("#error02").text("请输入优惠开始时间！");
		return false;
	}
	else if($("#end-time").val() == '') {
		$("#error02").text("请选择优惠结束时间！");
		return false;
	}
	else if($("#dynamics").val() == '') {
		$("#error02").text("请选择优惠力度！");
		return false;
	}
	else if($("#p_content").val() == '') {
		$("#error02").text("请输入优惠内容! ");
		return false;
	}
	else{
		return true;
	}
}