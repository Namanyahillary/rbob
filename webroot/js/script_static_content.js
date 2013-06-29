/**
 * Author: Namanya Hillary
 * Email -> namanyahillary@gmail.com
**/

$(document).ready(function(){
	/*setInterval(function(){ 
       fetchNewMessageCount();
    }, 3000);*/
	
});

function fetchNewMessageCount(){
	if(allow_get){
		$.get("/roundbob/messages/get_message_count", function(data) {$('.message-count').html((data));});
	}
}



