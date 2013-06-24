<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<div class="groupMembers form">
<?php echo $this->Form->create('GroupMember',array('class'=>'no-ajax')); ?>
	<fieldset>
		<legend><?php echo __('Add Group Members'); ?></legend>
	<p class="added-members">
		
	</p><hr/>
	
	<?php echo $this->Form->input('member',array('class'=>'search-users','label'=>'','placeholder'=>'Search:Whom do you want to add.')); ?>
	
	
	
	<div class="search-results">
	
	</div>
	<hr/>
	
	
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
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
    getUsers();
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

function getUsers(){
	var q=($('.search-users').val());
	if(q.length>1){
		console.log(added.join());
		$.getJSON('<?php echo $this->webroot; ?>users/get_users/'+q+'/'+(added.join()),function(resp){
			var users_block='';
			if(resp!=undefined && resp.length){
				$.each(resp,function(c,d){			
					users_block+='<p onclick="f1(this);" class="selected-user srid_'+d.User.id+'" rid="'+d.User.id+'"><img src="<?php echo $this->webroot;?>img/pic/'+d.User.profile_image+'" width="20px" /> '+d.User.name+'</p>';			
				});
				$('.search-results').html(users_block);
			}
		});
	}
}
</script>