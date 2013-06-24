<div class="paymentMethods view">
<h2><?php  echo __('Payment Method'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($paymentMethod['PaymentMethod']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($paymentMethod['PaymentMethod']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Payment Method'), array('action' => 'edit', $paymentMethod['PaymentMethod']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Payment Method'), array('action' => 'delete', $paymentMethod['PaymentMethod']['id']), null, __('Are you sure you want to delete # %s?', $paymentMethod['PaymentMethod']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Payment Methods'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Payment Method'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Payments'), array('controller' => 'payments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Payment'), array('controller' => 'payments', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Payments'); ?></h3>
	<?php if (!empty($paymentMethod['Payment'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Booking Id'); ?></th>
		<th><?php echo __('Payment Method Id'); ?></th>
		<th><?php echo __('Transaction Reference'); ?></th>
		<th><?php echo __('Amount Paid'); ?></th>
		<th><?php echo __('Ip Address'); ?></th>
		<th><?php echo __('Date'); ?></th>
		<th><?php echo __('Time'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($paymentMethod['Payment'] as $payment): ?>
		<tr>
			<td><?php echo $payment['id']; ?></td>
			<td><?php echo $payment['booking_id']; ?></td>
			<td><?php echo $payment['payment_method_id']; ?></td>
			<td><?php echo $payment['transaction_reference']; ?></td>
			<td><?php echo $payment['amount_paid']; ?></td>
			<td><?php echo $payment['ip_address']; ?></td>
			<td><?php echo $payment['date']; ?></td>
			<td><?php echo $payment['time']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'payments', 'action' => 'view', $payment['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'payments', 'action' => 'edit', $payment['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'payments', 'action' => 'delete', $payment['id']), null, __('Are you sure you want to delete # %s?', $payment['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Payment'), array('controller' => 'payments', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
