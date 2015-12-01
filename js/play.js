/*     */
 var csj_data;
 $.ajax({
 	cache: false,
 	async: false,
 	type: "post",
 	url: "deal/getdate.php",
 	success: function (data) {
 		csj_data=data.split(",");
 	}
 });
var wid=new Array();//每张网页的长度

var n=csj_data[0];
$screen_wid=$(window).width();
var dui=(csj_data.length-1)/2;
for(var j=0;j<dui-1;j++){
	var k=j*2+1;
	//alert(parseInt(csj_data[k])+"+"+parseInt(csj_data[k+1]));
	if(parseInt(csj_data[k])<parseInt(csj_data[k+1])){
		csj_data[j]=csj_data[j+1];
	}
	if(csj_data[k]*52<=$screen_wid){
		wid[j]=$screen_wid;
	}
	else {
		wid[j]=csj_data[k]*52;
	}

}
//alert(wid); //获取路口跳转街区
var roadurl_data;
$.ajax({    
 	cache: false,
 	async: false,
 	type: "post",
 	url: "deal/get_road.php",
 	success: function (data) {
 		roadurl_data=data.split(",");
 	}
 });

function changeroad(){ 
	for (var l = roadurl_data.length - 2; l >= 0; l--) {
		var street_dm;
		var street_cmd;
		var street_cmd1;
		var street_cmd2;
		var street_direction_data;
		var direction_data;
		street_dm=roadurl_data[l].substring(0,roadurl_data[l].length-2);
		street_cmd1=roadurl_data[l].substring(roadurl_data[l].length-2,roadurl_data[l].length);
		var street_cmd2=street_cmd1.split('0');
        var street_cmd=street_cmd2.join('');
		$("."+roadurl_data[l]).click(function(){
			//window.location.href = "index"+".php";
			//alert(street_dm+" "+street_cmd+" "+street_dir_data+" "+dir_data)
			$.ajax({
			 	cache: false,
			 	async: false,
			 	type: "get",
			 	//url: "index.php?street_dm="+street_dm+'?n_c='+street_cmd,
			 	url: "index.php+'?n_c='+street_cmd+'&street='+street_dm+'&street_direction_data='+street_dir_data+'&direction_data='+dir_data",
				dataType:"html",
			 	success: function () {
			 		$("body").html(data);
			 		//changeimg();
			    }
			 	//}
			});	
	    })	

	};
}


//for (var i =0; i < csj_data.length-1; i++) {
     //alert(csj_data[i]);
//} 

var perwidth=new Array();//每个街区所占比例
var perwid=new Array();//在进度条上每张网页所占的长度
var sumwidth=0;//所有网页的长度和
var sumwid=new Array();//进度条上距离位置
var sumper=new Array();
var cssleft;
var antime;
var imgspeeds=30;

for(var i=0;i<n;i++){
		sumwidth=parseFloat(sumwidth)+parseFloat(wid[i]);	
}

for(var i=0;i<n;i++){
	perwidth[i]=wid[i]/sumwidth;	
}
var fastspeed=1;
var speed=4000;
var htmspeed=3000;//规定网页移动的速度
var imgspeed=speed*4.5;

var $verwheight=new Array();
var $verwwidth=new Array();
var bili=new Array("1","0.15","0.12","0.7","0.7","0.03","0.03","0.95","0.99");
$verwheight[0]=$(window).height();
$verwwidth[0]=$(window).width();
for(var i=0;i<10;i++){
	$verwheight[i]=bili[i]*$verwheight[0];
	$verwwidth[i]=bili[i]*$verwwidth[0];
}
verwwid=$verwwidth[0];
var midheig=$verwheight[4];

var bil=new Array("0.4","0.2","0.1");
var strheight=new Array();
for(var i=0;i<3;i++){
    strheight[i]=bil[i]*midheig;
}

var width=new Array();
for (var i =0; i < 2; i++) {
	width[i]=wid[i];
};

$(document).ready(function(){	
	for (var i = n - 1; i >= 0; i--) {
		var j=i+1;
		$("#contair"+j).width(width[i]);
    };

    $(".contair").height(midheig);
    $(".tablea").height(strheight[0]);
    $(".cont1").height(strheight[1]);
    $(".cont").height(strheight[0]);
    $(".t1").height(strheight[2]);
    $(".t2").height(strheight[1]);
    $(".t3").height(strheight[0]);
    $(".img1").height(strheight[1]);
    $(".img2").height(strheight[2]);
    $(".img3").height(strheight[0]);

	//调整宽度和高度
	$("#header").width($verwwidth[0]);
	$("#header").height($verwheight[1]);
	$("#bottom").width($verwwidth[0]);
	$("#bottom").height($verwheight[2]);
	$("#content").width($verwwidth[0]);
	$("#content").height($verwheight[3]);
	//$("#mid").width($verwwidth[0]);
	//$("#mid").height($verwheight[4]);
	$("#nav").width($verwwidth[0]);
	$("#nav").height($verwheight[5]);
	$(".lin").width($verwwidth[0]);
	$(".lin").height($verwheight[5]);
	$(".navli").width($verwwidth[0]);
	$(".navli").height($verwheight[5]);
	$("#timeline").width($verwwidth[0]);
	$("#timeline").height($verwheight[5]);
	$("#mycanvs").width($verwwidth[0]);
	$("#mycanvs").height($verwheight[5]);
	$(".inside").width($verwwidth[0]);
	$(".inside").height($verwheight[5]);

    //changeroad();
	sumwidfun();
	Adddirection();
    streetplay();
	changeimg();
})

