<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<div class="activityImages form">
<?php echo $this->Form->create('ActivityImage'); ?>
	<fieldset>
		<legend><?php echo __('Edit Activity Image'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('caption');
		echo $this->Form->input('activity_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('image_file');
		echo $this->Form->input('date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ActivityImage.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ActivityImage.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Activity Images'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Activities'), array('controller' => 'activities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Activity'), array('controller' => 'activities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
