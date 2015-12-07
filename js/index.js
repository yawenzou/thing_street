//商店提交评论事件
function SubmitReview(dh,shop_id,n){
	var c_content = document.getElementById("cont"+dh+n).value;
    var num = document.getElementById("add-img"+dh+n).childNodes.length-5;
    // var aaaa = document.getElementById("file-img-cc"+n+"1").value;
    // alert(aaaa);
	var c;
	if(dh=='-cc'){
		c=1;
	}
	else{
		c=2;
	};
	var formData = new FormData($('#comment-form'+dh+n)[0]); 
    //var textAreaName="cont-cc"+n; 
    $.ajax({
        cache: true,
        type: "POST",
        url:"deal/correction_comment.php?num="+num+"&n="+n+"&c="+c+"&shop_id="+shop_id,
        data: formData,  
        async: false,  
        cache: false,  
        contentType: false,  
        processData: false,
        error: function(request) {
            alert("error");
        },
        success: function(data) {
            alert(data);
            $(".cont-cc").val("");
        }
    });
}


function bindevent(){
    $(".base-mag").show();
	//店铺信息内容切换
    $(".tit-teb").click(function(){
        // $(".tit-teb").removeClass("click");
        $(this).addClass("click").siblings().removeClass("click");
        // $(".J_click").hide();
        $(this).parents(".shop-title").siblings(".J_click").hide();
        $(this).parents(".shop-title").siblings("."+$(this).attr("_content")).show();
    })

    $(".close").click(function(){
        $(".shop-wrap").hide();
        
    })
    $(".shopblock").click(function(){
        $(this).next(".shop-wrap").show();
    })
    $(".totalshop").click(function(){
        $(".tit-teb").removeClass("click");
        $(".total").addClass("click");
        $(".J_click").hide();
        $(".total-shop").show();

    })

    //店铺评论信息图片放大
    $(".comment-img").click(
        function(){
            $(".comment-img-big").hide();
            $(this).parent("div").nextAll("."+$(this).attr("_number")+"img").show();
        }
    )


    //店铺图片放大
    $(".1bigimg").show();
    $(".0abigimg").show();
    $(".img-little").click(
        function(){
            $(this).parent(".img-list").siblings(".shopimg-big").hide();
            $(this).parent(".img-list").prevAll("#"+$(this).attr("_num")+"bigimg").show();
        }
    )
    $(".img-littlea").click(
        function(){
            $(this).parent(".img-list").siblings(".shopimg-biga").hide();
            $(this).parent(".img-list").prevAll("#"+$(this).attr("_num")+"bigimg").show();
        }
    )


    //发表评论
    $(".my-comment").click(function(){
        $(".com-cont").toggle();
    });

    //登录与注册导航切换
    $(".head").mouseover(function(){
        $(".head").css({opacity:"1"},{filter:"alpha(opacity=100)"});
    })
    $(".head").mouseout(function(){
        $(".head").css({opacity:"0"},{filter:"alpha(opacity=0)"});
    });
    
    //評論添加圖片
    var n=0;
    $(".addpic-btn-cc").click(function(){
        n++;
        var nClass = $(this).next().attr("name");
        var nClassNum = nClass.substring(4);
        var filetext="<input class='file-img' id=file-img-cc"+nClassNum+n+" name=file-img-cc"+nClassNum+n+" type='file' value = '选择图片'/>";
        $(this).parent(".add-img").append(filetext);
        $(this).next().val(n);
    });
    var m=0;
    $(".addpic-btn-ec").click(function(){
        m++;
        var nClass = $(this).next().attr("name");
        var nClassNum = nClass.substring(4);
        var filetext="<input class='file-img' id=file-img-ec"+nClassNum+m+" name=file-img-ec"+nClassNum+m+" type='file' value = '选择图片'/>";
        $(this).parent(".add-img").append(filetext);
        $(this).next().val(m);
    });

//change_leaving();
}
function change_leaving(){
	
	$.ajax({
	 	cache: false,
	 	async: false,
	 	type: "get",
	 	url: "page/shop.php",
	 	dataType:"html",
	 	success: function (data) {
	 		alert(data);
	 		$("shop-wrap").html(data);
	 	}
    });
}