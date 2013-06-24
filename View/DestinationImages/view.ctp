<div class="destinationImages view">
<h2><?php  echo __('Destination Image'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($destinationImage['DestinationImage']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Caption'); ?></dt>
		<dd>
			<?php echo h($destinationImage['DestinationImage']['caption']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Destination'); ?></dt>
		<dd>
			<?php echo $this->Html->link($destinationImage['Destination']['name'], array('controller' => 'destinations', 'action' => 'view', $destinationImage['Destination']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image File'); ?></dt>
		<dd>
			<?php echo h($destinationImage['DestinationImage']['image_file']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($destinationImage['User']['name'], array('controller' => 'users', 'action' => 'view', $destinationImage['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($destinationImage['DestinationImage']['date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Destination Image'), array('action' => 'edit', $destinationImage['DestinationImage']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Destination Image'), array('action' => 'delete', $destinationImage['DestinationImage']['id']), null, __('Are you sure you want to delete # %s?', $destinationImage['DestinationImage']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Destination Images'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Destination Image'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Destinations'), array('controller' => 'destinations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Destination'), array('controller' => 'destinations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
