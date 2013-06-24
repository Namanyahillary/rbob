<div class="destinationsRegions form">
<?php echo $this->Form->create('DestinationsRegion'); ?>
	<fieldset>
		<legend><?php echo __('Edit Destinations Region'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('region_id');
		echo $this->Form->input('destination_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('DestinationsRegion.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('DestinationsRegion.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Destinations Regions'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Regions'), array('controller' => 'regions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Region'), array('controller' => 'regions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Destinations'), array('controller' => 'destinations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Destination'), array('controller' => 'destinations', 'action' => 'add')); ?> </li>
	</ul>
</div>
