<div class="banks view">
<h2><?php  echo __('Bank'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($bank['Bank']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($bank['Bank']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Location'); ?></dt>
		<dd>
			<?php echo h($bank['Bank']['location']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country'); ?></dt>
		<dd>
			<?php echo $this->Html->link($bank['Country']['name'], array('controller' => 'countries', 'action' => 'view', $bank['Country']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Bank'), array('action' => 'edit', $bank['Bank']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Bank'), array('action' => 'delete', $bank['Bank']['id']), null, __('Are you sure you want to delete # %s?', $bank['Bank']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Banks'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bank'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Countries'), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country'), array('controller' => 'countries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Bookings'), array('controller' => 'bookings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Booking'), array('controller' => 'bookings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Bookings'); ?></h3>
	<?php if (!empty($bank['Booking'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Destination Id'); ?></th>
		<th><?php echo __('Booking Date'); ?></th>
		<th><?php echo __('Booking Time'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Current Status'); ?></th>
		<th><?php echo __('Status History'); ?></th>
		<th><?php echo __('Bank Id'); ?></th>
		<th><?php echo __('Payment Mode'); ?></th>
		<th><?php echo __('Amount'); ?></th>
		<th><?php echo __('Transaction'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($bank['Booking'] as $booking): ?>
		<tr>
			<td><?php echo $booking['id']; ?></td>
			<td><?php echo $booking['user_id']; ?></td>
			<td><?php echo $booking['destination_id']; ?></td>
			<td><?php echo $booking['booking_date']; ?></td>
			<td><?php echo $booking['booking_time']; ?></td>
			<td><?php echo $booking['status']; ?></td>
			<td><?php echo $booking['current_status']; ?></td>
			<td><?php echo $booking['status_history']; ?></td>
			<td><?php echo $booking['bank_id']; ?></td>
			<td><?php echo $booking['payment_mode']; ?></td>
			<td><?php echo $booking['amount']; ?></td>
			<td><?php echo $booking['transaction']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'bookings', 'action' => 'view', $booking['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'bookings', 'action' => 'edit', $booking['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'bookings', 'action' => 'delete', $booking['id']), null, __('Are you sure you want to delete # %s?', $booking['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Booking'), array('controller' => 'bookings', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Users'); ?></h3>
	<?php if (!empty($bank['User'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Slug'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('Password Token'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Email Verified'); ?></th>
		<th><?php echo __('Email Token'); ?></th>
		<th><?php echo __('Email Token Expires'); ?></th>
		<th><?php echo __('Tos'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th><?php echo __('Last Login'); ?></th>
		<th><?php echo __('Last Action'); ?></th>
		<th><?php echo __('Is Admin'); ?></th>
		<th><?php echo __('Profile Image'); ?></th>
		<th><?php echo __('Role'); ?></th>
		<th><?php echo __('Date'); ?></th>
		<th><?php echo __('Credit'); ?></th>
		<th><?php echo __('Bank Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($bank['User'] as $user): ?>
		<tr>
			<td><?php echo $user['id']; ?></td>
			<td><?php echo $user['name']; ?></td>
			<td><?php echo $user['username']; ?></td>
			<td><?php echo $user['slug']; ?></td>
			<td><?php echo $user['password']; ?></td>
			<td><?php echo $user['password_token']; ?></td>
			<td><?php echo $user['email']; ?></td>
			<td><?php echo $user['email_verified']; ?></td>
			<td><?php echo $user['email_token']; ?></td>
			<td><?php echo $user['email_token_expires']; ?></td>
			<td><?php echo $user['tos']; ?></td>
			<td><?php echo $user['active']; ?></td>
			<td><?php echo $user['last_login']; ?></td>
			<td><?php echo $user['last_action']; ?></td>
			<td><?php echo $user['is_admin']; ?></td>
			<td><?php echo $user['profile_image']; ?></td>
			<td><?php echo $user['role']; ?></td>
			<td><?php echo $user['date']; ?></td>
			<td><?php echo $user['credit']; ?></td>
			<td><?php echo $user['bank_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), null, __('Are you sure you want to delete # %s?', $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
