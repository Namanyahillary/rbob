<div class="destinationImages form">
<?php echo $this->Form->create('DestinationImage'); ?>
	<fieldset>
		<legend><?php echo __('Edit Destination Image'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('caption');
		echo $this->Form->input('destination_id');
		echo $this->Form->input('image_file');
		echo $this->Form->input('user_id');
		echo $this->Form->input('date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('DestinationImage.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('DestinationImage.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Destination Images'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Destinations'), array('controller' => 'destinations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Destination'), array('controller' => 'destinations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
