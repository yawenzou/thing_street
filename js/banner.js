var screenWidth = $(window).width();
var bannerProgressbarWidth = screenWidth*0.9;
var bannerImgWidth = 450; 
var imgNumber = 5;
var currentNumber = 1;
function banner() {
	var bannerWidth = bannerImgWidth*2;
	var bannerAllImgWidth = bannerImgWidth*imgNumber;
	var bannerProgressbarLiWidth = bannerProgressbarWidth/imgNumber;
	$(".banner").width(bannerWidth);
	$(".banner-img").width(bannerAllImgWidth);
	$(".banner-progressbar-ul").width(bannerProgressbarWidth);
	$(".banner-progressbar-li").width(bannerProgressbarLiWidth);
	$(".circle").css("left",bannerProgressbarLiWidth/2);
	autoPlay();
	playEvent();
}

function autoPlay() {
	timer = setInterval("bannerPlay()",3000); 
}

function stopPlay() {
	clearTimeout(timer);
}

function bannerPlay() {
	var circleLeft = currentNumber*(bannerProgressbarWidth/imgNumber)+(bannerProgressbarWidth/imgNumber)/2;
	var left = (bannerImgWidth*2)*((currentNumber)/2);
	$(".circle").animate({left: circleLeft});
	$(".banner-img").animate({left: -left});
	if(currentNumber<imgNumber-1) {
		currentNumber++;
	}
	else {
		currentNumber = 0;
	}
}

function playEvent() {
	$(".banner-img").mouseover(function () {
		stopPlay();
	});
	$(".banner-img").mouseout(function () {
		autoPlay();
	});
	$(".pref_content").mouseover(function () {
		stopPlay();
	});
	$(".pref_content").mouseout(function () {
		autoPlay();
	});
	$(".banner-progressbar-li").click(function() {
		stopPlay();
		currentNumber = $(this).attr("_number");
		bannerPlay();
		autoPlay();
	});
	$(".left-icon").click(function() {
		stopPlay();
		if(currentNumber>1) {
			currentNumber=currentNumber-2;
		}
		else if(currentNumber == 0) {
			currentNumber = imgNumber-2;
		}
		else {
			currentNumber = imgNumber-1;
		}	
		bannerPlay();
		autoPlay();
	});
	$(".right-icon").click(function() {
		stopPlay();
		if(currentNumber<imgNumber) {
		}
		else {
			currentNumber = 0;
		}	
		bannerPlay();
		autoPlay();
	})
}