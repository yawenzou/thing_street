$(document).ready(function(){//鼠标移到图标上显示图片
	$(".imglabel").mouseover(function(){
		$(this).next().css('display','block');
	})
	$(".imglabel").mouseout(function(){
		$(this).next().css('display','none');
	})
	$(".build_label").mouseover(function(){
		$(this).children(".build_img1").first().css('display','block');
	})
	$(".build_label").mouseout(function(){
		$(this).children(".build_img1").first().css('display','none');
	})
	$(".build_label").mouseover(function(){
		$(this).children(".build_img2").first().css('display','block');
	})
	$(".build_label").mouseout(function(){
		$(this).children(".build_img2").first().css('display','none');
	})


})