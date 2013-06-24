<div class="payments view">
<h2><?php  echo __('Payment'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($payment['Payment']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Booking'); ?></dt>
		<dd>
			<?php echo $this->Html->link($payment['Booking']['id'], array('controller' => 'bookings', 'action' => 'view', $payment['Booking']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Payment Method'); ?></dt>
		<dd>
			<?php echo $this->Html->link($payment['PaymentMethod']['name'], array('controller' => 'payment_methods', 'action' => 'view', $payment['PaymentMethod']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Transaction Reference'); ?></dt>
		<dd>
			<?php echo h($payment['Payment']['transaction_reference']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amount Paid'); ?></dt>
		<dd>
			<?php echo h($payment['Payment']['amount_paid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ip Address'); ?></dt>
		<dd>
			<?php echo h($payment['Payment']['ip_address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($payment['Payment']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Time'); ?></dt>
		<dd>
			<?php echo h($payment['Payment']['time']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Payment'), array('action' => 'edit', $payment['Payment']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Payment'), array('action' => 'delete', $payment['Payment']['id']), null, __('Are you sure you want to delete # %s?', $payment['Payment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Payments'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Payment'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Bookings'), array('controller' => 'bookings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Booking'), array('controller' => 'bookings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Payment Methods'), array('controller' => 'payment_methods', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Payment Method'), array('controller' => 'payment_methods', 'action' => 'add')); ?> </li>
	</ul>
</div>
