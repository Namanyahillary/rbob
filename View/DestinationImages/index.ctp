<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>

<div class="destinationImages well">
	<h2><?php echo __('Destination Images'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('caption'); ?></th>
			<th><?php echo $this->Paginator->sort('destination_id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
			<th class="actions"><?php echo __(''); ?></th>
	</tr>
	<?php foreach ($destinationImages as $destinationImage): ?>
	<tr>
		<td><?php echo h($destinationImage['DestinationImage']['caption']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($destinationImage['Destination']['name'], array('controller' => 'destinations', 'action' => 'view', $destinationImage['Destination']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($destinationImage['User']['name'], array('controller' => 'users', 'action' => 'view', $destinationImage['User']['id'])); ?>
		</td>
		<td><?php echo h($destinationImage['DestinationImage']['date']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $destinationImage['DestinationImage']['id'])); ?>
			<!--<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $destinationImage['DestinationImage']['id'])); ?>-->
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $destinationImage['DestinationImage']['id']), null, __('Are you sure you want to delete # %s?', $destinationImage['DestinationImage']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>