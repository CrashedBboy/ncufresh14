$(function(){

	var LorP = 'Picture';
	var canDrag = false;
	var drag = $('#1').draggable({
				containment: '#containment'
        		});
	var bURL = getTransferData('burl');
	DragLocal();

	$('#place').jScrollPane();

	$('.place').click(function(){
		var num = $(this).data("num");
		var formURL = getTransferData('ncu_life_select_url');
		var data = {num: num};
		var id = $(this).data("id");
		$('.place').css("background-image", "url(../images/nculife/place.png)");
		$('#place' + id).css("background-image", "url(../images/nculife/prese_place.png)");
		canDrag = false;
		DragLocal();
		ajaxGet(formURL, data, changeIntroductionAndImage);
	});

	$('#buttom').click(function(){
		var num = $(this).data("num");
		var formURL = getTransferData('ncu_life_select_url');
		var data = {num: num};
		if(LorP == 'Picture')
		{	
			LorP = 'Local';
			canDrag = true;
			DragLocal();
			ajaxGet(formURL, data, changeLocal);
		}
		else if(LorP == 'Local')
		{	
			LorP = 'Picture';
			canDrag = false;
			DragLocal();
			ajaxGet(formURL, data, changePicture);	
		}
	});

	$('.select').click(function(){
		var num = $(this).data("num");
		var id = $(this).data("id");
		var formURL = getTransferData('ncu_life_selectpicture_url');
		var data = {num: num};
		$('.select').css("background-image", "url(../images/nculife/switchoff.png)");
		$('#select' + id).css("background-image", "url(../images/nculife/switchon.png)");
		ajaxGet(formURL, data, selectPicture);
	});

	function changeIntroductionAndImage(data){
		$('#introduction').html(data['result']['introduction']);
		$('#buttom').data("num", data['result']['id']);
		if(LorP == 'Picture')
		{
			$('#picture_select').remove();
			$('#img').remove();
			$('#picture').append('<div id="picture_select"></div>');
			i = data['pictures'].length;
			var j = 0;
			for(j;j<i;j++)
			{
				$('#picture_select').append('<div id="select' + (j+1) + '" class="select" data-num="' + data['pictures'][j].picture_id + '" data-id="' + (j+1) + '" ></div> ');
			}
			$('#picture').append('<div id="img"></div>');
			$('#img').append('<img id="1" class="img" class="img" src="' + bURL + "/img/uploadImage/" + data['pictures'][0]['picture_admin'].file_name +'">');
			drag = $('#1').draggable({
					containment: '#containment'
        			});
			DragLocal();
			$('.select').click(function(){
				var num = $(this).data("num");
				var formURL = getTransferData('ncu_life_selectpicture_url');
				var data = {num: num};
				var id = $(this).data("id");
				$('.select').css("background-image", "url(../images/nculife/switchoff.png)");
				$('#select' + id).css("background-image", "url(../images/nculife/switchon.png)");
				ajaxGet(formURL, data, selectPicture);
			});
			LorP = 'Picture';
		}
		else if(LorP == 'Local')
		{
			$('#img').remove();
			$('#containment').remove();
			$('#picture').append('<div id="picture_select"></div>');
			i = data['pictures'].length;
			var j = 0;
			for(j;j<i;j++)
			{
				$('#picture_select').append('<div id="select' + (j+1) + '" class="select" data-num="' + data['pictures'][j].picture_id + '" data-id="' + (j+1) + '" ></div> ');
			}
			$('#picture').append('<div id="img"></div>');
			$('#img').append('<img id="1" class="img" src="' + bURL + "/img/uploadImage/" + data['pictures'][0]['picture_admin'].file_name +'">');
			drag = $('#1').draggable({
					containment: '#containment'
        			});
			DragLocal();
			$('.select').click(function(){
				var num = $(this).data("num");
				var formURL = getTransferData('ncu_life_selectpicture_url');
				var data = {num: num};
				var id = $(this).data("id");
				$('.select').css("background-image", "url(../images/nculife/switchoff.png)");
				$('#select' + id).css("background-image", "url(../images/nculife/switchon.png)");
				ajaxGet(formURL, data, selectPicture);
			});
			LorP = 'Picture';
		}
		$('#change').attr('src', bURL + "/images/nculife/buttom_left.png")
	}

	function changePicture(data){
		var i = data['pictures'].length;
		var j = 0;
		$('#img').remove();
		$('#containment').remove();
		$('#picture').append('<div id="picture_select"></div>');
		for(j;j<i;j++)
		{
			$('#picture_select').append('<div id="select' + (j+1) + '" class="select" data-num="' + data['pictures'][j].picture_id + '" data-id="' + (j+1) + '" ></div> ');
		}
		$('#picture').append('<div id="img"></div>');
		$('#img').append('<img id="1" class="img" src="' + bURL + "/img/uploadImage/" + data['pictures'][0]['picture_admin'].file_name +'">');
		$('#change').attr('src', bURL + "/images/nculife/buttom_left.png")
		drag = $('#1').draggable({
				containment: '#containment'
        		});
		DragLocal();
		$('.select').click(function(){
		var num = $(this).data("num");
			var formURL = getTransferData('ncu_life_selectpicture_url');
			var data = {num: num};
			var id = $(this).data("id");
			$('.select').css("background-image", "url(../images/nculife/switchoff.png)");
			$('#select' + id).css("background-image", "url(../images/nculife/switchon.png)");
			ajaxGet(formURL, data, selectPicture);
		});
	}

	function changeLocal(data){
		$('#picture_select').remove();
		$('#img').remove();
		$('#picture').append('<div id="img"></div>');
		$('#img').append('<div id="border"></div>');
		$('#border').css("width", "545px").css("height", "325px").css("margin-top", "150px").css("margin-left", "45px").css("overflow", "hidden");
		$('#border').append('<img id="1" class="img" src="' + bURL + "/img/uploadImage/" + data['local'][0].file_name +'">');
		$('#1').css("width", "783px").css("height", "522px").css("margin-top", "0px").css("margin-left", "0px").css("top", data['result']['top']).css("left", data['result']['left']);
		$('.img').css('-webkit-mask-image', 'null');
		$('#picture').append('<div id="containment"></div>');
		$('#change').attr('src', bURL + "/images/nculife/buttom_right.png")
		drag = $('#1').draggable({
				containment: '#containment'
        		});
		DragLocal();
	}

	function selectPicture(data){
		$('#1').attr("src", bURL + "/img/uploadImage/" + data['pictures'][0]['picture_admin'].file_name);
	}

	function DragLocal(){
		if(canDrag == true)
		{
			drag.draggable('enable');
		}
		else if(canDrag == false)
		{
			drag.draggable('disable');
		}
	}

	function PlaceButtom()
	{

	}
})