<div class="groupPostComments form">
<?php echo $this->Form->create('GroupPostComment'); ?>
	<fieldset>
		<legend><?php echo __('Edit Group Post Comment'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('group_post_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('comment');
		echo $this->Form->input('date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('GroupPostComment.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('GroupPostComment.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Group Post Comments'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Group Posts'), array('controller' => 'group_posts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group Post'), array('controller' => 'group_posts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
