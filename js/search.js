var i=0;
var sern=new Array();
sern[0]='';
function searchtext(){//出现搜索提示
	$('#ser').keyup(function(event){
		i++;
		var sertexta=$("#ser").val();
		var place=$("#place").text();
		sern[i]=sertexta;
		$(".sertext").hide();
		if(sern[i]!=sern[i-1]&&sertexta.length>1){//输入内容至少两个字开始搜索
			var node=document.getElementById("sertext");
			node.parentNode.removeChild(node);
			$(".search").append( "<ul class='sertext' id='sertext'></ul>");
			$(".sertext").show();
			$.post("deal/get_search.php",{sertexta:sertexta,place:place},function(msg){//获取搜索的所有街区并显示
				var num=new Array();
				num=msg.split(";");
				var m=num[num.length-1];
				for (var j = num.length - 2; j >= 0; j--) {
					var result=new Array();
					result=num[j].split(",");
					if(result[1]=='0'){
						result[1]=1;
					}
					var url="index.php?n_c="+result[1]+"&street="+result[0];
					var text="<li><a href="+url+">" + result[2] + "</a></li>";
					//alert(text);
					$(".sertext").append(text);
				};
				$("#ser-ico").click(function(){
					var first=num[0].split(",");
					if(first[1]=='0'){
						first[1]=1;
					}
					var firsturl="index.php?n_c="+first[1]+"&street="+first[0];
					//alert(firsturl);
					window.location.href=firsturl;
				})
			})
		}	
	});
}


function detail(){//优惠信息内容显示
	$(".close").click(function(){
		$(".pref_content").hide();
	})
	$(".J_detail").click(function(){
		$(".pref_content").hide();
		$("#"+"content"+$(this).attr("_num")).show();
	})
}


function change_city(){//城市切换
	$(".change-place").mouseover(function(){
		$(".shangecity").show();
	})
	$(".shangecity li").click(function(){
		document.getElementById("place").innerHTML=$(this).text();
		$(".shangecity").hide();
	})
}