<div class="destinationsRegions view">
<h2><?php  echo __('Destinations Region'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($destinationsRegion['DestinationsRegion']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Region'); ?></dt>
		<dd>
			<?php echo $this->Html->link($destinationsRegion['Region']['name'], array('controller' => 'regions', 'action' => 'view', $destinationsRegion['Region']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Destination'); ?></dt>
		<dd>
			<?php echo $this->Html->link($destinationsRegion['Destination']['name'], array('controller' => 'destinations', 'action' => 'view', $destinationsRegion['Destination']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Destinations Region'), array('action' => 'edit', $destinationsRegion['DestinationsRegion']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Destinations Region'), array('action' => 'delete', $destinationsRegion['DestinationsRegion']['id']), null, __('Are you sure you want to delete # %s?', $destinationsRegion['DestinationsRegion']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Destinations Regions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Destinations Region'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Regions'), array('controller' => 'regions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Region'), array('controller' => 'regions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Destinations'), array('controller' => 'destinations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Destination'), array('controller' => 'destinations', 'action' => 'add')); ?> </li>
	</ul>
</div>
