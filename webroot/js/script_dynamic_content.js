/**
 * Author: Namanya Hillary
 * Email -> namanyahillary@gmail.com
**/
var lock=0;
$(document).ready(function(){
	//Pagination
	$('.paging span a').addClass('btn').addClass('btn-small');
	
	//Edit Links
	prepare_ajax_links();
	
	//Fetch data for clicked links
	$('.dynamic-content a, .use-ajax').click(function (){	
		if(!($(this).hasClass('no-ajax')) && !($(this).hasClass('nivo-nextNav')) && !($(this).hasClass('nivo-control')) && !($(this).hasClass('nivo-prevNav'))){
			if(!(confirmRequest($(this))))	return false;showLoading();
			_obj=$(this);
			
			if(lock==0)lock=1;
			else return;
			
			var data = {};
			data={};
			if(lock==1){
				$.ajax({
					url: $(this).attr('data-target'),
					data: data,
					success: function(data) {lock==0;afterFetch(_obj,data);},
					error: function() {lock==0;}
				});
				//$.get($(this).attr('data-target'), function(data) {afterFetch(_obj,data);});
			}
		}
	});
	
	
	//submit Form data
	$(".dynamic-content form, .modal-body form").submit(function(e){
		var $form = $( this ),
		my_url = $form.attr( 'action' );
		if(!$form.hasClass('no-ajax')){
		e.preventDefault();
		dataString = $( this ).serialize();		
			if(!(confirmRequest($(this))))	return false;showLoading();
			_obj=$(this);
			$.ajax({type: "POST",url: my_url,data: dataString,dataType: "html",
				success: function(data) {lock==0;afterFetch(_obj,data);} ,
				error: function() {lock==0;}
			}); 
		}
	});
	
	//Fade out Flash Message
	setTimeout(function(){
		$('.flash-message').fadeOut('slow');
	},4000);
	
	//Search for receipt
	$('.user_search_query_btn, .booking_search_query_btn').click(function (){	
		if(($('.search_query_string').val()).length==0) return false;
		showLoading();
		_obj=$(this);
		
		if(lock==0)lock=1;
		else return;
		
		var data = {};
		data={'search_query_string':$('.search_query_string').val()};
		if(lock==1){
			$.ajax({
				url: $(this).attr('search-target'),
				data: data,
				success: function(data) {lock==0;afterFetch(_obj,data);},
				error: function() {lock==0;}
			});
		}
	});
	
});

//Show that data is being sent/fetched from the server
function showLoading(){
	var img="<img class='loading-animation' src='/roundbob/img/spinner.gif' style='position:fixed;bottom:120px;left:220px;'>";
	$('.dynamic-content').prepend(img);
}

//Remove the loading animation 
function removeLoading(){
	$('.loading-animation').remove();
}

function prepare_ajax_links(){
	//remove all the hrefs(hyperlinks)
	$('.dynamic-content a, .use-ajax').each(function(){
		if(!($(this).hasClass('no-ajax')) && ($(this).attr('href')!='#') && !($(this).hasClass('nivo-nextNav')) && !($(this).hasClass('nivo-control')) && !($(this).hasClass('nivo-prevNav'))){
			var reference_link=$(this).attr('href');
			$(this).attr('href','#');
			$(this).attr('data-target',reference_link);
			$(this).attr('onclick','return false;');
		}
		
			
		
	});
}

//called before a request is sent to confirm user

function confirmRequest(obj){
	var bool=1;
	var attr = obj.attr('data-confirm-text');
	if(obj.hasClass('confirm-first') && (typeof attr !== 'undefined' && attr !== false)){
		if(!(confirm(obj.attr('data-confirm-text')))){
			bool=0;
		}	
	}
	return bool;
}


//function called after the data has been fetched and the request is successfull
function afterFetch(obj,data){
	if(obj.hasClass('change-container')){
		var loadable_container=obj.attr('loadable-container');
		var _class_object=$(''+loadable_container);
		if(_class_object.length){
			$(''+loadable_container).html(data);
		}else{
			$('.dynamic-content').html(data);
		}		
		removeLoading();
	}else if(obj.hasClass('for-modal')){
		removeLoading();
		$('.modal-body').html(data);
		$("#view-modal").modal('show');
		if(obj.hasClass('remove-modal-after')){
			setTimeout(function(){
				$("#view-modal").modal('hide');
			},4000);	
		}
		
	}else{
		$('.dynamic-content').html(data);
	}
}


