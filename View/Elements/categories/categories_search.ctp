<div id="search-site">
	<input type="text" placeholder="Search here..." class="tip-right site-search-users" />
</div>
<style>
	<!--
		#search-site{position: absolute;z-index: 25;top: 5px;left: 90px;}
		#search-site input[type=text]{background-color: #f1f2f3;}
		.search-results{background: #fff;min-height: 176px;max-height: 400px;width: 20%;left: 90px;top: 36px;position: absolute;z-index: 21;border-radius: 5px;opacity: 0.98;overflow-y:auto;overflow-x:auto;color:#000;}
		@media (max-width: 768px){
			.search-results{width: 50%;}
		}
		
		
	->
</style>

<style>
<!--
.widget {margin-top: 1.5em;overflow: hidden;}
.widget {-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;-moz-background-clip: padding;-webkit-background-clip: padding-box;background-clip: padding-box;border: 1px solid #cfcfd6;background:#f7f8f9;}
.sidebar .widget .cards {margin: 0em;}
.cards {list-style: none;margin-left: 0px;margin: 0em 0em 1em 0em;}
.cards .title {text-transform: uppercase;text-shadow: 1px 1px 0px #fff;line-height: 1.2em;margin-bottom: 1em;color: #41414c;}
.cards .img {width: 48px;height: 48px;float: left;margin-right: 1em;margin-bottom: 1em;}
.cards .info-text {position: relative;top: -4px;}
.cards .stats {padding-top: .75em;margin-bottom: 0em;}
.cards li {margin-bottom: 2em 0em;padding: 1em;border-top: 1px solid #dddde2;}
.cards .title {text-transform: uppercase;text-shadow: 1px 1px 0px #fff;line-height: 1.2em;margin-bottom: 1em;color: #41414c;}
.cards .time {font-size: .75em;float: right;}
.cards .stats span {margin-right: .75em;}
.slimScrollDiv{
background: #fff;
border: 1px solid #fff;
}
-->
</style>
<div class="search-results">
	<div class="widget">
		<ul class="cards"></ul>
		<div style="height: 30px;text-align: center;"><span style="cursor:pointer;color:#08c"><b class="load-more-items">load more</b></span></div>
	</div>
</div>

<script>
$('.search-results').hide();
$(document).ready(function(){
	$('.search-results').hide();
	$('body').click(function(){
		$('.search-results').hide();
	});
	$('.site-search-users').click(function(){
		if(($('.site-search-users').val()).length){
			$('.search-results').show('slow',function(){
				$('.search-results').show('slow');
			});
		}
	});
	
	
	$(function(){
	  $('.search-results .widget ul').slimScroll({
		  height: '290px',
		  alwaysVisible: false,
		  start: 'top',
		  wheelStep: 10
	  });
	});
	
});

$('.site-search-users').keyup(function () {
  typewatch(function () {
    getSearchResults();
  }, 500);
});

var typewatch = (function(){
  var timer = 0;
  return function(callback, ms){
    clearTimeout (timer);
    timer = setTimeout(callback, ms);
  }  
})();

function getSearchResults(){
	$('.search-results').show('slow');
	var q=$('.site-search-users').val();
	if(q.length){
		$.getJSON('<?php echo $this->webroot.'my_search/get_data/'; ?>'+(q),function(jsonD){
			var _html='';
			$.each(jsonD,function(k1,v1){
				$.each(v1,function(k2,v2){
					if(k1=='User'){
						_html+='<li class="use-ajax"><a href="<?php echo $this->webroot.'users/view/';?>'+(v2.User.id)+'"><div class="img"><img src="<?php echo $this->webroot;?>img/pic/'+(v2.User.profile_image)+'" style="border-radius:5px" width="100px" alt=""></div><p class="info-text" ><b>'+(v2.User.name)+'</b><br/><span style="font-size:9px;color:#999">User</span></p></a></li>';
						console.log();
					}else if(k1=='Group'){					
						_html+='<li><a class="use-ajax" href="<?php echo $this->webroot.'groups/view/';?>'+(v2.Group.id)+'"><div class="img"><img src="<?php echo $this->webroot;?>img/imagecache/group_covers/'+(v2.Group.cover_img)+'" style="border-radius:5px" width="100px" alt=""></div><p class="info-text" ><b>'+(v2.Group.name)+'</b><br/><span style="font-size:9px;color:#999">Group<span></p></a></li>';
					}else if(k1=='Destination'){
						_html+='<li><a class="use-ajax" href="<?php echo $this->webroot.'destinations/view/';?>'+(v2.Destination.id)+'"><div class="img"><img src="<?php echo $this->webroot;?>img/imagecache/destinations/'+(v2.Destination.image_file)+'" style="border-radius:5px" width="100px" alt=""></div><p class="info-text" ><b>'+(v2.Destination.name)+'</b><br/><span style="font-size:9px;color:#999">Destination</span></p></a></li>';
					}				
				});
			});
			if(!_html.length) _html='No results found';			
			$('.search-results .widget .cards').html(_html);
		});
	}
}

</script>