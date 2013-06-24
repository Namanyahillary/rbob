<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<div class="groupPosts form">
<?php echo $this->Form->create('GroupPost'); ?>
	<fieldset>
		<legend><?php echo __('Add Group Post'); ?></legend>
	<?php
		echo $this->Form->input('group_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('content');
		echo $this->Form->input('image_url');
		echo $this->Form->input('has_image');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>