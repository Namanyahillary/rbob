<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<div class="bookings index">
	<h2><?php echo __('Bookings'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('transaction'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('destination_id'); ?></th>
			<th><?php echo $this->Paginator->sort('booking_date'); ?></th>
			<th><?php echo $this->Paginator->sort('booking_time'); ?></th>
			<th class="actions"><?php echo __(''); ?></th>
	</tr>
	<?php foreach ($bookings as $booking): ?>
	<tr>
		<td><?php echo h($booking['Booking']['transaction']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($booking['User']['name'], array('controller' => 'users', 'action' => 'view', $booking['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($booking['Destination']['name'], array('controller' => 'destinations', 'action' => 'view', $booking['Destination']['id'])); ?>
		</td>
		<td><?php echo h($booking['Booking']['booking_date']); ?>&nbsp;</td>
		<td><?php echo h($booking['Booking']['booking_time']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $booking['Booking']['id'])); ?>
			<?php if($super_admin): ?>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $booking['Booking']['id'])); ?>			
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $booking['Booking']['id']), null, __('Are you sure you want to delete # %s?', $booking['Booking']['id'])); ?>
			<?php endif; ?>
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