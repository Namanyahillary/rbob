<div class="groupPostComments form">
<?php echo $this->Form->create('GroupPostComment'); ?>
	<fieldset>
		<legend><?php echo __('Add Group Post Comment'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Group Post Comments'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Group Posts'), array('controller' => 'group_posts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group Post'), array('controller' => 'group_posts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
