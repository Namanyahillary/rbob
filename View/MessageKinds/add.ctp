<div class="messageKinds form">
<?php echo $this->Form->create('MessageKind'); ?>
	<fieldset>
		<legend><?php echo __('Add Message Kind'); ?></legend>
	<?php
		echo $this->Form->input('kind');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Message Kinds'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Messages'), array('controller' => 'messages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Message'), array('controller' => 'messages', 'action' => 'add')); ?> </li>
	</ul>
</div>
