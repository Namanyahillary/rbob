<div class="payments index">
	<h2><?php echo __('Payments'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('booking_id'); ?></th>
			<th><?php echo $this->Paginator->sort('payment_method_id'); ?></th>
			<th><?php echo $this->Paginator->sort('transaction_reference'); ?></th>
			<th><?php echo $this->Paginator->sort('amount_paid'); ?></th>
			<th><?php echo $this->Paginator->sort('ip_address'); ?></th>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
			<th><?php echo $this->Paginator->sort('time'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($payments as $payment): ?>
	<tr>
		<td><?php echo h($payment['Payment']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($payment['Booking']['id'], array('controller' => 'bookings', 'action' => 'view', $payment['Booking']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($payment['PaymentMethod']['name'], array('controller' => 'payment_methods', 'action' => 'view', $payment['PaymentMethod']['id'])); ?>
		</td>
		<td><?php echo h($payment['Payment']['transaction_reference']); ?>&nbsp;</td>
		<td><?php echo h($payment['Payment']['amount_paid']); ?>&nbsp;</td>
		<td><?php echo h($payment['Payment']['ip_address']); ?>&nbsp;</td>
		<td><?php echo h($payment['Payment']['date']); ?>&nbsp;</td>
		<td><?php echo h($payment['Payment']['time']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $payment['Payment']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $payment['Payment']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $payment['Payment']['id']), null, __('Are you sure you want to delete # %s?', $payment['Payment']['id'])); ?>
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
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Payment'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Bookings'), array('controller' => 'bookings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Booking'), array('controller' => 'bookings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Payment Methods'), array('controller' => 'payment_methods', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Payment Method'), array('controller' => 'payment_methods', 'action' => 'add')); ?> </li>
	</ul>
</div>
