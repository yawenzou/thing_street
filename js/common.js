function change_city(){//城市切换
	$(".place").click(function(){
		$(".shangecity").show();
		return false;
	})
	$(".shangecity li").click(function(){
		document.getElementById("place").innerHTML=$(this).text();
		$(".shangecity").hide();
	})
	$("body").click(function(){
		$(".shangecity").hide();
	})
}