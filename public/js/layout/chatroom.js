$(function(){

	window.app = {};

	dataSection = $('#data_section');

	var userId = getTransferData('user-id');
	var userName = getTransferData('user-name');

	if(userId == undefined){
		userId = 0;
		userName = '遊客';
	}

	var path = $('#chat_room').data('chatroom-url');
	app.BrainSocket = new BrainSocket(
		new WebSocket('ws://'+path+':8080'),
		new BrainSocketPubSub()
	);

	//get data
	app.BrainSocket.Event.listen('generic.event',function(msg){
		displayMessage(msg.client.data.user_name, msg.client.data.message, '');
	});

	app.BrainSocket.Event.listen('app.success',function(data){
		displayMessage('系統', '連線成功', 'success');
	});

	app.BrainSocket.Event.listen('app.error',function(data){
		displayMessage('系統', '連線失敗', 'error');
	});

	$('#chat-message').keypress(function(event) {

		if(event.keyCode == 13){

			app.BrainSocket.message('generic.event',
			{
					'message': $(this).val(),
					'user_id': userId,
					'user_name': userName
			}
			);
			$(this).val('');

		}

		return event.keyCode != 13;
	});

	function displayMessage(name, message, type){
		//0 default 1 success 2 error
		var spanName = $('<span class="chat_name"></span>').text(name + '：');
		var spanMessage = $('<span class="chat_message"></span>').text(message);
		var divRow = $('<div class="chat_row"></div>').append(spanName).append(spanMessage);
		$('#chat-log').append(divRow);

	}

});