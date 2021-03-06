$(document).ready(function(){
	
	var burl = getTransferData('burl');

	var mousePressed = false;
	var lastX, lastY;
	var ctx = document.getElementById("canvas").getContext("2d");
	
	var img = new Image();   // Create new img element
	img.addEventListener("load", function() {
	  // execute drawImage statements here
	}, false);
	

	$.konami({
		code:  			[83,69,86,69,78],
		interval:		100,
	    complete:	function(){
		  	var canvas = document.getElementsByTagName('canvas')[0];
			canvas.width  = screen.width;
			canvas.height = screen.height;
			draw();
			$("body").css({"overflow-y":"hidden"});
			$("#canvas").css({"z-index":"30"});
			$(".arrow").show(1000);
			$("#egg").css({"width":screen.width,"height":screen.height});
			$("#egg").show(1000);
			$("#clear").show(20000);
			}
	});
	
	$("#close").click(function(){
		$("#egg").hide();
		$("#part1").hide();
		$("#part2").hide();
	});
	$("#clear").click(function(){
		ctx.clearRect(0,0,canvas.width,canvas.height);
		$("#canvas").css({"z-index":"0"});
		$(this).hide();
		$(".arrow").hide();
	});
	$('#canvas').mousedown(function (e) {
        mousePressed = true;
        Draw(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top, false);
    });

    $('#canvas').mousemove(function (e) {
        if (mousePressed) {
            Draw(e.pageX - $(this).offset().left, e.pageY - $(this).offset().top, true);
        }
    });

    $('#canvas').mouseup(function (e) {
        mousePressed = false;
    });
	    $('#canvas').mouseleave(function (e) {
        mousePressed = false;
    });

	function Draw(x, y, isDown) {
	    if (isDown) {
	    	ctx.beginPath();    
	        ctx.clearRect(x,y,20,20);
	    }
	}

		function draw() {
		  var img = new Image();
		  img.onload = function(){
		   ctx.drawImage(img, 0, 0,canvas.width,canvas.height);
		   ctx.strokeStyle = "black"
		   ctx.font = "bold 50px Arial";
		   ctx.fillText("click left mouse to clear the screen",300,100);
		  }
		   img.src = burl+'/images/SchoolGuide/fog.jpeg';
	}

	$(".good").click(function(){
		var good = $(this).data('id');
		var id = $(this).data('placed_id');
		console.log(good + ':'+ id);
		ajaxPost(getTransferData('guide_good'),{id:id,good:good},function(data) {
			console.log(data);
			$('.word').text('無限期支持數' + data['count']);
		});
	});
	$(".good2").click(function(){
		var good = $(this).data('id');
		var id = $(this).data('placed_id');
		console.log(good + ':'+ id);
		ajaxPost(getTransferData('guide_good'),{id:id,good:good},function(data) {
			console.log(data);
			$('.word2').text('支持數' + data['count']);
		});
	});
	
});