window.onresize = function() {
    location.reload();	
}

var factx;
function getzb(e){	
	x=e.clientX;
	factx=x;
	/*document.getElementById("xycoordinates").innerHTML="Coordinates: (" + factx + ")";*/
	introStop();
	nac=factx;
	chag(nac);
	//change(nac);
}

function chag(nac){
	  for(i=0;i<n;i++){
		  j=i+1;
		  if(i==0){
			  if(factx>=0&&factx<=sumwid[i]){ 
			    change(nac,1) ;
			  }
		   }
			else if(factx>=sumwid[i-1]&&x<=sumwid[i]){
				 change(nac,j) ;
			}

	  }
}

function change(nac,j){
	//$("#timeline .inside img").css("left",nac); 
	//getUrlData(j);
	var n_c;
	$.ajax({
	 	cache: false,
	 	async: false,
	 	type: "get",
	 	url: "index.php?n_c="+j+"&street_direction_data='none'&direction_data='none'",
	 	dataType:"html",
	 	success: function (data) {
	 		$("body").html(data);
	 		$("#timeline .inside img").css("left",nac);
	 		contentplay();
	 	}
    });
}

function sumwidfun(){
	sumper[0]=0;
	for(var i=0;i<n;i++){//计算每个街区对应滑动条的宽度
		var j=i+1;
		perwid[i]=parseFloat(perwidth[i]*$verwwidth[8]);
		perwid[i]=parseFloat(perwid[i].toFixed(2));
		$('.p'+j).width(perwid[i]);
		sumper[j]=parseFloat(sumper[i])+parseFloat(perwid[i]);
		sumper[j]=parseFloat(sumper[j].toFixed(2));
	}

	sumwid[0]=perwid[0];
	for(var i=0;i<n-1;i++)sumwid[i+1]=parseFloat(sumwid[i])+parseFloat(perwid[i+1]);
	for(var i=0;i<n;i++){
		if(i==0)apla(i,0);
		else{
		    apla(i,sumwid[i-1]);
		}
	}
}
$
function apla(i,a){
	i++;
	$('.a'+i).on('click', function(){
		setnunber(i);
		introStop();
		var pos=a;	
		var n_c;
		getUrlData(i);
		//var url = "index.php?n_c="+i+"&street_direction_data=10&direction_data=10";
		//window.location.href=url;
		//$("#timeline .inside img").css("left",pos);
		// $.ajax({
		//  	cache: false,
		//  	async: true,
		//  	type: "get",
		//  	url: "index.php?n_c="+i+"&street_direction_data='none'&direction_data='none'",
		//  	dataType:"html",
		//  	success: function (data) {
		//  		// var dealdata1 = data.split("<body>")[1];
		//  		// var dealdata2 = dealdata1.split("</body>")[0];
		//  		$("body").html(data);
		//  		$("#timeline .inside img").css("left",pos);
		//  		streetplay();
		//  	}
	 //    });
	})
}

function contentplay(){//框架里的页面根据横坐标比例偏移动画
	sumwidfun();
	var y=0;
	var m=factx;
	//console.log(factx);
	for(var k=0;k<n;k++){
		if(k==0){   
			if((m>=0&&m<=sumwid[0])){
			   y=((width[0]-verwwid)*m)/perwid[0];		   
			   break;
			}
			else y=0;		
		}
		else{
			if(m>=sumwid[k-1]&&m<=sumwid[k]){
			   y=((width[k]-verwwid)*(m-sumwid[k-1]))/perwid[k];
			   break;
			}
			else y=0;
		}
	}
	j=k+1;
	$('#contair'+j).animate({left:-y},0.1);/**/
}

function introStop(){//动画停止
		//parent.frames["mid"].window.ifastop();	//调用子页面动画停止函数
		$(".contair").stop();
	    //$("#timeline .inside img").stop(function(){
		$("#timeline .inside img").stop();	
	//});
}


function Goforward(Number){	
	cssleft = $("#timeline .inside img").css("left");
    antime = (sumper[Number]-parseFloat(cssleft))*imgspeeds;
	//alert(antime);
    $("#timeline .inside img").animate({left:sumper[Number]},antime);
}

function GoBackforward(Number){
	cssleft = $("#timeline .inside img").css("left");
    antime = (parseFloat(cssleft)-sumper[Number-1])*imgspeeds;
$("#timeline .inside img").animate({left:sumper[Number-1]},antime);
}

function Changeforward(Number){
	if(Number>1){
		$("#timeline .inside img").css("left",sumper[Number-2]);
	}
}

