var ul;
var liItems;
var imageNumber;
var imageWidth;
var prev,next;
var currentPosition;
var currentImage;
function initdelay(ids){
	setTimeout(function(){
		init(ids);
		init1(ids);
	},1000);
}
function init(js){
	g = js + "_slider"
	currentPosition = 0;
	currentImage = 0;
	ul = document.getElementById(g);
	liItems = ul.children;
	imageNumber = liItems.length;
	imageWidth = liItems[0].clientWidth;
	ul.style.width = parseInt(imageWidth * imageNumber) + 'px';
	ul.style.left = "0px";
}
function animate(opts){
	var start = new Date;
	var id = setInterval(function(){
		var timePassed = new Date - start;
		var progress = timePassed/opts.duration;
		if(progress > 1){
			progress = 1;
		} 
		var delta = opts.delta(progress);
		opts.step(delta);
		if(progress==1){
			clearInterval(id);
			opts.callback();
		}
	}, opts.delay || 17);
}
function slideTo(imageToGo){
	var direction;
	var numOfImageToGo = Math.abs(imageToGo - currentImage);
	direction = currentImage > imageToGo ? 1 : -1;
	currentPosition = -1 * currentImage * imageWidth;
	var opts = {
		duration:1000,
		delta:function(p){return p;},
		step:function(delta){
			ul.style.left = parseInt(currentPosition + direction * delta * imageWidth * numOfImageToGo) + "px";
		},
		callback:function(){currentImage = imageToGo;}
	};
	animate(opts);
}
function onClickPrev(){
	if(currentImage == 0){
		slideTo(imageNumber - 2);
	}
	else{
		slideTo(currentImage - 1);
	}
}
function onClickNext(){
	if(currentImage == imageNumber - 2){
		slideTo(0);
	}
	else{
		slideTo(currentImage + 1);
	}
}
function generatePager(imageNumber){
	/*var pageNumber;
	var pagerDiv = document.getElementById('pager');
	for(i=0;i<imageNumber;i++){
		var li = document.createElement('li');
		pageNumber = document.createTextNode(parseInt(i + 1));
		li.appendChild(pageNumber);
		pagerDiv.appendChild(li);
		li.onclick = function(i){
			return function(){
				slideTo(i);
			}
		}(i);
	}*/
	var computedStyle = document.defaultView.getComputedStyle(li, null);
	var liWidth = parseInt(li.offsetWidth);
	var liMargin = parseInt(computedStyle.margin.replace('px',""));
	pagerDiv.style.width = parseInt((liWidth + liMargin * 2) * imageNumber) + 'px';
}
var ul1;
var liItems1;
var imageNumber1;
var imageWidth1;
var prev1,next1;
var currentPosition1;
var currentImage1;
function init1(js){
	currentPosition1 = 0;
	currentImage1 = 0;
	var l = js + "_pager";
	ul1 = document.getElementById(l);
	liItems1 = ul1.children;
	imageNumber1 = liItems.length;
	imageWidth1 = liItems1[0].children[0].clientWidth/(imageNumber1-1);
	ul1.style.width = parseInt(imageWidth * imageNumber) + 'px';
	ul1.style.left = "0px";
	//generatePager(imageNumber);
}
function animate1(opts1){
	var start1 = new Date;
	var id1 = setInterval(function(){
		var timePassed1 = new Date - start1;
		var progress1 = timePassed1/opts1.duration;
		if(progress1 > 1){
			progress1 = 1;
		} 
		var delta1 = opts1.delta1(progress1);
		opts1.step1(delta1);
		if(progress1==1){
			clearInterval(id1);
			opts1.callback();
		}
	}, opts1.delay || 17);
}
function slideTo1(imageToGo1){
	var direction1;
	var numOfImageToGo1 = Math.abs(imageToGo1 - currentImage1);
	direction1 = currentImage1 > imageToGo1 ? 1 : -1;
	currentPosition1 = -1 * currentImage1 * imageWidth1;
	var opts1 = {
		duration:1000,
		delta1:function(p){return p;},
		step1:function(delta1){
			ul1.style.left = parseInt(currentPosition1 + direction1 * delta1 * imageWidth1 * numOfImageToGo1) + "px";
		},
		callback:function(){currentImage1 = imageToGo1;}
	};
	animate1(opts1);
}
function onClickPrev1(){
	if(currentImage1== 0){
		slideTo1(((imageNumber1 - 2)/6 - ((imageNumber1 - 2)/6)%1)*6);
	}
	else{
		slideTo1(currentImage1 - 6);
	}
}
function onClickNext1(){
	if(currentImage1/6 - (currentImage1/6)%1 == ((imageNumber1 - 2)/6) - ((imageNumber1 - 2)/6)%1){
		slideTo1(0);
	}
	else{
		slideTo1(currentImage1 + 6);
	}
}
function generatePager(imageNumber){
	/*var pageNumber;
	var pagerDiv = document.getElementById('pager');
	for(i=0;i<imageNumber;i++){
		var li = document.createElement('li');
		pageNumber = document.createTextNode(parseInt(i + 1));
		li.appendChild(pageNumber);
		pagerDiv.appendChild(li);
		li.onclick = function(i){
			return function(){
				slideTo(i);
			}
		}(i);
	}*/
	var computedStyle = document.defaultView.getComputedStyle(li, null);
	var liWidth = parseInt(li.offsetWidth);
	var liMargin = parseInt(computedStyle.margin.replace('px',""));
	pagerDiv.style.width = parseInt((liWidth + liMargin * 2) * imageNumber) + 'px';
}
