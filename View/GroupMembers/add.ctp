<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<h6><?php echo __('Add Group Members'); ?></h6><hr/>
<div class="well">
<?php echo $this->Form->input('member',array('class'=>'search-users','label'=>'','placeholder'=>'Search:Whom do you want to add.')); ?>
<div class="search-res"><div>
</div>

<style>
<!--
.remove-user{font-weight:bold;}
.added-user{background:greenyellow;padding:2px;}
.selected-user{cursor:pointer;}
-->
</style>


<script>

$('.search-users').keyup(function () {
  typewatch(function () {
    getNonMembers();
  }, 500);
});

var typewatch = (function(){
  var timer = 0;
  return function(callback, ms){
    clearTimeout (timer);
    timer = setTimeout(callback, ms);
  }  
})();

var added=[];

function removeSelectedUser(index){
	added.splice(index, 1);
}

function f1(_ob){
	uid=$(_ob).attr('rid');
	name=$(_ob).html();
	$('.srid_'+uid).remove();
	$('.added-members').append('<span pos='+(added.length)+' class="added-user rid_'+uid+'">'+name+'<b><a href="#" class="no-ajax remove-user" rid="'+uid+'" onclick="f2(this);return false;">x</a></b><input type="hidden" name="data[GroupMember][members][]" value="'+uid+'" /></span>');
	added.push(uid);
}

function f2(_ob){
	var position=$('.rid_'+($(_ob).attr('rid'))).attr('pos');
	removeSelectedUser(position);
	$('.rid_'+($(_ob).attr('rid'))).remove();	
}

function getNonMembers(){
	var q=($('.search-users').val());
	if(q.length>1){
		$.get('<?php echo $this->webroot; ?>users/get_non_members/'+q+'/'+(<?php echo $this->Session->read("RoundBob['Booking']['ViewGroup']"); ?>),function(resp){
			$('.search-res').html(resp);
		});
	}
}
</script>