function setnunber(a){
   //alert(Number);
   return Number;
}

function Stopall(){
   $(".contair").stop();
   $("#timeline .inside img").stop();
}


function ChangeForward(num){
	if(num<n){
		var k=num+1;
		//alert(k);
		getUrlData(k)
		//window.location.href = "index"+".php"+"?n_c="+k;
    }
	else{
		alert("抱歉，后面没有街区了！");
	}
}

function ChangeBackforward(num){
	if(num>1){
		var k=num-1;
		getUrlData(k)
		//window.location.href = "index"+".php"+"?n_c="+k;
	}
	else{
		//window.location.href = "middle"+".php"+"n_c="+1;
	    alert("抱歉，前面没有街区了！");
	}
}

function getUrlData(k) {
	var url = window.location.href;
	var urlArr = url.split('&');
	if(urlArr[0]) {
	    var s = urlArr[0].split('=')[1];
	}
	if(urlArr[2]) {
	    var s_d_d = urlArr[2].split('=')[1];
	    var d_d = urlArr[3].split('=')[1];
	}
	if(s_d_d&&d_d) {
		if ((s_d_d=='1'||s_d_d=='3'||s_d_d=='5')&&(d_d=='2'||d_d=='3'||d_d=='4')) {
			d_d = 1;
		}
		else if ((s_d_d=='0'||s_d_d=='2'||s_d_d=='4')&&(d_d=='1'||d_d=='5'||d_d=='6')) {
			d_d = 2;
		}
		window.location.href = "index.php?street="+s+"&n_c="+k+"&street_direction_data="+s_d_d+"&direction_data="+d_d;
	}
	else {
		window.location.href = "index.php?street="+s+"&n_c="+k;
	}
}

function changeimg(){
	var leftimg;
	//alert(sumwid);
	if(street_dir_data=='none'||dir_data=='none'||dir_data=='10'||street_dir_data=='10'){//alert(street_dir_data+dir_data);
		return;
		//leftimg=sumwid[Number-2];
	}
	else{
		if (Number==1){
			if ((street_dir_data=='0'||street_dir_data=='2'||street_dir_data=='4')&&(dir_data=='1'||dir_data=='5'||dir_data=='6')) {
				leftimg=sumwid[0];
			}
			else{
				leftimg=0;
			}	
		}
		else{
		    if (((street_dir_data=='1'||street_dir_data=='3'||street_dir_data=='5')&&(dir_data=='2'||dir_data=='3'||dir_data=='4'))||((street_dir_data=='0'||street_dir_data=='2'||street_dir_data=='4')&&(dir_data=='1'||dir_data=='5'||dir_data=='6'))) {
				leftimg=sumwid[Number-1];
			}
			else{
				leftimg=sumwid[Number-2];
			} 
	    }
	//alert(leftimg);
	$("#timeline .inside img").animate({left:leftimg},1);
	factx = leftimg;
	contentplay();
	}
}

function Adddirection(){
$(".cont1").append("<div id='l1' class='left'></div>");
$(".cont1").append("<div id='r1' class='right'></div>");
$(".cont1").append("<div id='r2' class='right'>点击进入下一街区</div>");
$(".cont1").append("<div id='l2' class='left'>点击进入上一街区</div>");
$(".cont1").append("<div id='stopL' class='stop'></div>");
$(".cont1").append("<div id='stopR' class='stop'></div>");
}

function streetplay(){
	$("#l2").hide();
	$("#r2").hide();
	$(".stop").hide();
	$("#l1").click(function(){
		Stopall();
		if($("#r1").is(':hidden')){
    	    $("#stopR").hide();
		    $("#r2").hide();
	 	    $("#r1").show();
		}
		$("#l1").hide();
		$("#stopL").show();
		
		GoBackforward(Number);
		var t=antime;
	    $(".contair").animate({left:'0px'},t,function(){
			$("#stopL").hide();
			$("#l1").hide();
			$("#l2").show();
		});
	})
    $("#r1").click(function(){
		Stopall();
		if($("#l1").is(':hidden')){ 
			$("#l1").show();
			$("#l2").hide();
		    $("#stopL").hide();
		}
		$("#r1").hide();
		$("#stopR").show();
		var x=$(".contair").width();
		var scroll=verwwid-x;
		Goforward(Number);
	    var t=antime;
		$(".contair").animate({left:scroll},t,function(){
			$("#stopR").hide();
			$("#r1").hide();
		    $("#r2").show();
	    });
	})
	$("#stopL").click(function(){
		$("#stopL").hide();
		$("#l1").show();
	$(".contair").stop();
	$("#timeline .inside img").stop();
	
	});
	$("#stopR").click(function(){
		$("#stopR").hide();
		$("#r1").show();
	    $(".contair").stop();
	    $("#timeline .inside img").stop();
	});

	$("#r2").click(function(){
		ChangeForward(Number);
	});
	$("#l2").click(function(){
		ChangeBackforward(Number);
		Changeforward(Number);
	});
}


